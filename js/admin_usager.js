/**
 * @file Script contenant les fonctions necessaires pour le panneau admin
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 *
 */

//const BaseURL = "https://a_remplir";



 //const BaseURL = document.baseURI;

console.log(BaseURL);
window.addEventListener('scroll',function() {
    //When scroll change, you save it on localStorage.
    localStorage.setItem('scrollPosition',window.scrollY);
},false);

window.addEventListener('load', function () {


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
                        document.querySelector(".txt_msg-usg-supprime").innerText = " ";
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

///////////////////////////////////////////////////////
//Fonction Effet Hover de l'id Bouteilles et Usagers //
///////////////////////////////////////////////////////
/*
let items = document.querySelectorAll(".item");
// console.log(items)


items.forEach(function(element){
    element.addEventListener("mouseover", function () {
        // console.log(element)
        let id = element.dataset.rowId;
      //  console.log(id)
        let hoverIdCooltip = document.querySelector('[data-id-hover="'+id+'"]');
        hoverIdCooltip.classList.remove("hidden");
    //    console.log(hoverIdCooltip)

    });
    element.addEventListener("mouseout", function () {
        // console.log(element)
         let id = element.dataset.rowId;
       //  console.log(id)
         let hoverIdCooltip = document.querySelector('[data-id-hover="'+id+'"]');
         hoverIdCooltip.classList.add("hidden");
        // console.log(hoverIdCooltip)
 
     });
})*/




if(localStorage.getItem('scrollPosition') !== null)
window.scrollTo(0, localStorage.getItem('scrollPosition'));
},false);