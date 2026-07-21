<?php
include 'template/header.php';
?>

<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Practice Range</a></li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Table</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>

    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-container show">
                    <div class="panel-content">

                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead class="bg-primary-600">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>DateStamp</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <!-- datatable end -->

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
    $(document).ready(function() {

        $('#dt-basic-example').dataTable({
            responsive: true,
            lengthChange: false,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "logsres.php",

            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f>" +
                "<'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

            buttons: [
                <?php if ($_SESSION['login_userlevel'] == 'ADMINISTRATOR' || $_SESSION['login_userlevel'] == 'OPERATOR') { ?> {

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
                    },
                <?php } ?> {
                    extend: 'print',
                    text: 'Print',
                    titleAttr: 'Print Table',
                    className: 'btn-outline-primary btn-sm'
                }
            ]
        });

    });


    /* ================= FORM VALIDATION + AJAX ================= */

    (function() {
        'use strict';

        window.addEventListener('load', function() {

            var forms = document.getElementsByClassName('needs-validation');

            Array.prototype.filter.call(forms, function(form) {

                form.addEventListener('submit', function(event) {

                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');

                    $.ajax({
                        url: 'rangeprocess.php',
                        type: "POST",
                        data: $(form).serialize(),
                        success: function(data) {

                            if (data == 'success') {

                                Swal.fire({
                                    position: "top-end",
                                    icon: "success",
                                    title: "Player successfully save..",
                                    showConfirmButton: false,
                                    timer: 4000
                                });

                                $('#addmodal').modal('hide');
                                document.getElementById("addvform").reset();
                                $("#dt-basic-example").DataTable().ajax.reload();

                            } else {

                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
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


    /* ================= DELETE FUNCTION ================= */

    function deletes(id) {

        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!"
        }).then(function(result) {

            if (result.value) {

                $.ajax({
                    url: 'rangeprocess.php',
                    data: 'id=' + id + '&action=delete',
                    type: 'post',
                    success: function() {
                        $("#dt-basic-example").DataTable().ajax.reload();
                    }
                });

                Swal.fire("Delete!", "Player successfully signout.", "success");
            }

        });
    }


    /* ================= SIGNOUT FUNCTION ================= */

    function signout(id) {

        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Signout it!"
        }).then(function(result) {

            if (result.value) {

                $.ajax({
                    url: 'rangeprocess.php',
                    data: 'id=' + id + '&action=signout',
                    type: 'post',
                    success: function() {
                        $("#dt-basic-example").DataTable().ajax.reload();
                    }
                });

                Swal.fire("Signout!", "Player successfully signout.", "success");
            }

        });
    }
</script>