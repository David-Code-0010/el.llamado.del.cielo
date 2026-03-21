<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VINI'S WORLD - GAME</title>
    
    <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
    
    <style>
        /* =========================================
           1. ESTILOS DE FONDO Y ESTRUCTURA BASICA
           ========================================= */
        body {
            margin: 0;
            padding: 20px;
            background-color: #ffe6f2; 
            background-image: radial-gradient(#ff69b4 20%, transparent 20%);
            background-size: 20px 20px; 
            font-family: 'VT323', monospace; 
            overflow-x: hidden; 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            
            /* TODO EN NEGRITA Y CURSIVA */
            font-weight: bold; 
            font-style: italic; 
        }

        /* Efecto Scanlines (TV Antigua) */
        body::after {
            content: " ";
            display: block;
            position: fixed;
            top: 0; left: 0; bottom: 0; right: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.05) 50%);
            background-size: 100% 4px;
            z-index: 999;
            pointer-events: none;
        }

        .container {
            width: 100%;
            max-width: 600px;
            position: relative;
            z-index: 10; 
        }

        /* =========================================
           2. ESTILOS DE LA VENTANA
           ========================================= */
        .window {
            background: #ffffff;
            border: 2px solid #ff69b4; 
            box-shadow: 6px 6px 0px rgba(255, 105, 180, 0.4); 
            position: relative;
        }

        .window-header {
            background: linear-gradient(to right, #ff69b4, #ffb6c1);
            color: white;
            padding: 5px 10px;
            font-size: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ff69b4;
        }

        .window-controls span {
            display: inline-block;
            width: 15px; height: 15px;
            border: 1px solid white;
            background: #ffccdd;
            margin-left: 2px;
        }

        .window-body {
            padding: 20px;
            color: #d63384;
            font-size: 1.3rem;
            line-height: 1.4;
            text-align: center; 
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* =========================================
           3. ESTILOS ESPECÍFICOS DEL JUEGO
           ========================================= */
        .key-btn {
            background: #fff;
            border: 2px solid #ff69b4;
            color: #ff69b4;
            font-family: 'VT323', monospace;
            font-size: 1.2rem;
            width: 35px;
            height: 35px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 2px 2px 0 rgba(255,105,180,0.3);
            transition: transform 0.1s;
            margin: 2px;
        }
        .key-btn:hover:not(:disabled) {
            background: #ff69b4;
            color: white;
            transform: translateY(-2px);
        }
        .key-btn:disabled {
            background: #ffe6f2;
            border-color: #ccc;
            color: #ccc;
            cursor: not-allowed;
            box-shadow: none;
        }
        
        .retro-btn {
            margin-top: 20px;
            background: #ff69b4;
            color: white;
            border: 2px solid white;
            padding: 10px 20px;
            font-family: 'VT323', monospace;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 4px 4px 0 rgba(0,0,0,0.2);
        }
        .retro-btn:hover {
            background: #ff1493;
            transform: scale(1.05);
        }

        /* Canvas para el dibujo */
        canvas {
            background: #fff0f5;
            border: 2px dashed #ffb6c1;
            margin-bottom: 10px;
            border-radius: 10px;
        }

    </style>
</head>
<body>

    <div class="container">

        <div class="window">
            <div class="window-header">
                <span>★ El Ahorcado Celestial ★</span>
                <div class="window-controls"><span></span><span></span></div>
            </div>
            <div class="window-body">
                <p style="font-size: 1.1rem; margin-bottom: 15px;">Adivina la palabra para recuperar tus alas...</p>
                
                <canvas id="hangman" width="150" height="180"></canvas>

                <div id="word-display" style="font-size: 2.5rem; letter-spacing: 10px; margin: 10px 0; font-weight: bold; color: #d63384;">
                    _ _ _ _ _
                </div>

                <div id="game-message" style="min-height: 30px; color: #ff69b4; font-weight: bold; font-size: 1.4rem;"></div>

                <div id="keyboard" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 5px; margin-top: 10px;">
                    </div>

                <button onclick="initGame()" class="retro-btn">REINICIAR DESTINO</button>
            </div>
        </div>

    </div>

    <script>
        // =========================================
        // JUEGO DEL AHORCADO (LORE VINI)
        // =========================================
        
        // Palabras basadas en la historia
        const words = ["ABISMO", "ALAS", "CIELO", "VINI", "LUZ", "MILAGRO", "LIBERTAD", "OSCURIDAD", "NUBES", "ANGEL"];
        
        let selectedWord = "";
        let guessedLetters = [];
        let mistakes = 0;
        const maxMistakes = 6; 

        function initGame() {
            // Reiniciar variables
            mistakes = 0;
            guessedLetters = [];
            document.getElementById('game-message').innerText = "";
            document.getElementById('game-message').style.color = "#ff69b4";
            
            // Seleccionar palabra al azar
            selectedWord = words[Math.floor(Math.random() * words.length)];
            
            // Limpiar y dibujar la horca inicial
            drawHangman();
            
            updateDisplay();
            generateKeyboard();
        }

        // Función para dibujar el ahorcado en el Canvas
        function drawHangman() {
            const canvas = document.getElementById('hangman');
            const ctx = canvas.getContext('2d');
            
            // Limpiar canvas si es inicio
            if (mistakes === 0) {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }

            ctx.beginPath();
            ctx.strokeStyle = "#ff1493"; // Color del trazo (Rosa fuerte)
            ctx.lineWidth = 4;
            ctx.lineCap = "round";

            // Dibujar la base y el poste (Siempre visible al inicio o se redibuja)
            if (mistakes === 0) {
                // Base
                ctx.moveTo(20, 160); ctx.lineTo(130, 160);
                // Poste vertical
                ctx.moveTo(40, 160); ctx.lineTo(40, 20);
                // Poste horizontal
                ctx.lineTo(100, 20);
                // Cuerda
                ctx.lineTo(100, 40);
                ctx.stroke();
            }

            // Partes del cuerpo según errores
            if (mistakes >= 1) { // Cabeza
                ctx.beginPath();
                ctx.arc(100, 55, 15, 0, Math.PI * 2); 
                ctx.stroke();
            }
            if (mistakes >= 2) { // Tronco
                ctx.beginPath();
                ctx.moveTo(100, 70); ctx.lineTo(100, 110);
                ctx.stroke();
            }
            if (mistakes >= 3) { // Brazo Izquierdo
                ctx.beginPath();
                ctx.moveTo(100, 80); ctx.lineTo(80, 100);
                ctx.stroke();
            }
            if (mistakes >= 4) { // Brazo Derecho
                ctx.beginPath();
                ctx.moveTo(100, 80); ctx.lineTo(120, 100);
                ctx.stroke();
            }
            if (mistakes >= 5) { // Pierna Izquierda
                ctx.beginPath();
                ctx.moveTo(100, 110); ctx.lineTo(80, 140);
                ctx.stroke();
            }
            if (mistakes >= 6) { // Pierna Derecha
                ctx.beginPath();
                ctx.moveTo(100, 110); ctx.lineTo(120, 140);
                ctx.stroke();
                
                // Ojos muertos (X X)
                ctx.lineWidth = 2;
                ctx.beginPath();
                // Ojo izq
                ctx.moveTo(94, 50); ctx.lineTo(98, 56);
                ctx.moveTo(98, 50); ctx.lineTo(94, 56);
                // Ojo der
                ctx.moveTo(102, 50); ctx.lineTo(106, 56);
                ctx.moveTo(106, 50); ctx.lineTo(102, 56);
                ctx.stroke();
            }
        }

        function updateDisplay() {
            // Actualizar palabra oculta
            const display = selectedWord.split('').map(letter => 
                guessedLetters.includes(letter) ? letter : "_"
            ).join(' ');
            
            document.getElementById('word-display').innerText = display;

            // Verificar Ganar/Perder
            if (!display.includes("_")) {
                document.getElementById('game-message').innerText = "¡HAS ASCENDIDO AL CIELO!";
                disableAllButtons();
            } else if (mistakes >= maxMistakes) {
                document.getElementById('game-message').innerText = "CAÍSTE AL ABISMO... ERA: " + selectedWord;
                document.getElementById('game-message').style.color = "red";
                disableAllButtons();
            }
        }

        function generateKeyboard() {
            const keyboardDiv = document.getElementById('keyboard');
            keyboardDiv.innerHTML = '';
            const alphabet = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
            
            alphabet.split('').forEach(letter => {
                const btn = document.createElement('button');
                btn.innerText = letter;
                btn.classList.add('key-btn');
                btn.onclick = () => handleGuess(letter, btn);
                keyboardDiv.appendChild(btn);
            });
        }

        function handleGuess(letter, btnElement) {
            btnElement.disabled = true;
            if (selectedWord.includes(letter)) {
                guessedLetters.push(letter);
                btnElement.style.backgroundColor = "#90ee90"; // Verde si acierta
                btnElement.style.borderColor = "#90ee90";
                btnElement.style.color = "white";
            } else {
                mistakes++;
                drawHangman(); // Dibujar una parte nueva
                btnElement.style.backgroundColor = "#ffcccb"; // Rojo claro si falla
            }
            updateDisplay();
        }

        function disableAllButtons() {
            const buttons = document.querySelectorAll('.key-btn');
            buttons.forEach(btn => btn.disabled = true);
        }

        // Iniciar el juego al cargar
        initGame();
    </script>
</body>
</html>