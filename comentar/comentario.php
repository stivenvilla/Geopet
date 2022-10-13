<?php
    
    // Incluir archivo de conexion a la base de datos
    require_once "../config/conexion.php";
    
    // Definir variable e inicializar con valores vacio
    $correo=$telefono=$mensaje= "";
    $correo_err=$telefono_err = $mensaje_err = "";
     //variable de checkbox
     

    //en el momento de precionar el boton registrarse se validan los campos
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // VALIDANDO INPUT DE correo
        if(empty(trim($_POST["correo"]))){
            $correo_err = "Requerido";
        }else{
            //consulta sql
            $sql = "SELECT * FROM comentarios WHERE correo = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_correo);
                
                $param_docid = trim($_POST["correo"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                        $correo = trim($_POST["correo"]);
                    
                }else{
                    echo'
                    <script>alert("Ha ocurrido un error, Por favor intentelo mas tarde");
                    window.location="../ingresar/bienvenida.php";
                    </script>';
                }
            }
        }
        
        // VALIDANDO INPUT DE NOMBRE DE telefono
        if(empty(trim($_POST["telefono"]))){
            $telefono_err = "Requerido";
        }else{
            //consulta sql
            $sql = "SELECT * FROM comentarios WHERE contacto= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_tele);
                
                $param_tele = trim($_POST["telefono"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $telefono = trim($_POST["telefono"]);
                }else{
                    echo'
                    <script>alert("Ha ocurrido un fallo por favor intentelo mas tarde");
                    window.location="../ingresar/bienvenida.php";
                    </script>';
                }
            }
        }

        // VALIDANDO INPUT DE mensaje
        if(empty(trim($_POST["mensaje"]))){
            $mensaje_err = "Requerido";
        }else{
            //consulta sql
            $sql = "SELECT * FROM comentarios WHERE mensaje= ?";
            //sentencia preparada
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_mensa);
                
                $param_mensa = trim($_POST["mensaje"]);
                
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                   $mensaje = trim($_POST["mensaje"]);
                }else{
                    echo'
                    <script>alert("Ha ocurrido un fallo por favor intentelo mas tarde");
                    window.location="../ingresar/bienvenida.php";
                    </script>';
                }
            }
        }
        
        

         
        
        // COMPROBANDO LOS ERRORES DE ENTRADA ANTES DE INSERTAR LOS DATOS EN LA BASE DE DATOS
        if(!empty($correo) && !empty($telefono) && !empty($mensaje)){
            
            $sql = "INSERT INTO comentarios( correo, contacto, mensaje, fechaComent) VALUES(?, ?, ?, CURDATE())";
            
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "sss", $param_correo, $param_tele, $param_mensa);
                
                // ESTABLECIENDO PARAMETRO
                $param_correo=$correo; 
                $param_tele = $telefono;
                $param_mensa=$mensaje; 
                
                if(mysqli_stmt_execute($stmt)){
                    header("Location:../ingresar/bienvenida.php"); 
                }else{
                    echo'
                    <script>alert("Ha ocurrido un fallo por favor intentelo mas tarde");
                    window.location="../ingresar/bienvenida.php";
                    </script>';
                }
            }
        }
        
        mysqli_close($link); //cierre de la base de datos
        
    }//cierre de request
    
?>