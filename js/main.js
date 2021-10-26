/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

//const BaseURL = "https://jmartel.webdev.cmaisonneuve.qc.ca/n61/vino/";

    //////////////////////////////////////////////
    //Fonction boire bouteille                  //
    //////////////////////////////////////////////

const BaseURL = document.baseURI;
console.log(BaseURL);
window.addEventListener('load', function() {
    console.log("load");
    document.querySelectorAll(".btnBoire").forEach(function(element){
        element.addEventListener("click", function(evt){
            let id = evt.target.parentElement.dataset.id;
            let requete = new Request("index.php?requete=boireBouteilleCellier", {method: 'POST', body: '{"id": '+id+'}'});
            fetch(requete)
            .then(response => {
              if (response.status === 200) {
                  return response.json();
                } else {
                  throw new Error('Erreur');
                }
              })
              .then((data) => {
                console.log(data);
                 let el = document.querySelector(`[data-js-cellier="${id}"]`);
                 el.innerHTML = '';
                 el.innerHTML = `<strong>${data} </strong> bouteilles`;

              }).catch(error => {
                console.error(error);
              });
        })

    });

    //////////////////////////////////////////////
    //Fonction ajouter bouteille unité          //
    //////////////////////////////////////////////

    document.querySelectorAll(".btnAjouter").forEach(function(element){
        console.log(element);
        element.addEventListener("click", function(evt){
            let id = evt.target.parentElement.dataset.id;
            console.log(id);
            let requete = new Request("index.php?requete=ajouterBouteilleCellier", {method: 'POST', body: '{"id": '+id+'}'});

            fetch(requete)
            .then(response => {
                if (response.status === 200) {
                  console.log(response);
                  return response.json();
                } else {
                  throw new Error('Erreur');
                }
              })
              .then(data => {
                let el = document.querySelector(`[data-js-cellier="${id}"]`);
                console.log(el)
                el.innerHTML = '';
                el.innerHTML = `<strong>${data} </strong> bouteilles`;
              }).catch(error => {
                console.error(error);
              });
        })

    });

    //////////////////////////////////////////////
    //Fonction modifier                         //
    //////////////////////////////////////////////
    let modifBouteille = {
      millesime : document.querySelector("[name='millesime']"),
      date_achat : document.querySelector("[name='date_achat']"),
      prix : document.querySelector("[name='prix']"),
      garde_jusqua : document.querySelector("[name='garde_jusqua']"),
      notes : document.querySelector("[name='notes']"),
    };

    document.querySelectorAll(".btnModifier").forEach(function(element){
      console.log(element);
      element.addEventListener("click", function(evt){

        let id = document.querySelector('[data-id]').dataset.id;

        var param = {
          "id":id,
          "millesime":modifBouteille.millesime.value,
          "date_achat":modifBouteille.date_achat.value,
          "garde_jusqua":modifBouteille.garde_jusqua.value,
          "notes":modifBouteille.notes.value,
          "prix":modifBouteille.prix.value,
        };
        let requete = new Request("index.php?requete=modifierBouteilleCellier", {method: 'PUT', body: JSON.stringify(param)});
        console.log(requete);
        fetch(requete)
        .then(response => {
          if (response.status === 200) {
            console.log(response);
            return response.json();
          } else {
            throw new Error('Erreur');
          }
        })
        .then(response => {
          console.log(response);

        }).catch(error => {
          console.error(error);
        });
      });
    });

    //////////////////////////////////////////////
    //Fonction autoComplete                     //
    //////////////////////////////////////////////

    let inputNomBouteille = document.querySelector("[name='nom_bouteille']");
    console.log(inputNomBouteille);
    let liste = document.querySelector('.listeAutoComplete');

    if(inputNomBouteille){
      inputNomBouteille.addEventListener("keyup", function(evt){
        console.log(evt);
        let nom = inputNomBouteille.value;

        liste.innerHTML = "";
        if(nom){
          // console.log(nom)

// enleve le BaseURL+ de la Request, pour la faire fonctionner
          let requete = new Request("index.php?requete=autocompleteBouteille", {method: 'POST', body: '{"nom": "'+nom+'"}'});
          console.log(requete)
          fetch(requete)


              .then(response => {

                  if (response.status === 200) {

                    return response.json();

                  }
                   else {
                    throw new Error('Erreur');
                  }

                })
                .then(data => {
                  data.forEach(function(element){
                    // console.log(element)
                    // console.log(liste.innerHTML)

                    liste.innerHTML += "<li data-id='"+element.id+"'>"+element.nom+"</li>";

                  })
                })
                .catch(error => {
                  console.error(error);
                });
        }


      });

      let bouteille = {
        nom : document.querySelector(".nom_bouteille"),
        millesime : document.querySelector("[name='millesime']"),
        quantite : document.querySelector("[name='quantite']"),
        date_achat : document.querySelector("[name='date_achat']"),
        prix : document.querySelector("[name='prix']"),
        garde_jusqua : document.querySelector("[name='garde_jusqua']"),
        notes : document.querySelector("[name='notes']"),
      };


      liste.addEventListener("click", function(evt){
        console.dir(evt.target)
        if(evt.target.tagName == "LI"){
          bouteille.nom.dataset.id = evt.target.dataset.id;
          bouteille.nom.innerHTML = evt.target.innerHTML;

          liste.innerHTML = "";
          inputNomBouteille.value = "";

        }
      });

      let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
      if(btnAjouter){
        btnAjouter.addEventListener("click", function(evt){
          var param = {
            "vino__bouteille_id":bouteille.nom.dataset.id,
            "date_achat":bouteille.date_achat.value,
            "garde_jusqua":bouteille.garde_jusqua.value,
            "notes":bouteille.notes.value,
            "prix":bouteille.prix.value,
            "quantite":bouteille.quantite.value,
            "millesime":bouteille.millesime.value,
          };

          let requete = new Request("index.php?requete=ajouterNouvelleBouteilleCellier", {method: 'POST', body: JSON.stringify(param)});
            fetch(requete)
                .then(response => {
                  console.log(response);
                    if (response.status === 200) {
                      return response.json();
                    } else {
                      throw new Error('Erreur');
                    }
                  })
                  .then(response => {
                    console.log(response);

                  }).catch(error => {
                    console.error(error);
                  });

        });
      }
  }


});

