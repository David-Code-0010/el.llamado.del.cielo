<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Kawaii Pong</title>
  <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
  
<style>
/* ============================
   ESTILO RETRO PINK KAWAII
   ============================ */
html, body {
  height: 100%;
  margin: 0;
  overflow: hidden; /* Evita barras de desplazamiento */
}

body {
  background-color: #ffe6f2; /* Rosa pastel de fondo */
  /* Rejilla retro de fondo */
  background-image: 
    linear-gradient(#ffccde 2px, transparent 2px),
    linear-gradient(90deg, #ffccde 2px, transparent 2px);
  background-size: 40px 40px; 
  
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-family: 'VT323', monospace;
  color: #ff1493;
}

.game-wrapper {
  text-align: center;
  border: 6px solid #ff99cc;
  border-radius: 20px;
  background: #fff0f6;
  padding: 10px;
  /* Efecto de brillo/sombra suave */
  box-shadow: 
    0 0 0 4px #fff,
    0 10px 20px rgba(255, 105, 180, 0.4);
  max-width: 90%;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.container {
  /* Contenedor del canvas para hacerlo responsivo */
  max-width: 640px;
  max-height: 480px;
  width: 100%;
  height: auto;
  border-radius: 10px;
  overflow: hidden;
  border: 4px dashed #ffb6c1;
  background: #fff0f5;
}

canvas {
  display: block;
  width: 100%;
  height: 100%;
}

/* ============================
   INSTRUCCIONES
   ============================ */
.instructions {
  margin-top: 15px;
  font-size: 1.5rem;
  background: #ff1493;
  color: #fff;
  padding: 8px 25px;
  border-radius: 50px;
  border: 2px dashed #fff;
  text-transform: uppercase;
  letter-spacing: 1px;
  box-shadow: 3px 3px 0px #ff69b4;
}

.key {
  background: #fff;
  color: #ff1493;
  padding: 0 8px;
  border-radius: 4px;
  font-weight: bold;
  font-family: monospace;
}
</style>

</head>
<body>

<div class="game-wrapper">
  
  <div class="container">
    <canvas id="c" width="640" height="480"></canvas>
  </div>
  
  <div class="instructions">
    💖 P1: <span class="key">Q</span> Arriba / <span class="key">A</span> Abajo &nbsp;|&nbsp; 
    P2: <span class="key">↑</span> Arriba / <span class="key">↓</span> Abajo 💖
  </div>

</div>

<script>
 /**
 * LÓGICA DEL JUEGO PONG
 * Modificado para estilo Kawaii y marcadores separados
 */

c = document.getElementById('c').getContext('2d');

// Configuración de la fuente pixelada
c.font = "60px 'VT323', monospace";

// Inicialización de variables
w = s = 1;         // w: esperando, s: inicio
p = q = a = b = 0; // a, b: puntuaciones
m = n = 190;       // posiciones de las paletas
x = 300; y = 235;  // posición de la pelota
u = -5; v = 3;     // velocidad de la pelota

setInterval(function(){
    if(w && !s) return; // Si está en pausa, no hacer nada
    s = 0;
    
    // 1. LIMPIAR Y PINTAR FONDO DEL CANVAS
    c.fillStyle = "#fff0f5"; // Fondo rosa muy pálido (Lavender Blush)
    c.fillRect(0, 0, 640, 480);

    // 2. CONFIGURAR COLOR DE ELEMENTOS
    c.fillStyle = "#ff69b4"; // Rosa Fuerte (Hot Pink)

    // Dibujar la red central (línea punteada)
    for(i = 5; i < 480; i += 20) c.fillRect(318, i, 4, 10);
    
    // Calcular posiciones
    m += p; n += q;
    m = m < 0 ? 0 : m; m = m > 380 ? 380 : m;
    n = n < 0 ? 0 : n; n = n > 380 ? 380 : n;
    x += u; y += v;
    
    // Rebote superior e inferior
    if(y <= 0){ y = 0; v = -v; }
    if(y >= 470){ y = 470; v = -v; }
    
    // Rebote con paletas
    if(x <= 40 && x >= 20 && y < m + 110 && y > m - 10){ u = -u + 0.2; v += (y - m - 45) / 20; }
    if(x <= 610 && x >= 590 && y < n + 110 && y > n - 10){ u = -u - 0.2; v += (y - n - 45) / 20; }
    
    // Puntos (Gol)
    if(x < -10){ b++; x = 360; y = 235; u = 5; w = 1; }
    if(x > 640){ a++; x = 280; y = 235; u = -5; w = 1; }
    
    // --- DIBUJAR MARCADOR SEPARADO ---
    c.fillText(a, 240, 60); // Puntuación Jugador 1 (Izquierda)
    c.fillText(b, 380, 60); // Puntuación Jugador 2 (Derecha)
    
    // Dibujar paletas y pelota
    c.fillRect(20, m, 20, 100);  // Paleta Izquierda
    c.fillRect(600, n, 20, 100); // Paleta Derecha
    c.fillRect(x, y, 10, 10);    // Pelota
    
}, 30);

// DETECTAR TECLAS
document.onkeydown = function(e){
    k = (e || window.event).keyCode;
    // Tecla ESC (27) para pausar/reanudar
    w = w ? 0 : k == '27' ? 1 : 0;
    // Jugador 1 (A=65, Q=81)
    p = k == '65' ? 5 : k == '81' ? -5 : p;
    // Jugador 2 (Flechas: 40=Abajo, 38=Arriba)
    q = k == '40' ? 5 : k == '38' ? -5 : q;
}

document.onkeyup = function(e){
    k = (e || window.event).keyCode;
    p = k == '65' || k == '81' ? 0 : p;
    q = k == '38' || k == '40' ? 0 : q;
}
</script>

</body>
</html>
