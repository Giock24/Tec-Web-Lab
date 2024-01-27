document.addEventListener("DOMContentLoaded", function () {
    let all_pokemon;
    fetchJSONData("./data.json");

    let main = document.getElementsByTagName("main");
    //console.log(main);
    //console.log(document.getElementsByTagName("button"));
    
    document.getElementsByTagName("button")[0].addEventListener("click", function() {
        //console.log(all_pokemon.data[0].name);
        let content = ``;
        let number = 0;
        all_pokemon.data.forEach(element => {
            content += `<div class="${number}"> <ul>`

            content += `<li> ${element.id} ${element.name} `;
            element.type.forEach(tipo => {
                content += `${tipo} `;
            });
            content += `</li> </ul>`
            content += `<button>Up</button> <button>Down</button> </div>`
        });

        main[0].innerHTML = content;
    });

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
