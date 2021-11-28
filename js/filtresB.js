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
  let filtres = document.querySelector(".filtres>.open");
  let anneeIndex = 0;
  let anneeSelect;
  let selectionChoix = Array()

   el.classList.remove("show_button");

  filtres.addEventListener("click", (e) => {
    e.preventDefault();

    let modal = document.querySelector(".filtres__modal__wrapper");
    modal.classList.add("show");

    
    //empecher le scroll de l'arriere plan ref: https://css-tricks.com/prevent-page-scrolling-when-a-modal-is-open/
    const scrollY =
      document.documentElement.style.getPropertyValue("--scroll-y");
    const body = document.body;
    body.style.position = "fixed";
    body.style.top = `-${scrollY}`;

    // Nom ASC
    let sortNomUp = document.querySelector(".nomASC");

    sortNomUp.addEventListener("click", (e) => {
      // Récuperer les bouteilles dans l'ordre demandé
      fetchBouteilles(id, "ASC", "nom");
    });

    // Nom DESC
    let sortNomDown = document.querySelector(".nomDESC");
    sortNomDown.addEventListener("click", (e) => {
      
      // Récuperer les bouteilles dans l'ordre demandé
      fetchBouteilles(id, "DESC", "nom");
    });

    // Prix ASC
    let sortPrixUp = document.querySelector(".prixASC");
    sortPrixUp.addEventListener("click", (e) => {
    

      // Récuperer les bouteilles dans l'ordre demandé
      fetchBouteilles(id, "ASC", "prix");
    });

    // Prix DESC
    let sortPrixDown = document.querySelector(".prixDESC");

    sortPrixDown.addEventListener("click", (e) => {
      

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
     if((enfantEl.classList.contains('mill')) || (enfantEl.classList.contains('pa')) || (enfantEl.classList.contains('ty'))
        || (enfantEl.classList.contains("sel-mill"))){
        console.log(enfantEl)
        
        if (enfantEl.classList.contains("sel-mill")) {
          enfantEl.addEventListener("change", (e) => {
            var index = e.target.selectedIndex;
            SelMill = e.target[index].text    
            console.log(SelMill)
            anneeIndex = enfantEl.selectedIndex;
            anneeSelect = enfantEl;
            selectionChoix.push(SelMill);
          })
        }  else {
          selectionChoix.push(enfantEl.textContent);
          if (anneeSelect) resetSelectElement(anneeSelect);
        }
        
        console.log(selectionChoix)
        let cartes = document.querySelectorAll(".carte");
        cartes.forEach((card) => {
          
              let cMill = card.querySelector(".carte__description-millesime").textContent.replace("Millesime: ", ""),
                  cPays = card.querySelector(".carte__description-pays").textContent,
                  cType = JSON.stringify(card.querySelector(".carte__tag-top span").textContent.trim())
                  
                  console.log(cMill)
                  console.log(cPays)
                  console.log(cType)
                  enfantEl.classList.add('clicked');

                let cardEl = Array() 
                  if(!isEmpty(cMill)) cardEl.push(cMill)
                  if(cPays!='') cardEl.push(cPays)
                  if(cType!='') cardEl.push(cType)
                  let checker = (arr1, arr2) => {
                   return arr1.every(v => arr2.includes(v))
                   
                  }
                  console.log(checker(selectionChoix,cardEl))
                  if (!checker(selectionChoix,cardEl))
                  card.style.display = "none";
                
                
              
              if (!checker) {
                card.style.display = "none";
                console.log(card.style.display)
              }
              // fermerModal(modal)
           
        });
      }
    
    }); // fin filtres
  })
  function getChoix(el, val) {
    console.log(el);
    if (el.classList.contains(val)) {
      choix = el.textContent;
      console.log(choix);
      return choix;
    }
  }
  function isEmpty(str) {
    return (!str || str.length === 0 );
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
