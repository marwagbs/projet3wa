// EVENEMENTS //

import { storage, addQuantiy } from "./storage.js";
import { removeItemFromStorage, clearAllItemFromStorage ,removeQuantiy}  from "./remove.js";
// Selecteurs
let btn = document.querySelectorAll(".add");
let btnRemove=document.querySelectorAll(".removeItem");
let btnClear = document.querySelectorAll(".ClearItems");
let btnRemoveOne=document.querySelectorAll(".removeOne");
let btnAddOne=document.querySelectorAll(".addQuantity");


function btnEvent() {
    btn.forEach(element => element.addEventListener('click', storage));
}

btnEvent();


function BtnRemove(){
    btnRemove.forEach(remove=>remove.addEventListener('click',removeItemFromStorage))
}
BtnRemove();

function btnClearAllItems() {
    btnClear.forEach(clear => clear.addEventListener('click',clearAllItemFromStorage ));
}

btnClearAllItems();

function BtnRemoveOne() {
    btnRemoveOne.forEach(clear => clear.addEventListener('click', removeQuantiy ));
}
BtnRemoveOne();


function BtnAddOne() {
    btnAddOne.forEach(add => add.addEventListener('click', addQuantiy ));
}
BtnAddOne();

