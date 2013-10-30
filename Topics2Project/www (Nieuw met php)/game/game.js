//Initialisaties variabelen
//-=-=-=-=-=-=-=-=-=-=-=-=-
//BRON SPRINGEN (gedeeltelijk): http://www.williammalone.com/articles/create-html5-canvas-javascript-game-character/2/

var FPS = 30; //Frames Per Second (aantal keren dat het beeld herladen per seconden)
var fontType = "bold 1.2em Tahoma"; //Font voor aantal meters te tonen
var soundStartscreen; //Geluid op het startscherm
var soundJump; //Geluid bij het springen
var soundDead; //Geluid bij het doodgaan
var soundBackground; //Geluid in de achtergrond
var soundHighscores; //Geluid bij de highscores
var canvas; //Canvas -> worden componenten op getoond
var canvasWidth = 900; //Breedte canvas
var canvasHeight = 512; //Hoogte canvas
var playerWidth = 32; //Breedte speler
var playerHeight = 32; //Hoogste speler

var userNameInput = "";

var imgSprite;
var playerImg; //Afbeelding speler
var cloudImg1; //Wolk 1 op het startscherm
var clousImg2; //Wolk 2 op het startscherm
var backgroundImg1; //Achtergrond 1
var backgroundImg2; //Achtergrond 2
var platformImg;

var backgroundVelocity; //Snelheid beeld dat naar links gaat
var backgroundPosX1; //Positie x-as achtergrond 1
var backgroundPosY1; //Positie y-as achtergrond 1
var backgroundPosX2; //Positie x-as achtergrond 2
var backgroundPosY2; //Positie y-as achtergrond 2
var cloudPosX1; //Positie x wolk 1
var cloudPosY1; //Positie y wolk 1
var cloudPosX2; //Positie x wolk 2
var clousPosY2; //Positie y wolk 2
var playerPosX; //Positie x-as speler
var playerPosY; //Positie y-as speler
var playerAllowJump; //Speler heeft toestemming om te springen
var platformPosX;
var platformPosY;

var jumpVelocity; //hoogte van het springen
var jumpState; //Status van de speler (false != springen - true = springen)
var goDown; //Speler is omlaag aan het gaan na het springen
var gravity; //Hoe snel een speler omlaag gaat
var meters; //Afstand dat de speler gelopen heeft
var userClickSpeed; //Snelheid dat een gebruiker kan kliken

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
var allowKeyEventNavCanvas;
var firstTime = true;

var soundMuted = false;
var listHighscores;

var Debugger = function() { };
Debugger.log = function (message) {
	try {
		console.log(message);
	} catch(e) {
		console.log(e);
	}
};

window.onload = init();

function init() {
	if(localStorage.getItem("muted") !== null) {
		if(localStorage.getItem("muted") === '0') {
			soundMuted = false;
			document.getElementById("btnMute").value = "Geluid aan";
		}else if(localStorage.getItem("muted") === '1') {
			soundMuted = true;
			document.getElementById("btnMute").value = "Geluid uit";
		}
	}

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

	imgSprite = new Image();
	imgSprite.src = "img/sprite.png"; //AFWERKEN!!!


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
	playerImg.src = "img/mushroom.png";
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

	jumpHeight = 50;
	gravity = 3;
	jumpState = false;
	goDown = false;

	userClickSpeed = 1000; //1000 = 1 seconde
	allowKeyEvent = true;
	allowKeyEventNavCanvas = true;

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
		makePlatforms();
		intervalPlaying = setInterval(draw, FPS);
	}else if(highscore) {
		clearInterval(intervalPlaying);
		clearInterval(intervalStartscherm);
		intervalHighscore = setInterval(drawHighscores, FPS);
	}
}

