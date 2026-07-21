<?php
include 'dbconnection.php';
$id=$_POST['id'];
$ttype=$_POST['ttype'];
$tdate=$_POST['tdate'];
$mysqli->query("update tbl_trasaction set t_type_id='$ttype', trans_date='$tdate' where id='$id' ");

   
				         $name    = $_SESSION['login_username'];
				         $action  = 'UPDATE';
				         $details = $name . ' successfully update (' . $id . ' / ' . $ttype . ' / ' . $tdate . ') in the transaction table.';
				         $broker  = 'Successful';
				         $mysqli->query("insert into tbl_logs(name,action,details,status) value ('$name','$action','$details','$broker')");
echo 'success';
?>