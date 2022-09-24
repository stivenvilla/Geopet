function validacionReporte(){
    //se llaman los ids de los campos del formulario
    var empresa=document.getElementById("cEmpresa").value;
    var id=document.getElementById("docid").value;
    var mensaje=document.getElementById("message").value;
    //se comprueban que los campos no esten vacios y si estan vacios se manda una alerta
    if(empresa===""){
        alert("el campo empresa no puede estar vacio");
        return false; 
     } 

     if(id===""){
      alert("el campo Documento no puede estar vacio");
      return false; 
    
     }
    
     
     if(mensaje===""){
        alert("El campo justificación es requerido");
        return false;
      }

    }