function getHighscores() {
	 //2D array voor highscores
	 //AANPASSEN
	 var lengthArray = 0;

	 if(localStorage.getItem("highscores") === null) {
		 var scores = [
		 				[1000, "WingedDestinyX"],
						[900, "8BallJunkie"],
						[800, "Selman555"],
						[700, "AnkA"],
						[600, "GlennT"],
						[500, "RobbieV"],
						[400, "StevenV"],
						[300, "WingedDestinyY"],
						[200, "PickaMonstrox"],
						[100, "CharDidEmber"]
					];

		localStorage.setItem("highscores", JSON.stringify(scores)); //Fancy doen voor misschien extra punten
	}

	var scores = JSON.parse(localStorage.getItem("highscores"));

	scores = scores.sort(function(a,b) {
					return b[0] - a[0]; //Kijken op 1ste kolom (0)
			});

	//Highscores tonen
	context2D.fillText(scores[0][0] + " meter: " + scores[0][1], 150, 110);
	context2D.fillText(scores[1][0] + " meter: " + scores[1][1], 150, 140);
	context2D.fillText(scores[2][0] + " meter: " + scores[2][1], 150, 170);
	context2D.fillText(scores[3][0] + " meter: " + scores[3][1], 150, 200);
	context2D.fillText(scores[4][0] + " meter: " + scores[4][1], 150, 230);
	context2D.fillText(scores[5][0] + " meter: " + scores[5][1], 150, 260);
	context2D.fillText(scores[6][0] + " meter: " + scores[6][1], 150, 290);
	context2D.fillText(scores[7][0] + " meter: " + scores[7][1], 150, 320);
	context2D.fillText(scores[8][0] + " meter: " + scores[8][1], 150, 350);
	context2D.fillText(scores[9][0] + " meter: " + scores[9][1], 150, 380);
}

function muteSound() {
	if(soundMuted) {
		soundJump.muted = false;
		soundDead.muted = false;
		soundBackground.muted = false;
		soundStartscreen.muted = false;
		soundHighscores.muted = false;

		soundMuted = false;
		localStorage.setItem("muted", "0"); //0 = muted
	}else {
		soundJump.muted = true;
		soundDead.muted = true;
		soundBackground.muted = true;
		soundStartscreen.muted = true;
		soundHighscores.muted = true;

		soundMuted = true;
		localStorage.setItem("muted", "1"); //1 = niet muted
	}
	
	if(localStorage.getItem("muted") === '0') {
		soundMuted = false;
		document.getElementById("btnMute").value = "Geluid aan";
	}else if(localStorage.getItem("muted") === '1') {
		soundMuted = true;
		document.getElementById("btnMute").value = "Geluid uit";
	}
}

