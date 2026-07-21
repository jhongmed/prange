<style>
    .page-footer {
        display: none !important;
    }


    .panel-content input {
        font-size: 23px;

    }

    #addmodal select option {
        font-size: 25px;
        font-weight: bolder;
        height: 45px;
        color: #111111;
        font-family: Arial, Helvetica, sans-serif;
    }

    .form-label,
    .custom-control-label {
        font-size: 20px !important;
        font-weight: bold;
    }

    .modal-body,
    .modal-content {
        width: 800px !important;
        /* adjust mo */
    }

    .modal-content p {
        font-size: 20px;
    }



    .folio-dropdown {
        position: absolute;
        background: #fff;
        border: 1px solid #ccc;
        width: 100%;
        font-size: 27px;
        font-weight: bolder;
        max-height: 250px;
        overflow-y: auto;
        display: none;
        z-index: 1000;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);

        font-family: Arial, Helvetica, sans-serif;
        /* important */
        letter-spacing: normal;
    }

    .folio-item {
        padding: 5px 10px;
        cursor: pointer;
        font-family: Arial, Helvetica, sans-serif;
        /* reset font */
        letter-spacing: normal;
        /* remove spacing */
        word-spacing: normal;
        white-space: nowrap;
    }

    .folio-item.selected {
        background-color: #007bff;
        color: #fff;
    }



    .folio-input {
        width: 100%;
        padding: 10px 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: border 0.2s;
    }

    .folio-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }





    .folio-item:hover {
        background-color: #f0f0f0;
    }
</style>

<?php
include 'template/header.php';

