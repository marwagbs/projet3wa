import * as local from './localStorage.js'
import * as event from './events.js'

// Selecteurs:
const cartList = local.getDatas("cartList");

// Fonction remove item, qui nous permettra de supprimer un article du panier
// Fonction de suppression du produit désiré dans le panier(remove)
function removeItemFromStorage(event) {

      // On utilise findIndex pour rechercher la clé
      const productId = event.target.getAttribute('data-id');
      let positon = local.isItemInStorage(productId, 'cartList');

      if (cartList && positon) {
            const key = cartList.findIndex(p => p === productId);
            cartList.splice(key, 1);
            local.setDatas('cartList', cartList); // enregistrement du nouveau panier aprés suppression.
            window.location.reload(false); // rafraichissement du panier.
          
      }
}


// Fonction clear, qui nous permettra de vider le panier.

function clearAllItemFromStorage() {
    
    local.clearData("cartList"); // Vider totalement le localStorage/Panier.
    window.location.reload(false); // rafraichissement 
    // localStorage.setItem("cartList", []);
}

function removeQuantiy(event){
    const productId = event.target.getAttribute('data-id');
    const position = local.isItemInStorage(productId, 'cartList');
    let index = cartList.find(item => item.id === productId);
    if(cartList && position && index.qtt>1){
        index.qtt--;
        console.log("diminue")
    }
    
    //Enregistrement du nouveau panier pour remplacer l'ancien.
    local.setDatas('cartList', cartList);
    window.location.reload(false);
}

export { removeItemFromStorage, clearAllItemFromStorage ,removeQuantiy} 