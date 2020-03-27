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
        <a href="inicio.php" class="btn-border btn fa fa-caret-right active">    Posicion</a>
    </div>
    <div class="flex ">
        <a href="movimientos.php" class="btn-border btn">Movimientos</a>
    </div>
    <div class="flex ">
        <a href="transferencia.php" class="btn-border btn">Transferencias</a>
    </div>
    <div class="flex ">
        <a href="dinero.php" class="btn-border btn">Dinero</a>
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
<?php
$dolar = 68000;
$tdolares = $rs['saldo'] / $dolar;
?>
<div class="contenido">
       <div><h1 class="txtp">Posicion de la cuenta</h1></div>
       <div class="mt"><span class="txtc">Cuenta: <?php echo $rs['tipo_de_cuenta'];?></span></div>
       <div><span class="txtf">Hoy:<?php echo '   ',date('d'),'-',date('m'),'-',date('y');?></span></div>
       <div class="mt" style="display:inline-flex;"><h1 class="txts">Saldo: <?php echo $rs['saldo'];?></h1><span style="align-content: center;color:#13ace2;">bs</span></div>
       <div class="mt"><span style="color: #13ace2; font-size: 20px;">Tasa del dolar: <?php echo $dolar;?></span><span style="align-content: center;color:#13ace2;">bs</span></div>
       <div class="mt"><span style="color: #13ace2; font-size: 20px;">Total en dolares: $<?php echo $tdolares;?></span></div>
</div>
</div>

