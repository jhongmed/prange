<?php
session_start();
if (isset($_GET['datereport'])) {
	$_SESSION['datereport'] = $_GET['datereport'];
}

include 'dbconnection.php';

$table = 'datatable_range_sched';
$primaryKey = 'id';
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');

$columns = array(
	array('db' => 'id', 'dt' => 0),
	array('db' => 'name', 'dt' => 1),
	array('db' => 'rack_no', 'dt' => 2),
	array('db' => 'folio_no', 'dt' => 3),
	array('db' => 'status1', 'dt' => 4),
	array('db' => 'time_in', 'dt' => 5),
	array('db' => 'time_out', 'dt' => 6),
	array('db' => 'total_hrs', 'dt' => 7),
	array('db' => 'bucket_used', 'dt' => 8),
	array('db' => 'prange_charges', 'dt' => 9),
	array('db' => 'pr_quantity', 'dt' => 10),
	array('db' => 'regular_amount', 'dt' => 11),
	array('db' => 'jungolf', 'dt' => 12),
	array('db' => 'warmup', 'dt' => 13),
	array('db' => 'senior', 'dt' => 14),
	array('db' => 'complimentary', 'dt' => 15),
	array('db' => 'FED', 'dt' => 16),

	//heres' the old index
	// array('db' => 'unlirange', 'dt' => 16),
	// array('db' => 'pr_amount', 'dt' => 17), // TOTAL moved here
	// array('db' => 'revenue', 'dt' => 18),
	// array('db' => 'date_stamp', 'dt' => 19),
	// array('db' => 'user', 'dt' => 20)

	array('db' => 'unlirange', 'dt' => 17),
	array('db' => 'pr_amount', 'dt' => 18), // TOTAL moved here
	array('db' => 'revenue', 'dt' => 19),
	array('db' => 'date_stamp', 'dt' => 20),
	array('db' => 'user', 'dt' => 21)
);

$sql_details = array(
	'user' => 'root',
	'pass' => '',
	'db'   => 'db_prange1',
	'host' => '128.168.64.26'
);

require('ssp.class.php');

// Custom filter by date
if (isset($_SESSION['datereport'])) {
	$date1 = $_SESSION['datereport'];
	if ($date1 == '') {
		$output = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null, "status!='DELETED' and date_play='$date'");
	} else {
		$output = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null, "status!='DELETED' and date_play='$date1'");
	}
} else {
	$output = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null, "status!='DELETED' and date_play='$date'");
}

// Process each row
foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	$result = $mysqli->query("SELECT * FROM tbl_range_sched WHERE id='$id'");
	$row = mysqli_fetch_assoc($result);

	// Format total hours
	$output['data'][$i][7] = isset($output['data'][$i][7]) ? number_format($output['data'][$i][7], 2, '.', ',') : '';

	// Format REGULAR amount
	$output['data'][$i][11] = '<p class="text-right">' . number_format($row['regular_amount'], 2) . '</p>';

	// Reset category columns
	$output['data'][$i][12] = ''; // JUNGOLF
	$output['data'][$i][13] = ''; // WARMUP
	$output['data'][$i][14] = ''; // SENIOR
	$output['data'][$i][15] = ''; // COMPLIMENTARY
	$output['data'][$i][16] = ''; // FED
	$output['data'][$i][17] = ''; // UNLI RANGE

	// Fill category amounts
	if ($row['jungolf'] == 'on' || $row['jungolf'] == 1) {
		$output['data'][$i][12] = '<p class="text-right">' . number_format($row['pr_amount'], 2) . '</p>';
	}
	if ($row['warmup'] == 'on' || $row['warmup'] == 1) {
		$output['data'][$i][13] = '<p class="text-right">' . number_format($row['pr_amount'], 2) . '</p>';
	}
	if ($row['senior'] == 'on' || $row['senior'] == 1) {
		$output['data'][$i][14] = '<p class="text-right">' . number_format($row['pr_amount'], 2) . '</p>';
	}
	if ($row['complimentary'] == 'on' || $row['complimentary'] == 1) {
		$output['data'][$i][15] = '<p class="text-right">' . number_format($row['pr_amount'], 2) . '</p>';
	}
	if ($row['FED'] == 'on' || $row['FED'] == 1) {
		$output['data'][$i][16] = '<p class="text-right">' . number_format($row['pr_amount'], 2) . '</p>';
	}
	if ($row['unlirange'] == 'on' || $row['unlirange'] == 1) {
		$output['data'][$i][17] = '<p class="text-right">' . number_format($row['pr_amount'], 2) . '</p>';
	}

	// TOTAL after UNLI RANGE
	$output['data'][$i][18] = '<p class="text-right">' . number_format($row['pr_amount'], 2) . '</p>';

	// Action buttons
	if ($row['time_out'] == NULL) {
		if ($_SESSION['login_username'] == "admin" || $_SESSION['login_username'] == "rico") {
			$output['data'][$i][22] = '<button type="button" class="btn btn-info btn-sm" title="Edit transaction" onclick="edit(' . $id . ')"><i class="fa-2x fas fa-pencil"></i></button>
                <button type="button" class="btn btn-info btn-sm" title="Time Out" onclick="signout(' . $id . ')"><i class="fa-2x fas fa-sign-out-alt"></i></button>
                <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="deletes(' . $id . ')"><i class="fa-2x fas fa-trash-alt"></i></button>';
		} else {
			$output['data'][$i][22] = '<button type="button" class="btn btn-info btn-sm" title="Time Out" onclick="signout(' . $id . ')"><i class="fa-2x fas fa-sign-out-alt"></i></button>
                <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="deletes(' . $id . ')"><i class="fa-2x fas fa-trash-alt"></i></button>';
		}
	} else {
		$output['data'][$i][22] = 'PLAYER CHECKOUT';
	}
}

// COUNT MEMBER & GUEST
$dateToCheck = isset($date1) && $date1 != '' ? $date1 : $date;
$countQuery = "
    SELECT status1, COUNT(*) as total 
    FROM tbl_range_sched 
    WHERE status!='DELETED' 
    AND date_play='$dateToCheck'
    GROUP BY status1
";
$countResult = $mysqli->query($countQuery);

$memberCount = 0;
$guestCount = 0;
while ($rowCount = mysqli_fetch_assoc($countResult)) {
	if ($rowCount['status1'] == 'MEMBER') $memberCount = $rowCount['total'];
	if ($rowCount['status1'] == 'GUEST') $guestCount = $rowCount['total'];
}

// ADD TO OUTPUT
$output['memberTotal'] = $memberCount;
$output['guestTotal'] = $guestCount;

// RETURN JSON
echo json_encode($output);
