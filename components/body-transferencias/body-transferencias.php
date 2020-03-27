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
<div><h1 style="color: #13ace2;">Transferencias </h1></div>
<br><br>
       <div>
           <form method="POST">
           <button type="submit" name="btnMismoBanco" class="btnb <?php if(isset($_POST['btnMismoBanco'])){echo "activebtnb";}?>">Mismo Banco</button>
           <button type="submit" name="btnOtrosBancos" class="btnb <?php if(isset($_POST['btnOtrosBancos'])){echo "activebtnb";}?>">Otros Bancos</button>
            <?php 
            if(isset($_POST['btnOtrosBancos'])){
                $opc2 = true;
            }else{$opc1 = false;}
            ?>
           </form>
       </div>

       <div style="width:250%">
            <form method="POST">
            <br><br>
           <input type="text" class="inputt" name="nombre" placeholder="Nombre">
           <br><br>
           <input type="number" class="inputt" name="cedula" placeholder="Cedula">
           <br><br>
           <input type="number" class="inputt" name="tarjeta" placeholder="Numero de tarjeta">
           <br><br>
           <input type="number" class="inputt" name="monto" placeholder="Monto">
           <br><br><br>
           <input type="submit" name="btntransferir" class="btntransferir" value="Transferir">
           <?php if(isset($_POST['btntransferir']))
           {
                if(empty($_POST['nombre']) && empty($_POST['cedula']) && empty($_POST['tarjeta']) && empty($_POST['monto'])){
                    
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
                   Error. Rellene todos los campos</h3></div>';  
                }else{
                    for($i=0;$i<8;$i++){
                        $ref .= mt_rand(0,9);
                    }
                    $_SESSION['nombrereceptor'] = $_POST['nombre'];
                    $_SESSION['cedulareceptor'] = $_POST['cedula'];
                    $_SESSION['tarjetareceptor'] = $_POST['tarjeta'];
                    $_SESSION['montoreceptor'] = $_POST['monto'];
                    $_SESSION['referencia'] = $ref;

                    

                    header('location: seguridad.php');
                    
                }   
            
           }?>
            </form>
       </div>
</div>
</div>