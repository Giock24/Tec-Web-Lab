const risultato = document.querySelector("div");
/*
document.querySelectorAll("input")[0].addEventListener("click", function() {
        let testo = risultato.innerHTML;
        testo = testo.toUpperCase(); // il contenuto della variabile testo diventa maiuscolo
        risultato.innerHTML = testo;
    }
)
*/

// per andare a selezionare un elemento è un po' come abbiamo visto in CSS
document.querySelector("input[value='Testo uppercase']").addEventListener("click", function() {
        let testo = risultato.innerHTML;
        testo = testo.toUpperCase(); // il contenuto della variabile testo diventa maiuscolo
        risultato.innerHTML = testo;
    }
);

document.querySelectorAll("input")[1].addEventListener("click", function() {
        let testo = risultato.innerHTML;
        testo = testo.toLowerCase(); // il contenuto della variabile testo diventa minuscolo
        risultato.innerHTML = testo;
    }
);

//document.querySelectorAll("input")[2].addEventListener("click", function() {
// tra tutti i tipi prendi l'ultimo
document.querySelector("input:last-of-type").addEventListener("click", function() {
    let testo = risultato.innerHTML;
    //let take_text = testo.substring(5, testo.length) + testo.substring(0, 5); // per la funzione substring prendi da 0 a n valori della stringa
    let testo_spostato = testo.slice(5, testo.lenght) + testo.slice(0, 5);
    risultato.innerHTML = testo_spostato;
    }
);