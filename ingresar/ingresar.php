<?php
//se vincula con el archivo donde esta el backend del login
require 'code-login.php' 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ingresar</title>
    <link rel="stylesheet" href="../estilosCss/login.css">
    <script src="/ojo.js"></script>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>

<body>

    <div class="container-all">

        <div class="ctn-form">
            <h1 class="title">INGRESAR</h1>
            <!--formulario donde tendra dos campos uno de email y el otro de tipo password-->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> <!--se le indica a la pagina que este a la espera de una accion-->
    
                <label for="">Correo electronico</label>
                <input type="text" name="email" pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$">
                <span class="msg-error"> <?php echo $email_err; ?></span>
                
                <label for="">Contraseña</label>
                <input type="password" name="password" id="contraseña" pattern="[a-zA-Z0-9\_\#\-]{8, 16}">
                <img src="../imagenes/ojo.png" class="icon" id="eye" alt="">
                <span class="msg-error"> <?php echo $password_err; ?></span> 
                <!--boton de ingresar-->
                <input type="submit" value="INGRESAR">

            </form>
            
            <!--textos que iran debajo del formulario preguntas para el usuario-->
            <span class="text-footer">¿No te has registrado?
                <a href="perfil.php">Registrarse</a> <br> <br>
                <a href="../ingresar/recuperarClave.php">¿Olvide mi contraseña?</a>
            </span>

            
        </div>

        <div class="ctn-text">
            <div class="capa"></div>
            <h1 class="title-description"></h1>
            <p class="text-description"></p>
        </div>
            
        </div>

        

    </div>



    <script src="ojo.js"></script>
</body>

</html>
