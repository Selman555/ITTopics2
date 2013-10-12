//Initialisaties variabelen
//-=-=-=-=-=-=-=-=-=-=-=-=-
//BRON SPRINGEN (gedeeltelijk): http://www.williammalone.com/articles/create-html5-canvas-javascript-game-character/2/

const FPS = 30; //Frames Per Second (aantal keren dat het beeld herladen per seconden)
const fontType = "bold 1.2em Tahoma"; //Font voor aantal meters te tonen
var soundStartscreen; //Geluid op het startscherm
var soundJump; //Geluid bij het springen
var soundDead; //Geluid bij het doodgaan
var soundBackground; //Geluid in de achtergrond
var soundHighscores; //Geluid bij de highscores
var canvas; //Canvas -> worden componenten op getoond
const canvasWidth = 900; //Breedte canvas
const canvasHeight = 512; //Hoogte canvas
const playerWidth = 32; //Breedte speler
const playerHeight = 32; //Hoogste speler
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
var playerAllowJump; //Speler heeft toestemming om te springen
var jumpVelocity; //hoogte van het springen
var jumpState; //Status van de speler (false != springen - true = springen)
var goDown; //Speler is omlaag aan het gaan na het springen
var gravity; //Hoe snel een speler omlaag gaat
var meters; //Afstand dat de speler gelopen heeft
var userClickSpeed; //Snelheid dat een gebruiker kan kliken

var platformImg;
var platformPosX;
var platformPosY;

var dead; //Boolean -> true = dood, false != dood
var gameover; //Boolean -> true = gameover, false != gameover
var playing = false;
var highscore = false;
var startscreen = true;

var intervalPlaying = null; //Nodig om te laten stoppen bij doodgaan
var intervalStartscherm = null; //Nodig om te laten stoppen bij het klikken van startknop
var intervalHighscore = null;
var intervalJumping;
var intervalGoingDown;

var posStartbutton = [];
var playingSong;
var playingStartscreensong;
var playingHighscoreSong;

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
	soundJump = new Audio("sounds/jump.wav");
	soundDead = new Audio("sounds/dead.wav");

	soundBackground = new Audio("sounds/racing.wav");
	soundStartscreen = new Audio("sounds/startscreen.mp3");
	soundHighscores = new Audio("sounds/highscores.mp3");
	soundBackground.volume = 0.4;
	soundHighscores.volume = 0.3; //1 is normale volume

	canvas = document.getElementById("canvasGame");
	canvas.width = canvasWidth;
	canvas.height = canvasHeight;

	context2D = canvas.getContext("2d");
	context2D.font = fontType;

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
	playerPosY = canvasHeight - 50;

	listPlatformPos = new Array(10); //10 platformen maken
	platformImg = new Image();
	platformImg.src = "img/platform.png";
	platformImg.width = 28;
	platformImg.height = 28;
	platformPosY = canvasHeight - 45;
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
	playingStartscreenSong = false;
	playingHighscoreSong = false;

	Debugger.log("Elementen aangemaakt");

	soundBackground.pause();
	soundHighscores.pause();
	soundStartscreen.pause();

	if(startscreen) {
		clearInterval(intervalPlaying);
		clearInterval(intervalHighscore);
		intervalStartscherm = setInterval(drawStartscreen, FPS);
	}else if(playing) {
		clearInterval(intervalStartscherm);
		clearInterval(intervalHighscore);
		intervalPlaying = setInterval(draw, FPS);
	}else if(highscore) {
		clearInterval(intervalPlaying);
		clearInterval(intervalStartscherm);
		intervalHighscore = setInterval(drawHighscores, FPS);
	}
}

