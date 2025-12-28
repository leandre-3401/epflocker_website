var btnreset = document.getElementById('btnreset');
var btnblock = document.getElementById('btnblock');
var btnchanger = document.getElementById('btnchanger');
var btnechanger = document.getElementById('btnechanger');

var overlayreset = document.getElementById('overlayreset');
var overlayblock = document.getElementById('overlayblock');
var overlaychanger = document.getElementById('overlaychanger');
var overlayechanger = document.getElementById('overlayechanger');

var btnretourreset = document.getElementById('btnretourreset');
var btnretourblock = document.getElementById('btnretourblock');
var btnretourchanger = document.getElementById('btnretourchanger');
var btnretourechanger = document.getElementById('btnretourechanger');

btnreset.addEventListener('click',openModalreset);
btnblock.addEventListener('click',openModalblock);
btnchanger.addEventListener('click',openModalchanger);
btnechanger.addEventListener('click',openModalechanger);

btnretourreset.addEventListener('click',closePopupreset);
btnretourblock.addEventListener('click',closePopupblock);
btnretourchanger.addEventListener('click',closePopupchanger);
btnretourechanger.addEventListener('click',closePopupechanger);

function openModalreset(){
    overlayreset.style.display = 'block';
}
function openModalblock(){
    overlayblock.style.display = 'block';
}
function openModalchanger(){
    overlaychanger.style.display = 'block';
}
function openModalechanger(){
    overlayechanger.style.display = 'block';
}

function closePopupreset(){
    overlayreset.style.display = 'none';
}
function closePopupblock(){
    overlayblock.style.display = 'none';
}
function closePopupchanger(){
    overlaychanger.style.display = 'none';
}
function closePopupechanger(){
    overlayechanger.style.display = 'none';
}



