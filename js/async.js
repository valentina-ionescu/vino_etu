function async(action,id) {
   
      
      let requete = new Request(`index.php?requete=${action}`, { method: 'DELETE', body: '{"id": '+id+'}'});
      console.log(requete);
      fetch(requete)
        .then(response => {
          if (response.status === 200) {
           
            console.log(response)
            window.location.href = "index.php?requete=accueil"
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

}