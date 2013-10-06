//Initialisaties variabelen
//-=-=-=-=-=-=-=-=-=-=-=-=-
//BRON SPRINGEN (gedeeltelijk): http://www.williammalone.com/articles/create-html5-canvas-javascript-game-character/2/

const FPS = 30; //Frames Per Second (aantal keren dat het beeld herladen per seconden)
const fontType = "bold 1.2em Tahoma"; //Font voor aantal meters te tonen
var soundJump; //Geluid bij het springen
var soundDead; //Geluid bij het doodgaan
var soundBackground; //Geluid in de achtergrond
var canvas; //Canvas -> worden componenten op getoond
const canvasWidth = 900; //Breedte canvas
const canvasHeight = 512; //Hoogte canvas
const playerWidth = 28; //Breedte speler
const playerHeight = 28; //Hoogste speler
var backgroundVelocity; //Snelheid beeld dat naar links gaat
var backgroundImg1; //Achtergrond 1
var backgroundImg2; //Achtergrond 2
var backgroundPosX1; //Positie x-as achtergrond 1
var backgroundPosY1; //Positie y-as achtergrond 1
var backgroundPosX2; //Positie x-as achtergrond 2
var backgroundPosY2; //Positie y-as achtergrond 2
var cloudImg1; //Wolk 1 op het startscherm
var clousImg2; //Wolk 2 op het startscherm
var cloudPosX1; //Positie x wolk 1
var cloudPosY1; //Positie y wolk 1
var cloudPosX2; //Positie x wolk 2
var clousPosY2; //Positie y wolk 2
var playerImg; //Afbeelding speler
var playerPosX; //Positie x-as speler
var playerPosY; //Positie y-as speler
var jumpVelocity; //hoogte van het springen
var jumpState; //Status van de speler (false != springen - true = springen)
var goDown; //Speler is omlaag aan het gaan na het springen
var gravity; //Hoe snel een speler omlaag gaat
var meters; //Afstand dat de speler gelopen heeft
var posRectY; //Startpositie y-as rectangle
var posRectX; //Startpositie x-as rectangle
var rectXVelocity; //Snelheid dat de rectangle beweegt
var rectWidth; //Breedte van de rectangle
var rectHeight; //Hoogte van de rectangle
var rectColor; //Kleur van de rectangle
var statusRect; //false = naar links - true = naar rechts
var userClickSpeed; //Snelheid dat een gebruiker kan kliken

var platformImg;
var platformPosX;
var platformPosY;

var dead; //Boolean -> true = dood, false != dood
var gameover; //Boolean -> true = gameover, false != gameover
var playing;
var highscore;
var startscreen;

var intervalPlaying; //Nodig om te laten stoppen bij doodgaan
var intervalStartscherm; //Nodig om te laten stoppen bij het klikken van startknop
var intervalJumping;
var intervalGoingDown;

var posStartbutton = [];
var playingSong;

var allowKeyEvent;

var listPlatformPos;

var Debugger = function() { };
Debugger.log = function (message) {
	try {
		console.log(message);
	} catch(e) {
		console.log(e);
	}
}

window.onload = init();

function init() {
	playing = true;
	highscore = false;
	startscreen = false;

	soundJump = new Audio("sounds/jump.wav");
	soundBackground = new Audio("sounds/racing.wav");
	soundDead = new Audio("sounds/dead.wav");

	canvas = document.getElementById("canvasGame");
	canvas.width = canvasWidth;
	canvas.height = canvasHeight;

	context2D = canvas.getContext("2d");
	context2D.font = fontType;

	rectWidth = 650;
	rectHeight = 20;
	rectColor = "black";
	posRectY = 150;
	posRectX = 10;
	rectXVelocity = 5;
	statusRect = true;

	cloudImg1 = new Image();
	cloudImg1.src = "img/clouds.png";
	cloudImg1.width = 1280;
	cloudImg1.height = canvasHeight;
	cloudPosX1 = 0;
	cloudPosY1 = 0;

	cloudImg2 = new Image();
	cloudImg2.src = "img/clouds.png";
	cloudImg2.width = 1280;
	cloudImg2.height = canvasHeight;
	cloudPosX2 = cloudImg1.width;
	cloudPosY2 = 0;

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
	playerPosX = 200;
	playerPosY = 100 - playerImg.height; //Beginnen OP de rectangle

	listPlatformPos = new Array(10); //10 platformen maken
	platformImg = new Image();
	platformImg.src = "img/platform.png";
	platformImg.width = 32;
	platformImg.height = 32;
	makePlatforms();

	jumpHeight = 50;
	gravity = 3;
	jumpState = false;
	goDown = false;

	userClickSpeed = 1000; //1000 = 1 seconde
	allowKeyEvent = true;

	meters = 0;
	dead = false;
	gameover = false;
	playingSong = false;

	Debugger.log("Elementen aangemaakt");

	intervalStartscherm = setInterval(drawStartscreen, FPS);
}

