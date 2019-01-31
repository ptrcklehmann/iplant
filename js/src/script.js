"use strict";

console.log(window);
// Get the modal
var modal = document.getElementById('myModal');



// Get the button that opens the modal
var btn = document.getElementById("myBtn");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";
}


// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
} 

// let regador = document.getElementsByClassName(".regadordry");
// // function hover(regador) {
// //     regador.setAttribute
// // }

// // function unhover(regador) {
// //     regador.setAttribute('src', 'http://dummyimage.com/100x100/000/fff');
// // }
// regador.hover.setAttribute('src', 'http://dummyimage.com/100x100/eb00eb/fff');
