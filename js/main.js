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
window.addEventListener("load", function () {
  console.log("load - main.js");
  document.querySelector(".loader").classList.add('hidden');
 


  document.querySelectorAll(".btnBoire").forEach(function (element) {
    element.addEventListener("click", function (evt) {
      let id = evt.target.parentElement.dataset.id;
      let requete = new Request("index.php?requete=boireBouteilleCellier", {
        method: "POST",
        body: '{"id": ' + id + "}",
      });
      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((data) => {
          console.log(data);
          let el = document.querySelector(`[data-js-cellier="${id}"]`);
          el.innerHTML = "";
          el.innerHTML = `<strong>${data} </strong> `;
        })
        .catch((error) => {
          console.error(error);
        });
    });
  });

  //////////////////////////////////////////////
  //Fonction ajouter bouteille unité          //
  //////////////////////////////////////////////

  document.querySelectorAll(".btnAjouter").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {
      let id = evt.target.parentElement.dataset.id;
      console.log(id);
      let requete = new Request("index.php?requete=ajouterBouteilleCellier", {
        method: "POST",
        body: '{"id": ' + id + "}",
      });

      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            console.log(response);
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((data) => {
          let el = document.querySelector(`[data-js-cellier="${id}"]`);
          console.log(el);
          el.innerHTML = "";
          el.innerHTML = `<strong>${data} </strong> `;
        })
        .catch((error) => {
          console.error(error);
        });
    });
  });


  

  // 
  //////////////////////////////////////////////
  //Fonction ajouter Cellier                  //
  //////////////////////////////////////////////

  let newCellier = {
    nom: document.querySelector("[name='nomCellier']"),
  };

  let btnAjouter = document.querySelector(".u__ajout");
  if (btnAjouter) {
    btnAjouter.addEventListener("click", function (evt) {
      //Afficher Modal  //
      let modal = document.querySelector(".modal__ajout-wrapper");
      modal.classList.toggle("show");

      //Fermeture du modal //
      let fermerBouton = document.querySelector(".fermer");
      fermerBouton.addEventListener("click", function (e) {
        let modal = document.querySelector(".modal__wrapper");
        modal.classList.remove("show");
      });

      let annBouton = document.querySelector(".x__annuler");
      annBouton.addEventListener("click", function (e) {
        let modal = document.querySelector(".modal__ajout-wrapper");
        modal.classList.remove("show");
      });

      let btnAjout = document.querySelector('.btnAjout');
      btnAjout.addEventListener('click', (evt) => {
        var param = {
          nom: newCellier.nom.value,
        };


        let requete = new Request("index.php?requete=ajouterCellier", {
          method: "POST",
          body: JSON.stringify(param),
          headers: { "Content-Type": "application/json" },
        });
        console.log(requete);

        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              console.log(response);

              setTimeout(function () {
                window.location.href = "index.php?requete=profile";
              }, 1500);
              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((response) => {
            console.log(response)
            document.querySelector('.msg-erreur').innerHTML = `<p>${response}</p>`
          })
          .catch((error) => {
            console.error(error);
          });
      });
    })


  }


  //////////////////////////////////////////////
  //Fonction ajouter Usager                   //
  //////////////////////////////////////////////

  // console.log(modalConfirmRegistration)
  let newUser = {
    nom: document.querySelector("[name='nomUser']"),
    prenom: document.querySelector("[name='prenomUser']"),
    email: document.querySelector("[name='emailUser']"),
    password: document.querySelector("[name='passwordUser']"),
  };

  let validation = document.querySelectorAll('[data-js-champ-inscription]')

  for (let i = 0; i < validation.length; i++) {
    validation[i].addEventListener('keyup', (e) => {
      if (validation[i].value.length < 1 || validation[i].value.length > 45) {
        validation[i].classList.add("error");
        validation[i].parentElement.classList.add("error");
      }else {
        validation[i].classList.remove("error");
        validation[i].parentElement.classList.remove("error");
      }
    });
    validation[i].addEventListener('click', (e) => {
      if (validation[i].value.length < 1 || validation[i].value.length > 45) {
        validation[i].classList.add("error");
        validation[i].parentElement.classList.add("error");
      }else {
        validation[i].classList.remove("error");
        validation[i].parentElement.classList.remove("error");
      }
    })
  }

  let btnAjouterUser = document.querySelector("[name='ajouterUser']");

  let msgError = document.querySelector("[data-js-msgError]");

  if (btnAjouterUser) {
    btnAjouterUser.addEventListener("click", function (evt) {
      for (let i = 0; i < validation.length; i++) {
        if (validation[i].value.length < 1 || validation[i].value.length > 45) {
          validation[i].classList.add("error");
          validation[i].parentElement.classList.add("error");
        }
      }
      const re = /\S+@\S+\.\S+/;
      if(re.test(validation[2].value) == false){
        validation[2].classList.add("error");
        validation[2].parentElement.classList.add("error");
      }else {
        validation[2].classList.remove("error");
        validation[2].parentElement.classList.remove("error");
      }
      let erreur = document.getElementsByClassName('error');
      if (erreur.length > 0) {
        msgError.classList.add("display");
      }else {
      console.log('adduser');
      var param = {
        nom: newUser.nom.value,
        prenom: newUser.prenom.value,
        email: newUser.email.value,
        password: newUser.password.value,
      };

      let requete = new Request("index.php?requete=creationUsager", {
        method: "POST",
        body: JSON.stringify(param),
        headers: { "Content-Type": "application/json" },
      });
      console.log(requete);

      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
          console.log(response);
          let formulaireRegistration = document.querySelector('.form__connexion');
          let modalConfirmRegistration = formulaireRegistration.querySelector('.confirm__modal__wrapper')
          modalConfirmRegistration.classList.add('show');
          modalConfirmRegistration.querySelector('.txt_msg-modif').innerText = 'Votre compte a été créé avec succes!';
  
            setTimeout(function () {
              window.location.href = 'index.php?requete=profile';
            }, 1500);
            
            // window.location.href = "index.php?requete=profile";
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.error(error);
        });
      }
    });
  }

  //////////////////////////////////////////////
  //Fonction modifier Usager                  //
  //////////////////////////////////////////////

  let modifUsager = {
    nom: document.querySelector("[name='nom']"),
    prenom: document.querySelector("[name='prenom']"),
    email: document.querySelector("[name='email']"),
    password: document.querySelector("[name='password']"),
  };

  let validationModif = document.querySelectorAll('[data-js-champ-inscription]')

  let msgErrorModif = document.querySelector("[data-js-msgError]");

  for (let i = 0; i < validationModif.length; i++) {
    validationModif[i].addEventListener('keyup', (e) => {
      if (validationModif[i].value.length < 1 || validationModif[i].value.length > 45) {
        validationModif[i].classList.add("error");
        validationModif[i].parentElement.classList.add("error");
      }else {
        validationModif[i].classList.remove("error");
        validationModif[i].parentElement.classList.remove("error");
      }
    });
    validationModif[i].addEventListener('click', (e) => {
      if (validationModif[i].value.length < 1 || validationModif[i].value.length > 45) {
        validationModif[i].classList.add("error");
        validationModif[i].parentElement.classList.add("error");
      }else {
        validationModif[i].classList.remove("error");
        validationModif[i].parentElement.classList.remove("error");
      }
    })
  }

  document.querySelectorAll(".btnModifierUser").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {

      for (let i = 0; i < validation.length; i++) {
        if (validation[i].value.length < 1 || validation[i].value.length > 45) {
          validation[i].classList.add("error");
          validation[i].parentElement.classList.add("error");
        }
      }
      const re = /\S+@\S+\.\S+/;
      if(re.test(validation[2].value) == false){
        validation[2].classList.add("error");
        validation[2].parentElement.classList.add("error");
      }else {
        validation[2].classList.remove("error");
        validation[2].parentElement.classList.remove("error");
      }
      let erreur = document.getElementsByClassName('error');
      if (erreur.length > 0) {
        msgError.classList.add("display");
      }else {
      console.log('adduser');
      var param = {
        "nom": modifUsager.nom.value,
        "prenom": modifUsager.prenom.value,
        "email": modifUsager.email.value,
        "password": modifUsager.password.value,
      };
      let requete = new Request("index.php?requete=modifUsager", { method: 'PUT', body: JSON.stringify(param) });
      console.log(requete);
      fetch(requete)
        .then(response => {
          if (response.status === 200) {
            window.location.href = "index.php?requete=paramUsager"
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
      }
    });
  });

  //////////////////////////////////////////////
  //Fonctions gestion de Celliers             //
  //////////////////////////////////////////////

  // Supprimer cellier

  let supprimerCellier = document.querySelectorAll(".c__supp");
  supprimerCellier.forEach((element) => {
    let id = element.dataset.cellid;
    console.log(id);

    element.addEventListener("click", (e) => {
      //Afficher Modal  //
      let modal = document.querySelector(".modal__wrapper");
      modal.classList.toggle("show");

      //Fermeture du modal //
      let fermerBouton = document.querySelector(".fermer");
      fermerBouton.addEventListener("click", function (e) {
        let modal = document.querySelector(".modal__wrapper");
        modal.classList.remove("show");
      });

      let annBouton = document.querySelector(".btn__annuler");
      annBouton.addEventListener("click", function (e) {
        let modal = document.querySelector(".modal__wrapper");
        modal.classList.remove("show");
      });

      // Supprimer cellier apres confirmation

      let suppCell = document.querySelector(".btn__danger");
      console.log(suppCell);
      suppCell.addEventListener("click", (evt) => {
        console.log(id);
        let requete = new Request("index.php?requete=suppCellier", {
          method: "DELETE",
          body: '{"id": ' + id + "}",
        });
        console.log(requete);

        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              console.log(response);
              // window.location.href = 'index.php?requete=accueil';
              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((data) => {
            console.log(data);
            modal.classList.remove("show"); //fermeture du modal.
            element.closest('tr').remove();
            document.querySelector(".msg-supprime").innerText =
              "Cellier supprimé.";
          })
          .catch((error) => {
            console.error(error);
          });
      });
    });
  });

  //Ouvrir cellier

  let selCell = document.querySelectorAll(".selectCellier");
  selCell.forEach((element) => {
    element.addEventListener("click", (evt) => {
      evt.preventDefault();
      let id = element.dataset.cellid;
      console.log(id);
      let qte = element.closest('tr').querySelector('.b__compte').textContent;
      
      // Si le cellier est vide, afficher un modal de confirmation de bouteilles
      if(qte == 0) {
        console.log('Cellier vide')
       
        // element.addEventListener("click", (e) => {
          //Afficher Modal  //
          let modal = document.querySelector(".modal__wrapper_ajout-bouteille");
          modal.classList.toggle("show");
    
          //Fermeture du modal //
          let fermerBouton = modal.querySelector(".fermer");
          fermerBouton.addEventListener("click", function (e) {
            // let lemodal = modal.querySelector(".modal__wrapper_ajout-bouteille");
            modal.classList.remove("show");
            
          });
    
          let annBouton = modal.querySelector(".btn__annuler");
          annBouton.addEventListener("click", function (e) {
            let modal = document.querySelector(".modal__wrapper_ajout-bouteille");
            modal.classList.remove("show");
           
          });
          let btnAjoutBouteille = modal.querySelector('.btn__ajout-bouteille');
          console.log(btnAjoutBouteille);
          btnAjoutBouteille.addEventListener('click', (e) => {
            let requete = new Request("index.php?requete=getCellier", {
              method: "POST",
              body: '{"id": ' + id + "}",
            });
            console.log(requete);
            fetch(requete)
              .then((response) => {
                if (response.status === 200) {
                  console.log(response);
        
                  return response.json();
                } else {
                  throw new Error("Erreur");
                }
              })
              .then((data) => {
                console.log(data);
                window.location.href = "index.php?requete=ajouterNouvelleBouteilleCellier";
              })
              .catch((error) => {
                console.error(error);
              });
          })
      }else {
        let btnAjoutBouteille = element;
        console.log(btnAjoutBouteille);
        let requete = new Request("index.php?requete=getCellier", {
          method: "POST",
          body: '{"id": ' + id + "}",
        });
        console.log(requete);
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              console.log(response);
    
              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((data) => {
            console.log(data);
            window.location.href = "index.php?requete=accueil";
          })
          .catch((error) => {
            console.error(error);
          });
      }
     
     
    });
  });

  // Modifier cellier

  let modifCellier = {
    id: document.querySelector("[name='id']"),
    nom_cellier: document.querySelector("[name='nom_cellier']")
  }
  console.log(modifCellier)
  let btnModifier = document.querySelector("[name='btnModifier']");
  if (btnModifier) {

    btnModifier.addEventListener("click", function (evt) {
      var param = {
        id: modifCellier.id.value,
        nom_cellier: modifCellier.nom_cellier.value,
      };
      console.log(param)
      let requete = new Request("index.php?requete=editCellier", {
        method: "PUT",
        body: JSON.stringify(param),
      });
      console.log(param);
      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            //re-afficher le cellier
            window.location.href = "index.php?requete=profile";
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.error(error);
        });
    });


  }

  //////////////////////////////////////////////
  //Fonction modifier bouteille               //
  //////////////////////////////////////////////
  let modifBouteille = {
    millesime: document.querySelector("[name='millesime']"),
    date_achat: document.querySelector("[name='date_achat']"),
    prix: document.querySelector("[name='prix']"),
    garde_jusqua: document.querySelector("[name='garde_jusqua']"),
    notes: document.querySelector("[name='notes']"),
  };

  document.querySelectorAll(".btnModifier").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {
      let id = document.querySelector("[data-id]").dataset.id;

      var param = {
        id: id,
        millesime: modifBouteille.millesime.value,
        date_achat: modifBouteille.date_achat.value,
        garde_jusqua: modifBouteille.garde_jusqua.value,
        notes: modifBouteille.notes.value,
        prix: modifBouteille.prix.value,
      };
      console.log(param);
      console.log("prix", modifBouteille.prix.value);
      let requete = new Request("index.php?requete=modifierBouteilleCellier", {
        method: "PUT",
        body: JSON.stringify(param),
      });
      console.log(requete);
      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            //re-afficher le cellier
            window.location.href = "index.php?requete=accueil";
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.error(error);
        });
    });
  });
  //////////////////////////////////////////////
  //Fonction SUPPRIMER Bouteille du cellier   //
  //////////////////////////////////////////////

  document.querySelectorAll(".btnSupprimer").forEach(function (element) {
    element.addEventListener("click", function (evt) {
      let id = element.dataset.id;
      let modal = document.querySelector(".modal__wrapper");

      //Afficher Modal  //
      modal.classList.toggle("show");

      //Fermeture du modal //

      let fermerBouton = document.querySelector(".fermer");
      fermerBouton.addEventListener("click", function (e) {
        let modal = document.querySelector(".modal__wrapper");
        modal.classList.remove("show");
      });

      let annBouton = document.querySelector(".btn__annuler");
      annBouton.addEventListener("click", function (e) {
        let modal = document.querySelector(".modal__wrapper");
        modal.classList.remove("show");
      });

      // Suppression de la bouteille //

      let btnDanger = modal.querySelector(".btn__danger");
      btnDanger.addEventListener("click", (e) => {
        console.log(id);
        let requete = new Request(
          "index.php?requete=supprimerBouteilleCellier",
          { method: "DELETE", body: '{"id": ' + id + "}" }
        );
        console.log(requete);
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              //re-afficher le cellier
              console.log(response);
              window.location.href = "index.php?requete=accueil";
              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.error(error);
          });
      });
    });
  });

  //////////////////////////////////////////////
  //Fonction autoComplete                     //
  //////////////////////////////////////////////

  let inputNomBouteille = document.querySelector("[name='nom_bouteille']");
  console.log("inputNomBouteille", inputNomBouteille);
  let liste = document.querySelector(".listeAutoComplete");

  if (inputNomBouteille) {
    inputNomBouteille.addEventListener("keyup", function (evt) {
      console.log(evt);
      let nom = inputNomBouteille.value;

      liste.innerHTML = "";
      console.log("nom", nom);
      if (nom) {
        // enleve le BaseURL+ de la Request, pour la faire fonctionner
        let requete = new Request("index.php?requete=autocompleteBouteille", {
          method: "POST",
          body: '{"nom": "' + nom + '"}',
        });
        console.log(requete);
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              console.log(response);

              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((data) => {
            data.forEach(function (element) {
              console.log(element);
              // console.log(liste.innerHTML)

              //liste.innerHTML += "<li data-id='"+element.id+"'>"+element.nom+"</li>";
              //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
              liste.innerHTML +=
                "<li data-id='" +
                element.id +
                "' data-prix='" +
                element.prix_saq +
                "'>" +
                element.nom +
                "</li>";
              //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            });
          })
          .catch((error) => {
            console.error(error);
          });
      }

//////////////////////////////////////////////
//Fonction Nouvelle Bouteille               //
//////////////////////////////////////////////
    });

    let validationAjout = false;
    let msgErr = document.querySelector('[data-js-erreur_ajout]');

    let bouteille = {
      nom: document.querySelector("[name='nom_bouteille']"),
      millesime: document.querySelector("[name='millesime']"),
      quantite: document.querySelector("[name='quantite']"),
      date_achat: document.querySelector("[name='date_achat']"),
      prix: document.querySelector("[name='prix']"),
      garde_jusqua: document.querySelector("[name='garde_jusqua']"),
    };

    let videSearchBtn = document.querySelector('.clearSearchBtn ');
    let searchIconeBtn = document.querySelector('.searchIconeBtn ');
    let searchbar = document.querySelector('[data-js-search]');

    liste.addEventListener("click", function (evt) {
      console.dir(bouteille.nom);

      if (evt.target.tagName == "LI") {
        console.dir(evt.target);

        validationAjout = true;
        searchbar.setAttribute("disabled", true);

        bouteille.nom.dataset.id = evt.target.dataset.id;
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        bouteille.prix.setAttribute("value", evt.target.dataset.prix);
        bouteille.nom.setAttribute("value", evt.target.innerText);
        console.log("nom", evt.target.innerText);
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // bouteille.nom.innerHTML = evt.target.innerText;

        // bouteille.prix.setAttribute('value', evt.target.dataset.prix)
        console.log(evt.target.dataset.prix);

        liste.innerHTML = "";
        inputNomBouteille.value = evt.target.innerText;
        videSearchBtn.classList.remove('hidden');
        searchIconeBtn.classList.add('hidden');


        console.log(videSearchBtn)

      }

    });

    videSearchBtn.addEventListener('click', function (evt) {

      validationAjout = false;
      searchbar.removeAttribute("disabled", true);

      inputNomBouteille.value = "";
      bouteille.prix.setAttribute("value", " ");

      videSearchBtn.classList.add('hidden');
      searchIconeBtn.classList.remove('hidden');

    })


    let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
    if (btnAjouter) {
      btnAjouter.addEventListener("click", function (evt) {
        

        if (validationAjout == true) {

          var param = {
            vino__bouteille_id: bouteille.nom.dataset.id,
            date_achat: bouteille.date_achat.value,
            garde_jusqua: bouteille.garde_jusqua.value,
            prix: bouteille.prix.value,
            quantite: bouteille.quantite.value,
            millesime: bouteille.millesime.value,
          };

  
          let requete = new Request(
            "index.php?requete=ajouterNouvelleBouteilleCellier",
            {
              method: "POST",
              body: JSON.stringify(param),
              headers: { "Content-Type": "application/json" },
            }
          );
          console.log(requete);

          fetch(requete)
            .then((response) => {
              console.log(response);
              response.json();
            })
            .then((json) => {
              console.log(json);
              document.querySelector(".loader").classList.remove('hidden');


            
              let formulaireRegistration = document.querySelector('.form__ajout_bouteille');
              let modalConfirmRegistration = formulaireRegistration.querySelector('.confirm__modal__wrapper')

              //loader
              setTimeout(function () {
                  document.querySelector(".loader").classList.add('hidden');
              }, 1500);

              modalConfirmRegistration.classList.add('show');
              modalConfirmRegistration.querySelector('.txt_msg-modif').innerText = 'La bouteille a été ajoutée avec succès!';
      
                setTimeout(function () {
                  window.location.href = "index.php?requete=accueil";
                }, 1500);
              
            });
        }else {
          msgErr.classList.remove('hidden');
        }
      });
    }
  }

  // let uimage = document.querySelector('.u__img');
  let uimage = document.querySelector(".u__profile_img");
  let umenu = document.querySelector(".u__profile-toggle");
  console.log(umenu);
  console.log(uimage);
  uimage.addEventListener("click", (e) => {
    // umenu.style.display = umenu.style.display === "none" ? "flex" : "none";
    umenu.classList.toggle('show');
  });

// click en dehors du menu le fermera
document.addEventListener('click',(e) => {
  if(!e.target.matches('.u__profile_img img'))
  if(umenu.classList.contains('show'))
   umenu.classList.remove('show');
})


  //////////////////////////////////////////////
  // Fonction supprimer usager                //
  //////////////////////////////////////////////

  let element = document.querySelector(".btnSupprimerProfile");
  if (element) {
    element.addEventListener("click", function (evt) {
      let modal = document.querySelector(".modal__wrapper");

      //Afficher Modal  //
      modal.classList.toggle("show");

      //Fermeture du modal //

      let fermerBouton = document.querySelector(".fermer");
      fermerBouton.addEventListener("click", function (e) {
        let modal = document.querySelector(".modal__wrapper");
        modal.classList.remove("show");
      });

      let annBouton = document.querySelector(".btn__annuler");
      annBouton.addEventListener("click", function (e) {
        let modal = document.querySelector(".modal__wrapper");
        modal.classList.remove("show");
      });

      // Suppression de la bouteille //

      let btnDanger = modal.querySelector(".btn__danger");
      btnDanger.addEventListener("click", (e) => {
        let requete = new Request("index.php?requete=suppUsager");
        console.log(requete);
        fetch(requete)
          .then((response) => {
            if (response.status === 200) {
              //re-afficher le cellier
              console.log(response);
              window.location.href = "index.php?requete=accueil";
              return response.json();
            } else {
              throw new Error("Erreur");
            }
          })
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.error(error);
          });
      });
    });
  }

  //////////////////////////////////////////////
  // Fonction Formulaire Non-Listé            //
  //////////////////////////////////////////////

  let checkbox = document.querySelector("input[name=checkbox]");
  let formPerso = document.querySelector("[data-js-form-personel]");
  let formPublic = document.querySelector("[data-js-form-public]");

    
    checkbox.addEventListener('change', function(e) {
      if (this.checked) {
        formPerso.classList.remove('hidden');
        formPublic.classList.add('hidden');
      } else {
        formPerso.classList.add('hidden');
        formPublic.classList.remove('hidden');
      }
    });
  

  //////////////////////////////////////////////
  //Fonction Nouvelle Bouteille Personnalisé  //
  //////////////////////////////////////////////

  let btnAjoutBouteillePerso = document.querySelector("[name='ajouterBouteillePersonnalisé']");
  let msgErreur = document.querySelector('[data-js-erreur-inserer]');
  imageValide = false;
