
<div class="box-line">

    <img src="img/Recurso3.svg" class="logo">


</div>

<div class="caja-login">
        <form method="post">
            <br>
            <br>
            <br>
            <center><label class="txt">INICIO DE SESION</label></center>
            <br>
            <br>
            <div class="btns mt-4">
                <a href="#" class="btn1">Cliente</a>
                <a href="login-admin.php" class="btn2">Administrativo</a>
            </div>

            <div class="flex">
                <input type="number" name="cedula" class="input" placeholder="Cedula de identidad">
            </div>
            <div class="flex">
                <input type="number" name="tarjeta" class="input" placeholder="Numero de tarjeta">
            </div>
            <div class="flex">
                <input type="number" name="pin" class="input" placeholder="Pin">
            </div>

            <br>
            <br>
            <br>
            <center><button type="submit" name="btn-inicio" class="btn3">Entrar</button></center>
            <?php 
            if(isset($_POST['btn-inicio'])){
                if(!empty($_POST['cedula']) && !empty($_POST['tarjeta']) && !empty($_POST['pin'])){
                        $cedula = $_POST['cedula'];
                        $tarjeta = $_POST['tarjeta'];
                        $pin = $_POST['pin'];
                        
                                $cadmin = "SELECT usuario.cedula as cedula,cuenta.numero_tarjeta as tarjeta, cuenta.pin as pin FROM cuenta INNER JOIN 
                                usuario on usuario.ID = cuenta.ID_usuario where usuario.cedula='$cedula' AND cuenta.numero_tarjeta='$tarjeta' AND cuenta.pin='$pin'";
                                $qadmin = mysqli_query($con,$cadmin) or die(mysqli_error($con));
                                $rs = mysqli_num_rows($qadmin);
                                $rs1 = mysqli_fetch_array($qadmin);

                                if($rs > 0){
                                    mysqli_close($con);
                                        session_start();
                                        $_SESSION['cedula'] = $_POST['cedula'];
                                        header('location: inicio.php');
                                }else{echo'ERROR. El usuario o contrasena son incorrectos';}
                        
                }else{echo'ERROR. Rellena todos los campos';}
            }
            ?>
        </form>
    </div>