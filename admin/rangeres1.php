<?php
session_start();
if(isset($_GET['datereport'])){
	$_SESSION['datereport']=$_GET['datereport'];
}
include 'dbconnection.php';
$table = 'tbl_range_sched';
$primaryKey = 'id';
date_default_timezone_set('Asia/Manila');
$date=date('m/d/Y');
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'name', 'dt' => 1 ),
    array('db' => 'folio_no', 'dt'=> 2),
    array('db' => 'rack_no', 'dt'=> 3),
    array('db' => 'date_play', 'dt'=> 4),
    array('db' => 'time_in', 'dt'=> 5),
    array('db' => 'time_out', 'dt'=> 6),
    array('db' => 'status1', 'dt'=> 7),
    array('db' => 'revenue', 'dt'=> 8),
    array('db' => 'deposit', 'dt'=> 9),
    array('db' => 'jungolf', 'dt'=> 10),
    array('db' => 'warmup', 'dt'=> 11),
    array('db' => 'senior', 'dt'=> 12),
    array('db' => 'complimentary', 'dt'=> 13),
    array('db' => 'unlirange', 'dt'=> 14),
    array('db' => 'date_stamp', 'dt'=> 15),
    array('db' => 'user', 'dt'=> 16)
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'db_prange1',
    'host' => '128.168.64.26'
);

require( 'ssp.class.php' );
 	//for no buttons only
// echo json_encode(
   // SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
    
    //For custom where queries
    //SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"id='3'" )
// );
if(isset($_SESSION['datereport'])){
	$date1=$_SESSION['datereport'];
	if($date1==''){
		$output= SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"status!='DELETED'  and date_play='$date'");
	}else{
		$output= SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"status!='DELETED'  and date_play='$date1'");
	}
}else{
	$output= SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"status!='DELETED'  and date_play='$date'");
}
//$output= SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"status!='DELETED'  ");
	foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	
		$result=$mysqli->query("select * from tbl_range_sched where id='$id'");
		$row=mysqli_fetch_assoc($result);
		if($row['jungolf']=='on'){
			$output['data'][$i][10]=$row['status1'];
		}
		if($row['warmup']=='on'){
			$output['data'][$i][11]=$row['status1'];
		}
		if($row['senior']=='on'){
			$output['data'][$i][12]=$row['status1'];
		}
		if($row['complimentary']=='on'){
			$output['data'][$i][13]=$row['status1'];
		}
		if($row['unlirange']=='on'){
			$output['data'][$i][14]=$row['status1'];
		}
		if($row['time_out']==''){
			$output['data'][$i][17] = 'PLAYER CHECKIN';
		}else{
			$output['data'][$i][17] = 'PLAYER CHECKOUT';
		}
	}
echo json_encode(	
	$output
);
