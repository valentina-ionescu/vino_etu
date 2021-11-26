
/**
 * @file Script contenant les fonctions filres pour la page bouteilles
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 * @update 2021-11-22
 * @param  {} "load"
 * @param  {} function(
 */

window.addEventListener("load", function () {
 
   //////////////////////////////////////////////
    //Fonction filtres bouteilles               //
    //////////////////////////////////////////////
   

  
    let filtres = document.querySelector('.filtres');
    filtres.addEventListener('click', (e) => {
        e.preventDefault();
        console.log('filtres');
        let modal = document.querySelector(".filtres__modal__wrapper");
        modal.classList.add("show");

        //empecher le scroll de l'arriere plan ref: https://css-tricks.com/prevent-page-scrolling-when-a-modal-is-open/
        const scrollY = document.documentElement.style.getPropertyValue('--scroll-y');
        const body = document.body;
        body.style.position = 'fixed';
        body.style.top = `-${scrollY}`;
      
       

        // Nom ASC
            let sortNomUp = document.querySelector('.nomASC');
        
            sortNomUp.addEventListener('click', (e) => {
              console.log(e.target)

            // Récuperer les bouteilles dans l'ordre demandé
            fetchBouteilles(id,'ASC','nom');
          });

      // Nom DESC
      let sortNomDown = document.querySelector('.nomDESC');
      
          sortNomDown.addEventListener('click', (e) => {
            console.log(e.target)

            // Récuperer les bouteilles dans l'ordre demandé
            fetchBouteilles(id,'DESC','nom');
          });
      
          // Prix ASC
        let sortPrixUp = document.querySelector('.prixASC');
       
          sortPrixUp.addEventListener('click', (e) => {
            console.log(e.target)

            // Récuperer les bouteilles dans l'ordre demandé
            fetchBouteilles(id,'ASC','prix');
          });


          // Prix DESC
        let sortPrixDown = document.querySelector('.prixDESC');
       
          sortPrixDown.addEventListener('click', (e) => {
            console.log(e.target)

            // Récuperer les bouteilles dans l'ordre demandé
            fetchBouteilles(id,'DESC','prix');
          });
          // Fermeture du modale de filtres
          document.querySelector('.btn-filtre-fermer').addEventListener('click', (e) => {
          
              const body = document.body;
              const scrollY = body.style.top;
              body.style.position = '';
              body.style.top = '';
              window.scrollTo(0, parseInt(scrollY || '0') * -1);
           
            modal.classList.remove('show');
          })
          //
          // Filtres
          let choix = document.querySelector('.choix');
          choix.addEventListener('click', (e) => {
            //delegation d'evenements sur les elements enfants
            let enfantEl = e.target;
           console.log(enfantEl)
            
         
            //Millesime
            let millesime = getChoix(enfantEl,'mill');
            if(millesime)
            fetchBouteillesTri(id,'millesime',millesime)

           //Le select du millesime
           if (enfantEl.classList.contains('sel-mill')) {
             enfantEl.addEventListener('change', (e) => {
              fetchBouteillesTri(id,'millesime',e.target.value)
             })
           }
           

            
            //Pays
            let pays = getChoix(enfantEl,'pa');
            if(pays)
            fetchBouteillesTri(id,'pays', "'"+pays+"'")

            //Le select du pays
           if (enfantEl.classList.contains('sel-pa')) {
            enfantEl.addEventListener('change', (e) => {
             fetchBouteillesTri(id,'pays',"'"+e.target.value+"'")
            })
          }
            
            //Type
            let type = getChoix(enfantEl,'ty');
            console.log(type);
            if(type == 'Vin rouge')
            fetchBouteillesTri(id,'b.vino__type_id', 1)
            if(type == 'Vin blanc')
            fetchBouteillesTri(id,'b.vino__type_id', 2)

          
          
        })
         
 
            
    }) //filtres

    function getChoix(el, val) {
      console.log(el)
      if(el.classList.contains(val)) { 
        choix = el.textContent;
        console.log(choix)
        return choix;
      }
    }

    //// Fonction des récuperation des bouteilles dans l'ordre ////

  function fetchBouteilles(id,ordre,champs) {
    var param = {
      id: id,
      ordre: ordre,
      col: champs
    };
    console.log(param);
    let requete = new Request("index.php?requete=getCellierTrie", {
      method: "POST",
      body: JSON.stringify(param),
    });
    console.log(requete);
    fetch(requete)
      .then((response) => {
        response.json()
       console.log(response)
      })
      .then((res) => {
        var url_string = "index.php?requete=getListeBouteilles&id="+id+"&ordre="+ordre+"&col="+champs; 
        window.location.href=url_string;

      })
      .catch(error => console.log(error));
    
  } 

  function fetchBouteillesTri(id,col,valeur) {
    var param = {
      id: id,
      col: col,
      valeur: valeur
    };
    console.log(param);
    let requete = new Request("index.php?requete=getCellierFiltre", {
      method: "POST",
      body: JSON.stringify(param),
    });
    console.log(requete);
    fetch(requete)
      .then((response) => {
        response.json()
       console.log(response)
      })
      .then((res) => {
        let el = document.querySelector('.filtres');
        console.log(el);
        el.innerHTML +='<a href="" class="tag-gauche txt-blanc capit petit">Effacer<i class="fas fa-angle-down"></i></i></a>'
        console.log(el.innerHTML)
        var url_string = "index.php?requete=getListeBouteilles&id="+id+"&col="+col+"&valeur="+valeur; 
        console.log(url_string)
        window.location.href=url_string;

      })
      .catch(error => console.log(error));
    
     } 

 



 })

 