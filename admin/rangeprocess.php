<?php
session_start();
include 'dbconnection.php';

/* =========================
   SQL Server connection (CMSSQL) via DSN
   Established once here so it's available to any action block that needs
   a live folio lookup against SQL Server (currently used by 'add').
========================= */
try {
	$sqlsrvConn = new PDO("odbc:CMSSQL64", "mis-admin", "OrchardM1S2024");
	$sqlsrvConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// Normalize returned column keys to uppercase, since some ODBC drivers
	// return column names in a case that doesn't match how they were written
	// in the SELECT (e.g. always uppercase regardless of source casing).
	$sqlsrvConn->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
} catch (PDOException $e) {
	error_log("Failed to connect to CMSSQL: " . $e->getMessage());
	$sqlsrvConn = null; // Allow the page to continue; folio lookup will fail gracefully below
}

/* =========================
   Logging Function
========================= */
function logAction($mysqli, $action, $details)
{
	$name = $_SESSION['login_username'];
	$broker = 'Successful';
	$sql = "INSERT INTO tbl_logs(name, action, details, status) 
            VALUES ('$name', '$action', '$details', '$broker')";
	if (!$mysqli->query($sql)) {
		error_log("Logging Error: " . $mysqli->error); // Log silently to server error log
	}
}

/* =========================
   ADD NEW PLAYER
========================= */
if ($_POST['action'] == 'add') {

	date_default_timezone_set('Asia/Manila');
	$fno = $_POST['fno'];

	if (isset($_POST['pname']) && !empty($_POST['pname'])) {
		// Player name was supplied directly on the form; use it as-is.
		$pname = strtoupper($_POST['pname']);
	} else {
		// No name supplied — look up the folio holder's name from SQL Server
		// by folio number. Filtered the same way the FoxPro sync does
		// (open status, member/group category) so we only match live folios.
		$pname = "Not Found or Empty.";

		if ($sqlsrvConn !== null) {
			try {
				$sql = "SELECT Folfoli0.FOLINO, Folfoli0.FOLI_NAME " .
				       "FROM dbo.FOLFOLI0 Folfoli0 " .
				       "WHERE Folfoli0.FOLINO = ? " .
				       "AND Folfoli0.FOLI_STAT = 'O' " .
				       "AND Folfoli0.FOLI_CG IN ('M','G')";

				$stmt = $sqlsrvConn->prepare($sql);
				$stmt->execute([$fno]);
				$folioRow = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($folioRow && !empty(trim($folioRow['FOLI_NAME']))) {
					// RTRIM-equivalent in PHP, since fixed-length source columns
					// may carry trailing padding depending on how they were typed
					// during the MySQL -> SQL Server migration.
					$pname = strtoupper(trim($folioRow['FOLI_NAME']));
				}
			} catch (PDOException $e) {
				error_log("Folio lookup error (folino=$fno): " . $e->getMessage());
				// $pname stays "Not Found or Empty." — page continues normally.
			}
		}
	}

	$rno = $_POST['rno'];
	$timein = date('H:i:s');
	$date = date('Y-m-d');
	$status = $_POST['stat'];
	$rev = $_POST['rev'];

	$deposit = $_POST['deposit'] ?? '';
	$jgolf = $_POST['jgolf'] ?? '';
	$wball = $_POST['wball'] ?? '';
	$smem = $_POST['smem'] ?? '';
	$compli = $_POST['compli'] ?? '';
	$FED = $_POST['FED'] ?? '';



	$rrange = $_POST['rrange'] ?? '';

	$bucket_used = $_POST['noofbucket'] ?? 0;
	$pr_quantity = intval($_POST['pr_quantity'] ?? 0);

	$pr_chargesid = $_POST['pr_charges'] ?? '';
	$pr_charges = '';
	$pr_amount = 0;
	$pr_target_out = null;

	if (!empty($pr_chargesid)) {
		$result = $mysqli->query("SELECT * FROM tbl_charges WHERE prange_chargesid='$pr_chargesid'");
		if (!$result) die("DB Error: " . $mysqli->error);
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$unitprice = floatval($row['prange_unitprice']);
			$allotedTime = intval($row['prange_allotedtime']);
			$pr_charges = strtoupper($row['prange_charges']) . ' - Php ' . $unitprice;
			$pr_amount = $pr_quantity * $unitprice;

			$pr_target_out = date('H:i:s', strtotime($timein) + ($allotedTime * 60 * $pr_quantity));
		} else {
			$pr_chargesid = '';
		}
	}

	// Check bay availability
	$check = $mysqli->query("SELECT * FROM tbl_range_sched WHERE date_play='$date' AND rack_no='$rno' AND status!='DELETED' AND time_out IS NULL");
	if (!$check) die("DB Error: " . $mysqli->error);
	if (mysqli_num_rows($check) > 0) {
		echo 'Bay No.' . $rno . ' is Not Available';
		die();
	}

	// Default regular_amount
	$regular_amount = (empty($deposit) && empty($jgolf) && empty($wball) && empty($smem) && empty($compli) && empty($FED) && empty($rrange))
		? $pr_amount : 0;

	$sql = "INSERT INTO tbl_range_sched
