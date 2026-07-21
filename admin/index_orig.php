<?php
include 'template/header.php';

?>

                    <main id="js-page-content" role="main" class="page-content">
                        <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Practice Range</a></li>
                            <li class="breadcrumb-item">Admin</li>
                            <li class="breadcrumb-item active">Table</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                       
                        <div class="row">
                            <div class="col-xl-12">
                                <div id="panel-1" class="panel">
                                
                                     <div class="alert alert-primary alert-dismissible">
							                            <div class="d-flex flex-start w-100">
							                                <div class="mr-2">
							                                    <span class="icon-stack icon-stack-lg">
							                                        <i class="base-4 icon-stack-3x color-primary-400"></i>
							                                        <i class="base-4 icon-stack-2x color-primary-600 opacity-70"></i>
							                                        <i class="fa fa-calendar-alt icon-stack-1x text-white opacity-90"></i>
							                                    </span>
							                                </div>
							                                <div class="d-flex flex-fill">
							                                    <div class="flex-fill">
																	<form name="qidsearchs" id="qidsearchs">
																	
								                                        <select class="custom-select" name="datereport" id="datereport" required="">
																			<option value="">SELECT PLAY DATE</option>
			                                                                <?php
			                                                            	/* $result=$mysqli->query("select * from tbl_range_sched GROUP BY date_play DESC ORDER BY `id` DESC LIMIT 7"); */
                                                                            $result=$mysqli->query("SELECT DISTINCT id, date_play FROM db_prange1.tbl_range_sched ORDER BY db_prange1.tbl_range_sched.id DESC LIMIT 7");
			                                                            	while($row=mysqli_fetch_assoc($result)){
																				echo '<option value="'.$row['date_play'].'">'.$row['date_play'].'</option>';
																			}
			                                                            	?>
		                                                                
		                                                            	</select>
                                                                    </form>
							                                    </div>
							                                </div>
							                            </div>
							                        </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                        
                                            <!-- datatable start -->
                                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                                <thead class="bg-primary-600">
                                                    <tr>
                                                    	<th>ID</th>
                                                        <th>NAME</th>
                                                        <th>FOLIO NO.</th>
                                                        <th>BAY NO.</th>
                                                        <th>DATE</th>
                                                        <th>TIME IN</th>
                                                        <th>TIME OUT</th>
                                                        <th>PLAYER STATUS</th>
                                                        <th>MONITORING TYPE</th>
                                                        <th>DEPOSIT</th>
                                                        <th>JUNGOLF</th>
                                                        <th>WAMP UP</th>
                                                        <th>SENIOR</th>
                                                        <th>COMPLIMENTARY</th>
                                                        <th>UNLI RANGE</th>
                                                        <th>DATE STAMP</th>
                                                        <th>USER</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
 <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-left">
      <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title h4">New Player</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true"><i class="fal fa-times"></i></span>
            	</button>
          </div>
          <div class="modal-body">
            	 <div id="panel-2" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content p-0">
                                            <form class="needs-validation" id="addvform" novalidate>
                                                <div class="panel-content">
                                                    <div class="form-row">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="validationCustom01">Player Name<span class="text-danger"></span> </label>
                                                            <input type="text" class="form-control" name="pname" id="pname" placeholder="Player name" required>
                                                            <input type="hidden" class="form-control" name="action" id="action" value="add">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                            
                                                            <div class="invalid-feedback">
                                                                Please enter player name.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="validationCustom01">Folio No.<span class="text-danger"></span> </label>
                                                            <input type="text" class="form-control" name="fno" id="fno" placeholder="Folio No." required>
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Please enter folio no.
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="validationCustom03">Bay No. <span class="text-danger"></span></label>
                                                            <select class="custom-select" name="rno" id="rno" required="">
																<option value=""></option>
                                                                <?php
                                                            	$result=$mysqli->query("select * from tbl_bay");
                                                            	while($row=mysqli_fetch_assoc($result)){
																	echo '<option value="'.$row['bayno'].'">'.$row['bayno'].'</option>';
																}
                                                            	?>
                                                                
                                                            </select>
                                                            
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Please enter rack no.
                                                            </div>
                                                        </div>
                                                        <!--<div class="col-md-6 mb-3">
                                                            <label class="form-label" for="validationCustom01">Bay No.<span class="text-danger"></span> </label>
                                                            <input type="text" class="form-control" name="rno" id="rno" placeholder="Bay No." required>
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Please enter rack no.
                                                            </div>
                                                        </div>-->
                                                    </div>
                                                     <div class="form-row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="validationCustom03">Player Status <span class="text-danger"></span></label>
                                                            <select class="custom-select" name="stat" id="stat" required="">
																<option value="MEMBER">MEMBER</option>
																<option value="GUEST">GUEST</option>
                                                            </select>
                                                            
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Please choose player status.
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="validationCustom03">Monitoring Type<span class="text-danger"></span></label>
                                                            <select class="custom-select" name="rev" id="rev" required="">
																<option value="NON-REVENUE">NON-REVENUE</option>
																<option value="REVENUE">REVENUE</option>
                                                            </select>
                                                            
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Please choose monitoring type.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-row">
                                                        <div class="col-md-12 mb-12">
                                                            <label class="form-label" for="validationCustom01">Deposit<span class="text-danger"></span> </label>
                                                            <input type="text" class="form-control" name="deposit" id="deposit" placeholder="Deposit">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Please enter deposit.
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                     <div class="form-row">
                                                        <div class="col-md-4 mb-3">
                                                    		<label class="form-label"></label>
	                                                        <div class="custom-control custom-checkbox mb-3">
		                                                        <input type="checkbox" name="jgolf" class="custom-control-input" id="jungolf" >
		                                                        <label class="custom-control-label" for="jungolf">JUNGOLF</label>
		                                                    </div>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                    		<label class="form-label"></label>
	                                                        <div class="custom-control custom-checkbox mb-3">
		                                                        <input type="checkbox" name="wball"  class="custom-control-input" id="wball" >
		                                                        <label class="custom-control-label" for="wball">WARM UP BALL</label>
		                                                    </div>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                    		<label class="form-label"></label>
	                                                        <div class="custom-control custom-checkbox mb-3">
		                                                        <input type="checkbox" name="smem" class="custom-control-input" id="smem">
		                                                        <label class="custom-control-label" for="smem">SR.MEM</label>
		                                                    </div>
                                                        </div>
                                                    </div>
                                                    
                                                     <div class="form-row">
                                                        <div class="col-md-4 mb-3">
                                                    		<label class="form-label"></label>
	                                                        <div class="custom-control custom-checkbox mb-3">
		                                                        <input type="checkbox" name="compli" class="custom-control-input" id="compli">
		                                                        <label class="custom-control-label" for="compli">COMPLIMENTARY</label>
		                                                    </div>
                                                        </div>
                                                        <div class="col-md-5 mb-3">
                                                    		<label class="form-label"></label>
	                                                        <div class="custom-control custom-checkbox mb-3">
		                                                        <input type="checkbox" name="rrange"  class="custom-control-input" id="rrange" >
		                                                        <label class="custom-control-label" for="rrange">UNLIMITED RANGE</label>
		                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                                    <button class="btn btn-primary ml-auto" type="submit">Submit form</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
          </div>
          <div class="modal-footer">
          </div>
      </div>
    </div>
