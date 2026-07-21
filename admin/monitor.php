<?php
include 'template/header2.php';
?>
    <main id="js-page-content" role="main" class="page-content">
        <ol class="breadcrumb page-breadcrumb">
            <li class="position-absolute pos-top pos-center d-none d-sm-block"> <strong><h1><img src="img\orchard-logo.gif" class="rounded" alt="Orchard Golf"><span class="text-green">The Orchard Golf and Country Club - Practice Range</span> </h1></strong></li>
            <li class="position-absolute pos-top pos-right d-none d-sm-block"> <strong><h3><span class="text-gradient"><?php 
                                                date_default_timezone_set('Asia/Manila');
                                                echo $date1=date('l jS \of F Y'); ?></h3></strong></li>
        </ol>
        <hr/>
        <hr/>
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start - defining column headers -->
                            <div id="tableHolder">
                            <table id="dt-basic-examples" class="table table-bordered table-hover table-striped w-100 ">
                                <thead class="bg-success">
                                    <tr>
                                    <?php
                                        $result= $mysqli->query("select * from tbl_bay");
                                        while($row=mysqli_fetch_assoc($result)){
                                            ?>
                                            <th>BAY NO. <h2><?php echo $row['bayno'] ?></h2></th>
                                            <?php
                                        }
                                    ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                            $result= $mysqli->query("select * from tbl_bay");
                                            while($row=mysqli_fetch_assoc($result)){
                                                $bid=$row['bayno'];
                                                ?>
                                                <td>
                                                <?php
                
                                                date_default_timezone_set('Asia/Manila');
                                                $date=date('Y-m-d');
                                                $result1= $mysqli->query("select * from tbl_range_sched where time_out is NULL and rack_no='$bid' and date_play='$date' and status !='DELETED' order by id desc limit 5");
                                                while($row1=mysqli_fetch_assoc($result1)){ ?>
                                                        <div class="alert border <?php if($row1['time_out']==NULL){ echo 'border-danger';}else{ echo 'border-success'; } ?>  bg-transparent text-primary" role="alert">
                                                        <strong><?php echo $row1['name'] ?></strong> <br/>TIME IN: &nbsp; &nbsp;<?php echo $row1['time_in'] ?> <br/>TIME OUT : 
                                                            <?php if($row1['time_out']==NULL){ 
                                                                echo 'NOW PLAYING (';
                                                                $targetDate = strtotime($row1['target_out']);
                                                                $timeRemaining = timeRemaining($targetDate);
                                                                echo $timeRemaining. ' REMAINING )';
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
                                        $result= $mysqli->query("select * from tbl_bay");
                                        while($row=mysqli_fetch_assoc($result)){
                                            ?>
                                            <th>BAY NO. <?php echo $row['bayno'] ?></th>
                                            <?php
                                        }
                                    ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                            $result= $mysqli->query("select * from tbl_bay");
                                            while($row=mysqli_fetch_assoc($result)){
                                                $bid=$row['bayno'];
                                                ?>
                                                <td>
                                                <?php
                
                                                date_default_timezone_set('Asia/Manila');                              	
                                                $date=date('Y-m-d');
                                                $result1= $mysqli->query("select * from tbl_range_sched where rack_no='$bid' and date_play='$date'  and status !='DELETED' order by id desc limit 5");
                                                while($row1=mysqli_fetch_assoc($result1)){ ?>
                                                        <div class="alert border <?php if($row1['time_out']==NULL){ echo 'border-danger';}else{ echo 'border-success'; } ?>  bg-transparent text-primary" role="alert">
                                                <small> <strong><?php echo $row1['name'] ?></strong> <br/>TIME IN: &nbsp; &nbsp;<?php echo $row1['time_in'] ?> <br/>TIME OUT: 
                                                    <?php if($row1['time_out']==NULL){ 
                                                        echo 'NOW PLAYING (';
                                                        $targetDate = strtotime($row1['target_out']);
                                                        $timeRemaining = timeRemaining($targetDate);
                                                        echo $timeRemaining. ' REMAINING )';
                                                    }else{
                                                        echo $row1['time_out']; 
                                                    } 
                                                    
                                                    ?>
                                                </small>
                                </div>
                                                <?php }
                                                ?></td>
                                                <?php
                                            }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>        
<?php 
include 'template/footer.php';
?>

        <script>
            $(document).ready(function()
            {

                // initialize datatable
                $('#dt-basic-example').dataTable(
                {
                    responsive: true,
                    lengthChange: false,
                    serverSide: true,
                    ajax: "monitorres.php",
                    searching: false,
                });
                

     		 refreshTable();
            });
		    function refreshTable(){
		        $('#tableHolder').load('getTable.php', function(){
		           setTimeout(refreshTable, 5000);
		        });
		    }
        </script>
        