/**
 * @file Script contenant les fonctions de recherche
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 * @update 2021-11-26
 * @param  {} "load"
 * @param  {} function(
 */
window.addEventListener("load", function () {
  
   

  function rechercheBouteille(rechercheInput) {
    console.log(rechercheInput)
    rechercheInput.addEventListener("input", (e) => {
     

      let value = e.target.value.toLowerCase().trim();
      console.log(value)
    
      let cartes = document.querySelectorAll('.carte');
      cartes.forEach((card) => {
       let searchColumn = card.querySelector(".carte__description-nom");
        let searchQuery = searchColumn.textContent.toLowerCase().trim();

        if (searchQuery.search(value) == -1 ) { 
            card.style.display="none";
      }else {
        card.style.display="flex";
      }

      
        
      });
    
    });
   
    }

    let rechercheInput = document.querySelector("#b_rech");
    
      if (document.querySelector('.form__recherche--b') != "") {
          rechercheBouteille(rechercheInput);
      }



});
