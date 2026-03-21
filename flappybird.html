<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Kawaii Flappy Bird</title>
  <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
  
<style>
/* =========================
   ESTILOS RETRO KWAI
   ========================= */
body {
  width: 100vw;
  height: 100vh;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: 'VT323', monospace;
  overflow: hidden;
  background-color: #ffe6f2; /* Rosa pastel de fondo */
  background-image: radial-gradient(#ffccde 15%, transparent 16%),
  radial-gradient(#ffccde 15%, transparent 16%);
  background-size: 60px 60px;
  background-position: 0 0, 30px 30px;
}

canvas {
  position: absolute;
  border-radius: 15px;
  box-shadow: 0 10px 25px rgba(255, 105, 180, 0.4);
}

.ctn {
  position: relative;
  width: 360px;
  height: 640px;
  border: 8px solid #ffb7b2;
  border-radius: 20px;
  background: #fff;
  overflow: hidden;
}

#scoreboard {
  position: absolute;
  top: 10%;
  width: 360px;
  text-align: center;
  font-size: 80px;
  color: #ff69b4;
  text-shadow: 3px 3px 0 #fff;
  z-index: 10;
  pointer-events: none;
}

#start-screen {
  position: absolute;
  top: 20px;
  width: 100%;
  pointer-events: none;
}

#gameover-screen {
  visibility: hidden;
  position: absolute;
  width: 360px;
  height: 640px;
  opacity: 0;
  transition: opacity 0.5s;
  text-align: center;
  background: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(2px);
  z-index: 20;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

#gameover {
  width: auto;
  background-color: #ff69b4;
  color: #ffffff;
  padding: 15px 30px;
  font-size: 50px;
  border-radius: 50px;
  border: 4px dashed #fff;
  box-shadow: 0 5px 15px rgba(255, 105, 180, 0.5);
  margin-bottom: 30px;
}

#replay {
  background-color: #87ceeb;
  color: #ffffff;
  padding: 10px 30px;
  font-size: 30px;
  border-radius: 20px;
  border: 2px solid #fff;
  cursor: pointer;
  transition: transform 0.2s;
  box-shadow: 0 4px 0 #5fb0d1;
}

#replay:hover {
  transform: scale(1.1);
  background-color: #9ce0ff;
}

#ctrl-ctn {
  position: absolute;
  top: 400px;
  left: 0;
  width: 100%;
  text-align: center;
  opacity: 1;
  transition: opacity 1s;
}

.ctrl-btn {
  display: inline-block;
  background-color: #ffb7b2;
  color: #ffffff;
  font-size: 24px;
  padding: 10px 20px;
  margin: 5px;
  border-radius: 15px;
  border: 2px dashed #fff;
  box-shadow: 2px 2px 0 #ff9aa2;
}
</style>

</head>
<body>

<div class="ctn">
  <canvas id="c" width="360" height="640"></canvas>
  <div id="scoreboard">0</div>
  
  <div id="start-screen">
    <div id="ctrl-ctn">
      <div class="ctrl-btn">TAP / ESPACIO</div>
      <div class="ctrl-btn" style="background:#87ceeb">JUGAR</div>
    </div>
  </div>

  <div id="gameover-screen">
    <div id="gameover">GAME OVER</div>
    <div id="replay">REINTENTAR ↻</div>
  </div>
</div>

<script>
/* ==========================================
   RECURSOS GRÁFICOS (SVG INTEGRADO)
   ========================================== */

// --- NUEVO: PÁJARO KAWAII ROSA (SVG) ---
var birdSVG = `
<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
  <path d="M5 25 L 15 20 L 15 30 Z" fill="#ff66b2"/>
  <circle cx="35" cy="30" r="20" fill="#ff99cc" stroke="#ff66b2" stroke-width="2"/>
  <ellipse cx="35" cy="38" rx="12" ry="8" fill="#ffcce6"/>
  <circle cx="42" cy="26" r="3.5" fill="#000"/>
  <circle cx="44" cy="24.5" r="1.5" fill="#fff"/>
  <polygon points="52,28 58,30 52,32" fill="#ffcc00" stroke="#ffaa00" stroke-width="1"/>
  <ellipse cx="25" cy="30" rx="8" ry="5" fill="#ff66b2" transform="rotate(-10 25 30)"/>
</svg>`;

