
///////////////////////////////////////////////////////////////////////////////////////
/*                              Localstorage                                        */
///////////////////////////////////////////////////////////////////////////////////////
//Ce fichier ne va contenir que des fonction liées au LS 

//on récupère le contenu de LS
// Récupération du contenu

function getDatas(key) {
    return JSON.parse(localStorage.getItem(key)) ?? [];
}

// Enregistrement dans le localstorage de la clé et de ses valeurs

function setDatas(key, datas) {
    const dataConvert = JSON.stringify(datas)
    localStorage.setItem(key, dataConvert)
}

// Vérification de l'id s'il éxiste dans le localstorage
//key identifie le panier dans le LS
function isItemInStorage(idProd, key) {
    //récupérer mon local storage
    const datas = getDatas(key);
    //parcourir le LS
    let found = false;
    let index=0;
    for(let i = 0; i < datas.length; i++){
        if(idProd === datas[i].id){
            //return true
            found = true;
            break;
        }
        // else{
        //     return false
        // }
    }
    return found;
}
// Construction de notre produit qui sera ajouté dans le localstorage

function addProduct(id, name, price, picture) {
    return {id: id, name: name, price: price, picture: picture, qtt: 1}
}

// Dans LocalStorage : suppression de tout les articles
function clearData(key) {
    return localStorage.removeItem(key);
}
// Export de nos fonctions.
export {getDatas, setDatas, isItemInStorage, addProduct, clearData}



