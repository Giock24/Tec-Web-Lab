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
        console.log(main);
        allPokemon.forEach(pokemon => {
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
            div.appendChild(id);
            div.appendChild(name);
            div.appendChild(ul);
            main.appendChild(div);
        });
    }
    
});