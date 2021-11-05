/**
 * @file Script contenant les fonctions necessaires pour le panneau admin
 * @author DFV - "les Devs en Pyjamas"
 * @version 0.1
 *
 */

//const BaseURL = "https://a_remplir";




console.log(BaseURL);
window.addEventListener('load', function () {






    ////////////////////////////////////////////////////////////////////////
    //Fonction afficher le contenu en fonction de bouton/tab selectionnee //
    ////////////////////////////////////////////////////////////////////////

    document.querySelectorAll(".tabs__button").forEach(function (element) {
        console.log(element);
        let sideBar = element.parentElement;
        element.addEventListener("click", function (evt) {
            console.log(element);

            let mainContenant = document.querySelector('.admin_contenu_page');
            console.log(sideBar)
            let tabNumber = element.dataset.forTab;
            let contentActivate = mainContenant.querySelector(`.admin__tabs__content[data-tab="${tabNumber}"]`);
            console.log(contentActivate);

            sideBar.querySelectorAll('.tabs__button').forEach(button => {
                button.classList.remove('tabs__button--active');
            })
            mainContenant.querySelectorAll('.admin__tabs__content').forEach(tab => {
                tab.classList.remove('admin__tabs__content--active');
            })

            //retracter la side-bare
            sideBar.style = "transform: translate(-100%, 0);"

            //cacher le "x" et re-afficher le menu burger
            document.getElementById("admin_menuToggle").lastElementChild.classList.add('hidden')
            document.getElementById("admin_menuToggle").lastElementChild.previousElementSibling.classList.remove('hidden')


            element.classList.add('tabs__button--active');
            contentActivate.classList.add('admin__tabs__content--active');

        })
    })



    ////////////////////////////////////////////////////////////////////////
    //Fonction Toggle de class pour le bouton menu                       //
    ////////////////////////////////////////////////////////////////////////

    let menuToggle = document.getElementById("admin_menuToggle");
    // document.querySelector('.admin-menu').classList.add("hidden")
    sideBar = document.querySelector('.admin-menu');
    console.log(menuToggle)

    // console.log(menuToggle.querySelector('.menu_icon'))
    menuToggle.querySelectorAll('.menu_icon').forEach(icon => {
        sideBar.classList.remove("hidden");
        //    
        menuToggle.addEventListener("click", function (evt) {

            if (icon.classList.contains('hidden')) {
                icon.classList.remove('hidden')
                if (sideBar.classList.contains("hidden")) {
                    sideBar.classList.remove("hidden");
                }

                //    sideBar.style="visibility:visible; opacity:1;"
                sideBar.style = "transform: none;"

                console.log(document.querySelector('.admin-menu'))
                // if (document.querySelector('.admin-menu').classList.contains('hidden')) {
                //     console.log(document.querySelector('.admin-menu').classList)
                //     document.querySelector('.admin-menu').classList.remove("hidden")
                // }


            } else {




                icon.classList.add('hidden')
                sideBar.style = "transform: translate(-100%, 0);"
                // document.querySelector('.admin-menu').classList.add("hidden")


            }


        })

    })






});