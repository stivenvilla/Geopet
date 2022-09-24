<?php

    //iniciar sesion
    session_start();
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: bienvenida.php");
        exit;
    }
//conexion a la base de datos
require_once "../config/conexion.php";

//variables vacias
$email = $password ="";
$email_err = $password_err = "";


if($_SERVER["REQUEST_METHOD"] === "POST"){
    
    //se validan con un mensaje de error que los campos de email y password no vallan a estar vacios
    if(empty(trim($_POST["email"]))){
        $email_err = "Por favor, ingrese el correo electronico";
    }else{
        $email = trim($_POST["email"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, ingrese una contraseña";
    }else{
        $password = trim($_POST["password"]);
    }
    

    //validacion de informacion en la base de datos
    if(!empty($email) && !empty($password)){
        
        $sql = "SELECT doc_id, nombres, apellidos, direccion, ciudad, fecha_naci, telefono_movil, correo, clave FROM tblusuario WHERE correo = ?";

        if($stmt=mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            }
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $doc_id, $nombres, $apellidos, $direccion, $ciudad, $fecha_naci, $telefono_movil, $email, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                        session_start();
                        
                        // ALMACENAR DATOS EN VARABLES DE SESION
                        $_SESSION["loggedin"] = true;
                        $_SESSION["doc_id"]=$doc_id; 
                        $_SESSION["correo"] = $email;
                        
                        header("location: bienvenida.php");
                    }else{
                        $password_err = "La contraseña no es valida";
                    }
                    
                } 
            }else{
                    $email_err = "Correo electronico no registrado";
                }
            
        }

        $sqlV="SELECT cod_empresa, nombre, ciudad,  telefono, direccion, servicios, correo, clave FROM ciudadoresguar WHERE correo=?";

        if($stmt2=mysqli_prepare($link, $sqlV)){
            mysqli_stmt_bind_param($stmt2, "s", $param_email);
            
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt2)){
                mysqli_stmt_store_result($stmt2);
            }
            
            if(mysqli_stmt_num_rows($stmt2) == 1){
                mysqli_stmt_bind_result($stmt2, $cod_empresa, $nombre, $ciudad,  $telefono, $direccion, $servicios, $email, $hashed_password);
                if(mysqli_stmt_fetch($stmt2)){
                    if(password_verify($password, $hashed_password)){
                        session_start();
                        
                        // ALMACENAR DATOS EN VARABLES DE SESION
                        $_SESSION["loggedin"] = true;
                        $_SESSION["cod_empresa"]=$cod_empresa; 
                        $_SESSION["correo"] = $email;
                        
                        header("location: ../empresa/datosEmpresa.php");
                    }else{
                        $password_err = "La contraseña no es valida";
                    }
                    
                } 
            }else{
                    $email_err = "Correo electronico no registrado";
                }

        }
        
        //ADMINISTRADOR
        $sqlAD="SELECT * FROM tbladministrador WHERE correo=?";

        if($stmt3=mysqli_prepare($link, $sqlAD)){
            mysqli_stmt_bind_param($stmt3, "s", $param_email);
            
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt3)){
                mysqli_stmt_store_result($stmt3);
            }
            
            if(mysqli_stmt_num_rows($stmt3) == 1){
                mysqli_stmt_bind_result($stmt3,$cod_admin, $correo, $hashed_password);
                if(mysqli_stmt_fetch($stmt3)){
                    if(password_verify($password, $hashed_password)){
                        session_start();
                        
                        // ALMACENAR DATOS EN VARABLES DE SESION
                        $_SESSION["loggedin"] = true;
                        $_SESSION["cod_admin"]=$cod_admin; 
                        $_SESSION["correo"] = $email;
                        
                        header("location: ../administrador/admin.php");
                    }else{
                        $password_err = "La contraseña no es valida";
                    }
                    
                } 
            }else{
                    $email_err = "Correo electronico no registrado";
                }

        }else{
                    echo "algo salio mal, intentalo mas tarde";
                }



    }
    
    mysqli_close($link); //cierre de la conexion a la base de dato
    
}

?>
























