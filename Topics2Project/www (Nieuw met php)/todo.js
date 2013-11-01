$(document).ready = (function(){
  $.getJSON("http://localhost:8080/Groep1/ToDos?getTodo=true",function(result){
    $.each(result, function(i, field){
      $("TEMP").append(field + " ");
    });
  });
});

var clicked = false; //Om dubbele foutmeldingen te voorkomen

setTimeout(function() {
	var taak1 = document.getElementById("taak1");
	taak1.location.reload(1);
}, 1000); //Pagina elke 1 seconde herladen om juiste gegevens te tonen


function toDoAanmaken(){
	//Gegevens wegschrijven naar DB via Webservice
	alert("Dit werkt nog niet! Pas na webservice!!!");
	window.location.reload(1);
}


function allowDrop(ev){
	ev.preventDefault();
}

function drag(ev){
	clearTimeout(timeout);
	ev.dataTransfer.setData("content", ev.target.id);
}

function drop(ev){
	clearTimeout(timeout);

	ev.preventDefault();
	var text = ev.dataTransfer.getData("content");
	ev.target.appendChild(document.getElementById(text));

	clicked = false;
	startTimer();
}

function startTimer() {
	if(!clicked) {
		//10 seconden de tijd geven tot de gebruiker een item kan verslepen (inactive ppl voorkomen)
		timeout = setTimeout('tooLate()', 10000); //10000ms = 10s
	}
}

function changeState() {
	//Connectie met DB via Webservice
	

	//Dynamisch maken (Div id's worden dynamisch gemaakt)
	var enableDragTaak1 = document.getElementById("taak1");
	var enableDragTaak2 = document.getElementById("taak2");
	var enableDragTaak3 = document.getElementById("taak3");
	var enableDragTaak4 = document.getElementById("taak4");
	var enableDragTaak5 = document.getElementById("taak5");

	enableDragTaak1.draggable = true;
	enableDragTaak2.draggable = true;
	enableDragTaak3.draggable = true;
	enableDragTaak4.draggable = true;
	enableDragTaak5.draggable = true;

	clicked = true;
	startTimer();
}

function tooLate() {
	clicked = false;
	changeStateReady();
	alert("Te laat!!");
}

function changeStateReady() {
	//Later nutteloos -> Bij dragging wordt de DB geupdatet
	//Dynamisch maken (Div id's worden dynamisch gemaakt)

	clearTimeout(timeout); //Altijd timer stoppen
	
	var enableDragTaak1 = document.getElementById("taak1");
	var enableDragTaak2 = document.getElementById("taak2");
	var enableDragTaak3 = document.getElementById("taak3");
	var enableDragTaak4 = document.getElementById("taak4");
	var enableDragTaak5 = document.getElementById("taak5");

	enableDragTaak1.draggable = false;
	enableDragTaak2.draggable = false;
	enableDragTaak3.draggable = false;
	enableDragTaak4.draggable = false;
	enableDragTaak5.draggable = false;
}