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
            sessionStorage.setItem("activeLocation", tabNumber);
            
            sideBar.querySelectorAll('.tabs__button').forEach(button => {
                button.classList.remove('tabs__button--active');
            })
            mainContenant.querySelectorAll('.admin__tabs__content').forEach(tab => {
                tab.classList.remove('admin__tabs__content--active');
            })
           console.log(sessionStorage.getItem("activeLocation"))

            //cacher le "x" et re-afficher le menu burger
            // document.getElementById("admin_menuToggle").nextElementSibling.classList.add('hidden')
            //  document.getElementById("admin_menuToggle").lastElementChild.previousElementSibling.classList.remove('hidden');

            element.classList.add('tabs__button--active');
            contentActivate.classList.add('admin__tabs__content--active');
 //retracter la side-bare
 //sideBar.classList.remove('sideBar-ferme'); 

        })
    })

 ////////////////////////////////////////////////////
 //Fonction SUPPRIMER compte Usager du Catalogue   //
 ////////////////////////////////////////////////////


 document.querySelectorAll(".btnSupprUsager").forEach(function (element) {
  //  console.log(element.parentElement.parentElement);
    element.addEventListener("click", function (evt) {

        let modalUsager = document.querySelector('.usager__supprimer__modal__wrapper');

        // console.log(element)
        let id = element.dataset.id;
        let nom = element.dataset.nom;


        console.log(modalUsager)

        //Afficher Modal  //  
        modalUsager.classList.toggle('show');
        modalUsager.querySelector('.modal__texte').innerText = 'Supprimer le Compte de l\'usager ' + nom.toUpperCase() + ' ?';

        //Fermeture du modal //
       
        let fermerBouton = modalUsager.querySelector('.fermer');
        fermerBouton.addEventListener('click', function (e) {
            let modalUsager = document.querySelector('.usager__supprimer__modal__wrapper');
            modalUsager.classList.remove('show');
        })

        let annBouton = modalUsager.querySelector('.btn__annuler');
        annBouton.addEventListener('click', function (e) {
            let modalUsager = document.querySelector('.usager__supprimer__modal__wrapper');
            modalUsager.classList.remove('show');
        })

        // Suppression du compte usager //

        
        let btnDanger = modalUsager.querySelector('.btn__danger');
        btnDanger.addEventListener('click', (e) => {
            console.log(id);
            let requete = new Request("index.php?requete=supprimerUsagerCatalogue", { method: 'DELETE', body: '{"id": ' + id + '}' });
            console.log(requete);
            fetch(requete)
                .then(response => {
            console.log(response);

                  if (response.status === 200) {

                        //re-afficher le catalogue
                       

                        //fermer le modal
                        modalUsager.classList.remove('show');
                        //supprimer le dom de l'element 
                        element.parentElement.parentElement.remove();
                        // afficher message de confirmation de la suppression de l'element du catalogue

                        document.querySelector(".txt_msg-usg-supprime").innerText = "L'usager " + nom.toUpperCase() + " supprimé avec succes !";
                        setTimeout(function(){
                        document.querySelector(".txt_msg-usg-supprime").innerText = "";
                    }, 2000);
                    
                      setTimeout(function(){
                        //    window.location.href = 'index.php?requete=admin';
                    //    history.replaceState('index.php?requete=admin#listeUsagers', null, 'index.php?requete=admin' );
                            window.location.href = 'index.php?requete=admin#listeUsagers';


                       }, 2000);

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


  









});