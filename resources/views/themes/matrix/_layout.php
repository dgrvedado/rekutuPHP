<?php 

if (@$index == true) {
    require_once("_head.php");
} else {
    require_once("_headers.php");
}

?>
<body>
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
    <div id="main-wrapper">
<?php

if (@$index == false) {
    require_once("_navbar.php");
    require_once("_leftbar.php");    
}

//Este es el archivo que se debe instanciar en cada seccion del MENU
require_once($wrapper);
?>
</div>
<?php
if (@$index == true) {
    require_once("_lfooters.php");
} else {
    require_once("_footers.php");
}
?>
