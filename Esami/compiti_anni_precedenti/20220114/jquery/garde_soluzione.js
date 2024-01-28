document.addEventListener("DOMContentLoaded",() => {
    let nRow = 6;
    let nCol = 7;
    let matrix=[];

    let tables = document.getElementsByTagName("table");
    console.log(tables);
    let tableOne = tables[0];
    let tableTwo = tables[1];

    for(let i = 0; i<nRow; i++){
        matrix.push([])        
        for(let j = 0;j<nCol;j++){
            matrix[i].push(Math.floor(Math.random()*2)+1);
        };
    };

    let button = document.getElementsByTagName("button")[0];
    button.addEventListener("click",()=>{
        secondTable();
    })

    updateTables();

    function getColor(number){
        switch(number){
            case 1:
                return "red"
            case 2:
                return "blue"
            default:
                return "transparent"
        }
    }

    function updateTables(){
        tableOne.innerHTML="";
        for(let i = 0; i<nRow; i++){
            let rowOne = document.createElement("tr");     
            for(let j = 0;j<nCol;j++){
                let td_one = document.createElement("td");
                td_one.addEventListener("click",(event)=>{
                    matrix[i][j] = 0;
                    updateTables();
                })
                td_one.setAttribute("style",`background-color:${getColor(matrix[i][j])}`)
                td_one.innerHTML = matrix[i][j];
                rowOne.appendChild(td_one);
            };
            tableOne.appendChild(rowOne);
        };
    }

    function secondTable(){
        tableTwo.innerHTML="";
        for(let i = 0; i<nRow; i++){
            let rowTwo = document.createElement("tr");      
            for(let j = 0;j<nCol;j++){
                let td_two = document.createElement("td");
                td_two.innerHTML = matrix[i][j];
                rowTwo.appendChild(td_two);
            };
            tableTwo.appendChild(rowTwo);
        }
    }
})