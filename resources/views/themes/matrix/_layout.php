<?php 

if (@$index == true) {
    require_once("_head.php"); echo "\n";
} else {
    require_once("_headers.php"); echo "\n";
}

?>
<body>
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
<?php

if (@$index == false) {
    require_once("_navbar.php"); echo "\n";
    require_once("_leftbar.php"); echo "\n";
}

//Este es el archivo que se debe instanciar en cada seccion del MENU
require_once($wrapper); echo "\n";
?>
    </div>
<?php
if (@$index == true) {
    require_once("_lfooters.php"); echo "\n";
} else {
    require_once("_footers.php"); echo "\n";
}
?>
