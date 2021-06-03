function cookie(){
    event.preventDefault();

    fetch(`index.php?page=cookie`)
    .then(response=>response.text())
        .then(response=>{
           document.querySelector(".cookie").style.display="none"; 
        });
}


function deleted(){
    
    //demander à l'admin s'il est sûr de lui ?
      //si oui, alors on stoppe le comportement par défaut du lien
    if (confirm("Étes-vous sûrs de supprimer ?"))
    {
        event.preventDefault();
       //envoie une requête ajax fetch -->index.php en lui disant qu'on veut supprimer une categorie et celle qui a l'id 
        fetch(this.dataset.url)
        //.then --> supprimer le tr concerné
        .then(response=>response.text())
        .then(response=>{
            this.parentNode.parentNode.remove();   
        });
        
    }
    
}




document.addEventListener("DOMContentLoaded",function(){
    
     let buttons = document.querySelectorAll('.confirmButton');
     //boucle
     for (let i=0; i<buttons.length; i++){
         buttons[i].addEventListener('click',deleted);
     }
     
     let btnCookie = document.querySelector('.acceptCookie');
     btnCookie.addEventListener('click',cookie);
      
})
