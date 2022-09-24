<?php
require_once "../config/database.php";
$db=new database();
$con = $db->conectar();
$tipoUsuario=$_POST['perfil'];
$correo=$_POST['correo'];
$docid=$_POST['docid'];

switch($tipoUsuario){
    case 1:
        $sql=$con->prepare("SELECT correo FROM tblusuario where correo='$correo' and doc_id='$docid'");
        $sql->execute();
        $resultado3=$sql->fetch(PDO::FETCH_ASSOC);
        $correo=$resultado3['correo'];
        if($sql){
            echo'<script>alert("En el momento de cambiar la contraseña usted sera notificado via correo electronico");
            </script>';
            
        }else{
            echo'<script>alert("Sus datos no han sido reconocidos por favor verifique sus datos")
            window.location="../ingresar/recuperarClave.php";
            </script>';
        }
        break;
    case 2:
        $sql=$con->prepare("SELECT correo FROM ciudadoresguar where correo='$correo' and cod_empresa='$docid'");
        $sql->execute();
        $resultado2=$sql->fetch(PDO::FETCH_ASSOC);
        $correo=$resultado2['correo'];
        if($sql){
            echo'<script>alert("En el momento de cambiar la contraseña usted sera notificado via correo electronico");
            </script>';
            
        }else{
            echo'<script>alert("Sus datos no han sido reconocidos por favor verifique sus datos")
            window.location="../ingresar/recuperarClave.php";
            </script>';
        }
        break; 
    case 3:
        $sql=$con->prepare("SELECT correo FROM tbladministrador where correo='$correo' and cod_admin='$docid'");
        $sql->execute();
        $resultado2=$sql->fetch(PDO::FETCH_ASSOC);
        $correo=$resultado2['correo'];
        if($sql){
            echo'<script>alert("En el momento de cambiar la contraseña usted sera notificado via correo electronico");
            </script>';
            
        }else{
            echo'<script>alert("Sus datos no han sido reconocidos por favor verifique sus datos")
            window.location="../ingresar/recuperarClave.php";
            </script>';
        }
        break;
    default:

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GEOPET</title>
  <link rel="stylesheet" href="../estilosCss/reportar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  
</head>
<body>
  <!-- el usuario podra cambiar su clave mediante un formulario en donde debera de poner su 
numero de identificacion para hacer la verificacion de que es el y debe de ingresar la nueva 
contraseña en dos campos para saber si los dos campos son iguales  -->
<div class="content">

<div class="contact-wrapper animated bounceInUp">
    <div class="contact-form">
        <h3>Cambiar Contraseña</h3>
        <form action="mandarClave.php" method="post" >
        <p>
                <label>Tipo de usuario</label>
                <input type="text" name="user" id="docid" value="<?php echo $tipoUsuario; ?>" require readonly>
            </p>
            <p>
                <label>Correo</label>
                <input type="text" name="correo" id="correo" value="<?php echo $correo; ?>" require readonly>
            </p>
            <p>
                <label>Identificación</label>
                <input type="text" name="docid" id="docid" value="<?php echo $docid; ?>" require readonly>
            </p>
            <p>
                <label>Nueva Contraseña</label>
                <input type="password" name="pass" id="nombre" require>
            </p>
            <p>
                <label>Confirmar Contraseña</label>
                <input type="password" name="pass2" id="nombre" require>
            </p>
           
            <p class="block">
                <button>
                    Cambiar
                </button>
            </p>
        </form>
    </div>
    
</div>

</div>


</body>
</html>
