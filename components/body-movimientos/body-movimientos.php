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
        <a href="movimientos.php" class="btn-border btn fa fa-caret-right active">    Movimientos</a>
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
<div class="contenido">
       <div><h1 style="color: #13ace2;font-weight: normal;">Movimientos</h1></div>
       <div style="margin-top: 20px;margin-left: 10px">
        
        <div class="movimientos">
        <table class="tabla mtm">
        
        <tr class="tablem">
            <th class="lbltabla"><i class="fa fa-clock"></i>   Dia/Hora</th>
            <th class="lbltabla"><i class="fa fa-money-bill"></i> Monto</th>
            <th class="lbltabla"><i class="fa fa-user"></i> Referencia</th>
            <th class="lbltabla"><i class="fa fa-user"></i> Tipo </th>
        </tr>
        <?php 

            $cmovimientos = "SELECT  * FROM transaccion where ID_usuario_enviar = '{$rs1['ID']}' OR ID_usuario_recibir = '{$rs1['ID']}'";
            $qmovimientos = mysqli_query($con,$cmovimientos) or die(mysqli_error($con));
            
            while($movientos = mysqli_fetch_array($qmovimientos))
            {
                $userrecibe = $movientos['proposito'];
        ?>
        
            <tr>
                <th class="lbltabla1"><?php echo $movientos['hora']; ?></th>
                <th class="lbltabla1 <?php if($movientos['proposito'] == 'deposito')
                                            {echo 'lble';}
                                           if($movientos['proposito'] == 'retiro')
                                            {echo 'lblr';} 
                                           if($movientos['proposito'] == 'transferencia' && $movientos['ID_usuario_recibir'] == $rs1['ID'])
                                            {echo 'lble';}
                                           if($movientos['proposito'] == 'transferencia' && $movientos['ID_usuario_enviar'] == $rs1['ID'])
                                            {echo 'lblr';}
                                           if($movientos['proposito'] == 'pago de servicio')
                                            {echo 'lblr';}   
                                            ?>">
                <?php if($movientos['proposito'] == 'transferencia' && $movientos['ID_usuario_recibir'] == $rs1['ID'])
                        {echo '+';}
                      if($movientos['proposito'] == 'transferencia' && $movientos['ID_usuario_enviar'] == $rs1['ID'])
                        {echo '-';}
                      if($movientos['proposito'] == 'retiro')
                        {echo '-';}
                      if($movientos['proposito'] == 'deposito')
                        {echo '+';}
                      if($movientos['proposito'] == 'pago de servicio')
                        {echo '-';}
                ?>
                <?php echo $movientos['Monto'];?></th>
                <th class="lbltabla1"><?php echo $movientos['Referencia'];?></th>
                <th class="lbltabla1"><?php echo $movientos['proposito'];?></th>
            </tr>
        <?php }?>
        </table>
            
        </div>
       </div>
</div>
</div>