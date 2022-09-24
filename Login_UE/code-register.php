<?php
    
    // Incluir archivo de conexion a la base de datos
    require_once "../config/conexion.php";
    
    // Definir variable e inicializar con valores vacio
    $docid=$username=$apellido=$direccion=$ciudad=$fechana=$movil=$email = $password = "";
    $docid_err=$username_err = $apellido_err = $direc_err =$ciud_err=$fn_err=$MV_err=$email_err = $password_err = $check_err = "";
     //variable de checkbox
     

    //en el momento de precionar el boton registrarse se validan los campos
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // VALIDANDO INPUT DE documento
        if(empty(trim($_POST["docid"]))){
            $docid_err = "Por favor, ingrese su numero de identificación";
        }else{
            //consulta sql
            $sql = "SELECT * FROM tblusuario WHERE doc_id = ?";
            
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
                    echo'<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
                }
            }
        }
        
        // VALIDANDO INPUT DE NOMBRE DE USUARIO
        if(empty(trim($_POST["username"]))){
            $username_err = "Por favor, ingrese su nombre";
        }else{
            //consulta sql
            $sql = "SELECT * FROM tblusuario WHERE nombres= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                $param_username = trim($_POST["username"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $username = trim($_POST["username"]);
                }else{
                    echo'<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
                }
            }
        }

        // VALIDANDO INPUT DE APELLIDO
        if(empty(trim($_POST["apellido"]))){
            $apellido_err = "Por favor, ingrese sus apellidos";
        }else{
            //consulta sql
            $sql = "SELECT * FROM tblusuario WHERE apellidos= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_apellido);
                
                $param_apellido = trim($_POST["apellido"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $apellido = trim($_POST["apellido"]);
                }else{
                    echo'<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
                }
            }
        }
        

         // VALIDANDO INPUT DE DIRECCION
         if(empty(trim($_POST["direc"]))){
            $direc_err = "Por favor, ingrese su dirección";
        }else{
            //consulta sql
            $sql = "SELECT * FROM tblusuario WHERE direccion= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_direc);
                
                $param_direc = trim($_POST["direc"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $direccion = trim($_POST["direc"]);
                }else{
                    echo'<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
                }
            }
        }

         // VALIDANDO INPUT DE Ciudad
         if(empty(trim($_POST["ciud"]))){
            $ciud_err = "Por favor, ingrese su residencia";
        }else{
            //consulta sql
            $sql = "SELECT * FROM tblusuario WHERE ciudad= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_ciud);
                
                $param_ciud = trim($_POST["ciud"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $ciudad = trim($_POST["ciud"]);
                }else{
                    echo'<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
                }
            }
        }


         // VALIDANDO INPUT DE fecha de nacimiento
         if(empty(trim($_POST["FN"]))){
            $fn_err = "Por favor, ingrese su fecha de nacimiento";
        }else{
            //consulta sql
            $sql = "SELECT * FROM tblusuario WHERE fecha_naci= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_fechan);
                
                $param_fechan = trim($_POST["FN"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $fechana = trim($_POST["FN"]);
                }else{
                    echo'<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
                }
            }
        }



        // VALIDANDO INPUT DE TELEFONO 
        if(empty(trim($_POST["MV"]))){
            $MV_err = "Por favor, ingrese su numero de contacto sea fijo o movil";
        }else{
            //consulta sql
            $sql = "SELECT * FROM tblusuario WHERE telefono_movil = ?";
            
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
                    echo'<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
                }
            }
        }



        // VALIDANDO INPUT DE EMAIL
        if(empty(trim($_POST["email"]))){
            $email_err = "Por favor, ingrese un correo";
        }else{
            //consulta
            $sql = "SELECT * FROM tblusuario WHERE correo = ?";
            
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
                    echo'<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>';
                }
            }
        }
 
        // VALIDANDO CONTRASEÑA
        if(empty(trim($_POST["password"]))){
            $password_err = "Por favor, ingrese una contraseña";
        }elseif(strlen(trim($_POST["password"])) < 8){
            $password_err = "La contraseña debe de tener al menos 8 caracteres";
        }elseif(mysqli_stmt_num_rows($stmt) == 1){
            $password_err= "Digite otra contraseña digerente";
        }else{ 
            $password = trim($_POST["password"]);
        }
        
        
        // COMPROBANDO LOS ERRORES DE ENTRADA ANTES DE INSERTAR LOS DATOS EN LA BASE DE DATOS
        if(!empty($docid) && !empty($username) && !empty($apellido) && !empty($direccion) && !empty($ciudad) && !empty($fechana) && !empty($movil) && !empty($email) && !empty($password)){
            
            $sql = "INSERT INTO tblusuario(doc_id, nombres, apellidos, direccion, ciudad, fecha_naci, telefono_movil, correo, clave) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "sssssssss", $param_docid, $param_username,$param_apellido, $param_direc, $param_ciud, $param_fechan, $param_movil, $param_email, $param_password);
                
                // ESTABLECIENDO PARAMETRO
                $param_docid=$docid; 
                $param_username = $username;
                $param_apellido=$apellido; 
                $param_direc=$direccion; 
                $param_ciud=$ciudad; 
                $param_fechan=$fechana; 
                $param_movil=$movil; 
                $param_email = $email;
                //encriptando la contraseña
                $param_password =password_hash($password, PASSWORD_DEFAULT); 
            
                if(mysqli_stmt_execute($stmt)){
                    echo'
                     <script>alert("Gracias por registrarse le pedimos que por favor registre su mascota");
                     window.location="mascotaRegistro.php";
                     </script>
                    ';
                }else{
                    echo'<script>alert("Ha ocurrido un error por favor intentelo mas tarde");
                    return false;
                    </script>'; 
                }
            }
        }
        
        mysqli_close($link); //cierre de la base de datos
        
    }//cierre de request
    
?>