// 2. FONDO (Cielo)
var bgSVG = `
  <svg width="360" height="640" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient id="skyGradient" x1="0%" y1="0%" x2="0%" y2="100%">
        <stop offset="0%" style="stop-color:#bce6ff;stop-opacity:1" />
        <stop offset="100%" style="stop-color:#ffe6f2;stop-opacity:1" />
      </linearGradient>
    </defs>
    <rect width="360" height="640" fill="url(#skyGradient)" />
    <circle cx="280" cy="80" r="40" fill="#fff5b8" opacity="0.8" />
    <circle cx="280" cy="80" r="30" fill="#fffacd" />
    <path d="M50 150 Q 70 120 90 150 T 130 150 T 170 150" fill="none" stroke="#fff" stroke-width="20" stroke-linecap="round" opacity="0.4"/>
    <path d="M200 300 Q 220 270 240 300 T 280 300" fill="none" stroke="#fff" stroke-width="25" stroke-linecap="round" opacity="0.3"/>
  </svg>
`;

// 3. SUELO (Nubes)
var fgSVG = `
  <svg width="360" height="150" xmlns="http://www.w3.org/2000/svg">
     <defs>
      <filter id="shadow" x="-20%" y="-20%" width="140%" height="140%">
        <feDropShadow dx="0" dy="4" stdDeviation="4" flood-color="#ffb7b2" flood-opacity="0.5"/>
      </filter>
    </defs>
    <path d="M0 40 Q 30 10 60 40 Q 90 10 120 40 Q 150 10 180 40 Q 210 10 240 40 Q 270 10 300 40 Q 330 10 360 40 V 150 H 0 Z" 
          fill="#ffffff" filter="url(#shadow)" />
    <circle cx="40" cy="80" r="5" fill="#e0f7fa" />
    <circle cx="140" cy="100" r="8" fill="#e0f7fa" />
    <circle cx="260" cy="70" r="6" fill="#e0f7fa" />
  </svg>
`;

// 4. OBSTÁCULOS (Columnas)
var boneOpen = `<svg width="80" height="400" xmlns="http://www.w3.org/2000/svg">`;
var boneMid = `
  <rect x="15" y="0" width="50" height="400" fill="#ffffff" stroke="#ffcce0" stroke-width="4" />
  <line x1="25" y1="0" x2="25" y2="400" stroke="#f0f8ff" stroke-width="3" />
  <line x1="40" y1="0" x2="40" y2="400" stroke="#f0f8ff" stroke-width="3" />
  <line x1="55" y1="0" x2="55" y2="400" stroke="#f0f8ff" stroke-width="3" />
  <rect x="5" y="0" width="70" height="30" rx="5" fill="#fff0f5" stroke="#ff69b4" stroke-width="3" />
  <circle cx="15" cy="15" r="5" fill="#ff69b4" />
  <circle cx="65" cy="15" r="5" fill="#ff69b4" />
`;
var boneClose = `</svg>`;

var botBoneSVG = boneOpen + boneMid + boneClose;
var topBoneSVG = boneOpen + '<g transform="rotate(180 40 200)">' + boneMid + '</g>' + boneClose;

/* ==========================================
   LÓGICA DEL JUEGO
   ========================================== */

// Cargar SVGs como imágenes
var bg = new Image(); bg.src = "data:image/svg+xml," + encodeURIComponent(bgSVG);
var fg = new Image(); fg.src = "data:image/svg+xml," + encodeURIComponent(fgSVG);
var topBone = new Image(); topBone.src = "data:image/svg+xml," + encodeURIComponent(topBoneSVG);
var botBone = new Image(); botBone.src = "data:image/svg+xml," + encodeURIComponent(botBoneSVG);
// Cargar el nuevo Pájaro
var birdImg = new Image(); birdImg.src = "data:image/svg+xml," + encodeURIComponent(birdSVG);

var canvas = document.getElementById("c");
var ctx = canvas.getContext("2d");

var hitboxWidth = 40; 
var hitboxHeight = 40;
var spriteOffset_X = -10;
var spriteOffset_Y = -10;
var fgPos_X = 0;

// Variables del jugador (usamos 'bird' en la lógica ahora)
var birdPos_X = 100;
var birdPos_Y = 250;
var birdAngle = 0;

var minBoneHeight = -330;
var maxBoneHeight = -160;
var scrollSpeed = -2.5;
var gravity = 0.25;
var lift = -7;
var velocity = 0;

var start = false;
var gameOver = false;
var score = 0;
var bonePtr = 0;
var boneStart = 400;
var flyGap = 160; 
var boneGap = 260; 

var bones = [
  { x: boneStart, y: getRandomHeight(minBoneHeight, maxBoneHeight) },
  { x: boneStart + boneGap, y: getRandomHeight(minBoneHeight, maxBoneHeight) },
  { x: boneStart + 2 * boneGap, y: getRandomHeight(minBoneHeight, maxBoneHeight) }
];

