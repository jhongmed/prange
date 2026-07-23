<?php
session_start();
require 'auth.php';
include 'dbconnection.php';
unset($_SESSION['datereport']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            PRACTICE RANGE MONITORING SYSTEM 1.4.1
        </title>
        <meta name="description" content="Export">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="msapplication-tap-highlight" content="no">
        <link rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <!--<link rel="icon" type="image/png" sizes="32x32" href="img/qems.ico">-->
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="css/datagrid/datatables/datatables.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/notifications/sweetalert2/sweetalert2.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/formplugins/dropzone/dropzone.css">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
    </head>
    <body class="mod-bg-1 ">
        <script>
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c? Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                            <!--<img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">-->
                            <span class="page-logo-text mr-1">PRMS 1.4.2 </span>
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                      
                        <ul id="js-nav-menu" class="nav-menu">
                         <?php
                        	
                        if($_SESSION['login_userlevel']!='AUDIT'){
                        	
                        	?>
                        
                        	
                            	<li>
                                        <a href="monitor.php" title="VIEWER"  data-filter-tags="Monitoring">
                                            <i class="fal fa-info-circle"></i><span class="nav-link-text"  target="_blank" data-i18n="QEMS VIEWER">Practice Monitor</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="index.php" title="VIEWER"  data-filter-tags="Monitoring">
                                            <i class="fal fa-info-circle"></i><span class="nav-link-text" data-i18n="QEMS VIEWER">Player Input</span>
                                        </a>
                                    </li>
                                     <?php
}
                        if($_SESSION['login_userlevel']=='AUDIT'){
                        	
                        	?>
                                    <li>
                                        <a href="logs.php" title="VIEWER"  data-filter-tags="Monitoring">
                                            <i class="fal fa-info-circle"></i><span class="nav-link-text" data-i18n="QEMS VIEWER">History Logs</span>
                                        </a>
                                    </li>
                                   
                                    <li>
                                        <a href="report.php" title="VIEWER"  data-filter-tags="Monitoring">
                                            <i class="fal fa-info-circle"></i><span class="nav-link-text" data-i18n="QEMS VIEWER">Report</span>
                                        </a>
                                    </li>
                                    <?php } ?>
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                </aside>
                <!-- END Left Aside -->
                
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <!-- we need this logo when user switches to nav-function-top -->
                        <div class="page-logo">
                            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                <img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                <span class="page-logo-text mr-1"></span>
                                <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <!-- app settings -->
                           
                            <div>
                                <a href="#" data-toggle="dropdown" title="" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <img src="img/golf.png" class="profile-image rounded-circle" alt="Administrator">
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                       
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                        <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                                        <i class="float-right text-muted fw-n">F11</i>
                                    </a>
                                    <a href="#" class="dropdown-item" data-action="app-print">
                                        <span data-i18n="drpdwn.print">Print</span>
                                        <i class="float-right text-muted fw-n">Ctrl + P</i>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="logout.php">
                                        <span data-i18n="drpdwn.page-logout">Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </header>