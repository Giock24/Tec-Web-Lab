document.addEventListener("DOMContentLoaded", function() {

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
        $.ajax({
            url: "index.php",
            success: function (data) {
                console.log(data);
            }
        });
    });
});