function makePlatforms() {

	for(var i=0; i<10; i++) { //10 posities in de array maken met elk een array van 2 posities
			listPlatformPos[i] = new Array(2);
	}

	var posYVorigPlatf = 400;
	for(var i=0; i<10; i++) { //10 platformen maken
		platformPosX = i*100;

		//Platformhoogte randrom genereren
		if(posYVorigPlatf >= 300) {
			platformPosY = ((Math.random()*4)+3) * 100; //Tussen 3 en 4
		}else if(posYVorigPlatf >= 200 && posYVorigPlatf < 300) {
			platformPosY = ((Math.random()*3)+2) * 100; //Tussen 2 en 3
		}else if(posYVorigPlatf >= 100 && posYVorigPlatf < 200) {
			platformPosY = ((Math.random()*2)+1) * 100; //Tussen 1 en 2
		}else if(posYVorigPlatf < 100) {
			platformPosY = ((Math.random()*1)+1) * 100; //Tussen 1 en 1
		}

		posYVorigPlatf = platformPosY;

		listPlatformPos[i][0] = platformPosX;
		listPlatformPos[i][1] = platformPosY;
	}

	Debugger.log("Platformen aangemaakt");
}

function playBgSound() {
	//if(!gameover && !dead) {
	//	if(!playingSong) {
	//		soundBackground.play();
	//		playingSong = true;
	//	}
	//}
}

function drawStartscreen() {
	if(startscreen) {
		//Canvas leegmaken om weer op te vullen met ofbeeldingen op een ander locatie
		context2D.clearRect(0, 0, canvasWidth, canvasHeight);

		//Achtergrond tekenen
		context2D.drawImage(backgroundImg1, backgroundPosX1, backgroundPosY1, backgroundImg1.width, backgroundImg1.height);
		context2D.drawImage(backgroundImg2, backgroundPosX2, backgroundPosY2, backgroundImg2.width, backgroundImg2.height);

		//Wolken tekenen
		context2D.drawImage(cloudImg1, cloudPosX1, cloudPosY1, cloudImg1.width, cloudImg1.height);
		context2D.drawImage(cloudImg2, cloudPosX2, cloudPosY2, cloudImg2.width, cloudImg2.height);

		scrollCloudsStartscreen(1); //Wolken laten scrollen
		
		drawStartbutton(); //Startknop op het scherm tekenen

		Debugger.log("Canvas opgevuld");
	}
	else if(playing) {
		clearInterval(intervalStartscherm);
		intervalPlaying = setInterval(draw, FPS);
	}
}

function scrollCloudsStartscreen(vel) {
	cloudPosX1 -= vel;
	cloudPosX2 -= vel;

	if(cloudPosX1 <= -cloudImg1.width) {
		cloudPosX1 = cloudImg1.width;
	}else if(cloudPosX2 <= -cloudImg2.width) {
		cloudPosX2 = cloudImg2.width;
	}
}

function scrollPlatforms(vel) {
	for(var i=0; i<listPlatformPos.length-1; i++) {
		listPlatformPos[i][0] -= vel;
		if(listPlatformPos[i][0]+platformImg.width < 0) {
			listPlatformPos[i][0] = canvasWidth;
		}
	}
}

function scrollBackground(vel) {
	backgroundPosX1 -= vel;
	backgroundPosX2 -= vel;

	if(backgroundPosX1 <= -backgroundImg1.width) {
		backgroundPosX1 = backgroundImg1.width-10; //-10 om een zwarte streep tussen backgrounds te voorkomen
	}else if(backgroundPosX2 <= -backgroundImg2.width) {
		backgroundPosX2 = backgroundImg2.width-10; //-10 om een zwarte streep tussen backgrounds te voorkomen
	}
}

