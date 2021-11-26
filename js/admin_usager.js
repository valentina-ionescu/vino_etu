/**
 * @file Script contenant les fonctions necessaires pour le panneau admin_usager
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

    document.querySelector(".loader").classList.add('hidden');




    ///////////////////////////////////////////////////////
    //Fonction affichage modal Deconnexion Admin         // 
    ///////////////////////////////////////////////////////

    // let uimage = document.querySelector('.u__img');
    let aimage = document.querySelector(".u__profile_img_admin");
    let amenu = document.querySelector(".u__profile-toggle_admin");
    console.log(amenu);
    console.log(aimage);
    aimage.addEventListener("click", (e) => {
        // umenu.style.display = umenu.style.display === "none" ? "flex" : "none";
        console.log(amenu);
        amenu.classList.toggle('show');
    });

    // click en dehors du menu le fermera
    document.addEventListener('click', (e) => {
        if (!e.target.matches('.u__profile_img_admin i'))
            if (amenu.classList.contains('show'))
                amenu.classList.remove('show');
    })


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
    //bouton annuler
    formNonListee.querySelector('.btnAnnul').addEventListener('click',()=>{
        window.location.assign("index.php?requete=getCatalogue");
    })


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
            } else if(element.value == 2) {
                typeVin = "Vin blanc"
            } else if(element.value == 3) {
                typeVin = "Vin rosé"
            }
        })
    })

    let btnAjoutNonListeeCatalogue = formNonListee.querySelector(".ajoutNonlisteeBtn");



    let formData = new FormData();
    let imageNonListee = "./assets/img/bouteillesNonlistees/bouteilleParDefaut.jpg";//image par defaut
    imageValide = false;
    // console.log(document.getElementById("nom_image"));

    document.getElementById("image").addEventListener("change", function () {

        let fullPath = this.value; // fetched value = C:\fakepath\nomImage.extension
        let fileName = fullPath.split(/(\\|\/)/g).pop();  // fetch le nom de l'image

        if (image.files[0].type == "image/jpeg" || image.files[0].type == 'image/png' || image.files[0].type == 'image/gif') {

            document.getElementById("nom_image").innerHTML = fileName;  // afficher le nom de l'image dans le dom 

            imageValide = true;

        } else {
           
            imageNonListee = "./assets/img/bouteillesNonlistees/bouteilleParDefaut.jpg";
            document.getElementById("nom_image").innerHTML = '<p style="color:red;">L\'image doit etre de format *.jpeg, *.jpg, *.png ou *.gif!</p>';  // afficher msg d'erreur si le format de l'image n'est pas conforme
            imageValide = false;


        }
        

    }, false);


    if (btnAjoutNonListeeCatalogue) {
        btnAjoutNonListeeCatalogue.addEventListener("click", function (evt) {
            //  bouteilleNonlistee.image.value = bouteilleNonlistee.image.value.replace(/C:\\fakepath\\/i, "./assets/img/bouteillesNonlistees/");


            formData.append('file', image.files[0])// ajouter l'objet image dans l'info de form data pour envoyer vers php. 

            // console.log(image.files[0].type);

            if (imageValide && imageNonListee != "") {
                imageNonListee = "./assets/img/bouteillesNonlistees/" + Math.round(new Date().getTime() / 1000) + '-' + image.files[0].name.replace(/\s+/g, "");//enlever les espaces dans le nom des images, et ajouter un timestamp
            }

            var param = {
                nom: bouteilleNonlistee.nom.value,
                format: bouteilleNonlistee.format.value,
                // image: bouteilleNonlistee.image.value.replace(/C:\\fakepath\\/i, "./assets/img/bouteillesNonlistees/"),//remplacer la path de l'image avec celle en local. 
                // image: "./assets/img/bouteillesNonlistees/"+Math.round(new Date().getTime()/1000) + '-'+image.files[0].name.replace(/\s+/g, ""), //remplacer la path de l'image  avec celle en local. 
                image: imageNonListee,
                vino__type_id: bouteilleNonlistee.vino__type_id,
                pays: bouteilleNonlistee.pays.value,
                prix_saq: bouteilleNonlistee.prix.value,
                description: typeVin + " | " + bouteilleNonlistee.format.value + " | " + bouteilleNonlistee.pays.value,
                url_saq: 'Non Listée',
                code_saq: 'Non Listée',
            };
            let msgErreur = document.querySelector('[data-js-erreur-nonListee]');

            if (param.nom !== '' && param.nom.length > 2) {

            let requete = new Request("index.php?requete=ajouterBouteilleNonListeeCatalogue", {
                method: "POST",
                body: JSON.stringify(param),
                headers: { "Content-Type": "application/json" },
            });


            fetch(requete)
                .then(function (response) {
                    ////////////////////Ajouter Image dans le dossier local /////////////////////

                    if (param.image != "") {
                        let requete = new Request("index.php?requete=ajouterImageLocal", {
                            method: "POST",
                            body: formData,
                        });

                        fetch(requete)
                            .then(response => {

                            })
                            .catch((error) => {
                                console.error(error);
                            });
                    }

                    if (response.status === 200) {

                        document.querySelector(".loader").classList.remove('hidden');


                        setTimeout(function () {
                            document.querySelector(".loader").classList.add('hidden');
                            window.location.href = "index.php?requete=getCatalogue";
                        }, 1500);


                    }
                });
            }else {
                msgErreur.classList.remove('hidden');
              }






            ////////////////////Fin ajouter Image dans le dossier local ////////////////////



        }) // fin de btnAjoutNonListeeCatalogue.addEventListener('click'{})

    }//end If(btnAjoutNonListeeCatalogue)














    if (localStorage.getItem('scrollPosition') !== null)
        window.scrollTo(0, localStorage.getItem('scrollPosition'));
}, false);