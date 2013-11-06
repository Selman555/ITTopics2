//Initialisaties variabelen
//-=-=-=-=-=-=-=-=-=-=-=-=-
//BRON SPRINGEN (gedeeltelijk): http://www.williammalone.com/articles/create-html5-canvas-javascript-game-character/2/
var highscoresWebservice = new Array(10); //2D array voor 10 highscores vanuit de web service
var webservice = false; //Controle om te zien of er gegevens uit de webservice gehaald kan worden of niet
var scores;
var FPS = 30; //Frames Per Second (aantal keren dat het beeld herladen per seconden)
var fontType = "bold 1.2em Tahoma"; //Font voor aantal meters te tonen
var soundDead; //Geluid bij het doodgaan
var soundBackground; //Geluid in de achtergrond
var canvas; //Canvas -> worden componenten op getoond
var canvasWidth = 900; //Breedte canvas
var canvasHeight = 512; //Hoogte canvas
var playerWidth = 100; //Breedte speler
var playerHeight = 80; //Hoogste speler

var prevPlatform = 0;
var userNameInput = ""; //Username

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
var listHighscores;

var Debugger = function() {};
Debugger.log = function(message) {
    try {
        console.log(message);
    } catch (e) {
        console.log(e);
    }
};

window.onload = init();

function init() {
    //1D array 2D maken
    for (var i = 0; i < 10; i++) {
        highscoresWebservice[i] = new Array(2); //Elke rij 2 kolommen geven
    }
    
    soundDead = new Audio("sounds/dead.mp3");

    soundBackground = new Audio("sounds/background.mp3");
    soundBackground.volume = 0.4;

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
    playerImg.src = "img/player.png";
    playerImg.width = playerWidth;
    playerImg.height = playerHeight;
    playerPosX = 200;
    playerPosY = canvasHeight - 80;

    listPlatformPos = new Array(10); //10 platformen maken
    platformImg = new Image();
    platformImg.src = "img/platform.png";
    platformImg.width = 50;
    platformImg.height = 50;
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
    playingSong = false;
    soundBackground.play();
        
    getHighscoresWebservice();
            
    if (startscreen) {
        clearInterval(intervalPlaying);
        clearInterval(intervalHighscore);
        intervalStartscherm = setInterval(drawStartscreen, FPS);
    } else if (playing) {
        firstTime = true;
        clearInterval(intervalStartscherm);
        clearInterval(intervalHighscore);
        makePlatforms();
        intervalPlaying = setInterval(draw, FPS);
    } else if (highscore) {
        clearInterval(intervalPlaying);
        clearInterval(intervalStartscherm);
        intervalHighscore = setInterval(drawHighscores, FPS);
    }
}

function getHighscoresWebservice() {
    //Zorgen voor highscores vanuit de web service
    $.ajax({
        type: "POST",
        url: "http://localhost/Groep1/Highscore?getHighscore=true",
        crossDomain: true,
        dataType: 'json',
        success: function(response) {
            webservice = true;
            $.each(response, function(index, object) {
                highscoresWebservice[index][0] = object.Score;
                highscoresWebservice[index][1] = object.Naam;
            });
        },
        error: function() {
            webservice = false;
        }
    });
}

function setHighscoresWebservice(score, name) {
    var urlString = "http://localhost:8080/Groep1/Highscore?getHighscore=false&Name="+name+"&Score="+score;
    
    $.ajax({
        type: "POST",
        url: urlString,
        crossDomain: true,
        dataType: 'json'
    });
}