let formAjoutBouteillePerso  = document.querySelector('[data-js-form-personel]')

 console.log(formAjoutBouteillePerso);
  
 
  console.log( document.getElementById("imagePerso"));
  console.log( document.getElementById("nom_imagePerso"));
  
  let bouteillePerso = {
    nom: document.querySelector("[name='nom']"),
    image: formAjoutBouteillePerso.querySelector("[type=file]").files,
    pays: document.querySelector("[name='pays']"),
    prix: document.querySelector("[name='prix_perso']"),
    format: document.querySelector("[name='format']"),
    type: document.querySelector("[name='type']"),
    quantite: 1,
    date_achat: document.querySelector("[name='date_achat']"),
  };

console.log(bouteillePerso);
  let formData = new FormData();
  let imageContenue = "./assets/img/bouteillesNonlistees/bouteilleParDefaut.jpg";//image par defaut
  imageValide = false;



  document.getElementById("imagePerso").addEventListener("change", function(){
    let fullPath = this.value; // fetched value = C:\fakepath\nomImage.extension

    let fileName = fullPath.split(/(\\|\/)/g).pop();  // fetch le nom de l'image
  

      // afficher le nom de l'image
    if (imagePerso.files[0].type == "image/jpeg" || imagePerso.files[0].type == 'image/png' || imagePerso.files[0].type == 'image/gif') {

      document.getElementById("nom_imagePerso").innerHTML = fileName;  // afficher le nom de l'image dans le dom 

      imageValide = true;

  } else {
     
    imageContenue = "./assets/img/bouteillesNonlistees/bouteilleParDefaut.jpg";
      document.getElementById("nom_imagePerso").innerHTML = '<p style="color:red; font-size:13px; line-height:unset;margin: 0 0;">L\'image doit être de format *.jpeg, *.jpg, *.png ou *.gif!</p>';  // afficher msg d'erreur si le format de l'image n'est pas conforme
      imageValide = false;


  }

  }, false);

 

  //ajout de la bouteille personnalisee

  btnAjoutBouteillePerso.addEventListener('click', (e) => {

    
   
    let imageNom = '';
    let customTime = Math.round(new Date().getTime() / 1000);

    formData.append('file', imagePerso.files[0]);
    formData.append('time', customTime);
    // console.log(imagePerso.files[0]);
    
    if (imageValide && imageContenue != "") {
      imageNom = customTime + '-' + imagePerso.files[0].name.replace(/\s+/g, "");
      imageContenue = "./assets/img/bouteillePersonnalise/" + imageNom;//enlever les espaces dans le nom des images, et ajouter un timestamp;
      //imageContenue = "/ProjetWeb2/vino_etu/assets/img/bouteillePersonnalise/" + Math.round(new Date().getTime() / 1000) + '-' + imagePerso.files[0].name.replace(/\s+/g, "");//enlever les espaces dans le nom des images, et ajouter un timestamp;
    }
    
    // imageContenue = "./assets/img/bouteillePersonnalise/" + Math.round(new Date().getTime() / 1000) + '-' + imagePerso.files[0].name.replace(/\s+/g, "");//enlever les espaces dans le nom des images, et ajouter un timestamp;
    var param = {
      formData: formData,
      time: customTime,
      nom: bouteillePerso.nom.value,
      image:  imageContenue,
      pays: bouteillePerso.pays.value,
      prix: bouteillePerso.prix.value,
      format: bouteillePerso.format.value,
      type: bouteillePerso.type.options[bouteillePerso.type.selectedIndex].value,
      quantite: 1,
      date_achat: bouteillePerso.date_achat.value,
    };

    console.log(param.image);

    if (param.nom !== '' && param.nom.length > 2) {

      let requete = new Request(
        "index.php?requete=ajouterBouteillePerso",
        {
          method: "POST",
          body: JSON.stringify(param),
          headers: { "Content-Type": "application/json" },
        }
      );
      
      console.log(requete);

      fetch(requete)
        .then((response) => {
    

          let requete = new Request("index.php?requete=ajouterImagePerso&image="+imageNom, {
            method: "POST",
            body: formData,
          });
        fetch(requete)
        .then((response) => {
          
          document.querySelector(".loader").classList.remove('hidden');


          setTimeout(function () {
              document.querySelector(".loader").classList.add('hidden');
              window.location.href = "index.php?requete=accueil";
          response.json();
          }, 2000);

        });
        })
      }else {
        msgErreur.classList.remove('hidden');
      }
  })

  

}); //fin window load
