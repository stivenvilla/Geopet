<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilosCss/tablas.css">
    <link rel="stylesheet" href="../estilosCss/reportes.css">
    <title>PDF</title>
</head>
<body>

    <div class="wrapper">
        <nav>
            <div class="content">
               <div class="logo"> <a href="#">GEOPET</a></div>
               <div class ="inicio" ><a href="../reportes/tabla0cantidadReservas.php">Volver</a></div>
            </div>
        </nav>
      </div>




    <div class="titulo"> Cantidad de reservas por mes</div>

    <div class = "containerFecha" id = "containerFecha1">

        <form method="post" action="../pdfsDescarga/tabla0.php" class="fecha">
            
            <input type="number" class="selecAnio" placeholder="Año"  name="selecAnno" min="2019" max="2023" required>   
            
            <select  class="seleccionarFecha"  name ="selecMes1" required>
                <option value="" disabled selected hidden >1° Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiempre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>

            <select  class="seleccionarFecha"  name ="selecMes2" required>
                <option value="" disabled selected hidden>2° Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiempre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            
                <input type="submit" value="Descargar" name="enviar" class ="enviar" >
        </form>
    </div>
    <br>


    <!-- aca voy -->
    <div class="titulo">Cantidad de reservas por mes en empresa</div>

    <div class = "containerFecha" id = "containerFecha1">

    <form method="post" action="../pdfsDescarga/tabla1.php" class="fecha">
        <input type="text" class = "codEmpresa"  name= "nit" placeholder="Nit" required>
        <input type="number" class="selecAnio" placeholder="Año"  name="selecAnno" min="2019" max="2023" required>   
         
        <select  class="seleccionarFecha"  name ="selecMes1" required>
            <option value="" disabled selected hidden >1° Mes</option>
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Septiempre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>

        <select  class="seleccionarFecha"  name ="selecMes2" required>
            <option value="" disabled selected hidden>2° Mes</option>
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Septiempre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>
        
            <input type="submit" value="Descargar" name="enviar" class ="enviar">
            
        </form>
        
    </div><br>

    <div class="titulo">Cantidad de reservaciones por empresa en el último mes</div>
    
    <div class = "containerFecha" id = "containerFecha0">
    
        <form method="post" action="../pdfsDescarga/tabla2.php" >
            <input type="submit" value="Descargar" name="descargar" class="descargar">
        </form>
    </div><br>

    <!-- aca es la de empresas -->
    <div class="titulo">Cantidad de reservas por empresa</div>

    <div class = "containerFecha" id="containerFecha2">
        
        <form method="post" action="../pdfsDescarga/tabla3.php" class="fecha">
                    
            <input type="number" class="selecAnio" placeholder="Año"  name="selecAnnoI" min="2019" max="2023" required>
            <select  class="seleccionarFecha"  name ="selecMesI" required>
                <option value="" disabled selected hidden >1° Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiempre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>   
            
            <select  class="seleccionarFecha"  name ="selecDiaI" required>
                <option value="" disabled selected hidden>1° Día</option>
                <option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="10">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            
            <div class="espacio"></div>
        
            <input type="number" class="selecAnio" placeholder="Año"  name="selecAnnoF" min="2019" max="2023" required> 
            <select  class="seleccionarFecha"  name ="selecMesF" required>
                <option value="" disabled selected hidden>2° Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiempre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                
            </select>

            <select  class="seleccionarFecha"  name ="selecDiaF" required>
                <option value="" disabled selected hidden>2° Día</option>
                <option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="10">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            <input type="submit" value="Descargar" name="enviar" class="enviar">
                
        </form>

    </div><br>


    <div class="titulo">Servicio más solicitado </div>

    <div class = "containerFecha" id = "containerFecha3">

        <form method="post" action="../pdfsDescarga/tabla4.php" class="fecha">
            <input type="number" class="selecAnio" placeholder="N° meses"  name="selecMes" min="01" max="12" required>   
            <input type="submit" value="Descargar" name="enviar" class ="enviar">       
        </form>
    </div><br>


    
    <h1 class="titulo">Servicio más solicitado en empresa</h1>

    <div class = "containerFecha" id = "containerFecha4">
       
        <form method="post" action="../pdfsDescarga/tabla5.php" class="fecha">  
            <input type="text" class = "codEmpresa"  name= "nit" placeholder="Nit Empresa" required>
            <input type="number" class="selecAnio" placeholder="N° meses"  name="selecMes" min="01" max="12" required>   
            <input type="submit" value="Descargar" name="enviar" class ="enviar">                   
        </form>
        
    </div><br>


    <div class="titulo">Informacion de reservas</div>
    <div class = "containerFecha" id = "containerFecha5">
        <form method="post" action="../pdfsDescarga/tabla6.php" class="fecha">
            <input type="number" class="selecAnio" placeholder="Año"  name="selecAnno" min="2019" max="2023" required>   
           
            <select  class="seleccionarFecha"  name ="selecMes1" required>
                <option value="" disabled selected hidden >1° Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiempre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>

            <select  class="seleccionarFecha"  name ="selecMes2"  required>
                <option value="" disabled selected hidden>2° Mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiempre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            
                <input type="submit" value="Descargar" name="enviar" class ="enviar">
                
        </form>
        

    </div><br>

    <div class="titulo">Usuario con más reserva en una empresa</div>

    <div class = "containerFecha" id = "containerFecha6">
               
        <form method="post" action="../pdfsDescarga/tabla7.php" class="fecha">
            
            <input type="text" class = "codEmpresa"  name= "nit" placeholder="Nit Empresa" required>  
            <input type="submit" value="Descargar" name="enviar" class ="enviar">          
        </form>
    </div><br>

    <div class="titulo">Reservas canceladas por empresa</div>

    <div class = "containerFecha" id = "containerFecha6">
           
        <form method="post" action="../pdfsDescarga/tabla8.php" class="fecha">
            
            <input type="text" class = "codEmpresa"  name= "nit" placeholder="Nit Empresa" required>  
            <input type="submit" value="Descargar" name="enviar" class ="enviar">   
        </form>
    </div><br>

    <div class="titulo"> Reservas activas en empresa</div>

    <div class = "containerFecha" id = "containerFecha6">
      
        <form method="post" action="../pdfsDescarga/tabla9.php" class="fecha">
            
            <input type="text" class = "codEmpresa"  name= "nit" placeholder="Nit Empresa" required>  
            <input type="submit" value="Descargar" name="enviar" class ="enviar">  
        </form>
        
    </div><br>

    <div class="titulo"> Reservas finalizadas por empresa</div>

    <div class = "containerFecha" id = "containerFecha6">
   
        <form method="post" action="../pdfsDescarga/tabla10.php" class="fecha">
            
            <input type="text" class = "codEmpresa"  name= "nit" placeholder="Nit Empresa" required>  
            <input type="submit" value="Descargar" name="enviar" class ="enviar">
                   
        </form>
        
    </div>





    

</body>
</html>