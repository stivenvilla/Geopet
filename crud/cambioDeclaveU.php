<?php 

session_start();

    $sesion=$_SESSION["doc_id"];
    if(!isset($sesion)){
        header("location: ../ingresar/ingresar.php");
        exit;
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
        <form action="cambiarClave.php" method="post" >
            <p>
                <label>Identificación</label>
                <input type="text" name="docid" id="docid" value="<?php echo $sesion; ?>" require readonly>
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