function getRandomHeight(min, max) {
  return Math.floor(Math.random() * (max - min) + min);
}

function playerInput() {
  if (!start) {
    start = true;
    velocity = lift;
    birdAngle = -20;
    document.getElementById("ctrl-ctn").style.opacity = 0;
  } else {
    if (!gameOver) {
      velocity = lift;
      birdAngle = -20;
    }
  }
}

function checkCollision() {
  if (birdPos_Y <= -hitboxHeight) velocity = 0;

  // Choque con nubes (Suelo)
  if (birdPos_Y + hitboxHeight >= canvas.height - 100) { 
    velocity = 0;
    birdPos_Y = canvas.height - 100 - hitboxHeight;
    setGameOver();
  }

  // Choque con Columnas
  if (
    birdPos_X + hitboxWidth >= bones[bonePtr].x + 10 && 
    birdPos_X < bones[bonePtr].x + topBone.width - 10 &&
    (birdPos_Y <= bones[bonePtr].y + 400 || 
      birdPos_Y + hitboxHeight >= bones[bonePtr].y + 400 + flyGap)
  ) {
    setGameOver();
  }
}

function replay() {
  start = false;
  gameOver = false;
  score = 0;
  velocity = 0;
  birdPos_X = 100;
  birdPos_Y = 250;
  birdAngle = 0;
  bonePtr = 0;
  bones = [
    { x: boneStart, y: getRandomHeight(minBoneHeight, maxBoneHeight) },
    { x: boneStart + boneGap, y: getRandomHeight(minBoneHeight, maxBoneHeight) },
    { x: boneStart + 2 * boneGap, y: getRandomHeight(minBoneHeight, maxBoneHeight) }
  ];
  document.getElementById("ctrl-ctn").style.opacity = 1;
  document.getElementById("gameover-screen").style.visibility = "hidden";
  document.getElementById("gameover-screen").style.opacity = 0;
}

function setGameOver() {
  gameOver = true;
  document.getElementById("gameover-screen").style.visibility = "visible";
  document.getElementById("gameover-screen").style.opacity = 1;
}

function update() {
  if (!gameOver) {
    fgPos_X += scrollSpeed;
    if (fgPos_X <= -canvas.width) fgPos_X = 0;
  }

  if (start) {
    velocity += gravity;
    birdPos_Y += velocity;
    if (velocity < 0) birdAngle = -15;
    else birdAngle = Math.min(birdAngle + 1.5, 45);
    checkCollision();
    
    if (!gameOver) {
      for (var i = 0; i < bones.length; i++) {
        bones[i].x += scrollSpeed;
        if (bones[i].x <= -topBone.width) {
          if (i == 0) bones[0].x = bones[bones.length - 1].x + boneGap;
          else bones[i].x = bones[i - 1].x + boneGap;
          bones[i].y = getRandomHeight(minBoneHeight, maxBoneHeight);
        }
      }
      if (birdPos_X >= bones[bonePtr].x + topBone.width) {
        score++;
        if (bonePtr == 2) bonePtr = 0;
        else bonePtr++;
      }
    }
  }
  render();
}

function render() {
  document.getElementById("scoreboard").innerHTML = score;
  ctx.drawImage(bg, 0, 0);

  for (var i = 0; i < bones.length; i++) {
    ctx.drawImage(topBone, bones[i].x, bones[i].y);
    ctx.drawImage(botBone, bones[i].x, bones[i].y + 400 + flyGap);
  }

  ctx.save();
  ctx.translate(birdPos_X + hitboxWidth / 2 + spriteOffset_X, birdPos_Y + hitboxHeight / 2);
  
  if(!start) birdPos_Y = 250 + Math.sin(Date.now()/300) * 10;
  else ctx.rotate(birdAngle * Math.PI / 180);

  // DIBUJAR PÁJARO KAWAII (60x60 tamaño visual)
  ctx.drawImage(birdImg, -30, -30, 60, 60);
  ctx.restore();

  ctx.drawImage(fg, fgPos_X, canvas.height - 120); 
  ctx.drawImage(fg, fgPos_X + fg.width, canvas.height - 120);

  window.requestAnimationFrame(update);
}

document.addEventListener("keydown", function(e) {
  var char = e.which || e.keyCode;
  if (char == 32 || char == 38) { e.preventDefault(); playerInput(); }
});

document.addEventListener("touchstart", function(e) {
    e.preventDefault(); playerInput();
}, {passive: false});

document.getElementById("replay").addEventListener("click", function() { replay(); });

update();    
</script>
</body>
</html>