/* =========================
   SQL Server connection (CMSSQL) via DSN
   Used below to populate the folio dropdown directly from SQL Server
   instead of the local MySQL tbl_folio table.
========================= */
try {
    $sqlsrvConn = new PDO("odbc:CMSSQL64", "mis-admin", "OrchardM1S2024");
    $sqlsrvConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Normalize returned column keys to uppercase, since some ODBC drivers
    // return column names in a case that doesn't match how they were written
    // in the SELECT.
    $sqlsrvConn->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
} catch (PDOException $e) {
    error_log("Failed to connect to CMSSQL: " . $e->getMessage());
    $sqlsrvConn = null; // Folio dropdown will render empty rather than fatal-error the page
}
?>
<link rel="stylesheet" href="update.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                                        //$result=$mysqli->query("select * from tbl_range_sched GROUP BY date_play DESC ORDER BY id DESC LIMIT 7");
                                        $result = $mysqli->query("SELECT DISTINCT date_play FROM db_prange1.tbl_range_sched ORDER BY date_play DESC LIMIT 7");
                                        //$result=$mysqli->query("select * from tbl_range_sched GROUP BY date_play DESC ORDER BY id DESC LIMIT 7");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['date_play'] . '">' . $row['date_play'] . '</option>';
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
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    MEMBER TODAY: <strong id="member-count">0</strong>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    GUEST TODAY: <strong id="guest-count">0</strong>
                                </div>
                            </div>
                        </div>

                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th>ID</th>
                                    <th>PLAYER NAME</th>
                                    <th>BAY NO.</th>
                                    <th>FOLIO NO.</th>
                                    <th>TYPE</th>
                                    <th>TIME IN</th>
                                    <th>TIME OUT</th>
                                    <th>TOTAL HRS</th>
                                    <th>NO OF BUCKET</th>
                                    <th>CHARGES</th>
                                    <th>QTY</th>

                                    <th>REGULAR</th> <!-- NEW -->
                                    <th>JUNGOLF</th>
                                    <th>WAMP UP: </th>
                                    <th>SENIOR: </th>
                                    <th>PAL: </th>
                                    <th>FED: </th>
                                    <th>UNLI RANGE: </th>
                                    <th>TOTAL</th>
                                    <th>REVENUE: </th>
                                    <th>TIME STAMP: </th>
                                    <th>USER: </th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr style="font-weight:bold; background-color:#eee;">
                                    <th colspan="7" class="text-right">TOTAL:</th>
                                    <th></th>
                                    <!-- TIME OUT -->
                                    <th></th>
                                    <!-- TOTAL HRS -->
                                    <th></th>
                                    <!-- BUCKET -->
                                    <th></th>
                                    <!-- CHARGES -->
                                    <th></th>
                                    <!-- QTY -->
                                    <th></th>
                                    <!-- TOTAL -->
                                    <th></th>
                                    <!-- JUNGOLF -->
                                    <th></th>
                                    <!-- WARMUP -->
                                    <th></th>
                                    <!-- SENIOR -->
                                    <th></th>
                                    <!-- COMPLIMENTARY -->
                                    <th></th>

                                    <!-- FED -->
                                    <th></th>
                                    <!-- UNLI -->

                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Add Modal -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-left">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4">Add New Player</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="panel-2" class="panel">
                    <div class="panel-container show">
                        <div class="panel-content p-0">


                            <!-- eto yung form -->
                            <form class="needs-validation" id="addvform" novalidate>
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label" for="fno">Select Folio No. - Name <span class="text-danger"></span></label>
                                            <!-- <input type="text" class="form-control" name="fno" id="fno" placeholder="Folio No. - Name" required> -->
                                            <input type="hidden" class="form-control" name="action" id="action" value="add">
                                            <input type="text" id="folio_search" class="form-control" placeholder="Search Folio No - Name" autocomplete="off">

                                            <input type="hidden" name="fno" id="fno" required>

                                            <div id="folio_list" class="folio-dropdown">
                                                <?php
                                                // --- Folio list now sourced from SQL Server (FOLFOLI0) instead of ---
                                                // --- the local MySQL tbl_folio table. Filtered the same way as   ---
                                                // --- the FoxPro sync script: open status, member/group only.     ---
                                                if ($sqlsrvConn !== null) {
                                                    try {
                                                        $folioSql = "SELECT Folfoli0.FOLINO, Folfoli0.FOLI_NAME " .
                                                                    "FROM dbo.FOLFOLI0 Folfoli0 " .
                                                                    "WHERE Folfoli0.FOLI_STAT = 'O' " .
                                                                    "AND Folfoli0.FOLI_CG IN ('M','G') " .
                                                                    "ORDER BY Folfoli0.FOLINO";
                                                        $folioStmt = $sqlsrvConn->query($folioSql);
                                                        while ($row = $folioStmt->fetch(PDO::FETCH_ASSOC)) {
                                                            $folino = htmlspecialchars(trim($row['FOLINO']));
                                                            $foliName = htmlspecialchars(trim($row['FOLI_NAME']));
                                                            echo '<div class="folio-item" data-value="' . $folino . '">'
                                                                . $folino . ' - ' . $foliName .
                                                                '</div>';
                                                        }
                                                    } catch (PDOException $e) {
                                                        error_log("Folio dropdown query error: " . $e->getMessage());
                                                        // Dropdown simply renders empty; page continues normally.
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Select Folio no.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="validationCustom03">Bay No. <span class="text-danger"></span></label>
                                            <select class="custom-select" name="rno" id="rno" required="">
                                                <option value=""></option>
                                                <?php
                                                $result = $mysqli->query("select * from tbl_bay");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option value="' . $row['bayno'] . '">' . $row['bayno'] . '</option>';
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
                                                <option value="MEMBER">MEMBER</option>
                                                <option value="GUEST">GUEST</option>
                                            </select>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please choose player status.
                                            </div>


                                            <!-- eto hidden input na ipapasa sa regular amount -->
                                            <input type="hidden" name="regular_amount" id="regular_amount" value="500">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="validationCustom03">Type<span class="text-danger"></span></label>
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
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="validationCustom01">No. of Bucket<span class="text-danger"></span></label>
                                            <input type="text" class="form-control" name="noofbucket" id="noofbucket" placeholder="1" value=1>
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
                                            <label class="form-label" for="validationCustom03">Select Charges <span class="text-danger"></span></label>
                                            <select class="custom-select" name="pr_charges" id="pr_charges" required="">
                                                <option value=""></option>
                                                <?php
                                                $result = $mysqli->query("select * from tbl_charges");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<option value="' . $row['prange_chargesid'] . '">' . $row['prange_charges'] . '- Php' . $row['prange_unitprice'] . '</option>';
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
                                            <label class="form-label" for="validationCustom01">Quantity<span class="text-danger"></span></label>
                                            <input type="text" class="form-control" name="pr_quantity" id="pr_quantity" placeholder="1" value=1>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter Quantity.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="validationCustom01">Deposit<span class="text-danger"></span></label>
                                            <input type="text" class="form-control" name="deposit" id="deposit" placeholder="w/ Passport">
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
                                                <input type="checkbox" name="jgolf" class="custom-control-input" id="jungolf">
                                                <label class="custom-control-label" for="jungolf">JUNGOLF</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label"></label>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="wball" class="custom-control-input" id="wball">
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
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" name="compli" class="custom-control-input" id="compli">
                                                <label class="custom-control-label" for="compli">PAL</label>
                                            </div>

                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="FED" class="custom-control-input" id="FED">
                                                <label class="custom-control-label" for="FED">FED</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label"></label>
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="rrange" class="custom-control-input" id="rrange">
                                                <label class="custom-control-label" for="rrange">UNLIMITED RANGE</label>
                                            </div>
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

<?php include 'template/footer.php'; ?>

<script>
    function perHourQuantity(hours) {
        var whole = Math.floor(hours);
        var minutes = (hours - whole) * 60;

        if (minutes < 10) {
            return whole; // 0–9 min → round down
        } else if (minutes < 40) {
            return whole + 0.5; // 10–39 min → half-hour
        } else {
            return whole + 1; // 40–59 min → next full hour
        }
    }
    $(document).ready(function() {
        // initialize datatable
        $('#compli').change(function() {
            if (this.checked) {
                $('#compli-options').slideDown(200);
            } else {
                $('#compli-options').slideUp(200);
                $('input[name="compli_type"]').prop('checked', false);
            }
        });


        // ✅ Reset when modal closes
        $('#addmodal').on('hidden.bs.modal', function() {
            $('#compli').prop('checked', false);
            $('#compli-options').hide();
            $('input[name="compli_type"]').prop('checked', false);
        });


        // ✅ OPTIONAL: Validation before submit (example)







        const folioInput = document.getElementById('folio_search');
        const folioList = document.getElementById('folio_list');
        const folioHidden = document.getElementById('fno');


        folioInput.addEventListener('focusout', () => {
            setTimeout(() => {
                folioList.style.display = 'none';
            }, 400); // allow clicks inside dropdown
        });

        // Show dropdown on focus
        folioInput.addEventListener('focus', () => {
            folioList.style.display = 'block';
        });

        // Filter items while typing
        folioInput.addEventListener('input', () => {
            const value = folioInput.value.toLowerCase().trim();

            document.querySelectorAll('.folio-item').forEach(item => {

                const original = item.dataset.text || item.textContent;
                item.dataset.text = original;

                const text = original.toLowerCase();

                if (text.includes(value)) {
                    item.style.display = 'block';

                    if (value !== '') {
                        item.innerHTML = original.replace(
                            new RegExp(`(${value})`, 'ig'),
                            '<mark>$1</mark>'
                        );
                    } else {
                        item.innerHTML = original;
                    }

                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Select item
        folioList.addEventListener('click', e => {
            if (e.target.classList.contains('folio-item')) {
                folioInput.value = e.target.textContent;
                folioHidden.value = e.target.dataset.value;
                folioList.style.display = 'none';
            }
        });

        // Hide dropdown if clicked outside
        document.addEventListener('click', e => {
            if (!folioInput.contains(e.target) && !folioList.contains(e.target)) {
                folioList.style.display = 'none';
            }
        });



        $('#dt-basic-example').dataTable({
            responsive: false, // don't use responsive scrolling
            autoWidth: false, // let CSS handle column width
            scrollX: false, // no horizontal scroll
            lengthChange: false,



            order: [
                [0, "desc"]
            ],
            ajax: {
                url: "rangeres.php",
                dataSrc: function(json) {
                    // DISPLAY MEMBER & GUEST COUNT
                    $("#member-count").html(json.memberTotal);
                    $("#guest-count").html(json.guestTotal);
                    return json.data;
                }
            },
            "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": 7, // TOTAL HRS column
                    "render": function(data, type, row) {

                        // Keep original numeric value for sorting, filtering, totals, PDF
                        if (type === 'sort' || type === 'type') {
                            return parseFloat(data) || 0;
                        }

                        var hours = parseFloat(data) || 0;

                        var wholeHours = Math.floor(hours);
                        var minutes = Math.round((hours - wholeHours) * 60);

                        if (wholeHours === 0 && minutes === 0) return '';

                        var display = '';

                        if (wholeHours > 0) {
                            display += wholeHours + ' hr' + (wholeHours > 1 ? 's' : '');
                        }

                        if (minutes > 0) {
                            if (display !== '') display += ' ';
                            display += minutes + ' min';
                        }

                        return display;
                    }


                },
                {
                    "targets": 10, // QTY column
                    "render": function(data, type, row) {

                        var totalHours = parseFloat(row[7]) || 0;

                        // 🔥 important: round to 2 decimal places first
                        totalHours = Math.round(totalHours * 100) / 100;

                        var qty;

                        if (row.charge_type === 'PER_HOUR') {

                            qty = perHourQuantity(totalHours);

                        } else {

                            qty = parseFloat(data) || 0;

                        }

                        // 🔥 force only whole or .5
                        qty = Math.round(qty * 2) / 2;

                        return qty % 1 === 0 ? qty.toFixed(0) : qty.toFixed(1);
                    }


                },
                {
                    "targets": 11, // TOTAL column index
                    "render": function(data, type, row) {
                        // Remove HTML tags & commas before checking
                        var clean = parseFloat(
                            data.toString()
                            .replace(/<[^>]*>/g, '')
                            .replace(/,/g, '')
                        ) || 0;
                        // If zero, return blank
                        if (clean === 0) {
                            return '';
                        }
                        return data; // otherwise show original value
                    }
                }
            ],
            dom: /* --- Layout Structure --- Options l - length changing input control f - filtering input t - The table! i - Table information summary p - pagination control r - processing display element B - buttons R - ColReorder S - Select --- Markup < and > - div element <"class" and > - div with a class <"#id" and > - div with an ID <"#id.class" and > - div with an ID and a class --- Further reading https://datatables.net/reference/option/dom -------------------------------------- */ "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",


            buttons: [


                /*{ extend: 'colvis', text: 'Column Visibility', titleAttr: 'Col visibility', className: 'mr-sm-3' },*/
                {
                    extend: '',
                    text: 'NEW PLAYER',
                    titleAttr: 'Add Document',
                    className: 'btn-outline-info btn-sm mr-1',
                    action: function(e, dt, node, config) {
                        $('#addmodal').modal('show');
                    }
                }
                <?php if ($_SESSION['login_userlevel'] == 'ADMINISTRATOR' || $_SESSION['login_userlevel'] == 'OPERATOR') { ?>,
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        titleAttr: 'Generate PDF',
                        className: 'btn-outline-danger btn-sm mr-1',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        customize: function(doc) {
                            var api = $('#dt-basic-example').DataTable();

                            // 0️⃣ Get selected date from dropdown (or fallback to today)
                            var selectedDate = $('#datereport').val();
                            if (!selectedDate) {
                                var today = new Date();
                                var dd = String(today.getDate()).padStart(2, '0');
                                var mm = String(today.getMonth() + 1).padStart(2, '0');
                                var yyyy = today.getFullYear();
                                selectedDate = mm + '/' + dd + '/' + yyyy;
                            }

                            // 0️⃣ Add header with selected date on first page only
                            doc['header'] = function(currentPage, pageCount, pageSize) {
                                if (currentPage === 1) {
                                    return {
                                        columns: [{
                                                text: '',
                                                alignment: 'left'
                                            }, // empty left
                                            {
                                                text: 'DATE: ' + selectedDate,
                                                alignment: 'right'
                                            } // right top
                                        ],
                                        margin: [20, 10, 20, 0] // left, top, right, bottom
                                    };
                                } else {
                                    return {
                                        text: ''
                                    }; // no header for other pages
                                }
                            };

                            // 1️⃣ Adjust font size
                            doc.defaultStyle.fontSize = 6;
                            doc.defaultStyle.alignment = 'right';
                            doc.styles.tableHeader.fontSize = 6;
                            doc.styles.tableHeader.alignment = 'center';

                            // 2️⃣ Auto width for columns
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0].length).fill('auto');

                            // 3️⃣ Padding inside cells
                            doc.content[1].layout = {
                                paddingLeft: function(i) {
                                    return 2;
                                },
                                paddingRight: function(i) {
                                    return 2;
                                },
                                paddingTop: function(i) {
                                    return 2;
                                },
                                paddingBottom: function(i) {
                                    return 2;
                                }
                            };

                            // 4️⃣ Compute totals for relevant columns
                            var parseVal = i => (typeof i === 'string') ? parseFloat(i.replace(/<[^>]*>/g, '').replace(/,/g, '')) || 0 : parseFloat(i) || 0;
                            var totalHours = api.rows({
                                search: 'applied'
                            }).data().pluck(7).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var totalBuckets = api.rows({
                                search: 'applied'
                            }).data().pluck(8).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var totalQty = api.rows({
                                search: 'applied'
                            }).data().pluck(10).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var totalRegular = api.rows({
                                search: 'applied'
                            }).data().pluck(11).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var totalJungolf = api.rows({
                                search: 'applied'
                            }).data().pluck(12).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var totalWarmup = api.rows({
                                search: 'applied'
                            }).data().pluck(13).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var totalSenior = api.rows({
                                search: 'applied'
                            }).data().pluck(14).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var totalCompli = api.rows({
                                search: 'applied'
                            }).data().pluck(15).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var FED = api.rows({
                                search: 'applied'
                            }).data().pluck(16).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var totalUnli = api.rows({
                                search: 'applied'
                            }).data().pluck(17).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                            var totalGrand = api.rows({
                                search: 'applied'
                            }).data().pluck(18).reduce((a, b) => parseVal(a) + parseVal(b), 0);

                            // 5️⃣ Build TOTAL row
                            var totalRow = [{
                                    text: 'TOTAL:',
                                    colSpan: 7,
                                    alignment: 'right',
                                    bold: true
                                }, {}, {}, {}, {}, {}, {},
                                {
                                    text: totalHours.toFixed(2),
                                    bold: true
                                },
                                {
                                    text: totalBuckets.toLocaleString(),
                                    bold: true
                                },
                                {
                                    text: ''
                                },
                                {
                                    text: totalQty.toLocaleString(),
                                    bold: true
                                },
                                {
                                    text: totalRegular.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    }),
                                    bold: true
                                },
                                {
                                    text: totalJungolf.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    }),
                                    bold: true
                                },
                                {
                                    text: totalWarmup.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    }),
                                    bold: true
                                },
                                {
                                    text: totalSenior.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    }),
                                    bold: true
                                },
                                {
                                    text: totalCompli.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    }),
                                    bold: true
                                },
                                {
                                    text: FED.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    }),
                                    bold: true
                                }, {
                                    text: totalUnli.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    }),
                                    bold: true
                                },
                                {
                                    text: totalGrand.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    }),
                                    bold: true
                                }
                            ];

                            while (totalRow.length < doc.content[1].table.body[0].length) {
                                totalRow.push({
                                    text: ''
                                });
                            }

                            doc.content[1].table.body.push(totalRow);

                            // 6️⃣ Set margins
                            doc.pageMargins = [20, 20, 20, 20];
                        }
                    },

                    // {
                    //     extend: 'copyHtml5',
                    //     text: 'Copy',
                    //     titleAttr: 'Copy to clipboard',
                    //     className: 'btn-outline-primary btn-sm mr-1'
                    // }
                <?php } ?>,
                // {
                //     extend: 'print',
                //     text: 'Print',
                //     titleAttr: 'Print Table',
                //     customize: function(win) {
                //         var api = $('#dt-basic-example').DataTable();

                //         // Save current page length
                //         var currentLength = api.page.len();
                //         api.page.len(-1).draw(false);

                //         // Compute totals
                //         var parseVal = i => (typeof i === 'string') ? parseFloat(i.replace(/<[^>]*>/g, '').replace(/,/g, '')) || 0 : parseFloat(i) || 0;
                //         var totalHours = api.rows({
                //             search: 'applied'
                //         }).data().pluck(7).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                //         var totalBuckets = api.rows({
                //             search: 'applied'
                //         }).data().pluck(8).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                //         var totalQty = api.rows({
                //             search: 'applied'
                //         }).data().pluck(10).reduce((a, b) => parseVal(a) + parseVal(b), 0);

                //         var totalRegular = api.rows({
                //             search: 'applied'
                //         }).data().pluck(11).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                //         var totalJungolf = api.rows({
                //             search: 'applied'
                //         }).data().pluck(12).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                //         var totalWarmup = api.rows({
                //             search: 'applied'
                //         }).data().pluck(13).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                //         var totalSenior = api.rows({
                //             search: 'applied'
                //         }).data().pluck(14).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                //         var totalCompli = api.rows({
                //             search: 'applied'
                //         }).data().pluck(15).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                //         var totalUnli = api.rows({
                //             search: 'applied'
                //         }).data().pluck(16).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                //         var totalGrand = api.rows({
                //             search: 'applied'
                //         }).data().pluck(17).reduce((a, b) => parseVal(a) + parseVal(b), 0);
                //         // Remove old grand-total row
                //         $(win.document.body).find('tr.grand-total').remove();

                //         // Append totals
                //         $(win.document.body).find('table tbody')
                //             .append('<tr class="grand-total" style="font-weight:bold; background-color:#eee;">' +
                //                 '<td colspan="7" style="text-align:right">TOTAL:</td>' +
                //                 '<td>' + totalHours.toLocaleString(undefined, {
                //                     minimumFractionDigits: 2
                //                 }) + '</td>' +
                //                 '<td>' + totalBuckets.toLocaleString() + '</td>' +
                //                 '<td></td>' +
                //                 '<td>' + totalQty.toLocaleString() + '</td>' +
                //                 '<td>' + totalAmount.toLocaleString(undefined, {
                //                     minimumFractionDigits: 2
                //                 }) + '</td>' +
                //                 '<td>' + totalJungolf.toLocaleString() + '</td>' +
                //                 '<td>' + totalWarmup.toLocaleString() + '</td>' +
                //                 '<td>' + totalSenior.toLocaleString() + '</td>' +
                //                 '<td>' + totalCompli.toLocaleString() + '</td>' +
                //                 '<td>' + totalUnli.toLocaleString() + '</td>' +
                //                 '</tr>');

                //         // Restore page length
                //         api.page.len(currentLength).draw(false);
                //     }
                // }
            ],
            // ITO YUNG DISPLAY NG TOTALS SA PINAKABABA NG MGA COLUMNS
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();
                var info = api.page.info();

                // 👉 SHOW TOTALS ONLY ON LAST PAGE
                if (info.page !== info.pages - 1) {
                    // Clear footer if not last page
                    for (var i = 0; i < api.columns().count(); i++) {
                        $(api.column(i).footer()).html('');
                    }
                    return;
                }

                // Helper to safely parse numbers from HTML or strings
                var parseVal = function(i) {
                    if (typeof i === 'string') {
                        return parseFloat(
                            i.replace(/<[^>]*>/g, '').replace(/,/g, '')
                        ) || 0;
                    }
                    return parseFloat(i) || 0;
                };

                // Column indexes (adjust if needed)
                var totals = {
                    totalHours: 7,
                    totalBuckets: 8,
                    totalQty: 10,
                    regular: 11,
                    jungolf: 12,
                    warmup: 13,
                    senior: 14,
                    complimentary: 15,
                    FED: 16,
                    unli: 17,
                    totalAmount: 18
                };

                var totalValues = {};

                $.each(totals, function(key, colIndex) {
                    totalValues[key] = api
                        .column(colIndex, {
                            search: 'applied'
                        })
                        .data()
                        .reduce(function(a, b) {
                            return parseVal(a) + parseVal(b);
                        }, 0);
                });

                // Display totals
                $(api.column(totals.totalHours).footer())
                    .html(totalValues.totalHours.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }));

                $(api.column(totals.totalBuckets).footer())
                    .html(totalValues.totalBuckets.toLocaleString());

                var finalQty = Math.round(totalValues.totalQty * 2) / 2;

                $(api.column(totals.totalQty).footer())
                    .html(
                        finalQty % 1 === 0 ?
                        finalQty.toFixed(0) :
                        finalQty.toFixed(1)
                    );

                $(api.column(totals.totalAmount).footer())
                    .html(totalValues.totalAmount.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }));

                $(api.column(totals.regular).footer())
                    .html(totalValues.regular.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }));

                $(api.column(totals.jungolf).footer())
                    .html(totalValues.jungolf.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }));

                $(api.column(totals.warmup).footer())
                    .html(totalValues.warmup.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }));

                $(api.column(totals.senior).footer())
                    .html(totalValues.senior.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }));

                $(api.column(totals.complimentary).footer())
                    .html(totalValues.complimentary.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }));
                $(api.column(totals.FED).footer())
                    .html(totalValues.FED.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }));

                $(api.column(totals.unli).footer())
                    .html(totalValues.unli.toLocaleString(undefined, {
                        minimumFractionDigits: 2
                    }));
                $('tfoot th').css('text-align', 'right');
            }


        });
    });


    (function() {
        'use strict';
        window.addEventListener('load', function() {

            var forms = document.getElementsByClassName('needs-validation');

            Array.prototype.forEach.call(forms, function(form) {

                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    event.stopPropagation();

                    var isValid = true;

                    const folioInput = document.getElementById('folio_search');
                    const folioHidden = document.getElementById('fno');
                    const rno = document.getElementById('rno');
                    const stat = document.getElementById('stat');
                    const pr_charges = document.getElementById('pr_charges');
                    const noofbucket = document.getElementById('noofbucket');
                    const pr_quantity = document.getElementById('pr_quantity');

                    // --- Folio validation ---
                    if (!folioHidden.value.trim()) {
                        folioInput.classList.add('is-invalid');
                        folioInput.classList.remove('is-valid');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Folio Missing',
                            text: 'Please select a valid Folio No. from the list.'
                        }).then(() => folioInput.focus());
                        return;
                    } else {
                        folioInput.classList.remove('is-invalid');
                        folioInput.classList.add('is-valid');
                    }

                    // --- Bay No validation ---
                    if (!rno.value.trim()) {
                        rno.classList.add('is-invalid');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Bay No Missing',
                            text: 'Please select Bay No.'
                        }).then(() => rno.focus());
                        return;
                    } else {
                        rno.classList.remove('is-invalid');
                        rno.classList.add('is-valid');
                    }

                    // --- Player Status validation ---
                    if (!stat.value.trim()) {
                        stat.classList.add('is-invalid');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Player Status Missing',
                            text: 'Please select Player Status.'
                        }).then(() => stat.focus());
                        return;
                    } else {
                        stat.classList.remove('is-invalid');
                        stat.classList.add('is-valid');
                    }

                    // --- Charges validation ---
                    if (!pr_charges.value.trim()) {
                        pr_charges.classList.add('is-invalid');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Charges Missing',
                            text: 'Please select Charges.'
                        }).then(() => pr_charges.focus());
                        return;
                    } else {
                        pr_charges.classList.remove('is-invalid');
                        pr_charges.classList.add('is-valid');
                    }

                    // --- Numeric validations ---
                    if (isNaN(noofbucket.value) || parseFloat(noofbucket.value) <= 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Invalid Buckets',
                            text: 'Please enter a valid number of buckets.'
                        }).then(() => noofbucket.focus());
                        return;
                    }

                    if (isNaN(pr_quantity.value) || parseFloat(pr_quantity.value) <= 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Invalid Quantity',
                            text: 'Please enter a valid Quantity.'
                        }).then(() => pr_quantity.focus());
                        return;
                    }

                    // ✅ All validations passed, submit via AJAX
                    $.ajax({
                        url: 'rangeprocess.php',
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(data) {
                            if (data.trim() === 'success') {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Player successfully saved.",
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                $('#addmodal').modal('hide');
                                form.reset();
                                form.classList.remove('was-validated');
                                $("#dt-basic-example").DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Invalid Entry",
                                    text: data,
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                        }
                    });

                }, false);

            });

        }, false);
    })();

    function deletes(id) {
        Swal.fire({
            title: "Are you sure?",
            type: "warning",
            input: "text",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: 'rangeprocess.php',
                    data: 'id=' + id + '&&action=delete&&del=' + result.value,
                    type: 'post',
                    success: function(data) {
                        $("#dt-basic-example").DataTable().ajax.reload();
                    }
                });
                Swal.fire("Delete!", "Transaction successfully deleted.", "success");
            } else {
                Swal.fire("Delete!", "Please input remarks to delete this transaction.", "error");
            }
        });
    }

    function edit(id) {
        $.ajax({
            url: 'update.php',
            data: 'id=' + id,
            type: 'post',
            success: function(data) {
                $("#update").html(data)
                $('#sampleupdate').modal('show');
            }
        });
    }

    function signout(id) {
        Swal.fire({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Proceed to signout!"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: 'rangeprocess.php',
                    data: 'id=' + id + ' & action=signout',
                    type: 'post',
                    success: function(data) {
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
                console.log(data);
            }
        });
    });
</script>