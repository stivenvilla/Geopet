<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../estilosCss/contacto.css">
  <script src="../javaScript/contactoV.js"></script>
  <title>Contacto</title>
</head>
<body>
  <!-- formulario para que el usuario inserte el mensaje -->
  <form  class="form-register"  action="contactoP.php"  method="POST"  id="miformulario" onsubmit="return validacionContacto();">
    <h4>CONTACTO</h4>
    <input class="controls" type="text" name="nombre" id="nombres" placeholder="Ingrese su Nombre"  pattern="[a-zA-ZÀ-ÿ\s]{4,40}" title="No se admiten números ni caracteres especiales">
    <input class="controls" type="email" name="correo" id="correoEL" placeholder="Ingrese su correo electrónico">
    <input class="controls" type="text" name="asunto" id="ASUNTO" placeholder="Ingrese el Asunto">
    <input class="controls" type="text" name="numero" id="tele" placeholder="Ingrese el Teléfono">
    <textarea   name="mensaje" id="MensaJEE" placeholder="Ingrese su mensaje aqui.." ></textarea>
    <input class="boton" type="submit" value="ENVIAR">
  </form>

</body>
</html>