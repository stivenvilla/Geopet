function validacionContacto(){
//se llaman los ids de los campos del formulario
var nombre=document.getElementById("nombres").value;
var correoElectronico=document.getElementById("correoEL").value;
var asuntoContact=document.getElementById("ASUNTO").value;
var mensajeCotact=document.getElementById("MensaJEE").value;
var telefono=document.getElementById("tele").value;

//se comprueban que los campos no esten vacios y si estan vacios se manda una alerta
if(nombre==="" || nombre.length < 4){
    alert("verifique que el campo nombre este lleno o tenga el dato correcto");
    return false; 
 } 

 //se verifica que no este vacio y que dentro de lo que el usuario escriba haya una @
 if(correoElectronico.indexOf("@") == -1 || correoElectronico.length < 6){
    alert("Porfavor ingrese un correo electronico valido");
    return false;
  }

  if(telefono===""){
   alert("El campo telefono es requerido");
   return false;
} 
  



 if(asuntoContact===""){
    alert("verifique que el campo Asunto este lleno o tenga el dato correcto");
    return false; 
 } 
 
if(mensajeCotact==="" || mensajeCotact.length< 8){
    alert("el mensaje debe de tener por lo menos 8 letras")
    return false;
} 

}



