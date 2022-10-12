function validacionContacto(){
    //se llaman los ids de los campos del formulario
    var empresa=document.getElementById("empresa").value;
    var docdi=document.getElementById("docid").value;
    var nombre=document.getElementById("nombre").value;
    var fecha=document.getElementById("naci").value;
    var especie=document.getElementById("especie").value;
    var raza=document.getElementById("raza").value;
    var servicio=document.getElementById("servicio").value;
    var mensaje=document.getElementById("recomendacion").value;
    
    //se comprueban que los campos no esten vacios y si estan vacios se manda una alerta
    if(empresa===""){
        alert("verifique que el campo empresa este lleno o tenga el dato correcto");
        return false; 
     } 
    
     
     if(docdi===""){
        alert("Porfavor verifique su documento de identificación");
        return false;
      }

      if(nombre===""){
        alert("verifique que el campo nombre este lleno o tenga el dato correcto");
        return false; 
     }
     
     if(fecha===""){
        alert("verifique que el campo Fecha de nacimiento este lleno o tenga el dato correcto");
        return false; 
     } 

     if(especie===""){
        alert("verifique que el campo especie este lleno o tenga el dato correcto");
        return false; 
     } 
     if(raza===""){
        alert("verifique que el campo raza este lleno o tenga el dato correcto");
        return false; 
     } 

     if(servicio===""){
        alert("verifique que el campo servicio este lleno o tenga el dato correcto");
        return false; 
     } 
     if(mensaje===""){
        alert("por favor llene este campo esto es con el objectivo de que los profesionales tengan información importante de la mascota como lesiones, enfermedades, alergias entre otros");
        return false; 
     } 

    
    }
    
    
    
    