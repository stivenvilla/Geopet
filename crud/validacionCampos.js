function validacionCont(){
    //se llaman los ids de los campos del formulario
    var conta=document.getElementById("con1").value;
    var conta2=document.getElementById("con2").value;
   
    
    //se comprueban que los campos no esten vacios y si estan vacios se manda una alerta
    if( conta==="" || conta2===""){
        alert("Se ha detectado campos vacios Por favot verifique si los campos estan completos");
        return false; 
     } 

     if( conta  != conta2){
        alert("las contraseñas no coinciden por favor verifique los datos");
        return false; 
     } 
    
    
    }
    
    
    
    