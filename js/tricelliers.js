/**
 * @file Script contenant le tri des celliers d'un usager donné
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 * @update 2021-11-24
 * @param  {} "load"
 * @param  {} function(
 */
 window.addEventListener("load", function () {
   
    
    
    function triageColonneTable(table, colonne, asc = true) {
        let directionTriage = asc ? 1 : -1; // if (asc= true){ directionTriange=1}else { directionTriage = -1}
        
        let tBody = table.tBodies[0];
        let rangees = Array.from(tBody.querySelectorAll("tr"));
        console.log(tBody)


        // Trier chaque rangee
        let rangeesTriees = rangees.sort((a, b) => {
            let aColText = a.querySelector(`td:nth-child(${colonne + 1})`).textContent.trim();
            let bColText = b.querySelector(`td:nth-child(${colonne + 1})`).textContent.trim();
            bColText = parseInt(bColText);
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
    
   
    
    //  Recherche cellier
    
    
    
    function rechercheCellier(table, rechercheInput, searchColumn) {
        
        
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

        if (document.querySelector('.form__recherche') != "") {
            rechercheCellier(document.querySelector('.table_triable'), document.querySelector("#cell_rech"), document.querySelector(".nom"));
        }
    })