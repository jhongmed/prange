<?php
$mysqli = new mysqli("128.168.64.26", "prangedb", "OrchardM!S2024", "db_prange1", 3306);
if($mysqli->connect_errno){
	echo "Failed to connect:(" .$mysqli->connect_errno. ")".$mysqli->connect_error;
}

// SQL Server connection (CMSSQL) via DSN
try {
	$sqlsrvConn = new PDO("odbc:CMSSQL64", "mis-admin", "OrchardM1S2024");
	$sqlsrvConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Failed to connect to CMSSQL: " . $e->getMessage();
}
?>