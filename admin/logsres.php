<?php
include 'dbconnection.php';
$table = 'tbl_logs';
$primaryKey = 'id';
 
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'name', 'dt' => 1 ),
    array('db' => 'action', 'dt'=> 2),
    array('db' => 'details', 'dt'=> 3),
    array('db' => 'status', 'dt'=> 4),
    array('db' => 'datetime', 'dt'=> 5)
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'prangedb',
    'pass' => 'OrchardM!S2024',
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

$output= SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
	foreach ($output['data'] as $i => $d) {
	$id = $output['data'][$i][0];
	
	}
echo json_encode(	
	$output
);
