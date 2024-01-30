document.addEventListener("DOMContentLoaded",()=>{
    let form = document.getElementsByTagName("form")[0];
    form.setAttribute("hidden","");
    form.addEventListener("submit",handleForm);
    let buttons = document.getElementsByTagName("button");
    let nuova_partita = buttons[0];
    let valuta_partita = buttons[1];
    valuta_partita.setAttribute("hidden","");
    let win = document.getElementsByClassName("win")[0];
    win.setAttribute("hidden","");
    let lose = document.getElementById("lose");
    lose.setAttribute("hidden","");

    let partita;
    let n_row=9;
    let n_col=9;

    nuova_partita.addEventListener("click",()=>{
        newGame();
    })

    const newGame=()=>{
        $.post("garde_php.php", 
        {
            nuova_partita: "1",
        }
        ,function(data, status){
           newGameString=JSON.parse(data).split("");
           partita=[];
            for(let row=0;row<n_row;row++){
                partita[row]=[];
                for(let col=0;col<n_col;col++){
                   partita[row][col]=newGameString[row*9+col];
                }
            }
            newGameGrafic();
        });
    }

    const checkResult=()=>{
        $.post("garde_php.php", 
        {
            partita: JSON.stringify(partita)
        }
        ,function(data, status){
            if(data=="true"){
                win.removeAttribute("hidden");
            } else {
                lose.removeAttribute("hidden");
            }
        });
    }

    const newGameGrafic=()=>{
        createTable();
        form.removeAttribute("hidden");
        form.reset();
        valuta_partita.removeAttribute("hidden");
        win.setAttribute("hidden","");
        lose.setAttribute("hidden","");
    }

    const createTable=()=>{
        console.log(partita);
        let table=document.getElementsByTagName("table")[0];
        table.innerHTML="";

        console.log(table);
        
        for(let row=0;row<n_row;row++){
            let tr = document.createElement("tr");
            for(let col=0;col<n_col;col++){
                let td = document.createElement("td");
                td.innerHTML=partita[row][col];
                tr.appendChild(td);
            }
            table.appendChild(tr);
        }
        
    }

    function handleForm(event) { 
        event.preventDefault(); 
        let riga = form["riga"].value;
        let colonna = form["colonna"].value;
        let valore = form["valore"].value;
        if(0<riga && riga<10 && colonna>0 && colonna<10 && valore>0 && valore<10 ){
            partita[riga-1][colonna-1]=valore;
        }
        createTable()
    } 

    valuta_partita.addEventListener("click",()=>{
        checkResult();
    })
});