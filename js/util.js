/**
 * @file Script contenant les fonctions utilitaires
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 * @update 2021-11-15
 * @param  {} "load"
 * @param  {} function(
 */
window.addEventListener("load", function () {
  // Fonctions de tri, inspiration.: https://betterprogramming.pub/sort-and-filter-dynamic-data-in-table-with-javascript-e7a1d2025e3c

  let triUp = "fa fa-caret-up",
    triDown = "fa fa-caret-down",
    tableData = Array();

  let table = document.querySelector("#cell__table"),
    // cellCol = document.querySelector(''),
    cellRech = document.querySelector("#cell_rech"),
    cellLigne = table.querySelectorAll(".cell__ligne"),
    input = document.querySelector("#cell_rech");

  cellLigne.forEach((element) => {
    (cellNom = element.querySelector(".cell__col-nom")),
      (cellQte = element.querySelector(".cell__col-qte"));
    console.log(cellNom.textContent);
    tableData.push({ qte: cellQte.textContent, nom: cellNom.textContent });
  });

  console.log(tableData);

  let colonnes = document.querySelectorAll(".table-column");
  colonnes.forEach((col) => {
    col.addEventListener("click", (e) => {
      toggleFleche(e);
    });
  });
  cellRech.addEventListener("keyup", (e) => {
    filterTable();
  });

  //  Fonction de tri

  const sort_by = (field, reverse, primer) => {
    console.log(field);
    console.log(primer);
    const key = primer
      ? function (x) {
          return primer(x[field]);
        }
      : function (x) {
          console.log(x);
          return x[field];
        };

    reverse = !reverse ? 1 : -1;

    return function (a, b) {
      return (a = key(a)), (b = key(b)), reverse * ((a > b) - (b > a));
    };
  };

  //   Cacher les icones de tri

  function clearArrow() {
    let carets = document.getElementsByClassName("caret");
    for (let caret of carets) {
      caret.className = "caret";
    }
  }

  //   Fonction de filtre (recherche et autocomplete)

  function filterTable() {
    let filter = input.value.toUpperCase();
    rows = table.getElementsByTagName("TR");
    let flag = false;

    for (let row of rows) {
      let cells = row.getElementsByTagName("TD");
      for (let cell of cells) {
        if (cell.textContent.toUpperCase().indexOf(filter) > -1) {
          flag = true;
          break;
        }
      }

      if (flag) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }

      flag = false;
    }
  }

  function toggleFleche(event) {
    let element = event.target;
    console.log(element);
    let caret, field, reverse;
    if (element.tagName === "SPAN") {
      caret = element.getElementsByClassName("caret")[0];
      field = element.id;
      console.log(field);
    } else {
      caret = element;
      field = element.parentElement.id;
      console.log(field);
    }

    let iconClassName = caret.className;
    clearArrow();
    if (iconClassName.includes(triUp)) {
      caret.className = `caret ${triDown}`;
      console.log(caret);
      reverse = false;
    } else {
      reverse = true;
      caret.className = `caret ${triUp}`;
    }

    tableData.sort(sort_by(field, reverse));
    console.log(tableData);
    console.log(reverse);
    populateTable();
  }

  function populateTable() {
    table.innerHTML = "";
    for (let data of tableData) {
      let row = table.insertRow(-1);

      
      let nomCellier = row.insertCell(0);
      nomCellier.innerHTML = `<td class="cell__col-nom"><a href="" class="selectCellier" data-cellid="<?php echo $cel['id'] ?>">${data.nom}</a></td>`;
     
      let qte = row.insertCell(1);
      qte.innerHTML = `<td class="cell__col-qte b__compte">${data.qte}</td>`;
    }

    filterTable();
  }
});
