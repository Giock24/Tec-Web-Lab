// Object
let myCat = {
    "name" : "Meow",
    "species" : "cat",
    "favFood" : "tuna"
}

// Array
let myFavColors = ["blue", "green"];

// Example of JSON (Union of Object and Array)
let thePets = [
    {
        "name" : "Barky",
        "species" : "dog",
        "favFood" : "carrots"
    }, 
    {
        "name" : "Meow",
        "species" : "cat",
        "favFood" : "tuna"
    }
]

// toget property "carrots"
thePets[1].favFood;

let button = document.getElementById('btn');

button.addEventListener("click", function() {
    let ourRequest = new XMLHttpRequest();
    ourRequest.open('GET','https://learnwebcode.github.io/json-example/animals-1.json');
    ourRequest.onload = function() {
        //console.log(ourRequest.responseText);
        // responseText in questo caso ti dà come valore tutto
        // il JSON ma come intero testo, preso da quel URL
        // perciò c'è bisogno di fare un parsing e
        // fargli capire che è un JSON con .parse()
        let ourData = JSON.parse(ourRequest.responseText);
        renderHTML(ourData);
    };

    ourRequest.send();
});

function renderHTML(data) {
    let div = document.getElementById("animal-info");
    let animal = "<p>"
    for (let c = 0; c < data.length; c++) {
        animal+=`
        <p> ${data[c].name} is a ${data[c].species}</p>
        <p> foods that likes are: `
    
        for (let i = 0; i < data[c].foods.likes.length ; i++) {
            animal+=`${data[c].foods.likes[i]} `;
        }
    
        animal+=`</p> <p> food that dislikes are: `;
    
        for (let i = 0; i < data[c].foods.dislikes.length ; i++) {
            animal+=`${data[c].foods.dislikes[i]} `;
        }
    
        animal+=`</p>`;
    }

    //div.innerHTML = animal;
    // è la stessa identica cosa come è scritto sopra, ma usando una funzione
    div.insertAdjacentHTML('beforeend', animal);
}

