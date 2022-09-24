<?php

$foto_err=$cert_err=""; 

$nombre_imagen=$_FILES['foto']['name']; 
$tipo_imagen=$_FILES['foto']['type']; 
$tamaño_imagen=$_FILES['foto']['size']; 

if($tamaño_imagen<=1000000){
    if($tipo_imagen=="image/jpeg" !! $tipo_imagen=="image/jpg" !! $tipo_imagen=="image/png" !! $tipo_imagen=="image/gif" ){
        $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/intranet/uploads/'; 

        move_uploaded_file($_FILES['foto']['tmp_name'], $carpeta_destino.$nombre_imagen); 
    }else{
        $foto_err="solo se pueden subir imagenes tipo png, gif, jpg, jpeg"; 
    }
}else{
    $foto_err="El tamaño de la imagen debe de ser menor a 1 mega"; 
}


//imagen de los certificados
$nombre_imagen2=$_FILES['certi']['name']; 
$tipo_imagen2=$_FILES['certi']['type']; 
$tamaño_imagen2=$_FILES['certi']['size']; 


if($tamaño_imagen2<=1000000){
    if($tipo_imagen2=="image/jpeg" !! $tipo_imagen2=="image/jpg" !! $tipo_imagen2=="image/png" !! $tipo_imagen2=="image/gif" ){
        $carpeta_destino2=$_SERVER['DOCUMENT_ROOT'].'/intranet/uploads/'; 

        move_uploaded_file($_FILES['certi']['tmp_name'], $carpeta_destino2.$nombre_imagen2); 
    }else{
        $cert_err="solo se pueden subir imagenes tipo png, gif, jpg, jpeg"; 
    }
}else{
    $cert_err="El tamaño de la imagen debe de ser menor a 1 mega"; 
}


?>