(name, folio_no, rack_no, time_in, date_play, status1, revenue, deposit, jungolf, warmup, senior, complimentary, FED,  unlirange, user,
 prange_chargesid, prange_charges, pr_quantity, pr_amount, bucket_used, target_out, regular_amount)
VALUES
('$pname','$fno','$rno','$timein','$date','$status','$rev','$deposit','$jgolf','$wball','$smem','$compli','$FED','$rrange','{$_SESSION['login_username']}',
 '$pr_chargesid','$pr_charges','$pr_quantity','$pr_amount','$bucket_used','$pr_target_out','$regular_amount')";

	if (!$mysqli->query($sql)) die("DB Insert Error: " . $mysqli->error);

	logAction($mysqli, 'Added', "{$_SESSION['login_username']} successfully added ($pname / $fno / $rno / $timein) in the range schedule table.");
	echo 'success';
}

/* =========================
   SIGNOUT WITH AUTO OVERTIME AND 15 MINS GRACE PERIOD
========================= */ else if ($_POST['action'] == 'signout') {

	date_default_timezone_set('Asia/Manila');
	$id = $_POST['id'];
	$timeout = date('H:i:s');

	$result = $mysqli->query("SELECT * FROM tbl_range_sched WHERE id='$id'");
	if (!$result) die("DB Error: " . $mysqli->error);
	$row = mysqli_fetch_assoc($result);

	$pname = $row['name'];
	$timein = $row['time_in'];
	$pr_quantity = floatval($row['pr_quantity']);
	$prange_chargesid = $row['prange_chargesid'];

	$charge = $mysqli->query("SELECT * FROM tbl_charges WHERE prange_chargesid='$prange_chargesid'");
	$chargeRow = mysqli_fetch_assoc($charge);
	$unitprice = floatval($chargeRow['prange_unitprice']);
	$allotedTime = intval($chargeRow['prange_allotedtime']);

	$minutesPlayed = (strtotime($timeout) - strtotime($timein)) / 60;
	$originalMinutes = $allotedTime * $pr_quantity;
	$excess = $minutesPlayed - $originalMinutes;

	$newQuantity = $pr_quantity;
	if ($excess > 15) {
		if ($allotedTime == 60) $newQuantity += ceil(($excess - 15) / 30) * 0.5;
		else if ($allotedTime == 30) $newQuantity += ceil(($excess - 15) / 30);
		else $newQuantity += ceil(($excess - 15) / $allotedTime);
	}

	$newAmount = $newQuantity * $unitprice;
	// $regular_amount = (empty($row['jungolf']) && empty($row['warmup']) && empty($row['senior']) && empty($row['complimentary']) && empty($row['unlirange']))
	// 	? $newAmount : 0;

	//ADDED FED HERE
	$regular_amount = (
		empty($row['jungolf']) &&
		empty($row['warmup']) &&
		empty($row['senior']) &&
		empty($row['complimentary']) &&
		empty($row['FED']) && // <-- dito na, after complimentary
		empty($row['unlirange'])
	)
		? $newAmount : 0;

	$sql = "UPDATE tbl_range_sched SET time_out='$timeout', pr_quantity='$newQuantity', pr_amount='$newAmount', regular_amount='$regular_amount' WHERE id='$id'";
	if (!$mysqli->query($sql)) die("DB Update Error: " . $mysqli->error);

	logAction($mysqli, 'Signout', "{$_SESSION['login_username']} successfully signed out ($pname / $timeout) in the range schedule table.");
	echo 'success';
}

