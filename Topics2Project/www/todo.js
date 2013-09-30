//Bron Timeout: http://www.electrictoolbox.com/using-settimeout-javascript/
var timeout;
var clicked = false; //Om dubbele foutmeldingen te voorkomen

function nogNietKlaar(){
	alert("Dit werkt nog niet! Pas na webservice!!!");
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
	startTimer();
	clicked = true;

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