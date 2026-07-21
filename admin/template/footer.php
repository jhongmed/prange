
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <marquee><div class="text-success">Practice Range Monitoring System 1.1.x - <a class="text-danger">MIS Department 2024</a> </div></marquee>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script src="js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
        <!-- datatble responsive bundle contains: 
			+ jquery.dataTables.js
			+ dataTables.bootstrap4.js
			+ dataTables.autofill.js							
			+ dataTables.buttons.js
			+ buttons.bootstrap4.js
			+ buttons.html5.js
			+ buttons.print.js
			+ buttons.colVis.js
			+ dataTables.colreorder.js							
			+ dataTables.fixedcolumns.js							
			+ dataTables.fixedheader.js						
			+ dataTables.keytable.js						
			+ dataTables.responsive.js							
			+ dataTables.rowgroup.js							
			+ dataTables.rowreorder.js							
			+ dataTables.scroller.js							
			+ dataTables.select.js							
			+ datatables.styles.app.js
			+ datatables.styles.buttons.app.js -->
		        <script src="js/datagrid/datatables/datatables.bundle.js"></script>
		        <!-- datatbles buttons bundle contains: 
			+ "jszip.js",
			+ "pdfmake.js",
			+ "vfs_fonts.js"	
			NOTE: 	The file size is pretty big, but you can always use the
			build.json file to deselect any components you do not need under "export" -->
        <script src="js/datagrid/datatables/datatables.export.js"></script>
        <script src="js/formplugins/dropzone/dropzone.js"></script>
    </body>
</html>
