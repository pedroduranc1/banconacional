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
        <a href="dinero.php" class="btn-border btn fa fa-caret-right active">    Transferencias</a>
    </div>
    <div class="flex ">
        <a href="transferencia.php" class="btn-border btn">Dinero</a>
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
    <form method="POST">
        <div><h1 style="font-size: 26px;color:#13ace2;"><i class="fa fa-lock" style="border: 2px solid;border-radius: 25px;padding: 8px;"></i>   Pin de seguridad</h1></div>
        <br>
        <div><span style="color: #b2b2b2;font-size: 22px;">Porfavor. Introduzca el codigo pin de su tarjeta de debito.</span></div>
        <br><br><br><br>
        <div><input type="number" class="inputpin" name="pin" placeholder="Insertar Pin"> <input type="submit" class="btnok" name="btnok" value="Ok"></div>
        <?php if(isset($_POST['btnok'])){
            $qpin = "SELECT pin FROM cuenta WHERE ID_usuario = '{$rs1['ID']}'";
            $rspin = mysqli_query($con,$qpin) or die(mysqli_error($con));
            $pin = mysqli_fetch_array($rspin);
            if(empty($_POST['pin'])){
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
                Error. Porfavor introduzca el pin de seguridad</h3></div>';
            }else{
            
            $pininsert = $_POST['pin'];
            if($pin['pin'] == $pininsert){
                if($rs['saldo'] < $_SESSION['montoreceptor']){
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
                    
                $resta = $rs['saldo'] - $_SESSION['montoreceptor'];

                $crestar = "UPDATE cuenta SET saldo = '$resta' WHERE ID_usuario = '{$rs1['ID']}'";
                $qrestar = mysqli_query($con,$crestar) or die(mysqli_error($con)); 

                $cpersona = "SELECT * FROM usuario WHERE cedula = '{$_SESSION['cedulareceptor']}'";
                $qpersona = mysqli_query($con,$cpersona) or die (mysqli_error($con));
                $rspersona = mysqli_fetch_array($qpersona);
                
                
                $cuentapersona = "SELECT * FROM cuenta WHERE ID_usuario = '{$rspersona['ID']}'";
                $qcuentapersona = mysqli_query($con,$cuentapersona) or die (mysqli_error($con));
                $rscuentapersona = mysqli_fetch_array($qcuentapersona);

                $suma = $rscuentapersona['saldo'] + $_SESSION['montoreceptor'];
                
                $csuma = "UPDATE cuenta SET saldo = '$suma' WHERE ID_usuario = '{$rspersona['ID']}'";
                $qsuma = mysqli_query($con,$csuma) or die(mysqli_error($con)); 
                
                $querymovimientos = "INSERT INTO transaccion (ID_usuario_enviar,ID_usuario_recibir,Monto,hora,proposito,referencia)Values('{$rs1['ID']}','{$rspersona['ID']}', '{$_SESSION['montoreceptor']}', NOW(), 'transferencia','{$_SESSION['referencia']}')";
                $rsmovimiento = mysqli_query($con,$querymovimientos) or die(mysqli_error($con));
                header('location: success.php');
                }
                
            }else{
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
                Error. Pin de seguridad Invalido. </h3></div>';
            }
            }
            
            }?>
    </form>
       
</div>
</div>