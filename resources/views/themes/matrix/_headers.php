<?php

if ($_SERVER['SERVER_PORT'] != 80 && $_SERVER['SERVER_PORT'] != 443) {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"];
} elseif ($_SERVER['SERVER_PORT'] == 443) {
    $gouri = 'https://'.$_SERVER["SERVER_NAME"];
} else {
    $gouri = 'http://'.$_SERVER["SERVER_NAME"];
}

defined('BASEPATH') or header('Location: '.$gouri);
//exit('No se permite acceso directo');

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=ASSETS_URL?>/assets/images/favicon.png">
    <title>rekutuPHP</title>
    <!-- Custom CSS -->
    <link href="<?=ASSETS_URL?>/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
