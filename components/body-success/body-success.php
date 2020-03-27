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
        <a href="transferencia.php" class="btn-border btn fa fa-caret-right active">    Transferencias</a>
    </div>
    <div class="flex ">
        <a href="dinero.php" class="btn-border btn">Dinero</a>
    </div>
    <div class="flex ">
        <a href="" class="btn-border btn">Pago de servicios</a>
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
       <div><h1 style="color: #13ace2;">Transferencia Exitosa</h1></div>
       <br><br>
       <div class="recibo">
           <h3 class="lblrecibo">Nombre: <?php echo $rs1['nombre'],' ',$rs1['apellido'];?></h3>
           <h3 class="lblrecibo">Cedula/Rif: <?php echo $rs1['cedula'];?></h3>
           <h3 class="lblrecibo">Numero de tarjeta: <?php echo $rs['numero_tarjeta'];?></h3>
           <br>
        <hr>
           <br>
           <h3 class="lblrecibo">Nombre: <?php echo$_SESSION['nombrereceptor'];?></h3>
           <h3 class="lblrecibo">Cedula/Rif: <?php echo$_SESSION['cedulareceptor'];?></h3>
           <h3 class="lblrecibo">Numero de tarjeta: <?php echo$_SESSION['tarjetareceptor'];?></h3>
           <h3 class="lblrecibo">Monto: <?php echo$_SESSION['montoreceptor'];?> bs</h3>
            <br>
           <div>
               <h3 class="lblreferencia">Referencia: <?php echo$_SESSION['referencia'];?></h3><div style="float: right;"><img src="img/Recurso2.svg" class="logor"></div>
           </div>

           <br><br>
       </div>
</div>
</div>