
/**
 * @file Script contenant les fonctions filres pour la page bouteilles
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 * @update 2021-11-22
 * @param  {} "load"
 * @param  {} function(
 */

window.addEventListener("load", function () {
  


console.log(dataB)



   //////////////////////////////////////////////
    //Fonction filtres bouteilles               //
    //////////////////////////////////////////////
  
    let filtres = document.querySelector('.filtres');
    filtres.addEventListener('click', (e) => {
      e.preventDefault();
      console.log('filtres');
      let modal = document.querySelector(".filtres__modal__wrapper");
      modal.classList.toggle("show");
    })

   
})