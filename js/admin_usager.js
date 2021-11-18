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




    ////////////////////////////////////////////////////
    //Fonction SUPPRIMER compte Usager du Catalogue   //
    ////////////////////////////////////////////////////


    document.querySelectorAll(".btnSupprUsager").forEach(function (element) {
        //  console.log(element.parentElement.parentElement);
        element.addEventListener("click", function (evt) {

            let modalUsager = document.querySelector('.usager__supprimer__modal__wrapper');

            // console.log(element)
            let id = element.dataset.id;
            let nom = element.dataset.nom;


            console.log(modalUsager)

            //Afficher Modal  //  
            modalUsager.classList.toggle('show');
            modalUsager.querySelector('.modal__texte').innerText = 'Supprimer le Compte de l\'usager ' + nom.toUpperCase() + ' ?';

            //Fermeture du modal //

            let fermerBouton = modalUsager.querySelector('.fermer');
            fermerBouton.addEventListener('click', function (e) {
                let modalUsager = document.querySelector('.usager__supprimer__modal__wrapper');
                modalUsager.classList.remove('show');
            })

            let annBouton = modalUsager.querySelector('.btn__annuler');
            annBouton.addEventListener('click', function (e) {
                let modalUsager = document.querySelector('.usager__supprimer__modal__wrapper');
                modalUsager.classList.remove('show');
            })

            // Suppression du compte usager //


            let btnDanger = modalUsager.querySelector('.btn__danger');
            btnDanger.addEventListener('click', (e) => {

                //afficher le pageLoader
                document.querySelector(".loader").classList.remove('hidden');

                setTimeout(function () {
                    document.querySelector(".loader").classList.add('hidden');
                }, 3000);


                console.log(id);
                let requete = new Request("index.php?requete=supprimerUsagerCatalogue", { method: 'DELETE', body: '{"id": ' + id + '}' });
                console.log(requete);
                fetch(requete)
                    .then(response => {
                        console.log(response);

                        if (response.status === 200) {

                            //re-afficher le catalogue

                            //fermer le modal
                            modalUsager.classList.remove('show');

                            setTimeout(function () {


                                //supprimer le dom de l'element 
                                element.parentElement.parentElement.remove();
                                // afficher message de confirmation de la suppression de l'element du catalogue

                                document.querySelector(".txt_msg-usg-supprime").innerText = "L'usager " + nom.toUpperCase() + " supprimé avec succes !";

                            }, 3000);

                            setTimeout(function () {

                                // window.location.href = 'index.php?requete=getUsagersListe';

                                document.querySelector(".txt_msg-usg-supprime").innerText = " ";


                            }, 8000);

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
    //Fonction Effet Hover de l'id Bouteilles et Usagers // 
    ///////////////////////////////////////////////////////

    let items = document.querySelectorAll(".item");
    // console.log(items)


    items.forEach(function (element) {
        element.addEventListener("mouseover", function () {
            // console.log(element)
            let id = element.dataset.rowId;
            //  console.log(id)
            let hoverIdCooltip = document.querySelector('[data-id-hover="' + id + '"]');
            hoverIdCooltip.classList.remove("hidden");
            //    console.log(hoverIdCooltip)

        });
        element.addEventListener("mouseout", function () {
            // console.log(element)
            let id = element.dataset.rowId;
            //  console.log(id)
            let hoverIdCooltip = document.querySelector('[data-id-hover="' + id + '"]');
            hoverIdCooltip.classList.add("hidden");
            // console.log(hoverIdCooltip)

        });
    })



    ///////////////////////////////////////////////////////
    //Fonction modifier Statut d'un usager en Admin      // 
    ///////////////////////////////////////////////////////


    let btnAdminifier = document.querySelectorAll('.transformAdminBtn');
    console.log(btnAdminifier)
    btnAdminifier.forEach(function (element) {
        element.addEventListener('change', function () {
            let id = element.dataset.id;
            console.log(id);
            if (element.checked) {
                console.log('You are admin!')

                element.setAttribute("value", 1);
                console.log(element.value)


            } else {

                console.log('Sorry! No more admin fun :(')

                element.setAttribute("value", 0);

                console.log(element.value)

            }



            let param = {
                id: id,
                admin: element.value,

            }





            let requete = new Request("index.php?requete=changerUsagerStatutAdmin", {
                method: "PUT",
                body: JSON.stringify(param),
            });
            console.log(requete);
            fetch(requete)
                .then((response) => {
                    console.log(response);

                    if (response.status === 200) {
                        //re-afficher le cellier
                        window.location.href = "index.php?requete=getUsagersListe";
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



    //////////////////////////////////////////////////////////////////////////////
    //Fonction importSAQ  importer des bouteilles de SAQ dans le Catalogue      // 
    //////////////////////////////////////////////////////////////////////////////
    console.log(document.querySelector('.importSAQ'))
    document.querySelector('.importSAQ').addEventListener("click", function (evt) {


        //afficher le pageLoader
        document.querySelector(".loader").classList.remove('hidden');
        window.location.href = "index.php?requete=updateSAQ";

        setTimeout(function () {
            document.querySelector(".loader").classList.add('hidden');

        }, 6000);

        // setTimeout(function () {



        // }, 1000);



        /* let requete = new Request("index.php?requete=updateSAQ", { method: 'Get' });
         console.log(requete);
         fetch(requete)
           .then(response => {
             if (response.status === 200) {
 
               
 
 
             }
           })*/


    })


    //////////////////////////////////////////////////////////////////////
    //Fonction ajouter  Bouteille Non-Listee dans le Catalogue Admin    // 
    //////////////////////////////////////////////////////////////////////

    let formNonListee = document.querySelector('.form_ajout_nonlistee');
    console.log(formNonListee)

    let bouteilleNonlistee = {
        vino__type_id: formNonListee.querySelector("input[name='vino__type_id']:checked"),
        nom: formNonListee.querySelector("[name='nom']"),
        format: formNonListee.querySelector("[name='format']"),
        //  image: formNonListee.querySelector("[name='image']"),formNonListee.querySelector('[type=file]').files
        image: formNonListee.querySelector('[type=file]').files,
        pays: formNonListee.querySelector("[name='pays']"),
        prix: formNonListee.querySelector("[name='prix']"),
        //  url_saq: formNonListee.querySelector("[name='url_saq']"),
    };

    let typeVin = '';

    formNonListee.querySelectorAll("[name='vino__type_id']").forEach(function (element) {
        element.addEventListener('click', function () {
            console.log(element);
            if (element.checked) {
                console.log('checked')
                bouteilleNonlistee.vino__type_id = element.value;
            }
            if (element.value == 1) {
                typeVin = "Vin rouge"
            } else {
                typeVin = "Vin blanc"
            }
        })
    })

    let btnAjoutNonListeeCatalogue = formNonListee.querySelector(".ajoutNonlisteeBtn");

    console.log(typeVin)

    //  $info->prix = preg_replace("/[^0-9\,]/", " ", $info->prix);
    console.log(formNonListee.querySelector('[type=file]').files);
 
    //ajouterImageLocal

    if (btnAjoutNonListeeCatalogue) {
        btnAjoutNonListeeCatalogue.addEventListener("click", function (evt) {
            //  bouteilleNonlistee.image.value = bouteilleNonlistee.image.value.replace(/C:\\fakepath\\/i, "./assets/img/bouteillesNonlistees/");

            let formData = new FormData();

            formData.append('file', image.files[0])
            console.log(image.files[0]);

            var param = {
                nom: bouteilleNonlistee.nom.value,
                format: bouteilleNonlistee.format.value,
                // image: bouteilleNonlistee.image.value.replace(/C:\\fakepath\\/i, "./assets/img/bouteillesNonlistees/"),//remplacer la path de l'image avec celle en local. 
                image: "./assets/img/bouteillesNonlistees/" + image.files[0].name,
                vino__type_id: bouteilleNonlistee.vino__type_id,
                pays: bouteilleNonlistee.pays.value,
                prix_saq: bouteilleNonlistee.prix.value,
                description: typeVin + " | " + bouteilleNonlistee.format.value + " | " + bouteilleNonlistee.pays.value,
                url_saq: 'Non Listée',
                code_saq: 'Non Listée',
            };

                ////////////////////Ajouter Image dans le dossier local /////////////////////
                
            // let formData = new FormData();

            // formData.append('file', image.files[0])
            // console.log(image.files[0]);
    
            let requete = new Request("index.php?requete=ajouterImageLocal", {
                method: "POST",
                body: formData,
            });
    
            fetch(requete)
                .then(function (response) {

                    let requete = new Request("index.php?requete=ajouterBouteilleNonListeeCatalogue", {
                        method: "POST",
                        body: JSON.stringify(param),
                        headers: { "Content-Type": "application/json" },
                    });
        
                    fetch(requete)
                        .then(response => {
                            if (response.status === 200) {
                                console.log(response);
        
        
        
                            }
        
                        })
                        .then((response) => {
                            console.log(response);
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                    console.log(response.text());
                });

                ////////////////////Fin ajouter Image dans le dossier local /////////////////////


            console.log(param.image)
            console.log(param)
            // let requete = new Request("index.php?requete=ajouterBouteilleNonListeeCatalogue", {
            //     method: "POST",
            //     body: JSON.stringify(param),
            //     headers: { "Content-Type": "application/json" },
            // });

            // fetch(requete)
            //     .then(response => {
            //         if (response.status === 200) {
            //             console.log(response);



            //         }

            //     })
            //     .then((response) => {
            //         console.log(response);
            //     })
            //     .catch((error) => {
            //         console.error(error);
            //     });




        }) // fin de btnAjoutNonListeeCatalogue.addEventListener('click'{})

    }//end If(btnAjoutNonListeeCatalogue)






    if (localStorage.getItem('scrollPosition') !== null)
        window.scrollTo(0, localStorage.getItem('scrollPosition'));
}, false);