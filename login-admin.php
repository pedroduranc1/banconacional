<?php
include_once('conexion/conexion.php'); 
session_start()?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/Recurso2.svg" href="img/Recurso2.svg">
    <title>Banco Nacional - Login - administrativo</title>
    <link rel="stylesheet" href="components/login-administrativo/login-administrativo.css">

</head>
<body>
    <?php 
    include('components/login-administrativo/login-administrativo.php');
    ?>
</body>
</html>
