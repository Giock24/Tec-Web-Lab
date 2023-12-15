// per stampare hello world
console.log("Hello World!");

//span id="ciao" quello che voglio modificare, lo faremo con il DOM

//const tagHello = document.getElementById("ciao"); // vettore con unico elemento con quel id
const tagHello = document.querySelector("#ciao"); // secondo modo per modificare il primo Placeholder
// metodo per modificare internamente l'HTML
tagHello.innerHTML = "Hello World";

//class="anno"

// # e il . vengono usati un po' come in CSS
//const tagYear = document.getElementsByClassName("anno")[1];
//const tagYear = document.querySelector(".anno");
var tagYear  = document.querySelectorAll(".anno")[1]; // ritorna un vettore e poi selezione l'elemento
tagYear.innerHTML = "2023";
/*
for (var c = 0; c < 10; c++ ) {
    console.log(c);
}
*/
function executeAsync(func) {
    setTimeout(func, 0);
}

executeAsync(function() {
    //alert("Test");
    let i = true;
    while(false) {
        if (i === true) {
            console.log("FUNZIA");
            //tagYear = document.querySelectorAll(".anno")[1];
            i = false;
        } else {
            //tagYear = document.querySelectorAll(".anno")[0];
            i = true;
        }
    }
});