function gravityPlayer(vel) {
	if(!jumpState && !goDown) { //Zorgen voor springen
		if(playerPosY+playerHeight < listPlatformPos[0][1]) {
			playerPosY+=3;
			//Voorlopig elk platform nakijken
			if((playerPosX >= listPlatformPos[0][0] && playerPosX+playerImg.width <= listPlatformPos[0][0]+platformImg.width) && 
				(playerPosX >= listPlatformPos[1][0] && playerPosX+playerImg.width <= listPlatformPos[1][0]+platformImg.width) && 
				(playerPosX >= listPlatformPos[2][0] && playerPosX+playerImg.width <= listPlatformPos[2][0]+platformImg.width) && 
				(playerPosX >= listPlatformPos[3][0] && playerPosX+playerImg.width <= listPlatformPos[3][0]+platformImg.width) && 
				(playerPosX >= listPlatformPos[4][0] && playerPosX+playerImg.width <= listPlatformPos[4][0]+platformImg.width) && 
				(playerPosX >= listPlatformPos[5][0] && playerPosX+playerImg.width <= listPlatformPos[5][0]+platformImg.width) && 
				(playerPosX >= listPlatformPos[6][0] && playerPosX+playerImg.width <= listPlatformPos[6][0]+platformImg.width) && 
				(playerPosX >= listPlatformPos[7][0] && playerPosX+playerImg.width <= listPlatformPos[7][0]+platformImg.width) && 
				(playerPosX >= listPlatformPos[8][0] && playerPosX+playerImg.width <= listPlatformPos[8][0]+platformImg.width) && 
				(playerPosX >= listPlatformPos[9][0] && playerPosX+playerImg.width <= listPlatformPos[9][0]+platformImg.width)) 
			{
				playerPosY=+3;

				//Kijken als de speler de grond raakt
				if(playerPosY + playerHeight > canvasHeight) {
					dead = true;
					gameover = true;
					playing = false;
				}
			}
		}


		//Onderstaande zit een fout
		//for(var i=0; i<listPlatformPos.length-1; i++) { //Voor elk platform nakijken
		//	if(!(playerPosX >= listPlatformPos[i][0] && playerPosX+playerImg.width <= listPlatformPos[i][0]+platformImg.width)) { //Als de speler op het platform staat
		//		if(!(playerPosY-playerHeight > listPlatformPos[i][1])) {
		//			playerPosY += vel;
		//			Debugger.log("Speler valt");
		//		} else {
		//			dead = true;
		//			gameover = true;
		//			playing = false;

		//			Debugger.log("Speler is dood");
		//		}
		//	} else {
		//		dead = true;
		//		gameover = true;
		//		playing = false;

		//		Debugger.log("Speler is dood");
		//	}
		//}
	}
}

function draw() { //Deze wordt bij het spelen ALTIJD opgeroepen (zie het als een update-functie)
	context2D.clearRect(0, 0, canvasWidth, canvasHeight);

	context2D.drawImage(backgroundImg1, backgroundPosX1, backgroundPosY1, backgroundImg1.width, backgroundImg1.height);
	context2D.drawImage(backgroundImg2, backgroundPosX2, backgroundPosY2, backgroundImg2.width, backgroundImg2.height);

	context2D.fillText("Meters: " + meters, 30, 30);
	
	drawPlatforms();
	gravityPlayer(1);

	if(!gameover) {
		scrollBackground(3);
		//playBgSound();
		meters++;

		drawPlayer();
	}else {
		clearInterval(intervalPlaying);
		soundBackground.pause();
		soundDead.play();
	}
}

function drawPlayer() {
	context2D.drawImage(playerImg, playerPosX, playerPosY, playerImg.width, playerImg.height);
}

function drawStartbutton() {
	var buttonWidth = 100;
	var buttonHeight = 50;
	var buttonPosX = canvasWidth/2 - buttonWidth/2;
	var buttonPosY = 400;

	posStartbutton.push(buttonWidth, buttonHeight, buttonPosX, buttonPosY);

	context2D.fillStyle = "black";
	context2D.fillRect(buttonPosX, buttonPosY, buttonWidth, buttonHeight);

	context2D.fillStyle = "white";
	context2D.fillText("Start", canvasWidth/2 - buttonWidth/2+25, buttonPosY + buttonHeight/2); //Text, x, y


	Debugger.log("Startknop gemaakt");
}

function drawPlatforms() {
	//context2D.clearRect(0, 0, canvasWidth, canvasHeight);
	scrollPlatforms(5);

	for(var i=0; i<listPlatformPos.length-1; i++) {
		context2D.drawImage(platformImg, listPlatformPos[i][0], listPlatformPos[i][1], platformImg.width, platformImg.height);
	}
	Debugger.log("Platformen getekend");
}

function jumping() {
	if(!gameover && !startscreen) {
		if(!jumpState) {
			jumpState = true;
			allowKeyEvent = false;
			intervalJumping = setInterval (function() {
				playerPosY--;
				drawPlayer();

				Debugger.log("Aan het springen");
			});


			//jumpState = true;
			soundJump.currentTime = 0;
			soundJump.play();
			setTimeout(goingDown, 500); //Bepaalt hoe lang de speler kan springen (500ms)
		}
	}
}

function goingDown() {
	if(!gameover && !startscreen) {
		if(jumpState) {
			goDown = true;
			clearInterval(intervalJumping);

			intervalGoingDown = setInterval(function() {
				playerPosY++;
				drawPlayer();

				Debugger.log("Aan het neerkomen");
			});

			jumpState = false;

			setTimeout(function() {
				goDown = false;
				clearInterval(intervalGoingDown);
				allowKeyEvent = true;
			}, 500);
		}
	}
}

canvas.onmousedown = function() { //Wanneer de speler wil springen
	if(allowKeyEvent) {
		jumping();
	}
	else return false;
};

document.body.onkeydown = function (e) {
	if(allowKeyEvent) {
		if(e.keyCode == 32 || e.keyCode == 38) { //Spatiebalk (32), pijltje omhoog (38)
			jumping();
		}
	}
	else return false;
}