import * as local from './localStorage.js'
//Déclaration de variables 
const listTab = local.getDatas("cartList");
let totalPanier=0;
let totalQuantity=0;
//affichage de la qtt dans le panier
listTab.forEach(products => {
 
          totalQuantity+=products.qtt
})
document.querySelector("#number").innerHTML=totalQuantity;
if(listTab.length>0){
   document.querySelector('.thead').insertAdjacentHTML('beforeend', 
     `
     <thead>
        <tr>
          <th scope="col" class="thimg"></th>
          <th scope="col">Nom</th>
          <th scope="col">Prix</th>
          <th scope="col">Quantité</th>
          <th scope="col">Totals</th>
          <th></th>
          
        </tr>
      </thead>
    `
    )
    listTab.forEach(products => {
   document.querySelector('.displayCart').insertAdjacentHTML('beforeend',
        `
        <tr>
            <th scope="row"><img src="${products.picture}" alt="img" class="imgCart"></th>
            <td>${products.name}</td>
            <td>${products.price}</td>
            <td>
                <div class="quantity">
                <i class="fas fa-solid fa-minus removeOne" data-id="${products.id}"></i>
                <span>${products.qtt}</span>
                <i class="fas fa-solid fa-plus addQuantity" data-id="${products.id}"></i>
                </div>
            </td>
            <td>${new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(products.qtt * products.price)}</td>
            
            
            <td><i class="fas fa-trash-alt removeItem" data-id="${products.id}"></i></td>

        </tr>
        `
    )
})
document.querySelector('.totalPanier').insertAdjacentHTML('beforeend',
 `  <tr>
      	<th scope="row">Totals</th>
        <td colspan="4">
          <p class="totalPanier" align="right"></p>
        </td>
    </tr>
        `
 )
 
}else{
    document.querySelector('.cartEmpty').insertAdjacentHTML('beforeend',
    `     <p class="oups">Oups <img src="img/Oups-Web.jpg"> Votre panier est vide.</p>
          <a href="product.php"class="cartBoutton">Continuer les achats</a>
     
    `
)
    
}

listTab.forEach(products => {
 
          totalPanier+=products.qtt * products.price
})
document.querySelector("p.totalPanier").insertAdjacentHTML('beforeend', new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(totalPanier))



