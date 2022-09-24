//lo que se hara en este codigo sera el buscador en donde se pondra con filtros para que cuando la persona busque en el input de busqueda valla dandole resultados

document.addEventListener("keyup", e=>{

  if (e.target.matches("#buscador")){

      if (e.key ==="Escape")e.target.value = ""

      document.querySelectorAll(".usuario").forEach(pet =>{

          pet.textContent.toLowerCase().includes(e.target.value.toLowerCase())
            ?pet.classList.remove("filtro")
            :pet.classList.add("filtro")
      })

  }


})