function makePlatforms() {
	if(!firstTime)
		var prevPlatform = 0; //Laten beginnen op 400px om de speler de tijd te geven om te beginnen
	else
		var prevPlatform = 400;
	listPlatformPos = new Array();

	for(var i=0; i<4; i++) { //4 platformen maken
		var rand = Math.floor((Math.random()*3)+1); //tussen 1 en 3 voor afstand platformen (1 = 100px, 2 = 150px, 3 = 200px)
		var distance;

		switch(rand) {
			case 1:
				distance = 100;
				break;
			case 2:
				distance = 200;
				break;
			case 3:
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
		if(!soundMuted) {
			if(!playingSong) {
				soundBackground.play();
				playingSong = true;
			}
		}
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
	//VERFIJNEN
	for(var i=0; i<listPlatformPos.length; i++) {
		listPlatformPos[i] -= vel;

		if(listPlatformPos[i]+platformImg.width <= 0) {
			listPlatformPos[i] = canvasWidth;
		}
		if(listPlatformPos[listPlatformPos.length - 1] + platformImg.width <= 5) {
			makePlatforms();
		}
		//alert(listPlatformPos[listPlatformPos.length - 1]);
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
	for(var i=0; i<listPlatformPos.length; i++) { //Elke platform controleren
	if((playerPosX >= listPlatformPos[i] && playerPosX <= listPlatformPos[i]) && //Positie x-as controleren
	 (playerPosY+playerImg.height >= platformPosY)) { //Positie y-as controleren
			//Collision
			soundBackground.pause();
			if(!soundMuted)
				soundDead.play();

			gameover = true;
			dead = true;
			playing = false;
			highscore = true;
			allowKeyEventNavCanvas = false;

			//Nutteloos, maar houden om aan te tonen dat we met LocalStorage en controle op internet kunnen toepassen
			if(!navigator.onLine) {
				localStorage.setItem("meters", meters);
			}

			setTimeout(function() {
				//Naam op laten geven voor highscores
				var user = prompt("Geef een naam op\nPas op: bij een naam langer dan 25 tekens, wordt de naam afgekapt!", "");
				if(user === null || user.trim() === "") {
					//Geen naam opgegeven
					user = "TeLuiVoorEenNaam";
				}

				if(user.length > 25) {
					user = user.substr(0, 25) + "...";
				}

				var newHighscore = [meters, user];
				var scores = JSON.parse(localStorage.getItem("highscores"));

				scores.push(newHighscore);
				//Array ordenen
				scores = scores.sort(function(a,b) {
					return b[0] - a[0]; //Kijken op 1ste kolom (0)
				});

				localStorage.setItem("highscores", JSON.stringify(scores)); 
			}, 1000);

			

			clearInterval(intervalPlaying);
			setTimeout(init, 1000); //Uitvoeren na 1 seconde (niet onmiddelijk van scherm overgaan)
			Debugger.log("Speler raakt platform");
			break;
		}
	}
}

function getStorage() {
	alert("Meters: " + localStorage.getItem("meters"));
	alert("Geluid: " + localStorage.getItem("muted") + " (0 = geluid aan, 1 = geluid uit)");
	alert("Highscores: " + localStorage.getItem("highscores"));
}

function resetStorage() {
	localStorage.clear();
	alert("Local Storage gereset");
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
		if(!soundMuted)
			playBgSound();
		meters++;

		drawPlayer();
	}else {
		clearInterval(intervalPlaying);
		soundBackground.pause();
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
		if(!soundMuted)
			soundStartscreen.play();

		Debugger.log("Canvas opgevuld");
	}
	else if(playing) {
		clearInterval(intervalStartscherm);
		intervalPlaying = setInterval(draw, FPS);
	}
}

function drawPlayer() {
	if(playing) {
		if(!dead && !gameover) {
			context2D.drawImage(playerImg, playerPosX, playerPosY, playerImg.width, playerImg.height);
		}
	}
}

function drawPlatforms() {
	scrollPlatforms(10);

	for(var i=0; i<listPlatformPos.length; i++) {
		context2D.drawImage(platformImg, listPlatformPos[i], platformPosY, platformImg.width, platformImg.height);
	}
	Debugger.log("Platformen getekend");
}

function drawStartText() {
	context2D.fillText("Druk [PIJLTJE RECHTS] om te spelen", canvasWidth/2-175, 400);
	context2D.fillText("Druk [PIJLTJE OMLAAG] om de highscores te bekijken", canvasWidth/2-250, 425);
	Debugger.log("Label gemaakt");
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
	context2D.fillText("Top spelers", canvasWidth/2-75, 50);

	context2D.font = "bold 1em Tahoma";
	getHighscores();

	context2D.fillText("Druk [PIJLTJE LINKS] om naar het startscherm te gaan", 20, 475);
	if(!soundMuted)
		soundHighscores.play();

	Debugger.log("highscores gemaakt");
}

function jumping() {
	if(playing) {
		if(!gameover && !dead && !startscreen) {
			if(!jumpState) {
				jumpState = true;
				allowKeyEvent = false;

				var i = 0; //Om setInterval te kunnen stoppen en weten wnr deze gestopt moet worden
				intervalJumping = setInterval (function() {
					playerPosY-=3;
					drawPlayer();
					
					Debugger.log("Aan het springen");

					i++;
					if(i>=250) { //250 ms om te springen
						clearInterval(intervalJumping);
					}
				});

				if(!soundMuted) {
					soundJump.currentTime = 0;
					soundJump.play();
				}
				setTimeout(goingDown, 250); //Bepaalt hoe lang de speler kan springen (500ms)
			}
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
	if(allowKeyEventNavCanvas) {
		if(e.keyCode === 37) { //Pijl links
			if(highscore) {
				startscreen = true;
				highscore = false;

				soundHighscores.pause();
				init();
			}
		}
		else if(e.keyCode === 39) {
			if(startscreen) { //Pijl rechts
				startscreen = false;
				playing = true;

				soundStartscreen.pause();
				init();
			}
		}
		else if(e.keyCode === 40) {
			if(startscreen) { //Pijl omlaag
				startscreen = false;
				highscore = true;
				
				soundStartscreen.pause();
				init();
			}
		}
		else if(e.keyCode === 32 || e.keyCode === 38) { //Spatiebalk (32), pijltje omhoog (38)
			if(allowKeyEvent)
				jumping();
		}
		else return false;
	}
	return false;
};