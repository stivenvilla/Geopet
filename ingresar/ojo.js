 //variables del ojo y la contraseña
 var ojo=document.getElementById('eye'); 
 var clave=document.getElementById('contraseña'); 

 //se crea la funcion para que identificar si el usuario toca el ojo y el campo esta en tipo
//contraseña entonces lo pasara a texto y si al tocar el ojo el campo esta en texto lo pasara a contraseña
ojo.addEventListener("click", function(){
   if(clave.type=="password"){
       clave.type="text"
       ojo.style.opacity=0.8
   }else{
       clave.type="password"
       ojo.style.opacity=0.2
   }
}); 