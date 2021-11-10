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
  console.log("load");

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

  //////////////////////////////////////////////
  //Fonction ajouter Cellier                  //
  //////////////////////////////////////////////

  let newCellier = {
    nom: document.querySelector("[name='nomCellier']"),
  };

  let btnAjouter = document.querySelector("[name='ajouterCellier']");
  if (btnAjouter) {
    btnAjouter.addEventListener("click", function (evt) {
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
            window.location.href = "index.php?requete=profile";
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((response) => {})
        .catch((error) => {
          console.error(error);
        });
    });
  }

  //////////////////////////////////////////////
  //Fonction ajouter Usager                   //
  //////////////////////////////////////////////

  let newUser = {
    nom: document.querySelector("[name='nomUser']"),
    prenom: document.querySelector("[name='prenomUser']"),
    username: document.querySelector("[name='usernameUser']"),
    email: document.querySelector("[name='emailUser']"),
    password: document.querySelector("[name='passwordUser']"),
  };

  let btnAjouterUser = document.querySelector("[name='ajouterUser']");
  if (btnAjouterUser) {
    btnAjouterUser.addEventListener("click", function (evt) {
      var param = {
        nom: newUser.nom.value,
        prenom: newUser.prenom.value,
        username: newUser.username.value,
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
  //Fonction modifier Usager                  //
  //////////////////////////////////////////////

  let modifUsager = {
    nom: document.querySelector("[name='nom']"),
    prenom: document.querySelector("[name='prenom']"),
    email: document.querySelector("[name='email']"),
    username: document.querySelector("[name='username']"),
    password: document.querySelector("[name='password']"),
  };

  document.querySelectorAll(".btnModifierUser").forEach(function (element) {
    console.log(element);
    element.addEventListener("click", function (evt) {

      var param = {
        "nom": modifUsager.nom.value,
        "prenom": modifUsager.prenom.value,
        "email": modifUsager.email.value,
        "username": modifUsager.username.value,
        "password": modifUsager.password.value,
      };
      let requete = new Request("index.php?requete=modifUsager", { method: 'PUT', body: JSON.stringify(param) });
      console.log(requete);
      fetch(requete)
        .then(response => {
          if (response.status === 200) {
            //re-afficher le cellier
            window.location.href = "index.php?requete=profile"
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
            element.parentElement.remove();
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
      let requete = new Request("index.php?requete=getCellier", {
        method: "POST",
        body: '{"id": ' + id + "}",
      });
      console.log(requete);
      fetch(requete)
        .then((response) => {
          if (response.status === 200) {
            console.log(response);
            window.location.href = "index.php?requete=accueil";
            return response.json();
          } else {
            throw new Error("Erreur");
          }
        })
        .then((data) => {
          console.log(data);
          // window.location.href = "index.php?requete=accueil";
        })
        .catch((error) => {
          console.error(error);
        });
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

    let bouteille = {
      //nom: document.querySelector(".nom_bouteille"),
      nom: document.querySelector("[name='nom']"),
      millesime: document.querySelector("[name='millesime']"),
      quantite: document.querySelector("[name='quantite']"),
      date_achat: document.querySelector("[name='date_achat']"),
      prix: document.querySelector("[name='prix']"),
      garde_jusqua: document.querySelector("[name='garde_jusqua']"),
      // notes : document.querySelector("[name='notes']"),
    };

    liste.addEventListener("click", function (evt) {
      console.dir(evt.target);

      if (evt.target.tagName == "LI") {
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
        inputNomBouteille.value = "";
      }
    });

    let btnAjouter = document.querySelector("[name='ajouterBouteilleCellier']");
    if (btnAjouter) {
      btnAjouter.addEventListener("click", function (evt) {
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
            window.location.href = "index.php?requete=accueil";
          });
      });
    }
  }

  // let uimage = document.querySelector('.u__img');
  let uimage = document.querySelector(".u__profile_img");
  let umenu = document.querySelector(".u__profile-toggle");
  console.log(umenu);
  uimage.addEventListener("click", (e) => {
    // umenu.style.display = umenu.style.display === "none" ? "flex" : "none";
    umenu.classList.toggle('show');
  });
  
  
  //////////////////////////////////////////////
  // Fonction modifier cellier               //
  //////////////////////////////////////////////

  // let cedit = document.querySelectorAll('.c__edit');
  // cedit.forEach((element) => {
  //   element.addEventListener("click", function (evt) {
  //     console.log(element);
  //   })
  //   });
}); //fin window load