function showHighscores() {
    var yAs = 80;

    if (webservice) {
        //Web service
        for (var i = 0; i < 10; i++) {
            yAs = yAs + 30;
            context2D.fillStyle = 'red';
            context2D.shadowColor = "black";
            context2D.shadowOffsetX = 2;
            context2D.shadowOffsetY = 2;
            context2D.fillText(highscoresWebservice[i][0] + " meter: " + highscoresWebservice[i][1], 150, yAs);
        }
    } else {
        //localStorage
        var scores;
        if (localStorage.getItem("highscores") === null) {
            //LocalStorage highscores bestaan niet/zijn leeg
            scores = [
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

        //LocalStorage
        scores = scores.sort(function(a, b) {
            return b[0] - a[0]; //Kijken op 1ste kolom (0)
        });

        //LocalStorage highscores tonen
        for (var i = 0; i < 10; i++) {
            yAs = yAs + 30;
            context2D.fillStyle = 'red';
            context2D.shadowColor = "black";
            context2D.shadowOffsetX = 2;
            context2D.shadowOffsetY = 2;
            context2D.fillText(scores[i][0] + " meter: " + scores[i][1], 150, yAs);
        }
    }
}

function makePlatforms() {
    if (firstTime) {
        prevPlatform = 400;
        firstTime = false;
    }
    listPlatformPos = new Array();

    for (var i = 0; i < 4; i++) { //4 platformen maken
        var rand = Math.floor((Math.random() * 3) + 1); //tussen 1 en 3 voor afstand platformen (1 = 200px, 2 = 300px, 3 = 500px)
        var distance;

        switch (rand) {
            case 1:
                distance = 200;
                break;
            case 2:
                distance = 400;
                break;
            case 3:
                distance = 550;
                break;
        }

        var posX = prevPlatform + distance;
        prevPlatform = posX;
        listPlatformPos[i] = posX;
    }
}

function scrollPlatforms(vel) {
    for (var i = 0; i < listPlatformPos.length; i++) {
        listPlatformPos[i] -= vel;

        if (listPlatformPos[i] + platformImg.width <= 0) {
            listPlatformPos[i] = canvasWidth;
        }
        if (listPlatformPos[listPlatformPos.length - 1] + platformImg.width <= 5) {
            makePlatforms();
        }
    }
}

function scrollCloudsStartscreen(vel) {
    cloudPosX1 -= vel;
    cloudPosX2 -= vel;

    if (cloudPosX1 <= -cloudImg1.width) {
        cloudPosX1 = cloudImg1.width;
    } else if (cloudPosX2 <= -cloudImg2.width) {
        cloudPosX2 = cloudImg2.width;
    }
}

function scrollBackground(vel) {
    backgroundPosX1 -= vel;
    backgroundPosX2 -= vel;

    if (backgroundPosX1 <= -backgroundImg1.width) {
        backgroundPosX1 = backgroundImg1.width - 10; //-10 om een zwarte streep tussen backgrounds te voorkomen
    } else if (backgroundPosX2 <= -backgroundImg2.width) {
        backgroundPosX2 = backgroundImg2.width - 10; //-10 om een zwarte streep tussen backgrounds te voorkomen
    }
}

function collisionPlayer() {
    //Verfijnen
    for (var i = 0; i < listPlatformPos.length; i++) { //Elke platform controleren
        if ((playerPosX >= listPlatformPos[i] &&
                playerPosX <= listPlatformPos[i]) && //Positie x-as controleren
                (playerPosY + playerImg.height >= platformPosY)) { //Positie y-as controleren

            //Collision
            soundDead.play();
            dead = true;
            playing = false;
            highscore = true;
            allowKeyEventNavCanvas = false;

            setTimeout(function() {
                //Naam op laten geven voor highscores
                var user = prompt("Geef een naam op\nPas op: bij een naam langer dan 25 tekens, wordt de naam afgekapt!", "");
                if (user === null || user.trim() === "") {
                    //Geen naam opgegeven
                    user = "TeLuiVoorEenNaam";
                }
                
                //Een naam beperken tot max. 25 tekens (+3 '...')
                if (user.length > 25) {
                    user = user.substr(0, 25) + "...";
                }

                //XSS voorkomen (geen probleem bij wegschrijven naar webservice. Wel probleem bij het uitlezen van webservice)
                //Elke niet-legale DB-teken wordt vervangen door een lege tekst (""). Een spatie wordt ook verwijderd.
                var lt = /</g, gt = />/g, ap = /'/g, ic = /"/g, scriptOpened = "script", scriptClosed = "/script"; //DB-gevoelige tekens
                user = user.toString().replace(lt, "").replace(gt, "").replace(ap, "").replace(ic, "").replace(scriptOpened, "").replace(scriptClosed, "").replace(" ", "");

                getHighscoresWebservice(); //Controle als er verbinding is met de web service

                if (!webservice) {
                    //localStorage
                    var scores = JSON.parse(localStorage.getItem("highscores"));

                    var newHighscore = [meters, user];
                    scores.push(newHighscore);
                    localStorage.setItem("highscores", JSON.stringify(scores));
                }else {
                    //Web service
                    setHighscoresWebservice(meters, user);
                }
            }, 3000);

            clearInterval(intervalPlaying);
            setTimeout(init, 3500); //Uitvoeren na 1 seconde (niet onmiddelijk van scherm overgaan)

            break;
        }
    }
}

function getStorage() {
    alert("Meters: " + localStorage.getItem("meters"));
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

    context2D.fillStyle = 'white';
    context2D.fillText("Meters: " + meters, 30, 30);
    drawPlatforms();
    collisionPlayer();

    if (!dead) {
        scrollBackground(5);
        scrollCloudsStartscreen(7); //Wolken laten scrollen
        meters++;

        drawPlayer();
    } else {
        clearInterval(intervalPlaying);
    }
}

function drawStartscreen() {
    if (startscreen) {
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
    }
    else if (playing) {
        clearInterval(intervalStartscherm);
        intervalPlaying = setInterval(draw, FPS);
    }
}

function drawPlayer() {
    if (playing && !dead)
        context2D.drawImage(playerImg, playerPosX, playerPosY, playerImg.width, playerImg.height);
}

function drawPlatforms() {
    scrollPlatforms(10);
    for (var i = 0; i < listPlatformPos.length; i++) {
        context2D.drawImage(platformImg, listPlatformPos[i], platformPosY, platformImg.width, platformImg.height);
    }
}

function drawStartText() {
    context2D.fillStyle = 'white';
    context2D.fillText("Druk [PIJLTJE RECHTS] om te spelen", canvasWidth / 2 - 175, 400);
    context2D.fillText("Druk [PIJLTJE OMLAAG] om de highscores te bekijken", canvasWidth / 2 - 250, 425);
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

    context2D.fillStyle = 'red';
    context2D.font = "bold 1.4em Tahoma";
    context2D.fillText("Top spelers", canvasWidth / 2 - 75, 50);

    context2D.font = "bold 1em Tahoma";
    showHighscores();

    context2D.fillText("Druk [PIJLTJE LINKS] om naar het startscherm te gaan", 20, 475);
    soundHighscores.play();
}

function jumping() {
    if (playing && !dead && !startscreen) {
        if (!jumpState) {
            jumpState = true;
            allowKeyEvent = false;
            
            intervalJumping = setInterval(function() {
                playerPosY -= 3;
                drawPlayer();
            });
            setTimeout(goingDown, 350); //Bepaalt hoe lang de speler kan springen
        }
    }
}

function goingDown() {
    if (!dead && !startscreen && playing) {
        if (jumpState) {
            goDown = true;
            clearInterval(intervalJumping);
            
            intervalGoingDown = setInterval(function() {
                playerPosY += 3;
                drawPlayer();
            });
            
            jumpState = false;

            setTimeout(function() {
                goDown = false;
                clearInterval(intervalGoingDown);
                allowKeyEvent = true;

                if (canvasHeight - 80 > playerPosY || canvasHeight - 80 < playerPosY) {
                    //Ervoor zorgen dat de speler op de grond is na het springen
                    playerPosY = canvasHeight - 80;
                }
            }, 350);
        }
    }
}

canvas.onmousedown = function() { //Wanneer de speler wil springen
    if (allowKeyEvent) {
        jumping();
    }
    else
        return false;
};

document.body.onkeydown = function(e) {
    if (allowKeyEventNavCanvas) {
        if (e.keyCode === 37) { //Pijl links
            if (highscore) {
                startscreen = true;
                highscore = false;
                init();
            }
        }
        else if (e.keyCode === 39) {
            if (startscreen) { //Pijl rechts
                startscreen = false;
                playing = true;
                init();
            }
        }
        else if (e.keyCode === 40) {
            if (startscreen) { //Pijl omlaag
                startscreen = false;
                highscore = true;
                init();
            }
        }
        else if (e.keyCode === 32 || e.keyCode === 38) { //Spatiebalk (32), pijltje omhoog (38)
            if (allowKeyEvent)
                jumping();
        }
        else
            return false;
    }
    return false;
};