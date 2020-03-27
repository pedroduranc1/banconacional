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
        <a href="transferencia.php" class="btn-border btn ">Transferencias</a>
    </div>
    <div class="flex ">
        <a href="dinero.php" class="btn-border btn fa fa-caret-right active">    Dinero</a>
    </div>
    <div class="flex ">
        <a href="pagoServicios.php" class="btn-border btn">Pago de servicios</a>
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
<div><h1 style="color: #13ace2;">Dinero</h1></div>
<br><br>
    <form method="POST">
        <div style="
        width: 100%;
        height: auto;
    ">
        <button name="btn-depositar" class="btndr">Depositar</button>
        <button name="btn-retirar" class="btndr">Retirar</button>
        </div>

        <?php
        if(isset($_POST['btn-depositar'])){
            
        ?>
            <div class="accion">
            <form method="POST">
            <div style="display: flexbox"><h1 class="saldo">Saldo Disponible: <?php echo $rs["saldo"];?></h1>
            <input type="number" name="deposito" class="input" placeholder="Monto a depositar">
            <input type="number" name="tarjeta" class="input" placeholder="Numero de tarjeta a depositar">
            <button class="btndep" name="depositar">Depositar</button>
            </form>
            </div>
            </div>
        
        <?php }
            if(isset($_POST['depositar'])){
                $saldo = $rs['saldo'];
                $deposito = $_POST['deposito'];
                $tarjeta1 = $_POST['tarjeta'];
                
                    for($i=0;$i<8;$i++){
                        $ref .= mt_rand(0,9);
                    }
                $depo = $saldo + $deposito;
                
                $querydeposito = "UPDATE cuenta SET saldo = '$depo' WHERE numero_tarjeta = '$tarjeta1'";
                $rsdeposito = mysqli_query($con,$querydeposito) or die(mysqli_error($con));
                $querymovimientos = "INSERT INTO transaccion (ID_usuario_enviar,ID_usuario_recibir,Monto,hora,proposito,referencia)Values('{$rs1['ID']}','{$rs1['ID']}', '$deposito', NOW(), 'deposito','$ref')";
                $rsmovimiento = mysqli_query($con,$querymovimientos) or die(mysqli_error($con));
                header('location: movimientos.php');   
            }    
        ?>
        
        <?php
        if(isset($_POST['btn-retirar'])){
        ?>
            <div class="accion">
            <form method="POST">
            <div style="display: flexbox"><h1 class="saldo">Saldo Disponible: <?php echo $rs["saldo"];?></h1>
            <input type="number" name="retiro" class="input" placeholder="Monto a retirar">
            <button class="btndep" name="retirar">Retirar</button>
            </form>
            </div>
            </div>
        
        <?php }
            if(isset($_POST['retirar'])){
                $saldo = $rs['saldo'];
                $retiro = $_POST['retiro'];
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
                    Saldo Insuficiente </h3></div>';
                }else{
                $reti = $saldo - $retiro;
                for($i=0;$i<8;$i++){
                    $ref .= mt_rand(0,9);
                }
                $queryretiro = "UPDATE cuenta SET saldo = '$reti' WHERE ID_usuario = '{$rs1['ID']}'";
                $rsretiro = mysqli_query($con,$queryretiro) or die(mysqli_error($con));
                $querymovimientos = "INSERT INTO transaccion (ID_usuario_enviar,ID_usuario_recibir,Monto,hora,proposito,referencia)Values('{$rs1['ID']}','{$rs1['ID']}', '$retiro', NOW(), 'retiro','$ref')";
                $rsmovimiento = mysqli_query($con,$querymovimientos) or die(mysqli_error($con));
                header('location: movimientos.php');   
                }
                
            } 
        ?>
    </form>
</div>
</div>