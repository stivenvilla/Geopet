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
numero de identificacion para hacer la verificacion -->
<div class="content">

<div class="contact-wrapper animated bounceInUp">
    <div class="contact-form">
        <h3>Recuperar Contraseña</h3>
        <form action="cambioDeclaveG.php" method="post" >
            <p>
            <label for="">Tipo de Usuario</label>
                <select name="perfil" class="select">
                    <option value="1">Usuario</option>
                    <option value="2">Empresa</option>
                    <option value="3">Administrador</option>
                </select>
            </p>
            <p>
                <label>Documento de Identificación</label>
                <input type="text" name="docid" id="docid" require>
            </p>
            <p>
                <label>Correo Electronico</label>
                <input type="text" name="correo" id="docid" require>
            </p>
            <p class="block">
                <button>
                    Validar
                </button>
            </p>
        </form>
    </div>
    
</div>

</div>


</body>
</html>
