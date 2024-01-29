document.addEventListener("DOMContentLoaded",()=>{
    let highlighted=null; //highlighted td in the first table
    console.log(highlighted);

    //first table
    let firstTableTds = document.getElementsByTagName("td");
    for(let i=0; i<firstTableTds.length; i++){
        let td = firstTableTds[i];
        td.addEventListener("click",()=>{
            if(highlighted==i){
                td.setAttribute("style","")
                highlighted=null;
            } else {
                if(highlighted!=null){
                    firstTableTds[highlighted].setAttribute("style","");
                }
                td.setAttribute("style","background-color:#cacaca");
                highlighted=i;
            }
        })
    }

    //second table creation
    let main = document.getElementsByTagName("main")[0];
    let table_numeri = document.createElement("table");
    let row = document.createElement("tr");
    let numbers = [1,2,3,4,5,6,7,8,9];
    let log = document.getElementsByClassName("log")[0];
    numbers.forEach((number)=>{
        let td = document.createElement("td");
        td.innerHTML = number;
        td.addEventListener("click",()=>{
            if(highlighted==null){
                log.innerHTML="Cella non selezionata";
            } else {
                let td = firstTableTds[highlighted];
                td.setAttribute("style","");
                td.innerHTML=number;
                log.innerHTML="Numero inserito correttamente";
            }
        });
        row.appendChild(td);
    });
    table_numeri.appendChild(row);
    main.appendChild(table_numeri);

})