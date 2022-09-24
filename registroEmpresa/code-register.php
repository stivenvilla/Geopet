<?php
    
    // Incluir archivo de conexion a la base de datos
    require_once "../config/conexion.php";
    
    // Definir variable e inicializar con valores vacio
    $docid=$username=$direccion=$servicios=$movil=$ciudad=$email = $password = "";
    $docid_err=$username_err=$sv_err= $direc_err =$MV_err=$email_err = $password_err = $check_err = "";
     
     

    //en el momento de precionar el boton registrarse se validan los campos
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // VALIDANDO INPUT DE documento
        if(empty(trim($_POST["docid"]))){
            $docid_err = "Por favor, ingrese el numero de identificación de la empresa";
        }else{
            //consulta sql
            $sql = "SELECT * FROM ciudadoresguar WHERE cod_empresa = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_docid);
                
                $param_docid = trim($_POST["docid"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $docid_err= "Este documento  ya está en uso";
                    }else{
                        $docid = trim($_POST["docid"]);
                    }
                }else{
                    echo "ha ocurrido un fallo intentelo luego";
                }
            }
        }
        
        // VALIDANDO INPUT DE NOMBRE DE USUARIO
        if(empty(trim($_POST["username"]))){
            $username_err = "Por favor, ingrese el nombre de la empresa";
        }else{
            //consulta sql
            $sql = "SELECT * FROM ciudadoresguar WHERE nombre= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                $param_username = trim($_POST["username"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $username = trim($_POST["username"]);
                }else{
                    echo "ha ocurrido un fallo intentelo luego";
                }
            }
        }

        // VALIDANDO INPUT DE SERVICIO EL CUAL SERA UN TEXTAREA
        if(empty(trim($_POST["service"]))){
            $sv_err = "esta información es requerida para que el usuario pueda conocer sobre la empresa";
        }else{
            //consulta sql
            $sql = "SELECT * FROM ciudadoresguar WHERE servicios= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_servicio);
                
                $param_servicio = trim($_POST["service"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $servicios = trim($_POST["service"]);
                }else{
                    echo "ha ocurrido un fallo intentelo luego";
                }
            }
        }
        

         // VALIDANDO INPUT DE DIRECCION
         if(empty(trim($_POST["direc"]))){
            $direc_err = "Por favor, ingrese su dirección";
        }else{
            //consulta sql
            $sql = "SELECT * FROM ciudadoresguar WHERE direccion= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_direc);
                
                $param_direc = trim($_POST["direc"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $direccion = trim($_POST["direc"]);
                }else{
                    echo "ha ocurrido un fallo intentelo luego";
                }
            }
        }

         // VALIDANDO INPUT DE Ciudad
         if(empty(trim($_POST["ciud"]))){
            $ciud_err = "Por favor, ingrese la ubicacion de la empresa";
        }else{
            //consulta sql
            $sql = "SELECT * FROM ciudadoresguar WHERE ciudad= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_ciud);
                
                $param_ciud = trim($_POST["ciud"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $ciudad = trim($_POST["ciud"]);
                }else{
                    echo "ha ocurrido un fallo intentelo luego";
                }
            }
        }


        // VALIDANDO INPUT DE TELEFONO 
        if(empty(trim($_POST["MV"]))){
            $MV_err = "Por favor, ingrese el numero de contacto sea fijo o movil";
        }else{
            //consulta sql
            $sql = "SELECT * FROM ciudadoresguar WHERE telefono= ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_movil);
                
                $param_movil = trim($_POST["MV"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $MV_err = "Este numero de telefono  ya está en uso";
                    }else{
                        $movil = trim($_POST["MV"]);
                    }
                }else{
                    echo "ha ocurrido un fallo intentelo luego";
                }
            }
        }



        // VALIDANDO INPUT DE EMAIL
        if(empty(trim($_POST["email"]))){
            $email_err = "Por favor, ingrese un correo electronico";
        }else{
            //consulta
            $sql = "SELECT * FROM ciudadoresguar WHERE correo = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                $param_email = trim($_POST["email"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $email_err = "Este correo ya está en uso";
                    }else{
                        $email = trim($_POST["email"]);
                    }
                }else{
                    echo "ha ocurrido un fallo intentelo luego";
                }
            }
        }
 
        // VALIDANDO CONTRASEÑA
        if(empty(trim($_POST["password"]))){
            $password_err = "Por favor, ingrese una contraseña";
        }elseif(strlen(trim($_POST["password"])) < 8){
            $password_err = "La contraseña debe de tener al menos 8 caracteres";
        }elseif(mysqli_stmt_num_rows($stmt) == 1){
            $password_err= "La contraseña no se puede usar";
        }else{ 
            $password = trim($_POST["password"]);
        }
        

        $imagen=addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $situacion="1";
        

        
        // COMPROBANDO LOS ERRORES DE ENTRADA ANTES DE INSERTAR LOS DATOS EN LA BASE DE DATOS
        if(!empty($docid) && !empty($username) && !empty($direccion) && !empty($ciudad) && !empty($movil) && !empty($email) && !empty($password)){
            
            $sql = "INSERT INTO ciudadoresguar(cod_empresa, nombre, ciudad,  telefono, direccion,servicios, correo, clave, foto_establecimiento, situacion) VALUES(?, ?, ?, ?, ?, ?, ?, ?,'$imagen','$situacion')";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "ssssssss", $param_docid, $param_username, $param_ciud, $param_movil,  $param_direc, $param_servicios, $param_email, $param_password);
                
                // ESTABLECIENDO PARAMETRO
                $param_docid=$docid; 
                $param_username = $username; 
                $param_direc=$direccion;
                $param_servicios=$servicios;
                $param_ciud=$ciudad; 
                $param_movil=$movil; 
                $param_email = $email;
                //encriptando la contraseña
                $param_password =password_hash($password, PASSWORD_DEFAULT); 
            
                if(mysqli_stmt_execute($stmt)){
                    echo'
                    <script>alert("Ha sido registrado correctamente");
                    window.location="../ingresar/ingresar.php";
                    </script>
                    '; 
                }else{
                    echo'
                    <script>alert("Ha ocurrido un error intentelo mas tarde");
                    return false; 
                    </script>
                    ';
                }
            }
        }
        
        mysqli_close($link); //cierre de la base de datos
        
    }//cierre de request
    
?>