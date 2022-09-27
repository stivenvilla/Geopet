<?php 
    
    require '../config/database.php';
    $db=new database();
    $con = $db->conectar();


    $sql3=$con->prepare("SELECT cod_especie, nombre FROM tblespecie ORDER BY nombre ASC");
    $sql3->execute();
    $resultado3=$sql3->fetchAll(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../estilosCss/registroempresa.css">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script language="javascript" src="../config/jquery-3.6.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
<script>  
      swal("RECUERDA", "Señor usuario recuerde que la información que se inserte debe de ser verídica esta es de suma importancia para las empresas");
</script>

    <div class="container-all">

        <div class="ctn-form">
            <h1 class="title">Registro Mascotas</h1>
            
            <form action="../Login_UE/registerMascota.php" method="post" enctype="multipart/form-data" >
                <label for="">Numero de Identificación</label>
                <input type="text" name="docid">
                

                <label for="">Nombre de la Mascota</label>
                <input type="text" name="username">
                
                <label for="">Fecha Nacimiento</label>
                <input type="date" name="fechaM">
                
                <label for="">Foto</label>
                <div id="div_file">
                <p id="texto">Foto de Mascota</p>
                <input type="file" id="btn_enviar" name="imagenMascota">
                </div>
                
            
                <p>
                <label>Especie</label>
                <select name="especie" id="especie" class="select">
                <option value="0">Selecionar Especie</option>
                <?php foreach($resultado3 as $especie){ ?>
                    <option value="<?php echo $especie['cod_especie'];?>"><?php echo $especie['nombre']; ?></option>
                    <?php } ?>
                </select>
            </p>
            <p>
                <label>Raza</label>
                <select name="raza" id="raza" class="select">    
                </select>
            </p>

                <label for="">Recomendaciones</label>
                <textarea name="recomen" id="" cols="30" rows="10" maxlength="120" placeholder="Por favor escriba caracteristicas de la mascota como habitos, patologias, vacunas entre otros esto con la finalidad de que reciva el mejor trato"></textarea>
                
                
                <input type="submit" value="Registrar">

            </form>

            <span class="text-footer">¿No desea registrar?
                <a href="../ingresar/ingresar.php">Omitir</a>
            </span>

            
        </div>

        <div class="ctn-text">
            <div class="capa"></div>
            <h1 class="title-description"></h1>
            <p class="text-description"></p>
        </div>
            
        </div>

    </div>


<!-- este es el codigo para cargar la raza dependiendo de la especie -->

    <script type="text/javascript">
			$(document).ready(function(){
                console.log("archivo cargado");
				$("#especie").change(function () {

					$("#especie option:selected").each(function () {
						cod_especie = $(this).val();
						$.post("llenarRaza.php", {cod_especie: cod_especie}, function(data){
							$("#raza").html(data);
						});            
					});

				})
			});
    </script>



    
</body>

</html>
