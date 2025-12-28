var popup = document.getElementById("popup");
var popup2 = document.getElementById("popup2");
var popup3 = document.getElementById("popup3");
var popup4 = document.getElementById("popup4");
var popup5 = document.getElementById("popup5");

var btn1 = document.getElementById('btn1');
var btn2 = document.getElementById('btn2');
var btn3 = document.getElementById('btn3');
var btn4 = document.getElementById('btn4');
var btn5 = document.getElementById('btn5');

var overlay = document.getElementById('overlay');
var overlay2 = document.getElementById('overlay2');
var overlay3 = document.getElementById('overlay3');
var overlay4 = document.getElementById('overlay4');
var overlay5 = document.getElementById('overlay5');

var btnretour = document.getElementById('btnretour');
var btnretour2 = document.getElementById('btnretour2');
var btnretour3 = document.getElementById('btnretour3');
var btnretour4 = document.getElementById('btnretour4');
var btnretour5 = document.getElementById('btnretour5');


var v1 = "Adresse_mail";
var v2 = "typeaction";

btn1.addEventListener('click',openModal);
btn2.addEventListener('click',openModal2);
btn3.addEventListener('click',openModal3);
btn4.addEventListener('click',openModal4);
btn5.addEventListener('click',openModal5);

btnretour.addEventListener('click',closePopup);
btnretour2.addEventListener('click',closePopup2);
btnretour3.addEventListener('click',closePopup3);
btnretour4.addEventListener('click',closePopup4);
btnretour5.addEventListener('click',closePopup5);



function openModal(){
    overlay.style.display = 'block';
    popup.style.display = "block";
}
function openModal2(){
    overlay2.style.display = 'block';
    popup2.style.display = "block";
}
function openModal3(){
    overlay3.style.display = 'block';
    popup3.style.display = "block";
}
function openModal4(){
    overlay4.style.display = 'block';
    popup4.style.display = "block";
}
function openModal5(){
    overlay5.style.display = 'block';
    popup5.style.display = "block";
}


function closePopup(){
    overlay.style.display = 'none';
    popup.style.display = "none";
}
function closePopup2(){
    overlay2.style.display = 'none';
    popup2.style.display = "none";
}
function closePopup3(){
    overlay3.style.display = 'none';
    popup3.style.display = "none";
}
function closePopup4(){     
    overlay4.style.display = 'none';
    popup4.style.display = "none";
}
function closePopup5(){
    overlay5.style.display = 'none';
    popup5.style.display = "none";
}


/* function openPage() {
    overlay.style.display = 'none';
    var url = "loader.php?v1=" + encodeURIComponent(v1) + "&v2=" + encodeURIComponent(v2);
    window.location.href = url;
    
}
*/



