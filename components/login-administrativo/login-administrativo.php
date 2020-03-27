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
                <a href="login.php" class="btn2">Cliente</a>
                <a href="login-administrativo.php" class="btn1">Administrativo</a>
            </div>

            <div class="flex">
                <input type="number" name="cedula" class="input" placeholder="Cedula de identidad">
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
                if(!empty($_POST['cedula']) && !empty($_POST['pin'])){
                        $cedula = $_POST['cedula'];
                        $pin = $_POST['pin'];
                        
                                $cadmin = "SELECT * FROM usuario WHERE cedula = '$cedula' AND tipo = 'admin'";
                                $qadmin = mysqli_query($con,$cadmin) or die(mysqli_error($con));
                                $rsadmin = mysqli_fetch_array($qadmin);

                                $cuentaadmin = "SELECT * FROM cuenta WHERE ID_usuario = '{$rsadmin['ID']}'";
                                $qcuentaadmin = mysqli_query($con,$cuentaadmin) or die(mysqli_error($con));
                                $rscuentaadmin = mysqli_fetch_array($qcuentaadmin);
                                
                                if($rsadmin['tipo']= 'admin'){
                                    if($pin == $rscuentaadmin['pin']){
                                        mysqli_close($con);
                                            session_start();
                                            header('location: registro.php');
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
                                        Usuario o pin incorrecto. </h3></div>';
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
                                        No posees privilegios de administrador. </h3></div>';
                                }

                                
                                
                        
                }else{echo '<div style= "background: #DC143C;
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
                    ERROR. Rellene todos los campos </h3></div>';}
            }
            ?>
        </form>
    </div>