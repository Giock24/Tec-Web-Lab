document.addEventListener("DOMContentLoaded", function() {
    let tables = document.getElementsByTagName("table");
    let rows = 6;
    let columns = 7;
    //Math.floor(Math.random() * 2) + 1; // per fare ottenere randomicamente o 1 o 2
    let matrix_numbers = [];
    
    console.log(tables[0]);
    let first_table = tables[0];
    let row_col = ``;
    
    for (let i = 0; i < rows; i++) {
        row_col += `<tr id="row_${i}">`;
        for (let j = 0; j < columns; j++) {
            let num = Math.floor(Math.random() * 2) + 1;
            matrix_numbers.push(num);
            row_col += `
                <td id="colum_${j}" row="${i}" column="${j}" style=""> 
                    ${num} 
                </td>`;           
        }
        row_col += `</tr>`;
    }

    first_table.innerHTML = row_col;

    let all_td = document.getElementsByTagName("td");
    //console.log(matrix_numbers);
    for (let counter = 0; counter < all_td.length; counter++) {

        if (matrix_numbers[counter] === 1) {
            all_td[counter].setAttribute("style", "background-color: red;");
        } else if(matrix_numbers[counter] === 2) {
            all_td[counter].setAttribute("style", "background-color: blue;");
        }

        all_td[counter].addEventListener("click", function() {
            //console.log("Sono nella riga: "+all_td[counter].getAttribute("row"));
            //console.log("e colonna: "+all_td[counter].getAttribute("column"));
            all_td[counter].innerHTML = 0;
            all_td[counter].setAttribute("style", "background-color: transparent;");
            matrix_numbers[counter] = 0;
        })
    }

    document.getElementsByTagName("button")[0].addEventListener("click", function() {
        let second_table = tables[1];
        let row_col = ``;
        let counter = 0;
        for (let i = 0; i < rows; i++) {
            row_col += `<tr id="row_${i}">`;
            for (let j = 0; j < columns; j++) {
                row_col += `
                    <td id="colum_${j}" row="${i}" column="${j}" style="${all_td[counter].getAttribute('style')}"> 
                        ${matrix_numbers[counter]} 
                    </td>`;
                counter++;           
            }
            row_col += `</tr>`;
        }

        second_table.innerHTML = row_col;
    });
    
});