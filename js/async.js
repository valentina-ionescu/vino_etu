function async(action,method,id) {
   
  console.log(action)
  console.log(method)
  console.log(id)
  let requete = new Request(`index.php?requete=${action}`, { method: `${method}`, body: '{"id": '+id+'}'});
      console.log(requete);
      fetch(requete)
        .then(response => {
          if (response.status === 200) {
           
            console.log(response)
            return response.json();
          } else {
            throw new Error('Erreur');
          }
        })
        .then(response => {
          console.log(response);
          window.location.href = "index.php?requete=accueil"

        }).catch(error => {
          console.error(error);
        });

}
