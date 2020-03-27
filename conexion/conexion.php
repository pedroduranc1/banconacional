<?php

    $host = "mysql.zz.com.ve";
    $user = "pedroduranc1";
    $password = "Duran.7865261";
    $db = "pedroduranc1";

    $con = mysqli_connect($host,$user,$password,$db);

    if(!$con){
        echo'No hay conexion con'.mysqli_error($con);
    }else{
        //echo'CONECTO';
    }

?>