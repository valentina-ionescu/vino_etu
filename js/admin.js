/**
 * @file Script contenant les fonctions necessaires pour le panneau admin
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 *
 */

//const BaseURL = "https://a_remplir";



//const BaseURL = document.baseURI;

console.log(BaseURL);

window.addEventListener('scroll', function () {
  //When scroll change, you save it on localStorage.
  localStorage.setItem('scrollPosition', window.scrollY);
}, false);

window.addEventListener('load', function () {

  document.querySelector(".loader").classList.add('hidden');





  ////////////////////////////////////////////////////////////////////////
  //Fonction afficher le contenu en fonction de bouton/tab selectionnee //
  ////////////////////////////////////////////////////////////////////////

  document.querySelectorAll(".tabs__button").forEach((element)=> {
    console.log(element)
    let sideBar = element.parentElement;
    //    if ( sideBar.style=("transform: translate(-100%, 0)")){
    //     sideBar.style= (" ");
    //    }
    element.addEventListener("click", function (evt) {
      document.querySelectorAll(".tabs__button").forEach(tab=>tab.classList.remove('tabs__button--active'))

       
        element.classList.add('tabs__button--active');
     
     
      // let mainContenant = document.querySelector('.admin_contenu_page');
      // let tabNumber = element.dataset.forTab;
      // let contentActivate = mainContenant.querySelector(`.admin__tabs__content[data-tab="${tabNumber}"]`);

      // sideBar.querySelectorAll('.tabs__button').forEach(button => {
      //   button.classList.remove('tabs__button--active');
      // })
      // mainContenant.querySelectorAll('.admin__tabs__content').forEach(tab => {
      //   tab.classList.remove('admin__tabs__content--active');
      // })
      // console.log(sessionStorage.getItem("activeLocation"))

      //cacher le "x" et re-afficher le menu burger
      // document.getElementById("admin_menuToggle").nextElementSibling.classList.add('hidden')
      //  document.getElementById("admin_menuToggle").lastElementChild.previousElementSibling.classList.remove('hidden');

      // element.classList.add('tabs__button--active');
      // contentActivate.classList.add('admin__tabs__content--active');
      //retracter la side-bare
      sideBar.classList.toggle('sideBar-ferme');

      document.querySelectorAll('.menu_icon').forEach(icon => {

        if (icon.classList.contains('hidden')) {
          icon.classList.remove('hidden')

        } else {

          icon.classList.add('hidden')
          //  sideBar.classList.remove('sideBar-ferme');

        }
        // // click en dehors du menu le fermera
    // document.addEventListener('click', (e) => {

    //   if (!e.target.matches('#admin_menuToggle1')) {

    //     if (!sideBar.classList.contains('sideBar-ferme')) {
    //       sideBar.classList.add('sideBar-ferme');
    //       // if (icon.classList.contains('hidden')) {
    //       //   icon.classList.remove('hidden')
    //       icon.classList.add('hidden')

    //       // } else {
    //       //   icon.classList.add('hidden')
    //       // }
    //     } else {
    //       if (icon.classList.contains('hidden')) {
    //         icon.classList.remove('hidden')

    //       } else {
    //         icon.classList.add('hidden')
    //       }
    //     }
    //   }

    // })

      })

    })
  })



  ////////////////////////////////////////////////////////////////////////
  //Fonction Toggle de class pour le bouton menu                       //
  ////////////////////////////////////////////////////////////////////////

  let menuToggle = document.getElementById("admin_menuToggle1");

  sideBar = document.querySelector('.admin-menu');

  document.querySelectorAll('.menu_icon').forEach(icon => {
    
    menuToggle.addEventListener("click", function (evt) {


      if (icon.classList.contains('hidden')) {
        icon.classList.remove('hidden')

        if (sideBar.classList.contains("sideBar-ferme")) {
          sideBar.classList.remove('sideBar-ferme');

        }

      } else {

        icon.classList.add('hidden')
        sideBar.classList.add('sideBar-ferme');
      }

    })

  })







  //////////////////////////////////////////////
  //Fonction SUPPRIMER Bouteille du Catalogue   //
  //////////////////////////////////////////////


  document.querySelectorAll(".btnSuppr").forEach(function (element) {

    //  console.log(element.parentElement.parentElement);
    element.addEventListener("click", function (evt) {
      console.log('click', evt.target);

      let modal = document.querySelector(".desactivation__modal__wrapper");
      let id = element.dataset.id;


      //Afficher Modal  //  
      modal.classList.toggle('show');
      modal.querySelector('.modal__texte').innerText = 'Supprimer la bouteille No.' + id + ' ?';

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

        let requete = new Request("index.php?requete=desactiverBouteilleCatalogue", { method: 'PUT', body: '{"id": ' + id + ', "statut_desactive": "1"}' });

        fetch(requete)
          .then(response => {
            if (response.status === 200) {

              //re-afficher le catalogue


              //fermer le modal
              modal.classList.remove('show');
              //supprimer le dom de l'element 
              element.parentElement.parentElement.parentElement.remove();
              // afficher message de confirmation de la suppression de l'element du catalogue


              document.querySelector(".txt_msg-supprime").innerText = "La bouteille No" + id + " supprimée avec succes !"

              setTimeout(function () {

                document.querySelector(".txt_msg-supprime").innerText = " ";


              }, 3000);

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

  function ModifierBouteilleAdmin() {

    let modifBouteilleCatalogue = {
      nom: document.querySelector("[name='nom']"),
      format: document.querySelector("[name='format']"),
      image: document.querySelector("[name='image']"),
      code_saq: document.querySelector("[name='code_saq']"),
      pays: document.querySelector("[name='pays']"),
      prix_saq: document.querySelector("[name='prix_saq']"),
      url_saq: document.querySelector("[name='url_saq']"),
    };

    document.querySelector('.admin_form__modif').querySelector(".btnAnnul").addEventListener("click", function (evt) {
      window.location.assign("index.php?requete=getCatalogue")
    })

    document.querySelector('.admin_form__modif').querySelector('.btnModifierBouteilleCatalogue').addEventListener("click", function (evt) {

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

    let msgErreur = document.querySelector('[data-js-erreur-modif-nonListee]');

    if (param.nom !== '' && param.nom.length > 2) {

      console.log(param);
      console.log('prix', modifBouteilleCatalogue.prix_saq.value)
      let requete = new Request("index.php?requete=modifierBouteilleCatalogue", { method: 'PUT', body: JSON.stringify(param) });
      console.log(requete);
      fetch(requete)
        .then(response => {
          if (response.status === 200) {
            //re-afficher le catalogue
            console.log(response);
            let modal = document.querySelector('.confirm__modal__wrapper');
            modal.classList.add('show');
            modal.querySelector('.txt_msg-modif').innerText = 'La bouteille «' + modifBouteilleCatalogue.nom.value + '» modifiée avec succes !';

            setTimeout(function () {
              window.location.href = 'index.php?requete=getCatalogue';
            }, 2000);

            return response.json();
          } else {
            throw new Error('Erreur');
          }
        })

        .catch(error => {
          console.error(error);
        });

      }else {
        msgErreur.classList.remove('hidden');
      }
    });

  }

  if (document.querySelector('.admin_form__modif').querySelector('.btnModifierBouteilleCatalogue')) {
    ModifierBouteilleAdmin();
  }





  if (localStorage.getItem('scrollPosition') !== null)
    window.scrollTo(0, localStorage.getItem('scrollPosition'));
}, false);