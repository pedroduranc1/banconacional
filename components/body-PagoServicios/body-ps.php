<?php 
session_start();
$cedula=$_SESSION['cedula'];
$cuser1 = "SELECT * from usuario where cedula ='$cedula'";
$quser1 = mysqli_query($con,$cuser1) or die(mysqli_error($con));
$rs1 = mysqli_fetch_array($quser1); 

$cuser = "SELECT * from cuenta where ID_usuario ='{$rs1['ID']}'";
$quser = mysqli_query($con,$cuser) or die(mysqli_error($con));
$rs = mysqli_fetch_array($quser);
?>

<div class="all">
<div class="menu">
    <br><br>
    <div class="flex margin-left-arrow"><i class=" fa fa-arrow-left"></i></div>
    <br><br>
    <div class="flex"><img src="img/Recurso2.svg" class="logo"></div>
    <br>
    <h1 class="usertxt flex"><?php echo $rs1['nombre'],' ',$rs1['apellido'];?></h1>
    <br><br>
    <div class="flex ">
        <a href="inicio.php" class="btn-border btn ">Posicion</a>
    </div>
    <div class="flex ">
        <a href="movimientos.php" class="btn-border btn ">Movimientos</a>
    </div>
    <div class="flex ">
        <a href="transferencia.php" class="btn-border btn">Transferencias</a>
    </div>
    <div class="flex ">
        <a href="dinero.php" class="btn-border btn">Dinero</a>
    </div>
    <div class="flex ">
        <a href="pagoServicios.php" class="btn-border btn fa fa-caret-right active">    Pago de servicios</a>
    </div>
    <br><br>
    <div class="flex">
        <form method="post">
            <button type="submit" name="btn-exit" class="btn-exit">Salir de la cuenta</button>
            <?php 
            if(isset($_POST['btn-exit'])){
                header('location: cs.php');
            }
            ?>
        </form>
    </div>
    <br><br>
    <div class="flex">
        <span class="txt-copy">Banco nacional &copy;2020</span>
    </div>
</div>
<div class="contenido">
<div><h1 style="color: #13ace2;">Pago de Servicios </h1></div>
<br><br>
       
        <form method="POST">
        <div style="width: 90%; padding: 0 5%; margin-top: 2%;">
            <input type="text" name="nombre" class="inputt" placeholder="Nombre">
       </div>
       <div style="width: 90%; padding: 0 5%; margin-top: 2%;">
            <input type="number" name="cedula" class="inputt" placeholder="Cedula">
       </div>
       
       <br>
        
        <select class="select" name="cerveza">    
        <option value="SanMiguel">Movistar</option>    
        <option value="Mahou">Digitel</option>    
        <option value="Heineken">Movilnet</option>    
        <option value="Carlsberg">Directv</option>    
        <option value="Aguila">Inter</option>
        <option value="Aguila">Luz</option>
        <option value="Aguila">Agua</option>   
        </select>
        
        
       <div style="width: 90%; padding: 0 5%; margin-top: 2%;">
            <input type="number" class="inputt" name="monto" placeholder="Monto">
       </div>
       <div style="width: 90%; padding: 0 25%; margin-top: 5%;">
            <input type="submit" class="btnpagar" name="btnpagar" value="Pagar">
       </div>

       <?php
            if(isset($_POST['btnpagar'])){
                if(empty($_POST['nombre']) && empty($_POST['cedula']) && empty($_POST['monto']) ){
                    echo '<div style= "background: #DC143C;
                                width: 48%;
                                height: auto;
                                padding: 20px;
                                margin-top: 20px;
                                margin-left: 5%;
                                border-radius: 20px;
                                text-align: center;
                                transition: 0.5s;
                                ">
                <h3 style="color: white;
                font-size: 18px;
                font-weight: normal;">
                Error. Rellene todos los campos </h3></div>';
                }else{
                    $saldo = $rs['saldo'];
                    $retiro = $_POST['monto'];
                if($saldo < $retiro){
                    echo '<div style= "background: #DC143C;
                                width: 90%;
                                height: auto;
                                padding: 20px;
                                margin-top: 20px;
                                border-radius: 20px;
                                text-align: center;
                                transition: 0.5s;
                                ">
                <h3 style="color: white;
                font-size: 18px;
                font-weight: normal;">
                Saldo insuficiente. </h3></div>';
                }else{
                $reti = $saldo - $retiro;
                for($i=0;$i<8;$i++){
                    $ref .= mt_rand(0,9);
                }
                $queryretiro = "UPDATE cuenta SET saldo = '$reti' WHERE ID_usuario = '{$rs1['ID']}'";
                $rsretiro = mysqli_query($con,$queryretiro) or die(mysqli_error($con));
                $querymovimientos = "INSERT INTO transaccion (ID_usuario_enviar,ID_usuario_recibir,Monto,hora,proposito,referencia)Values('{$rs1['ID']}','{$rs1['ID']}', '$retiro', NOW(), 'pago de servicio','$ref')";
                $rsmovimiento = mysqli_query($con,$querymovimientos) or die(mysqli_error($con));
                header('location: movimientos.php');   
                }
                }
            }
       ?>
        </form>
       
</div>
</div>