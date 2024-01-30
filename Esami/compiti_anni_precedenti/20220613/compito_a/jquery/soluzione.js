document.addEventListener("DOMContentLoaded", function() {
    // RICORDATI DI FAR PARTIRE L'HTML DA LOCALHOST
    // SE NO NON FUNZIONA LA PARTE DI XMLHttpRequest();
    
    let form = document.getElementsByTagName("form")[0];
    let array_span = document.getElementsByTagName("span");
    let button = document.getElementsByTagName("button")[1];
    let add = document.getElementsByName("submit")[0];

    form.setAttribute("hidden", "hidden");
    button.setAttribute("hidden", "hidden");
    for (let i = 0; i < array_span.length; i++) {
        array_span[i].setAttribute("hidden", "hidden");
    }

    let b_new = document.getElementsByTagName("button")[0];
    const rows = 9;
    const columns = 9;
    let my_table = new Map();
    let your_id;
    
    b_new.addEventListener("click", function() {
        /*
        $.ajax({
            url: "index.php",
            data: {
                type: "new_game"
            },
            success: function (data) {
                console.log(data);
            }
        });
        */
       let str = "new_game";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            let json_response = JSON.parse(this.responseText);
            
            let status = json_response.statoiniziale;
            your_id = json_response.id;

            //console.log(status[5]);
            let counter = 0;


            for (let i = 0; i < rows; i++) {
                for (let j = 0; j < columns; j++) {
                    my_table.set(`${i + 1} ${j + 1}`, `${status[counter]}`);
                    counter++;
                }
            }

            generate_table();
            //console.log(my_table);
            form.removeAttribute("hidden");
            button.removeAttribute("hidden");

            form.setAttribute("name","myForm");
            function handleForm(event) { event.preventDefault(); } 
            form.addEventListener('submit', handleForm);
            add.addEventListener("click", function () {
                //console.log(document.forms["myForm"]["riga"].value);
                let row = Number(document.forms["myForm"]["riga"].value);
                let column = Number(document.forms["myForm"]["colonna"].value);
                let my_value = Number(document.forms["myForm"]["valore"].value);
                if ((row >= 1 && row <= rows) && (column >= 1 && column <= columns)) {
                    if ( my_value >= 0 && my_value <= 9) {
                        //console.log(typeof my_value);
                        my_table.set(`${row} ${column}`, my_value);
                        //console.log(my_table);
                        generate_table();
                    }
                }
            });

            button.addEventListener("click", function () {
                // List all keys
                str = "evaluate"
                let text = "";
                for (const x of my_table.values()) {
                  text += x;
                }

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                    }
                };
                xmlhttp.open("GET", "../php/index.php?id=" + your_id + "&statonuovo=" + text + "&message=" + str, true);
                xmlhttp.send();
            });

          }
        };
        xmlhttp.open("GET", "../php/index.php?message=" + str, true);
        xmlhttp.send();

        console.log("fine");

    });

    function generate_table() {
        let table = document.getElementsByTagName("table")[0];
        let content_table = ``;

        for (let i = 1; i < rows + 1; i++) {
            content_table += `<tr>`;
            for (let j = 1; j < columns + 1; j++) {
                content_table += `<td data="${i} ${j}"> ${my_table.get(`${i} ${j}`)} </td>`;
            }
            content_table += `</tr>`;
        }

        table.innerHTML = content_table;
    }

});