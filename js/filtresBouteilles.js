/**
 * @file Script contenant les fonctions filres pour la page bouteilles
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 * @update 2021-11-22
 * @param  {} "load"
 * @param  {} function(
 */

window.addEventListener("load", function () {
  let id = document.querySelector("[data-cellid]").dataset.cellid;

  let el = document.querySelector(".filtres>.effacer");

  el.classList.remove("show_button");
  let filtres = document.querySelector(".filtres>.open");
  let anneeIndex = 0;
  let anneeSelect;
  let anneeIndexP = 0;
  let anneeSelectP;

  filtres.addEventListener("click", (e) => {
    e.preventDefault();

    let modal = document.querySelector(".filtres__modal__wrapper");
    modal.classList.add("show");

    // el.parentElement.innerHTML ='<a href="index.php?requete=accueil" class="tag-gauche txt-blanc capit petit">Effacer</a>'

    //empecher le scroll de l'arriere plan ref: https://css-tricks.com/prevent-page-scrolling-when-a-modal-is-open/
    const scrollY =
      document.documentElement.style.getPropertyValue("--scroll-y");
    const body = document.body;
    body.style.position = "fixed";
    body.style.top = `-${scrollY}`;

    // Nom ASC
    let sortNomUp = document.querySelector(".nomASC");

    sortNomUp.addEventListener("click", (e) => {
      console.log(e.target);

      // Récuperer les bouteilles dans l'ordre demandé
      fetchBouteilles(id, "ASC", "nom");
    });

    // Nom DESC
    let sortNomDown = document.querySelector(".nomDESC");

    sortNomDown.addEventListener("click", (e) => {
      console.log(e.target);

      // Récuperer les bouteilles dans l'ordre demandé
      fetchBouteilles(id, "DESC", "nom");
    });

    // Prix ASC
    let sortPrixUp = document.querySelector(".prixASC");

    sortPrixUp.addEventListener("click", (e) => {
      console.log(e.target);

      // Récuperer les bouteilles dans l'ordre demandé
      fetchBouteilles(id, "ASC", "prix");
    });

    // Prix DESC
    let sortPrixDown = document.querySelector(".prixDESC");

    sortPrixDown.addEventListener("click", (e) => {
      console.log(e.target);

      // Récuperer les bouteilles dans l'ordre demandé
      fetchBouteilles(id, "DESC", "prix");
    });
    // Fermeture du modale de filtres
    document
      .querySelector(".btn-filtre-fermer")
      .addEventListener("click", (e) => {
        const body = document.body;
        const scrollY = body.style.top;
        body.style.position = "";
        body.style.top = "";
        window.scrollTo(0, parseInt(scrollY || "0") * -1);

        modal.classList.remove("show");
      });
    //
    // Filtres
    let choix = document.querySelector(".choix");
    choix.addEventListener("click", (e) => {
      //delegation d'evenements sur les elements enfants
      let enfantEl = e.target;
      console.log(enfantEl);

      //Millesime
      let millesime = getChoix(enfantEl, "mill"),
        pays = getChoix(enfantEl, "pa"),
        type = getChoix(enfantEl, "ty");

      let cartes = document.querySelectorAll(".carte");
      cartes.forEach((card) => {
        // millesime
        if (millesime) {
          console.log(enfantEl);
          if (anneeSelect) resetSelectElement(anneeSelect);
           enfantEl.classList.add('clicked');
          if (card.querySelector(".carte__description-millesime").textContent !=`Millesime: ${millesime}`)
            card.style.display = "none";
          fermerModal(modal);

          //Le select du millesime
        } else if (enfantEl.classList.contains("sel-mill")) {
          enfantEl.addEventListener("change", (e) => {
            millesime = e.target.value;
            anneeIndex = enfantEl.selectedIndex;
            anneeSelect = enfantEl;

            if (
              card.querySelector(".carte__description-millesime").textContent !=
              `Millesime: ${millesime}`
            )
              card.style.display = "none";
            // resetSelectElement(enfantEl);
            fermerModal(modal);
          });
        }

        // pays
        if (pays) {
          if (anneeSelectP) resetSelectElement(anneeSelectP);
          if (card.querySelector(".carte__description-pays").textContent != pays) {
            console.log(card.querySelector(".carte__description-pays").textContent)
          enfantEl.classList.add('clicked');
          card.style.display = "none";
          fermerModal(modal);
        }

        } //Le select du pays
        else if (enfantEl.classList.contains("sel-pa")) {
          enfantEl.addEventListener("change", (e) => {
            pays = e.target.value;
            anneeIndexP = enfantEl.selectedIndex;
            anneeSelectP = enfantEl;
            if (
              card.querySelector(".carte__description-pays").textContent != pays
            )
              card.style.display = "none";
            fermerModal(modal);
          });
        }

        // type
        if (type) {
          let typeS = JSON.stringify(
            card.querySelector(".carte__tag-top span").textContent.trim()
          );
          if (typeS != JSON.stringify(type)) card.style.display = "none";
          enfantEl.classList.add('clicked');
          fermerModal(modal);
        }
      });
    });
  }); // fin filtres

  function getChoix(el, val) {
    console.log(el);
    if (el.classList.contains(val)) {
      choix = el.textContent;
      console.log(choix);
      return choix;
    }
  }

  //reinitialiser les selects
  //ref : https://stackoverflow.com/questions/12737528/reset-the-value-of-a-select-box
  function resetSelectElement(selectElement) {
    selectElement.selectedIndex = 0;
    console.log(selectElement);
  }

  function fermerModal(modal) {
    const body = document.body;
    const scrollY = body.style.top;
    body.style.position = "";
    body.style.top = "";
    window.scrollTo(0, parseInt(scrollY || "0") * -1);

    modal.classList.remove("show");
    let el = document.querySelector(".filtres>.effacer");
    console.log(el);
    el.classList.add("show_button");
  }

  // Fetch des bouteilles dans l'ordre choisi

  function fetchBouteilles(id, ordre, champs) {
    var param = {
      id: id,
      ordre: ordre,
      col: champs,
    };
    console.log(param);
    let requete = new Request("index.php?requete=getCellierTrie", {
      method: "POST",
      body: JSON.stringify(param),
    });
    console.log(requete);
    fetch(requete)
      .then((response) => {
        response.json();
        console.log(response);
      })
      .then((res) => {
        var url_string =
          "index.php?requete=getListeBouteilles&id=" +
          id +
          "&ordre=" +
          ordre +
          "&col=" +
          champs;
        window.location.href = url_string;
      })
      .catch((error) => console.log(error));
  }
}); /** */
