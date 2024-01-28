document.addEventListener("DOMContentLoaded",()=>{
    let allPokemon = []

    let loadData = document.getElementsByTagName("button");
    loadData[0].addEventListener("click",()=>{
        console.log(allPokemon);
        $.ajax({url: "./data.json", success: function(result){
            allPokemon = result.data;
            console.log(allPokemon);
            createPokemonList();
        }});
    })
    
    
    let createPokemonList = () => {
        let main = document.getElementsByTagName("main")[0];
        main.innerHTML="";
        allPokemon.forEach((pokemon,index) => {
            let div = document.createElement("div");
            let id = document.createElement("p");
            id.innerHTML = pokemon.id;
            let name = document.createElement("p");
            name.innerHTML = pokemon.name;
            let ul = document.createElement("ul");
            pokemon.type.forEach(element => {
                let li = document.createElement("li");
                li.innerHTML = element;
                ul.appendChild(li);
            })
            let up = document.createElement("button");
            up.addEventListener("click", () => {
                allPokemon[index] = allPokemon[index-1];
                allPokemon[index-1] = pokemon;
                createPokemonList();
            })
            //up.onclick= ()=>console.log("e");
            up.innerHTML="up";
            let down = document.createElement("button");
            down.addEventListener("click", () => {
                allPokemon[index] = allPokemon[index+1];
                allPokemon[index+1] = pokemon;
                createPokemonList();
            })
            down.innerHTML="down";
            div.appendChild(id);
            div.appendChild(name);
            div.appendChild(ul);
            if(index!=0){
                div.appendChild(up);
            }
            if(index != allPokemon.length-1){
                div.appendChild(down);
            }
            main.appendChild(div);
        });
    }
    
});