</div>    

<div id="uploadimage"></div>  
<div id="update"></div>               
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
                    order: [[ 0, "desc" ]],
                    ajax: "rangeres.php",
                    "columnDefs": [
			            {
			                "targets": [ 0 ],
			                "visible": false,
			                "searchable": false
			            }
			        ],
                    dom:
                        /*	--- Layout Structure 
                        	--- Options
                        	l	-	length changing input control
                        	f	-	filtering input
                        	t	-	The table!
                        	i	-	Table information summary
                        	p	-	pagination control
                        	r	-	processing display element
                        	B	-	buttons
                        	R	-	ColReorder
                        	S	-	Select

                        	--- Markup
                        	< and >				- div element
                        	<"class" and >		- div with a class
                        	<"#id" and >		- div with an ID
                        	<"#id.class" and >	- div with an ID and a class

                        	--- Further reading
                        	https://datatables.net/reference/option/dom
                        	--------------------------------------
                         */
                        "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    buttons: [
                        /*{
                        	extend:    'colvis',
                        	text:      'Column Visibility',
                        	titleAttr: 'Col visibility',
                        	className: 'mr-sm-3'
                        },*/
                        {
                            extend: '',
                            text: 'NEW PLAYER',
                            titleAttr: 'Add Document',
                            className: 'btn-outline-info btn-sm mr-1',
			                action: function ( e, dt, node, config ) {
								$('#addmodal').modal('show');
			                }
                        }
                        <?php
                        if($_SESSION['login_userlevel']=='ADMINISTRATOR'){
                        ?>,
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            titleAttr: 'Generate PDF',
                            className: 'btn-outline-danger btn-sm mr-1'
                        },
                        {
                            extend: 'copyHtml5',
                            text: 'Copy',
                            titleAttr: 'Copy to clipboard',
                            className: 'btn-outline-primary btn-sm mr-1'
                        }<?php } ?>,
                        {
                            extend: 'print',
                            text: 'Print',
                            titleAttr: 'Print Table',
                            className: 'btn-outline-primary btn-sm'
                        }
                    ]
                });

            });
               (function()
                    {
                       'use strict';
                       window.addEventListener('load', function()
                     {
                    	var forms = document.getElementsByClassName('needs-validation');
                        var validation = Array.prototype.filter.call(forms, function(form)
                        {
                        	form.addEventListener('submit', function(event)
                            {
                            	if (form.checkValidity() === false)
                                    {
                                    	event.preventDefault();
                                        event.stopPropagation();
                                                                   
                                    }			          
                                    form.classList.add('was-validated');
                                    $.ajax({
										url: 'rangeprocess.php',
										type: "POST",
										data: $(forms).serialize(),
										success: function(data) {
											if(data=='success'){
												Swal.fire(
													{
														position: "top-end",
														type: "success",
														title: "Player successfully save..",
														showConfirmButton: false,
														timer: 4000
														});
												
												$('#addmodal').modal('hide');
						          				document.getElementById("addvform").reset();
						          				$("#dt-basic-example").DataTable().ajax.reload();
												}
											else{
												Swal.fire(
													{
														position: "top-end",
														type: "error",
														title: "Please check input",
														showConfirmButton: false,
														timer: 3500
													});
												}
											}            
										});
                                    	event.preventDefault();
                                        event.stopPropagation();
                                }, false);
                            });
                        }, false);
                    })();

		function deletes(id)
		{
			Swal.fire(
                    {
                        title: "Are you sure?",
                        type: "warning",
                        input: "text",
                        showCancelButton: true,
                        confirmButtonText: "Yes, Delete it!"
                    }).then(function(result)
                    {
                    	
                        if (result.value)
                        {
                        	$.ajax({
								url:'rangeprocess.php', 
								data:'id='+id+'&&action=delete&&del='+result.value,
								type:'post',
								success  : function(data) {
									$("#dt-basic-example").DataTable().ajax.reload();
								}
							});
                            Swal.fire("Delete!", "Transaction successfully deleted.", "success");
                        }else{
                            Swal.fire("Delete!", "Please input remarks to delete this transaction.", "error");
						}
                    });
			
		}
		
		function edit(id)
		{
			$.ajax({
				url:'update.php', 
				data:'id='+id,
				type:'post',
				success  : function(data) {
		        	$("#update").html(data)	
					$('#sampleupdate').modal('show');
				}
			});
		}
		
		
		function signout(id)
		{
				Swal.fire(
                    {
                        title: "Are you sure?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, Proceed to signout!"
                    }).then(function(result)
                    {
                        if (result.value)
                        {
                        	$.ajax({
								url:'rangeprocess.php', 
								data:'id='+id+' & action=signout',
								type:'post',
								success  : function(data) {
									$("#dt-basic-example").DataTable().ajax.reload();
								}
							});
                            Swal.fire("Signout!", "Player successfully signout.", "success");
                        }
                    });
			
			
		}
		  $("[name='datereport']").on('change', function() {
		    var url = "rangeres.php";
		    $.ajax({
		      type: "GET",
		      url: url,
		      data: $("#qidsearchs").serialize(),
		      success: function(data) {
		      	$("#dt-basic-example").DataTable().ajax.reload();
		      }
		    });
		  });
        </script>
        