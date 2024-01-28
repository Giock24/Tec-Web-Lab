document.addEventListener("DOMContentLoaded", function () {
    let all_pokemon;
    fetchJSONData("./data.json");
    let array_pokemon =  [];

    let main = document.getElementsByTagName("main");
    //console.log(main);
    //console.log(document.getElementsByTagName("button"));
    let counter = 0;
    
    document.getElementsByTagName("button")[0].addEventListener("click", function() {
        //console.log(all_pokemon.data[0].name);
        if (counter == 0) {
            all_pokemon.data.forEach(element => {
                let all_type = ``;
                element.type.forEach(tipo => {
                    all_type += `${tipo} `;
                });
    
                array_pokemon.push(`${element.id} ${element.name} ${all_type}`);
            });
    
            //console.log(array_pokemon);
            counter++;
            generateList();
        }
    });

    function generateList() {
        let content = ``;
        array_pokemon.forEach(element => {            
            content += `<div> <ul>`;

            content += `<li> ${element} </li> </ul>`;
            content += `<button class="up">Up</button> <button class="down">Down</button> </div>`;
        });
        main[0].innerHTML = content;

        let downs = document.getElementsByClassName("down");
        let ups = document.getElementsByClassName("up");
        for (let i = 0; i < downs.length; i++) {
            downs[i].addEventListener("click", function () {
                if (i + 1 <= array_pokemon.length - 1) {
                    // save actual pokemon of originaly pos
                    let tmp = array_pokemon[i];
                    array_pokemon[i] = array_pokemon[i + 1];
                    array_pokemon[i + 1] = tmp;

                    //console.log("new list "+array_pokemon);
                    generateList();
                }
            });

            ups[i].addEventListener("click", function() {
                if (i - 1 >= 0) {
                    let tmp = array_pokemon[i - 1];
                    array_pokemon[i - 1] = array_pokemon[i];
                    array_pokemon[i] = tmp;
    
                    generateList();
                }
            });
        }
    }

    function fetchJSONData(path) {
        fetch(path)
            .then((res) => {
                if (!res.ok) {
                    throw new Error
                        (`HTTP error! Status: ${res.status}`);
                }
                return res.json();
            })
            .then((data) => 
                  all_pokemon = data
                  )
            .catch((error) => 
                   console.error("Unable to fetch data:", error));
    }

    // metodo che usa le jquery, in W3C
    // vai sui esempi Jquery -> JReferences
    // -> Jquery AJAX, primo esempio
    $.ajax(
        {
            url: "./data.json", 
            success: function(result){
                console.log(result); 
            }
        }
    );
});
