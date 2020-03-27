

<div class="box-line">

    <img src="img/Recurso3.svg" class="logo">


</div>

<div class="caja-login">
        <form method="post">
            <br>
            
            <center><label class="txt">REGISTRO DE USUARIO</label></center>
            <br>
            <br>
            <div class="btns mt-4">
                <a href="login.php" class="btn2">Inicio</a>
                <a href="#" class="btn1">Administrativo</a>
            </div>

            <div class="flex">
                <input type="text" name="nombre" class="input" placeholder="Nombre">
            </div>
            <div class="flex">
                <input type="text" name="apellido" class="input" placeholder="Apellido">
            </div>
            <div class="flex">
                <input type="number" name="cedula" class="input" placeholder="Cedula de identidad">
            </div>
            <div class="flex">
                <input type="number" name="tarjeta" class="input" placeholder="Numero de tarjeta">
            </div>
            <div class="flex">
                <input type="date" name="fecha_nacimiento" class="input" placeholder="Fecha de nacimiento">
            </div>
            <div class="flex">
                <input type="text" name="tcuenta" class="input" placeholder="Ahorro/Corriente">
            </div>
            <div class="flex">
                <input type="number" name="pin" class="input" placeholder="Pin">
            </div>
            <br>
            <center><button type="submit" name="btn-inicio" class="btn3">Registar</button></center>
            <?php 
            if(isset($_POST['btn-inicio'])){
                if(!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['cedula']) && !empty($_POST['tarjeta'])&& !empty($_POST['fecha_nacimiento'])&& !empty($_POST['tcuenta'])&& !empty($_POST['pin'])){
                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
                        $cedula = $_POST['cedula'];
                        $fecha_de_nacimiento = $_POST['fecha_nacimiento'];
                        $tcuenta = $_POST['tcuenta'];
                        $tarjeta = $_POST['tarjeta'];
                        $pin = $_POST['pin'];
                        
                                $cadmin1 = "INSERT INTO usuario (nombre,apellido,cedula,fecha_de_nacimiento) VALUES ('$nombre','$apellido','$cedula','$fecha_de_nacimiento')";
                                $qadmin1 = mysqli_query($con,$cadmin1) or die(mysqli_error($con));
                                $cadmin3 = "SELECT usuario.ID from usuario where usuario.cedula = '$cedula'";
                                $qadmin3 = mysqli_query($con,$cadmin3) or die(mysqli_error($con));
                                $id = mysqli_fetch_array($qadmin3);
                                $ceros= 0000;
                                $ncuenta = $ceros+$tarjeta;
                                $cadmin2 = "INSERT INTO cuenta (numero_tarjeta,tipo_de_cuenta,numero_cuenta,pin,ID_usuario)VALUES('$tarjeta','$tcuenta','$ncuenta','$pin','{$id['ID']}')";
                                $qadmin2 = mysqli_query($con,$cadmin2) or die(mysqli_error($con));
                                        

                                        mysqli_close($con);
                                        session_start();
                                        header('location: login.php');
                                    
                                
                                
                        
                }else{echo'ERROR. Rellena todos los campos';}
            }
            ?>
        </form>
    </div>