<?php 

if (@$index == true) {
    require_once("_head.php"); ?>
<body class="hold-transition login-page">
    <div class="login-box">
<?php

} else {
    require_once("_headers.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
<?php
}


?>

<?php

if (@$index == false) {
    require_once("_navbar.php");
    require_once("_leftbar.php");    
}

//Este es el archivo que se debe instanciar en cada seccion del MENU
require_once($wrapper);
?>
</div>
<!-- ./wrapper -->
<?php

    require_once("_footers.php");

?>
