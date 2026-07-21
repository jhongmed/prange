<?php
include 'dbconnection.php';
$id = $_POST['id'];
$result = $mysqli->query("select * from tbl_range_sched where id='$id'");
$row = mysqli_fetch_assoc($result);
$ids = $row['id'];
$pname = $row['name'];
$foliono = $row['folio_no'];
$rak = $row['rack_no'];
$status1 = $row['status1'];
$revenue = $row['revenue'];
$deposit = $row['deposit'];
$jungolf = $row['jungolf'];
$warmup = $row['warmup'];
$senior = $row['senior'];
$complimentary = $row['complimentary'];
$FED = $row['FED'];
$unlirange = $row['unlirange'];
$bucket_used = $row['bucket_used'];
$prange_chargesid = $row['prange_chargesid'];
$prange_charges = $row['prange_charges'];
$pr_quantity = $row['pr_quantity'];
?>

<div class="modal fade" id="sampleupdate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-left">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">UPDATE TRANSACTION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="panel-2" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content p-0">
                            <form class="needs-validation" id="updateform" novalidate>
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="validationCustom01">Folio - Player Name<span class="text-danger"></span> </label>
                                            <input type="text" class="form-control" name="pname" value="<?php echo $row['folio_no'] . ' - ' . $row['name'] ?>" id="pname" placeholder="<?php echo $row['folio_no'] . ' - ' . $row['name'] ?>" required>
                                            <input type="hidden" class="form-control" name="action" id="action" value="edit">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
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
                                            <label class="form-label" for="validationCustom03">Bay No. <span class="text-danger"></span></label>
                                            <select class="custom-select" name="rno" id="rno" required="">
                                                <option value=""></option>
                                                <?php
                                                $result1 = $mysqli->query("select * from tbl_bay");
                                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                                ?>
                                                    <option value="<?php echo $row1['bayno'] ?>" <?php if ($rak == $row1['bayno']) {
                                                                                                        echo 'selected="selected"';
                                                                                                    } ?>><?php echo $row1['bayno'] ?></option>';
                                                <?php
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
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="validationCustom03">Player Status <span class="text-danger"></span></label>
                                            <select class="custom-select" name="stat" id="stat" required="">
                                                <option value="MEMBER" <?php if ($status1 == 'MEMBER') {
                                                                            echo 'selected="selected"';
                                                                        } ?>>MEMBER</option>
                                                <option value="GUEST" <?php if ($status1 == 'GUEST') {
                                                                            echo 'selected="selected"';
                                                                        } ?>>GUEST</option>
                                            </select>

                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please choose player status.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="validationCustom03">Type<span class="text-danger"></span></label>
                                            <select class="custom-select" name="rev" id="rev" required="">
                                                <option value="NON-REVENUE" <?php if ($revenue == 'NON-REVENUE') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>NON-REVENUE</option>
                                                <option value="REVENUE" <?php if ($revenue == 'REVENUE') {
                                                                            echo 'selected="selected"';
                                                                        } ?>>REVENUE</option>
                                            </select>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please choose monitoring type.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="validationCustom01">No. of Bucket<span class="text-danger"></span> </label>
                                            <input type="text" class="form-control" name="noofbucket" id="noofbucket" placeholder="1" value=<?php echo $bucket_used; ?>>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter Total Buckets Used.
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-8 mb-3">
                                            <label class="form-label" for="validationCustom03">Select Charges<span class="text-danger"></span></label>
                                            <select class="custom-select" name="pr_charges" id="pr_charges" required="">
                                                <option value=""></option>
                                                <?php
                                                $result = $mysqli->query("select * from tbl_charges");
                                                while ($row1 = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <option value="<?php echo $row1['prange_chargesid'] ?>" <?php if ($prange_chargesid == $row1['prange_chargesid']) {
                                                                                                                echo 'selected="selected"';
                                                                                                            } ?>><?php echo strtoupper($row1['prange_charges']) . ' - Php ' . $row1['prange_unitprice'] ?></option>';
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Select Charges.
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label" for="validationCustom01">Quantity<span class="text-danger"></span> </label>
                                            <input type="text" class="form-control" name="pr_quantity" id="pr_quantity" placeholder="1" value=<?php echo $pr_quantity; ?>>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter Quantity.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-12">
                                            <label class="form-label" for="validationCustom01">Deposit<span class="text-danger"></span> </label>
                                            <input type="text" class="form-control" value="<?php echo $row['deposit'] ?? '';  ?>" name="deposit" id="deposit" placeholder="Deposit">
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
                                                <input type="checkbox" name="jgolf" <?php if ($jungolf == 'on') {
                                                                                        echo 'checked="checked"';
                                                                                    } ?> class="custom-control-input" id="jungolf1">
                                                <label class="custom-control-label" for="jungolf1">JUNGOLF</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label"></label>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="wball" <?php if ($warmup == 'on') {
                                                                                        echo 'checked="checked"';
                                                                                    } ?> class="custom-control-input" id="wball1">
                                                <label class="custom-control-label" for="wball1">WARM UP BALL</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label"></label>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="smem" <?php if ($senior == 'on') {
                                                                                        echo 'checked="checked"';
                                                                                    } ?> class="custom-control-input" id="smem1">
                                                <label class="custom-control-label" for="smem1">SR.MEM</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label"></label>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="compli" <?php if ($complimentary == 'on') {
                                                                                            echo 'checked="checked"';
                                                                                        } ?> class="custom-control-input" id="compli1">
                                                <label class="custom-control-label" for="compli1">PAL</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label"></label>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="hidden" name="FED" value="off">
                                                <input type="checkbox" name="FED" value="on"
                                                    <?php if ($FED == 'on') echo 'checked'; ?>
                                                    class="custom-control-input" id="FED1">
                                                <label class="custom-control-label" for="FED1">FED</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label"></label>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="rrange" <?php if ($unlirange == 'on') {
                                                                                            echo 'checked="checked"';
                                                                                        } ?> class="custom-control-input" id="rrange1">
                                                <label class="custom-control-label" for="rrange1">UNLIMITED RANGE</label>
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


<script>
    var frm = $('#updateform');

    frm.submit(function(e) {

        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'rangeprocess.php',
            data: frm.serialize(),
            success: function(data) {

                if (data == 'success') {
                    $('#sampleupdate').modal('hide');
                    document.getElementById("updateform").reset();
                    $("#dt-basic-example").DataTable().ajax.reload();
                    Swal.fire("Update!", "Transaction update.", "success");
                } else {
                    alert(data);
                    Swal.fire("Error!", "Transaction cannot update.", "error");
                }
            },
        });
    });
</script>