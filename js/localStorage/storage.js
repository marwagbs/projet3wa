import * as local from './localStorage.js'
import * as events from './events.js'

const cartList = local.getDatas("cartList");

// Fonction du stockage dans le local storage 
// event : accès à tous les évènements du click

function storage(events) {
    //On récupère les propriétés du produit
    //target est l'élément de l'objet event
    
    const productId = events.target.getAttribute("data-id");
     const productPicture = events.target.getAttribute("data-picture");
    const productName = events.target.getAttribute("data-name");
    const productPrice = events.target.getAttribute("data-price");
    
    let position = local.isItemInStorage(productId, "cartList");
    let index = cartList.find(item => item.id === productId);
    //Si cartlist n'est pas vide
    if(cartList && position) {
        //On insère la clé et les valeurs
   
         index.qtt++; // incrémentation
     
    } else {
        cartList.push(local.addProduct(productId, productName, productPrice, productPicture));
    }
    
    //Enregistrement du nouveau panier pour remplacer l'ancien.
    local.setDatas('cartList', cartList);
     window.location.reload(false);
}
function addQuantiy(event){
    const productId = event.target.getAttribute('data-id');
    const position = local.isItemInStorage(productId, 'cartList');
    let index = cartList.find(item => item.id === productId);
    if(cartList && position && index.qtt>=1){
     index.qtt++;
      
    }
    
    //Enregistrement du nouveau panier pour remplacer l'ancien.
    local.setDatas('cartList', cartList);
   window.location.reload(false);
}
export {storage , addQuantiy} 