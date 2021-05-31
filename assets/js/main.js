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
function showFormModif(){
    
    let id = this.dataset.id;
    fetch(`index.php?page=modifyUserBooking&id=${id}`)
    .then(response => response.text())
    .then(response => {
        document.querySelector(".resa").innerHTML=response;
    })
}

function modifyUserBooking(){
    let clientData = {
		firstName: document.getElementById("firstName").value,
		customerName: document.getElementById("lastName").value,
		nb: document.getElementById("nb").value,
		time: document.getElementById("time").value,
		date: document.getElementById("date").value,
		comment: document.getElementById("comment").value
	}
	clientData = JSON.stringify(clientData);
	//créer les options d'envoi de la requête ajax
	let options = {
		method : 'POST',
		body : clientData,
		headers:{'Content-Type':'application/json'}
	}
	
	fetch(`models/Booking.php`,options)
	.then(response => response.text())
}

document.addEventListener("DOMContentLoaded",function(){
    
     let buttons = document.querySelectorAll('.confirmButton');
     //boucle
     for (let i=0; i<buttons.length; i++){
         buttons[i].addEventListener('click',deleted);
     }
     let btnModif = document.querySelectorAll('.modifBooking');
     for (let i=0; i<btnModif.length; i++){
     btnModif[i].addEventListener('click',showFormModif);
     }
     
     let btnCookie = document.querySelector('.acceptCookie');
     btnCookie.addEventListener('click',cookie);
      
})
