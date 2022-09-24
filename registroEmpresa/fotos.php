<?php
 
session_start();
$sesion=$_SESSION["cod_empresa"];
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
  <title>Imagen</title>
  <link rel="stylesheet" href="../estilosCss/fotos.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
  <!-- en esta parte se hace un formulario en donde se pasan dos campos uno de tipo texto y el 
otro de tipo file que serviran para que el usuario inserte la imagen que desea modificar -->
  <div class="wrapper">
    <header>Modificar Ftodo de Establecimiento</header>
    <form action="imagen.php" method="post" enctype="multipart/form-data">
      <div class="dbl-field">
        <div class="field">
          <input type="text" name="docid" value="<?php echo $sesion;?>" required readonly>
          <i class='fas fa-user'></i>
        </div>
      </div>
      <div class="dbl-field">
        <div class="field">
          <input type="file" name="imagen" require>
          <i class='fas fa-globe'></i>
        </div>
      </div>
      
      <div class="button-area">
        <button type="submit">Enviar Imagen</button>
        <span></span>
      </div>
    </form>
  </div>


</body>
</html>
