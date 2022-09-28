<?php 
    
    include 'code-register.php'; //se incluye el archivo 
    require '../config/database.php'; //conexion a la base de datos
    $db=new database();
    $con = $db->conectar();
    //consulta que traera al combobox todos los datos de la tabla ciudad
    $sql=$con->prepare("SELECT * FROM ciudad ORDER BY nombre ASC");
    $sql->execute();
    $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../estilosCss/loginUE.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>

<body>
   <!-- por medio de un formulario se le piden los datos personales al usuario -->
    <div class="container-all">

        <div class="ctn-form">
            <h1 class="title">Registrarse</h1>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="">Docuemento de Identificación</label>
                <input type="text" name="docid">
                <span class="msg-error"><?php echo $docid_err; ?></span>

                <label for="">Nombre</label>
                <input type="text" name="username">
                <span class="msg-error"><?php echo $username_err; ?></span>
                
                <label for="">Apellidos</label>
                <input type="text" name="apellido" >
                <span class="msg-error"><?php echo $apellido_err; ?></span>
                
                <label for="">Dirección</label>
                <input type="text" name="direc">
                <span class="msg-error"><?php echo $direc_err; ?></span>
                
                <label for="">Ciudad</label>
                <select name="ciud" class="select">
                    <option value="">Selecionar Ciudad</option>
                    <?php foreach($resultado as $ciudad){ ?>
                    <option value="<?php echo $ciudad['cod_ciudad']; ?>"><?php echo $ciudad['nombre']; ?></option>
                    <?php } ?>
                </select>
                
                <label for="">Fecha de Nacimiento</label>
                <input type="date" name="FN">
                <span class="msg-error"><?php echo $fn_err; ?></span>
                
                <label for="">Numero de Contacto</label>
                <input type="text" name="MV">
                <span class="msg-error"><?php echo $MV_err; ?></span>
                
                <label for="">Correo electronico</label>
                <input type="text" name="email" pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$">
                <span class="msg-error"> <?php echo $email_err; ?></span>
                
                <label for="">Contraseña</label>
                <input type="password" name="password" id="contraseña">
                <img src="../imagenes/ojo.png" class="icon" id="eye" alt="">
                <span class="msg-error"> <?php echo $password_err; ?></span>
                
                
                <input type="submit" value="Registrarse">

            </form>

            <span class="text-footer">¿Ya te has registrado?
                <a href="../ingresar/ingresar.php">Iniciar Sesión</a>
            </span>

            
        </div>

        <div class="ctn-text">
            <div class="capa"></div>
            <h1 class="title-description"></h1>
            <p class="text-description"></p>
        </div>
            
        </div>

    </div>


<!-- se trae ek archivo encargado de mostrar la contraseña -->
    <script src="ojo.js"></script>
</body>

</html>
