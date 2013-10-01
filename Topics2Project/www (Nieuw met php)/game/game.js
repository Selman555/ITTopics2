//Initialisaties variabelen
//-=-=-=-=-=-=-=-=-=-=-=-=-
//BRON SPRINGEN (gedeeltelijk): http://www.williammalone.com/articles/create-html5-canvas-javascript-game-character/2/

const FPS = 30; //Frames Per Second (aantal keren dat het beeld herladen per seconden)
var soundJump; //Geluid bij het springen
var soundBackground; //Geluid in de achtergrond
var canvas; //Canvas -> worden componenten op getoond
const canvasWidth = 900; //Breedte canvas
const canvasHeight = 512; //Hoogte canvas
const playerWidth = 28; //Breedte speler
const playerHeight = 28; //Hoogste speler
var backgroundImg1; //Achtergrond 1
var backgroundImg2; //Achtergrond 2
var backgroundPosX1; //Positie x-as achtergrond 1
var backgroundPosY1; //Positie y-as achtergrond 1
var backgroundPosX2; //Positie x-as achtergrond 2
var backgroundPosY2; //Positie y-as achtergrond 2
var playerImg; //Afbeelding speler
var playerPosX; //Positie x-as speler
var playerPosY; //Positie y-as speler
var jumpHeight; //hoogte van het springen
var jumpState; //Status van de speler (false != springen - true = springen)
var gravity; //Hoe snel een speler omlaag gaat
var meters; //Afstand dat de speler gelopen heeft
var backgroundVelocity; //Snelheid beeld dat naar links gaat
var posRectY; //Startpositie y-as rectangle
var posRectX; //Startpositie x-as rectangle
var rectXVelocity; //Snelheid dat de rectangle beweegt
var rectWidth; //Breedte van de rectangle
var rectHeight; //Hoogte van de rectangle
var rectColor; //Kleur van de rectangle
var statusRect; //false = naar links - true = naar rechts
var userClickSpeed; //Snelheid dat een gebruiker kan kliken

function init() {
	soundJump = new Audio("sounds/jump.wav");
	soundBackground = new Audio("sounds/racing.wav");

	canvas = document.getElementById("canvasGame");
	canvas.width = canvasWidth;
	canvas.height = canvasHeight;

	context2D = canvas.getContext("2d");

	rectWidth = 650; //Afgestemd op muziek
	rectHeight = 20;
	rectColor = "black";
	posRectY = 150;
	posRectX = 10;
	rectXVelocity = 5;
	statusRect = true;

	//2 backgrounds om het te laten scrollen
	backgroundImg1 = new Image();
	backgroundImg1.src = "img/backgroundGame.png";
	backgroundImg1.width = 1280;
	backgroundImg1.height = canvasHeight;
	backgroundPosX1 = 0;
	backgroundPosY1 = 0;

	backgroundImg2 = new Image();
	backgroundImg2.src = "img/backgroundGame.png";
	backgroundImg2.width = 1280;
	backgroundImg2.height = canvasHeight;
	backgroundPosX2 = backgroundImg1.width;
	backgroundPosY2 = 0;

	backgroundVelocity = 10;

	playerImg = new Image();
	playerImg.src = "img/mushroom.png"
	playerImg.width = playerWidth;
	playerImg.height = playerHeight;

	playerPosX = 10;
	playerPosY = posRectY - playerImg.height; //Beginnen OP de rectangle

	jumpHeight = 50;
	gravity = 3;
	jumpState = false;

	meters = 0;

	userClickSpeed = 200; //1000 = 1 seconde
	setInterval(drawRectangle, FPS);
	setInterval(scrollBackground, FPS);

	soundBackground.play();
}

function scrollBackground() {
	backgroundPosX1 -= backgroundVelocity;
	backgroundPosX2 -= backgroundVelocity;

	if(backgroundPosX1 <= -backgroundImg1.width) {
		backgroundPosX1 = backgroundImg1.width;
	}else if(backgroundPosX2 <= -backgroundImg2.width) {
		backgroundPosX2 = backgroundImg2.width;
	}

	scrollRectangle();
	drawRectangle();
}

function scrollRectangle() {
	posRectX -= rectXVelocity;
}

window.onload = init();

function drawPlayer() {
	context2D.drawImage(backgroundImg1, backgroundPosX1, backgroundPosY1, backgroundImg1.width, backgroundImg1.height);
	context2D.drawImage(backgroundImg2, backgroundPosX2, backgroundPosY2, backgroundImg2.width, backgroundImg2.height);
	context2D.drawImage(playerImg, playerPosX+25, playerPosY, playerImg.width, playerImg.height);
}

function drawRectangle() {
	context2D.clearRect(0, 0, canvasWidth, canvasHeight);
	drawPlayer();
	context2D.beginPath();
		context2D.rect(posRectX, posRectY, rectWidth, rectHeight);
		context2D.fillStyle = rectColor;
	context2D.closePath();
	context2D.fill();

	//Beweging van de rectangle (OPTIONEEL)
	//if(posRectX <= canvas.width-rectWidth && statusRect) {
	//	posRectX += rectXVelocity;
	//	if(posRectX == canvas.width-rectWidth)
	//		statusRect = false;
	//}else {
	//	posRectX -= rectXVelocity;
	//	if(posRectX <= 0)
	//		statusRect = true;
	//}
}

function jumping() {
	if(!jumpState) {
		jumpState = true;
		playerPosY -= jumpHeight;

		//soundJump.currentTime = 0;
		//soundJump.play();
		setTimeout(notJumping, userClickSpeed);
	}
}

function notJumping() {
	jumpState = false;
}

canvas.onmousedown = function(e) { //Wanneer de speler wil springen
	jumping();
};