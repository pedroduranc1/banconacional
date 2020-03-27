<?php
include_once('conexion/conexion.php'); 
session_start()?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/Recurso2.svg" href="img/Recurso2.svg">
    <title>Banco Nacional - Login</title>
    <link rel="stylesheet" href="components/body-login/body-login.css">

</head>
<body>
    <?php 
    include('components/body-login/body-login.php');
    ?>
</body>
    <?php 
    include('components/scripts/scripts.php');
    ?>
</html>