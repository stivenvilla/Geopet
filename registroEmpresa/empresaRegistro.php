<?php 
    
    include 'code-register.php';

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
    <link rel="stylesheet" href="../estilosCss/registroempresa.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>

<body>
<!-- lo que se hara un formulario en donde la empresa debera de colocar sus datos personas que seran mostrados al usuario
estos se enviaran por post y el furmulario contara con el enctype="multipart/form-data" para poder enviar archivos  -->
    <div class="container-all">

        <div class="ctn-form">
            <h1 class="title">Registrarse</h1>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" >
                <label for="">Numero de Identificación</label>
                <input type="text" name="docid">
                <span class="msg-error"><?php echo $docid_err; ?></span>

                <label for="">Nombre</label>
                <input type="text" name="username">
                <span class="msg-error"><?php echo $username_err; ?></span>
                
                <label for="">Ciudad</label>
                <select name="ciud" class="select">
                <option value="">Selecionar Ciudad</option>
                    <?php foreach($resultado as $ciudad){ ?>
                    <option value="<?php echo $ciudad['cod_ciudad']; ?>"><?php echo $ciudad['nombre']; ?></option>
                    <?php } ?>
                </select>

                 
                <label for="">Numero de Contacto</label>
                <input type="text" name="MV">
                <span class="msg-error"><?php echo $MV_err; ?></span>

                <label for="">Dirección</label>
                <input type="text" name="direc">
                <span class="msg-error"><?php echo $direc_err; ?></span>
                
                
                
                <label for="">Servicios</label>
                <textarea name="service" id="" cols="30" rows="10" maxlength="120" placeholder="Escriba aca una pequeña descripción de los servicios que ofrece..."></textarea>
                <span class="msg-error"><?php echo $sv_err; ?></span>

                <label for="">Foto</label>
                <div id="div_file">
                <p id="texto">Foto de Establecimiento</p>
                <input type="file" id="btn_enviar" name="imagen">
                </div>
                
            
                <label for="">Correo Electronico</label>
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

        <!-- esta es la parte derecho que es un contenidor en donde se pondra para llenar espacio-->
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
