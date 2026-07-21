<?php
	if(isset($_SESSION['login_id'])){
		
    	if($_SESSION['login_userlevel']!='AUDIT'){
    		header("location:admin/report.php");
		}else{
			header("location:admin/index.php?p=DASHBOARD");
		}
			
	}
?>