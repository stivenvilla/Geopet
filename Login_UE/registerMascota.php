<?php
    
    // Incluir archivo de conexion a la base de datos
    require_once "../config/database.php";
    $db=new database();
    $con = $db->conectar();
    
    // Definir variable e inicializar con valores vacio
    $docid=$_POST['docid'];
    $username=$_POST['username'];
    $raza=$_POST['raza'];
    $recomendaciones=$_POST['recomen'];
    $fechana=$_POST['fechaM'];
     


        $imagen=addslashes(file_get_contents($_FILES['imagenMascota']['tmp_name']));

        
            //se realiza el insertar donde se mandan los datos a la tabla de la mascota
            $sql=$con->prepare("INSERT INTO tblmascota(doc_id, nombreMacota, fechaNaci, raza, recomendaciones, fotoMascota) VALUES('$docid','$username','$fechana','$raza', '$recomendaciones','$imagen')");
            $sql->execute();

            if($sql){
                echo'
                <script>alert("La mascota ha sido registrada si desea registrar otra mascota siga en la pagina de lo contrario oprima el boton omitir al final del formulario para iniciar sesion")
                window.location="../Login_UE/mascotaRegistro.php";
                </script>
                ';              
            }else{
                echo'
                <script>alert("Ha ocurrido un error por favor disculpe las dificultades tecnicas intente mas tarde");
                return false; 
                </script>
                ';
            }
                
        
        
        
        
    
    
?>