/* =========================
   EDIT
========================= */ else if ($_POST['action'] == 'edit') {

	$id = $_POST['id'];
	$rno = $_POST['rno'];
	$status = $_POST['stat'];
	$rev = $_POST['rev'];

	$deposit = $_POST['deposit'] ?? '';
	$jgolf = $_POST['jgolf'] ?? '';
	$wball = $_POST['wball'] ?? '';
	$smem = $_POST['smem'] ?? '';
	$compli = $_POST['compli'] ?? '';
	$FED = $_POST['FED'] ?? '';

	$rrange = $_POST['rrange'] ?? '';

	$bucket_used = $_POST['noofbucket'] ?? 0;
	$pr_quantity = intval($_POST['pr_quantity'] ?? 0);

	$pr_chargesid = $_POST['pr_charges'] ?? '';
	$pr_charges = '';
	$pr_amount = 0;

	if (!empty($pr_chargesid)) {

		$result = $mysqli->query("SELECT * FROM tbl_charges WHERE prange_chargesid='$pr_chargesid'");
		$row = mysqli_fetch_assoc($result);
		$unitprice = floatval($row['prange_unitprice']);
		$pr_charges = strtoupper($row['prange_charges']) . ' - Php ' . $unitprice;
		$pr_amount = $pr_quantity * $unitprice;
	}
	// Recompute regular_amount
	$regular_amount = (empty($deposit) && empty($jgolf) && empty($wball) && empty($smem) && empty($compli) && empty($FED) && empty($rrange))
		? $pr_amount
		: 0;

	$sql = "UPDATE tbl_range_sched SET
    rack_no='$rno', 
    status1='$status', 
    revenue='$rev', 
    deposit='$deposit', 
    jungolf='$jgolf',
    warmup='$wball', 
    senior='$smem', 
    complimentary='$compli', 
	FED='$FED', 
    unlirange='$rrange', 
    bucket_used='$bucket_used',
    prange_chargesid='$pr_chargesid', 
    prange_charges='$pr_charges', 
    pr_quantity='$pr_quantity', 
    pr_amount='$pr_amount',
    regular_amount='$regular_amount'
    WHERE id='$id'";
	if (!$mysqli->query($sql)) die("DB Update Error: " . $mysqli->error);

	logAction($mysqli, 'Edit', "{$_SESSION['login_username']} successfully edited record ID $id in the range schedule table.");
	echo 'success';
}

/* =========================
   DELETE
========================= */ else if ($_POST['action'] == 'delete') {

	$id = $_POST['id'];
	$del = $_POST['del'];

	$sql = "UPDATE tbl_range_sched SET status='DELETED', remarks='$del' WHERE id='$id'";
	if (!$mysqli->query($sql)) die("DB Update Error: " . $mysqli->error);

	logAction($mysqli, 'Deleted', "{$_SESSION['login_username']} successfully deleted record ID $id with remarks ($del) in the range schedule table.");
	echo 'success';
}
