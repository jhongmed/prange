<?php
session_start();
include 'dbconnection.php';

	date_default_timezone_set('Asia/Manila');
	$date=date('Y-m-d');

	function timeRemaining($targetDate, $currentTime = null) {
		if ($currentTime === null) {
		  $currentTime = time();
		}
	  
		$diff = $targetDate - $currentTime;
	  
		$days = floor($diff / (60 * 60 * 24));
		$hours = floor(($diff % (60 * 60 * 24)) / (60 * 60));
		$minutes = floor(($diff % (60 * 60)) / 60);
		$seconds = $diff % 60;
	  
		$timeRemaining = '';
	  
		if ($days > 0) {
		  $timeRemaining.= "$days day(s), ";
		}
	  
		if ($hours > 0) {
		  $timeRemaining.= "$hours hour(s), ";
		}
	  
		if ($minutes > 0) {
		  $timeRemaining.= "$minutes minute(s) ";
		}
	  
		/* $timeRemaining.= "$seconds seconds"; */
	  
		return $timeRemaining;
	  }



?>
<table id="dt-basic-examples" class="table table-bordered table-hover table-striped w-100">
	<thead class="bg-success">
		<tr>
		<?php
			$result= $mysqli->query("select * from tbl_bay where bayno <=10");
			while($row=mysqli_fetch_assoc($result)){
				?>
				<th class="text-lg">BAY NO. <span class="fw-bold text-lg text-white"><?php echo $row['bayno'] ?></span></th>
				<?php
			}
		?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
				$result= $mysqli->query("select * from tbl_bay  where bayno <=10");
				while($row=mysqli_fetch_assoc($result)){
					$bid=$row['bayno'];
					?>
					<td>
					<?php

					date_default_timezone_set('Asia/Manila');                              	
					$date=date('Y-m-d');
					$result1= $mysqli->query("select * from tbl_range_sched where  time_out is NULL and rack_no='$bid' and date_play='$date'  and status !='DELETED' order by id desc limit 5");
					while($row1=mysqli_fetch_assoc($result1)){ ?>
							<div class="alert border <?php if($row1['time_out']==''){ echo 'border-danger';}else{ echo 'border-success'; } ?>  bg-danger text-white" role="alert">
							<div class="text-white bg-dark text-center"><h2><?php echo $row1['name'] ?></h2>  </div>TIME IN: &nbsp; &nbsp;<?php echo $row1['time_in'] ?> <br/>TIME OUT: 
								<?php if($row1['time_out']==NULL){ 
										echo 'NOW PLAYING <br/>';
										$targetDate = strtotime($row1['target_out']);
										$timeRemaining = timeRemaining($targetDate);
										if ($timeRemaining == '') {
											echo '<div class="text-center text-black bg-warning"><h3> Time is Up </h3></div>';
										} else {
											echo '<div class="text-center text-white bg-primary"><h3>'.$timeRemaining. ' left </h3></div>';	
										}
									}else{
										echo $row1['time_out']; 
									} 
								?>
							</div>
					<?php }
					?></td>
					<?php
				}
			?>
		</tr>
	</tbody>
</table>

<br/>
<br/>
<br/>
	<table id="dt-basic-examples" class="table table-bordered table-hover table-striped w-100">
	<thead class="bg-success">
		<tr>
		<?php
			$result= $mysqli->query("select * from tbl_bay where bayno >10");
			while($row=mysqli_fetch_assoc($result)){
				?>
				<th class="text-lg">BAY NO. <span class="fs-1 fw-bolder float-end text-lg text-white"><?php echo $row['bayno'] ?></span></th>
				<?php
			}
		?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
				$result= $mysqli->query("select * from tbl_bay  where bayno  >10");
				while($row=mysqli_fetch_assoc($result)){
					$bid=$row['bayno'];
					?>
					<td>
					<?php

					date_default_timezone_set('Asia/Manila');                              	
					$date=date('Y-m-d');
					$result1= $mysqli->query("select * from tbl_range_sched where  time_out is NULL and rack_no='$bid' and date_play='$date'  and status !='DELETED' order by id desc limit 5");
					while($row1=mysqli_fetch_assoc($result1)){ ?>
							<div class="alert border <?php if($row1['time_out']==''){ echo 'border-danger';}else{ echo 'border-success'; } ?>  bg-danger text-white" role="alert">
							<div class="text-white bg-dark text-center"><h2><?php echo $row1['name'] ?></h2>  </div>TIME IN: &nbsp; &nbsp;<?php echo $row1['time_in'] ?> <br/>TIME OUT: 
								<?php if($row1['time_out']==NULL){ 
										echo 'NOW PLAYING <br/>';
										$targetDate = strtotime($row1['target_out']);
										$timeRemaining = timeRemaining($targetDate);
										if ($timeRemaining == '') {
											echo '<div class="text-center text-black bg-warning"><h3> Time is Up </h3></div>';
										} else {
											echo '<div class="text-center text-white bg-primary"><h3>'.$timeRemaining. ' left </h3></div>';	
										}
									}else{
										echo $row1['time_out']; 
									} 
								?>
							</div>
					<?php }
					?></td>
					<?php
				}
			?>
		</tr>
	</tbody>
</table>