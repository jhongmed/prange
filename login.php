<?php
include("admin/dbconnection.php");
session_start();
if(isset($_GET['p'])){
	$username=mysqli_real_escape_string($mysqli,$_GET['u']);
	$password=mysqli_real_escape_string($mysqli,$_GET['p']);
	$result=$mysqli->query("select * from tbl_user where username='$username' and password='$password'")or die("asd");
	
	//dd($result);
	$row=mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$id=$row['id'];
			if($row['userstat']=='on'){
					$_SESSION['login_id']=$row['id'];
					$_SESSION['login_username']=$row['username'];
					$_SESSION['user_name']=$row['fname'].' '.$row['mname'].' '.$row['lname'];
					$_SESSION['login_userlevel']=$row['userlvl'];
					$level=$_SESSION['login_userlevel'];
					$name=$_SESSION['login_username'];
					$action='Login';
					$details='Logging in';
					$status='Successful';
					$mysqli->query("insert into tbl_logs(name,action,details,status) value ('$name','$action','$details','$status')");
					if($level=='AUDIT'){
						
					echo 'success1';
					}else{
					echo 'success';
					}
			}else{
				echo 'failed2';
			}
		}else{
			echo 'failed';
		}
	}
?>