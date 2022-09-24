<?php
  require '../config/database.php';
  $db=new database();
  $con = $db->conectar();
  $documento=$_POST['docid'];
  $password =$_POST["pass"];
  $confirmacion=$_POST['pass2'];
  //se hara la verificacion de que la contraseña y la confirmacion sean iguales y se hara 
  //la incriptacion de la clave y se modificara en la base de datos
  if($password===$confirmacion){
    $param_password =password_hash($password, PASSWORD_DEFAULT);
    $sql=$con->prepare("UPDATE tblusuario SET clave='$param_password' where doc_id='$documento'");
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