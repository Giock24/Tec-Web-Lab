
// getElementsByTagName ti dà un vettore con tutti
// gli elementi di quel Tag
let allImages = document.getElementsByTagName("img");
let currentPosition = 0;
let oldPosition;

// per rendere invisibile un elemento (modifica il CSS)
//allImages[0].style.display = "none";

// per settare un nuovo attributo al elemento
allImages[currentPosition].setAttribute("class", "current");

for (let i = 2; i < allImages.length; i++) {
    allImages[i].style.display = "none";
}


for (let i = 0; i < allImages.length; i++) {
    allImages[i].addEventListener("click" , function() {
            currentPosition = i;
            for (let c = 0; c < allImages.length; c++) {
                if (c !== currentPosition && c !== (currentPosition - 1) && c !== (currentPosition + 1)) {
                    allImages[c].style.display = "none";
                } else {
                    if (allImages[c].hasAttribute("class")) {
                        allImages[c].removeAttribute("class", "current");
                    }

                    if (c === currentPosition) {
                        allImages[currentPosition].setAttribute("class", "current");
                    } else {
                        allImages[c].style.display = "inline-block";
                    }
                }
            }
        }
    );
}