function drawHighscores() {
	//Canvas leegmaken om weer op te vullen met afbeeldingen op een ander locatie
	context2D.clearRect(0, 0, canvasWidth, canvasHeight);

	//Achtergrond tekenen
	context2D.drawImage(backgroundImg1, backgroundPosX1, backgroundPosY1, backgroundImg1.width, backgroundImg1.height);
	context2D.drawImage(backgroundImg2, backgroundPosX2, backgroundPosY2, backgroundImg2.width, backgroundImg2.height);

	//Wolken tekenen
	context2D.drawImage(cloudImg1, cloudPosX1, cloudPosY1, cloudImg1.width, cloudImg1.height);
	context2D.drawImage(cloudImg2, cloudPosX2, cloudPosY2, cloudImg2.width, cloudImg2.height);

	scrollCloudsStartscreen(1); //Wolken laten scrollen
	
	context2D.font = "bold 1.4em Tahoma";
	context2D.fillText("Top 10 spelers", canvasWidth/2-75, 50);

	context2D.font = "bold 1em Tahoma";
	context2D.fillText("Speler 1 [NAAM]: 100 meters", 150, 110); //Doorlopen in for-lus
	context2D.fillText("Speler 2 [NAAM]: 98 meters", 150, 140);
	context2D.fillText("Speler 3 [NAAM]: 94 meters", 150, 170);
	context2D.fillText("Speler 4 [NAAM]: 60 meters", 150, 200);
	context2D.fillText("Speler 5 [NAAM]: 56 meters", 150, 230);
	context2D.fillText("Speler 6 [NAAM]: 47 meters", 150, 260);
	context2D.fillText("Speler 7 [NAAM]: 44 meters", 150, 290);
	context2D.fillText("Speler 8 [NAAM]: 41 meters", 150, 320);
	context2D.fillText("Speler 9 [NAAM]: 35 meters", 150, 350);
	context2D.fillText("Speler 10 [NAAM]: 10 meters", 150, 380);

	context2D.fillText("Druk [PIJLTJE LINKS] om naar het startscherm te gaan", 20, 475);
	soundHighscores.play();

	Debugger.log("highscores gemaakt");
}

function makePlatforms() {
	//!!!VERFIJNING NODIG!!!

	var prevPlatform = 500; //Laten beginnen op 500px om de speler de tijd te geven om te beginnen

	for(var i=0; i<10; i++) { //10 platformen maken
		var rand = Math.floor((Math.random()*2)+1); //tussen 1 en 2 voor afstand platformen (1 = 100px, 2 = 300px)
		var distance;

		switch(rand) {
			case 1:
				distance = 100;
				break;
			case 2:
				distance = 300;
				break;
		}

		var posX = prevPlatform + distance;
		prevPlatform = posX;
		listPlatformPos[i] = posX;
	}

	Debugger.log("Platformen aangemaakt");
}

function playBgSound() {
	if(playing && !gameover && !dead) {
		if(!playingSong) {
			soundBackground.play();
			playingSong = true;
		}
	}
}

