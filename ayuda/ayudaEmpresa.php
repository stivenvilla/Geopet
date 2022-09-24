<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda</title>
    <link rel="stylesheet" href="../estilosCss/ayuda.css">
</head>
<body>
    
    <!--se esta creando el div del boton-->
    <div class="boton">
        <div class="play"></div>
        <p>Video Tutorial</p>
    </div>

    <!--se esta creando el div de lo que va ir dentro del boton al abrirlo-->
    <div class="clip">
        <video src="../videos/RECOMPENSA POR EL CONEJO  LOONEY TUNES CARTOONS  CARTOON NETWORK.mp4" controls></video>
        <b class="cerrar">Cerrar</b>
    </div>




<!--se crea la etiqueta script dentro del html porque es un codigo demasiado corto para crear un nuevo archivo-->
<script>
    //se crean variables
    let boton=document.querySelector('.boton'); 
    let clip=document.querySelector('.clip');
    let cerrar=document.querySelector('.cerrar');
   let video=document.querySelector('video')
   //se crea la funcion para abrir el boton
    boton.onclick=function(){
        boton.classList.add('active'); 
        clip.classList.add('active');
        video.play(); //al abrir el boton el video comenzara automaticamente
        video.currentTime=0; //cada vez que se cierre y se vuelva abrir el boton el video comenzara desde cero
    }

    //se crea la funcion de que al darle en cerrar se reinicie la pagina y el video quede pausado
    cerrar.onclick=function(){
        boton.classList.remove('active'); 
        clip.classList.remove('active');
        video.pause();
    }
</script>
</body>
</html>