/**
 * @file Script contenant les fonctions necessaires pour le panneau admin
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 *
 */

//const BaseURL = "https://a_remplir";



 //const BaseURL = document.baseURI;

console.log(BaseURL);
window.addEventListener('load', function () {






    ////////////////////////////////////////////////////////////////////////
    //Fonction afficher le contenu en fonction de bouton/tab selectionnee //
    ////////////////////////////////////////////////////////////////////////

    document.querySelectorAll(".tabs__button").forEach(function (element) {
        console.log(element);
        let sideBar = element.parentElement;
        //    if ( sideBar.style=("transform: translate(-100%, 0)")){
        //     sideBar.style= (" ");
        //    }
        element.addEventListener("click", function (evt) {
            console.log(element);

            let mainContenant = document.querySelector('.admin_contenu_page');
            console.log(sideBar)
            let tabNumber = element.dataset.forTab;
            let contentActivate = mainContenant.querySelector(`.admin__tabs__content[data-tab="${tabNumber}"]`);
            console.log(contentActivate);

            sideBar.querySelectorAll('.tabs__button').forEach(button => {
                button.classList.remove('tabs__button--active');
            })
            mainContenant.querySelectorAll('.admin__tabs__content').forEach(tab => {
                tab.classList.remove('admin__tabs__content--active');
            })

           

            //cacher le "x" et re-afficher le menu burger
            // document.getElementById("admin_menuToggle").nextElementSibling.classList.add('hidden')
            //  document.getElementById("admin_menuToggle").lastElementChild.previousElementSibling.classList.remove('hidden');

            element.classList.add('tabs__button--active');
            contentActivate.classList.add('admin__tabs__content--active');
 //retracter la side-bare
 //sideBar.classList.remove('sideBar-ferme'); 

        })
    })



    ////////////////////////////////////////////////////////////////////////
    //Fonction Toggle de class pour le bouton menu                       //
    ////////////////////////////////////////////////////////////////////////
    /*
        let menuToggle = document.getElementById("admin_menuToggle");
       
        sideBar = document.querySelector('.admin-menu');
        console.log(menuToggle)
    
        menuToggle.querySelectorAll('.menu_icon').forEach(icon => {
            sideBar.classList.remove("hidden");
             
            menuToggle.addEventListener("click", function (evt) {
    
                if (icon.classList.contains('hidden')) {
                    icon.classList.remove('hidden')
                    if (sideBar.classList.contains("hidden")) {
                        sideBar.classList.remove("hidden");
                    }
    
                    sideBar.style = "transform: none;"
    
                    console.log(document.querySelector('.admin-menu'))
                   
    
    
                } else {
    
    
    
    
                    icon.classList.add('hidden')
                    sideBar.style = "transform: translate(-100%, 0);"
                    
    
                }
    
    
            })
    
        })
    
    */


    //////////////////////////////////////////////
    //Fonction SUPPRIMER Bouteille du Catalogue   //
    //////////////////////////////////////////////
 

    document.querySelectorAll(".btnSuppr").forEach(function (element) {
       
        console.log(element.parentElement.parentElement);
        element.addEventListener("click", function (evt) {
 console.log('click', evt.target);
            let modal = document.querySelector(".desactivation__modal__wrapper");

            console.log(element)
            let id = element.dataset.id;

            console.log(modal)

            //Afficher Modal  //  
            modal.classList.toggle('show');
            modal.querySelector('.modal__texte').innerText = 'Supprimer la bouteille No. ' + id + ' ?';

            //Fermeture du modal //
            
           

            let fermerBouton = modal.querySelector('.fermer');
            fermerBouton.addEventListener('click', function (e) {
               
                let modal = document.querySelector('.desactivation__modal__wrapper');
                modal.classList.remove('show');
             })

            let annBouton = modal.querySelector('.btn__annuler');
            annBouton.addEventListener('click', function (e) {
                let modal = document.querySelector('.desactivation__modal__wrapper');
                modal.classList.remove('show');
            })
 
            // Suppression de la bouteille //

          let btnDanger = modal.querySelector('.btn__danger');
            btnDanger.addEventListener('click', (e) => {
                console.log(id);
                let requete = new Request("index.php?requete=desactiverBouteilleCatalogue", { method: 'PUT', body: '{"id": ' + id + ', "statut_desactive": "1"}' });
                console.log(requete);
                fetch(requete)
                    .then(response => {
                        if (response.status === 200) {

                            //re-afficher le catalogue
                           

                            //fermer le modal
                            modal.classList.remove('show');
                            //supprimer le dom de l'element 
                            element.parentElement.parentElement.remove();
                            // afficher message de confirmation de la suppression de l'element du catalogue

                            document.querySelector(".txt_msg-supprime").innerText = "La bouteille No" + id + " supprimée avec succes !"

                            return response.json();


                        } else {
                            throw new Error('Erreur');
                        }
                    })
                    .then(response => {



                    }).catch(error => {
                        console.error(error);
                    });
            });


        });
    });





  ///////////////////////////////////////////////////////
  //Fonction modifier  Bouteille dans le Catalogue     //
  ///////////////////////////////////////////////////////
  
  // console.log(document.querySelector(".btnAnnul"));

  // console.log(document.querySelector(".btnModifierBouteilleCatalogue"));

  let modal = document.querySelector('.confirm__modal__wrapper');

  let modifBouteilleCatalogue = {
    nom: document.querySelector("[name='nom']"),
    format: document.querySelector("[name='format']"),
    image: document.querySelector("[name='image']"),
    code_saq: document.querySelector("[name='code_saq']"),
    pays: document.querySelector("[name='pays']"),
    prix_saq: document.querySelector("[name='prix_saq']"),
    url_saq: document.querySelector("[name='url_saq']"),
  };

  document.querySelector(".btnAnnul").addEventListener("click", function (evt) {
    window.location.assign("index.php?requete=admin") 
  })
    console.log(document.querySelector(".btnModifierBouteilleCatalogue"));
  document.querySelector(".btnModifierBouteilleCatalogue").addEventListener("click", function (evt) {
    console.log(document.querySelector(".btnModifierBouteilleCatalogue"));

    let id = document.querySelector("[name='id']").value;

    var param = {
      "id": id,
      "nom": modifBouteilleCatalogue.nom.value,
      "format": modifBouteilleCatalogue.format.value,
      "image": modifBouteilleCatalogue.image.value,
      "code_saq": modifBouteilleCatalogue.code_saq.value,
      "pays": modifBouteilleCatalogue.pays.value,
      "prix_saq": modifBouteilleCatalogue.prix_saq.value,
      "url_saq": modifBouteilleCatalogue.url_saq.value,
    };

    console.log(param);
    console.log('prix', modifBouteilleCatalogue.prix_saq.value)
    let requete = new Request("index.php?requete=modifierBouteilleCatalogue", { method: 'PUT', body: JSON.stringify(param) });
    console.log(requete);
    fetch(requete)
      .then(response => {
        if (response.status === 200) {
          //re-afficher le catalogue
          console.log(response);  
          modal.classList.add('show');
          modal.querySelector('.txt_msg-modif').innerText = 'La bouteille No' + id + ' modifiée avec succes !';

          setTimeout(function(){
            window.location.href = 'index.php?requete=admin';
         }, 2000);
            
          return response.json();
        } else {
          throw new Error('Erreur');
        }
      })

    .catch(error => {
       console.error(error);
     });

  });


  


   







});