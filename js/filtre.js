
/**
 * @file Script contenant les fonctions filres pour la page bouteilles
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 * @update 2021-11-22
 * @param  {} "load"
 * @param  {} function(
 */

window.addEventListener("load", function () {
 
   //////////////////////////////////////////////
    //Fonction filtres bouteilles               //
    //////////////////////////////////////////////
  
    let filtres = document.querySelector('.filtres');
    filtres.addEventListener('click', (e) => {
      e.preventDefault();
      console.log('filtres');
      let modal = document.querySelector(".filtres__modal__wrapper");
      modal.classList.toggle("show");

      // Nom ASC
      let sortNomUp = document.querySelector('.nomASC');
      
          sortNomUp.addEventListener('click', (e) => {
            console.log(e.target)

            // Récuperer les bouteilles dans l'ordre demandé
            fetchBouteilles(id,'ASC','nom');
          });
      // Nom DESC
      let sortNomDown = document.querySelector('.nomDESC');
      
          sortNomDown.addEventListener('click', (e) => {
            console.log(e.target)

            // Récuperer les bouteilles dans l'ordre demandé
            fetchBouteilles(id,'DESC','nom');
          });
      
          // Prix ASC
        let sortPrixUp = document.querySelector('.prixASC');
       
          sortPrixUp.addEventListener('click', (e) => {
            console.log(e.target)

            // Récuperer les bouteilles dans l'ordre demandé
            fetchBouteilles(id,'ASC','prix');
          });
          // Fermeture du modale de filtres
          document.querySelector('.btn-filtre').addEventListener('click', (e) => {
            modal.classList.remove('show');
          })
          // 
    })

    // Fonction de récuperation des bouteilles dans l'ordre

  function fetchBouteilles(id,ordre,champs) {
    var param = {
      id: id,
      ordre: ordre,
      col: champs
    };
    console.log(param);
    let requete = new Request("index.php?requete=getCellierTrie", {
      method: "POST",
      body: JSON.stringify(param),
    });
    console.log(requete);
    fetch(requete)
      .then((response) => {
        response.json()
       console.log(response)
      })
      .then((res) => {
       
        var url_string = "index.php?requete=getListeBouteilles&id="+id+"&ordre="+ordre+"&col="+champs; 
        window.location.href=url_string;

      })
      .catch(error => console.log(error));
    
  } 
})