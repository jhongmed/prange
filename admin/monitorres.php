<?php
include 'dbconnection.php';
$table = 'tbl_range_sched';
$primaryKey = 'id';
 

$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'name', 'dt' => 1 ),
    array('db' => 'folio_no', 'dt'=> 2),
    array('db' => 'rack_no', 'dt'=> 3),
    array('db' => 'date_play', 'dt'=> 4),
    array('db' => 'time_in', 'dt'=> 5),
    array('db' => 'time_out', 'dt'=> 6),
    array('db' => 'date_stamp', 'dt'=> 7)
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

$output= SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns,null,"status!='DELETED'");
	foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
    }

echo json_encode(	
	$output
);
