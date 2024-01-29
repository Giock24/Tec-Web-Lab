document.addEventListener("DOMContentLoaded", function() {
    // RICORDATI DI FAR PARTIRE L'HTML DA LOCALHOST
    // SE NO NON FUNZIONA LA PARTE DI XMLHttpRequest();
    
    let form = document.getElementsByTagName("form")[0];
    let array_span = document.getElementsByTagName("span");
    let button = document.getElementsByTagName("button")[1];

    form.setAttribute("hidden", "hidden");
    button.setAttribute("hidden", "hidden");
    for (let i = 0; i < array_span.length; i++) {
        array_span[i].setAttribute("hidden", "hidden");
    }

    let b_new = document.getElementsByTagName("button")[0];
    
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
            //document.getElementById("txtHint").innerHTML = this.responseText;
            console.log(this.responseText);
          }
        };
        xmlhttp.open("GET", "../php/index.php?q=" + str, true);
        xmlhttp.send();
    });
});