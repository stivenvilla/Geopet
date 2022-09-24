<?php
  require '../config/database.php';
  $db=new database();
  $con = $db->conectar();
  $documento=$_POST['docid'];
  $password =$_POST["pass"];
  $confirmacion=$_POST['pass2'];
  /*se traen los datos por medio de post desde el formulario y luego se hace una 
  validacion de que si las contraseñas que inserto son iguales realice primero el hash que lo 
  que se encarga de incriptar la contrasela y luegro se hace un update para modificar la clave
  */
  if($password===$confirmacion){
    $param_password =password_hash($password, PASSWORD_DEFAULT);
    $sql=$con->prepare("UPDATE ciudadoresguar SET clave='$param_password' where doc_id='$documento'");
    $sql->execute();

    if($sql){
        echo'
          <script>alert("Apreciado usuario su contraseña ha sido modificada");
          window.location="../ingresar/cerrar-sesion.php";
          </script>
        
        ';
      }
    
  }else{
    echo'
    <script>alert("Las contraseñas no son iguales por favor verifiquelas");
    return false; 
    </script>
  
  ';
  }


  

 

  
?>