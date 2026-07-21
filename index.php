<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Practice Range Monitoring System -  Log-in Page
        </title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="admin/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="admin/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <!-- Optional: page related CSS-->
        <link rel="stylesheet" media="screen, print" href="admin/css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="admin/css/notifications/sweetalert2/sweetalert2.bundle.css">
        <link rel="stylesheet" media="screen, print" href="admin/css/page-login.css">
    </head>
    <body>
	    <div class="blankpage-form-field">
	            <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
	                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
	                    <span class="page-logo-text mr-1">PRMS Release 1.3.x</span>
	                </a>
	            </div>
	            <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
	                <form id="login">
	                    <div class="form-group">
	                        <label class="form-label" for="username">Username</label>
	                        <input type="text" id="username" class="form-control" placeholder="Enter your username"  required="required" >
	                      
	                    </div>
	                    <div class="form-group">
	                        <label class="form-label" for="password">Password</label>
	                        <input type="password" id="pword" name="pword" class="form-control" placeholder="password" required="required" >
	                        
	                    </div>
	                    <button type="button"  id="button-addon5" class="btn btn-default float-right">LOGIN</button>
	                </form>
	            </div>
	        </div>
	        
        <script src="admin/js/vendors.bundle.js"></script>
        <script src="admin/js/app.bundle.js"></script>
        <script src="admin/js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
        <script>
            $("#button-addon5").click(function(event)
            {
            	
                var form = $("#login");
                var pword = $("#pword").val();
                var username = $("#username").val();

                if (form[0].checkValidity() === false)
                {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.addClass('was-validated');
					$.ajax({
						url: 'login.php?p='+pword+' & u='+username,
						type: "POST",
						data: $(form).serialize(),
						success: function(data) {
							if(data=='success'){
								Swal.fire(
				                	{
				                    	position: "top-end",
				                        type: "success",
				                        title: "Login success.. Redirect after 4 seconds",
				                        showConfirmButton: false,
				                        timer: 3500
				                    }).then(function() {
									  window.location="admin/index.php"; 
									})
							}else if(data=='success1'){
								Swal.fire(
				                	{
				                    	position: "top-end",
				                        type: "success",
				                        title: "Login success.. Redirect after 4 seconds",
				                        showConfirmButton: false,
				                        timer: 3500
				                    }).then(function() {
									  window.location="admin/report.php"; 
									})
							}
							else{
								Swal.fire(
				                	{
				                    	position: "top-end",
				                        type: "error",
				                        title: "Incorrect Password " + data,
				                        showConfirmButton: false,
				                        // timer: 3500
				                    });
							}
		          		},            
					});
					$form.submit();
            });

        </script>
    </body>
</html>
