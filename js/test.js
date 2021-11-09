let supprimerCellier = element.querySelectorAll(".c__supp");
      
supprimerCellier.forEach((element) => {
        let id = element.dataset.cellid;
        console.log(id);
        element.addEventListener('click', (e)=> {
          
          //Afficher Modal  //
        let modal = document.querySelector(".modal__wrapper");
        modal.classList.toggle("show");
  
        //Fermeture du modal //
  
        let fermerBouton = document.querySelector(".fermer");
        fermerBouton.addEventListener("click", function (e) {
          let modal = document.querySelector(".modal__wrapper");
          modal.classList.remove("show");
        })
        let annBouton = document.querySelector(".btn__annuler");
      annBouton.addEventListener("click", function (e) {
        let modal = document.querySelector(".modal__wrapper");
        modal.classList.remove("show");
      });
     
      
      // Supprimer cellier apres confirmation
      
      let suppCell = document.querySelector(".btn__danger");
      console.log(suppCell)
      suppCell.addEventListener('click', (evt) => {
        console.log(id);
        let requete = new Request("index.php?requete=suppCellier", {
          method: "DELETE",
          body: '{"id": ' + id + "}",
        });
        console.log(requete);
        
        fetch(requete)
            .then(response => {
                if (response.status === 200) {

                  console.log(response);
                  // window.location.href = 'index.php?requete=accueil';
                  return response.json();
                } else {
                  throw new Error('Erreur');
                }
              }).then((data) => {
                console.log(data)
                // modal.classList.remove('show'); //fermeture du modal.
                uArticle.remove();
                document.querySelector(".msg-supprime").innerText = "Cellier supprimé."
               
                }).catch(error => {
          console.error(error);
        });
       
      });

    })
    });