function drawStartscreen() {
	if(startscreen) {
		//Canvas leegmaken om weer op te vullen met afbeeldingen op een ander locatie
		context2D.clearRect(0, 0, canvasWidth, canvasHeight);

		//Achtergrond tekenen
		context2D.drawImage(backgroundImg1, backgroundPosX1, backgroundPosY1, backgroundImg1.width, backgroundImg1.height);
		context2D.drawImage(backgroundImg2, backgroundPosX2, backgroundPosY2, backgroundImg2.width, backgroundImg2.height);

		//Wolken tekenen
		context2D.drawImage(cloudImg1, cloudPosX1, cloudPosY1, cloudImg1.width, cloudImg1.height);
		context2D.drawImage(cloudImg2, cloudPosX2, cloudPosY2, cloudImg2.width, cloudImg2.height);

		scrollCloudsStartscreen(1); //Wolken laten scrollen
		
		drawStartText(); //Startknop op het scherm tekenen
		soundStartscreen.play();

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
	for(var i=0; i<listPlatformPos.length; i++) {
		listPlatformPos[i] -= vel;


		//Onderstaande controle heeft een fout
		if(listPlatformPos[i]+platformImg.width < 0) {
			listPlatformPos[i] = canvasWidth;
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

function collisionPlayer() {
	for(var i=0; i<10; i++) { //Elke platform controleren
	if((playerPosX >= listPlatformPos[i] && playerPosX <= listPlatformPos[i]) && //Positie x-as controleren
	 (playerPosY+playerImg.height >= platformPosY)) { //Positie y-as controleren
			//Collision
			soundBackground.pause();
			soundDead.play();

			gameover = true;
			dead = true;
			playing = false;
			highscore = true;

			setTimeout(init, 4000); //Uitvoeren na 4 seconden (niet onmiddelijk van scherm overgaan)
			Debugger.log("Speler raakt platform");
			break;
		}
	}
}

function draw() { //Deze wordt bij het spelen ALTIJD opgeroepen (zie het als een update-functie)
	context2D.clearRect(0, 0, canvasWidth, canvasHeight);

	context2D.drawImage(backgroundImg1, backgroundPosX1, backgroundPosY1, backgroundImg1.width, backgroundImg1.height);
	context2D.drawImage(backgroundImg2, backgroundPosX2, backgroundPosY2, backgroundImg2.width, backgroundImg2.height);

	//Wolken tekenen
	context2D.drawImage(cloudImg1, cloudPosX1, cloudPosY1, cloudImg1.width, cloudImg1.height);
	context2D.drawImage(cloudImg2, cloudPosX2, cloudPosY2, cloudImg2.width, cloudImg2.height);

	context2D.fillText("Meters: " + meters, 30, 30);
	
	drawPlatforms();
	collisionPlayer();

	if(!gameover) {
		scrollBackground(5);
		scrollCloudsStartscreen(7); //Wolken laten scrollen
		playBgSound();
		meters++;

		drawPlayer();
	}else {
		clearInterval(intervalPlaying);
		soundBackground.pause();
	}
}

function drawPlayer() {
	context2D.drawImage(playerImg, playerPosX, playerPosY, playerImg.width, playerImg.height);
}

function drawStartText() {
	context2D.fillText("Druk [PIJLTJE RECHTS] om te spelen", canvasWidth/2-175, 400);
	context2D.fillText("Druk [PIJLTJE OMLAAG] om de highscores te bekijken", canvasWidth/2-250, 425);
	Debugger.log("Label gemaakt");
}

function drawPlatforms() {
	scrollPlatforms(10);

	for(var i=0; i<listPlatformPos.length; i++) {
		context2D.drawImage(platformImg, listPlatformPos[i], platformPosY, platformImg.width, platformImg.height);
	}
	Debugger.log("Platformen getekend");
}

function jumping() {
	if(!gameover && !startscreen && playing) {
		if(!jumpState) {
			jumpState = true;
			allowKeyEvent = false;
			intervalJumping = setInterval (function() {
				playerPosY-=3;
				drawPlayer();

				Debugger.log("Aan het springen");
			});


			//jumpState = true;
			soundJump.currentTime = 0;
			soundJump.play();
			setTimeout(goingDown, 250); //Bepaalt hoe lang de speler kan springen (500ms)
		}
	}
}

function goingDown() {
	if(!gameover && !startscreen && playing) {
		if(jumpState) {
			goDown = true;
			clearInterval(intervalJumping);

				//Bij springen raak je de grond niet meer
				intervalGoingDown = setInterval(function() {
						playerPosY+=3;
						drawPlayer();
					Debugger.log("Aan het neerkomen");
				});

				playerPosY+=2;
		

			jumpState = false;

			
			setTimeout(function() { 
				goDown = false;
				clearInterval(intervalGoingDown);
				allowKeyEvent = true;

				if(canvasHeight - 50 > playerPosY || canvasHeight - 50 < playerPosY ) {
					//Ervoor zorgen dat de speler op de grond is
					playerPosY = canvasHeight - 50;
				}
			}, 250);
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
	if(e.keyCode == 37) { //Pijl links
		if(highscore) {
			startscreen = true;
			highscore = false;

			soundHighscores.pause();
			init();
		}
	}
	else if(e.keyCode == 39) {
		if(startscreen) { //Pijl rechts
			startscreen = false;
			playing = true;

			soundStartscreen.pause();
			init();
		}
	}
	else if(e.keyCode == 40) {
		if(startscreen) { //Pijl omlaag
			startscreen = false;
			highscore = true;
			
			soundStartscreen.pause();
			init();
		}
	}
	else if(e.keyCode == 32 || e.keyCode == 38) { //Spatiebalk (32), pijltje omhoog (38)
		if(allowKeyEvent)
			jumping();
	}
	else return false;
}