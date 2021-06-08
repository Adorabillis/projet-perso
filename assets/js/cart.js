//récupérer les valeurs quantity, hidden_name, hidden_price

function addToCart(){
    let id = this.dataset.id;
    let newCart={}; 
    newCart = {quantite:document.getElementById(`qte${id}`).value, prix:document.getElementById(`px${id}`).value, Nom:document.getElementById(`nom${id}`).value, id:id 
    }; 
    newCart=JSON.stringify(newCart);
    
    let options = {
		method : 'POST',
		body : newCart,
		headers:{'Content-Type':'application/json'}
	}
	
	fetch('index.php?page=addCart', options)
}
document.addEventListener("DOMContentLoaded",function(){
    
    let button = document.querySelectorAll('.btn');
     //boucle
     for (let i=0; i<button.length; i++){
         button[i].addEventListener('click',addToCart);
     }
})

