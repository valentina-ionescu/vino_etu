/**
 * @file Script contenant les fonctions de recherche et triage dans le panneau admin
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




    ////////////////////////////////////////////////////////
    //Fonction Recherche Catalogue par nom de bouteille   //
    ////////////////////////////////////////////////////////


    /**
    * Recherche Catalogue par nom de bouteille .
    * 
    * @param {HTMLTableElement} table La table a rechercher
    * @param {HTMLTableElement} searchColumn La colone a rechercher
    * @param {HTMLInputElement} rechercheInput champs de recherche
    */


    function rechercheCatalogue(table, rechercheInput, searchColumn) {


        let tablerangees = table.querySelectorAll("tbody > tr")
        console.log(tablerangees);
        //;
        let headerCell = searchColumn;
        let otherHeaderCells = headerCell.closest("tr").children;
        let columnIndex = Array.from(otherHeaderCells).indexOf(headerCell);
        let searchableCells = Array.from(tablerangees).map(
            (row) => row.querySelectorAll("td")[columnIndex]
        );

        rechercheInput.addEventListener("input", () => {
            let searchQuery = rechercheInput.value.toLowerCase();

            for (let tableCell of searchableCells) {
                let row = tableCell.closest("tr");
                let value = tableCell.textContent.toLowerCase().replace(",", "");

                row.style.visibility = null;

                if (value.search(searchQuery) === -1) {
                    row.style.visibility = "collapse";
                }
            }

        });

    }







    ///////////////////////////////////////////////////
    //Fonction Trier Bouteilles du Catalogue par nom  //
    ///////////////////////////////////////////////////


    /**
    * Triage de la table HTML .
    * 
    * @param {HTMLTableElement} table La table a trier
    * @param {number} colonne Le index de la  colonne a trier
    * @param {boolean} asc Determine la direction du triage asc ou desc
    */
    function triageColonneTable(table, colonne, asc = true) {
        let directionTriage = asc ? 1 : -1; // if (asc= true){ directionTriange=1}else { directionTriage = -1}
        
        let tBody = table.tBodies[0];
        let rangees = Array.from(tBody.querySelectorAll("tr"));
        console.log(tBody)

        // Trier chaque rangee
        let rangeesTriees = rangees.sort((a, b) => {
            let aColText = a.querySelector(`td:nth-child(${colonne + 1})`).textContent.trim();
            let bColText = b.querySelector(`td:nth-child(${colonne + 1})`).textContent.trim();

            let resultTriage = 0;

            if (aColText > bColText){

                resultTriage= 1 * directionTriage;
            }else{
                resultTriage= -1 * directionTriage;

            }

            return  resultTriage;

        });

        // Enlever toutes les rangees <tr> de la table 
        while (tBody.firstChild) {
            tBody.removeChild(tBody.firstChild);
        }

        // Re-ajouter les rangeer <tr> dansl la nouvelle ordre
        tBody.append(...rangeesTriees);

        // mettre en memoire l'ordre des rangees initiales 

        table.querySelectorAll("th.trier").forEach(th => th.classList.remove("th-tri-asc", "th-tri-desc"));
         table.querySelector(`th:nth-child(${colonne + 1})`).classList.toggle("th-tri-asc", asc);
         table.querySelector(`th:nth-child(${colonne + 1})`).classList.toggle("th-tri-desc", !asc);
    }

    //appelle de la fonction de triage

    document.querySelectorAll(".table_triable th.trier").forEach(headerCell => {
        console.log(headerCell)
        headerCell.addEventListener("click", () => {
            let tableElement = headerCell.parentElement.parentElement.parentElement;
            console.log(tableElement)
            let headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
            console.log(headerIndex)
            let currentIsAscending = headerCell.classList.contains("th-tri-asc");
            console.log(currentIsAscending)

            triageColonneTable(tableElement, headerIndex, !currentIsAscending);
        });
    });




    //appele de la fonction Recherche Catalogue Bouteilles  et Recherche Usagers
    //rechercheCatalogue(table, rechercheInput, searchColumn)

    if (document.querySelector('.liste_usagers')) {
        if (document.querySelector('.recherche_usager') != "") {
            rechercheCatalogue(document.querySelector('.table_usagers'), document.querySelector(".recherche_usager"), document.querySelector(".nom_usager"));
        }

    }

    if (document.querySelector('.recherche_bouteille') != "") {
        rechercheCatalogue(document.querySelector('.table_bouteilles'), document.querySelector(".recherche_bouteille"), document.querySelector(".nom_bouteille"));
    }











    if (localStorage.getItem('scrollPosition') !== null)
        window.scrollTo(0, localStorage.getItem('scrollPosition'));
}, false);