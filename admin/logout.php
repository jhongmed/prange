<?php
session_start();
include 'dbconnection.php';

					$name=$_SESSION['orchard_consumable_username'];
					$action='Logout';
					$details='Logout Account';
					$status='Successful';
					$mysqli->query("insert into tbl_logs(name,action,details,status) value ('$name','$action','$details','$status')");
session_destroy();
header('location:index.php');
?>