const datalist = document.getElementById("searchList")
const search=document.getElementById('search')
//creation d'options
const option = document.createElement("option");

search.addEventListener("keyup", (e)=>{

fetch('apiSearch.php?q='+e.target.value)
.then(response => response.json())
.then(name =>{
     datalist.innerHTML = "";
     for(const title of name) {
        const option = document.createElement("option");
        option.value = title
        datalist.append(option);
        console.log(option);
    }
    
    
  });
});
