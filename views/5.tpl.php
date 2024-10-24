<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Sensoria by Nissan</title>
    <!-- Add favicon -->
    <link rel="icon" type="image/jpg" href="./images/favicon-nissan.jpg">
    <style>
        @font-face {
            font-family: 'Nissan Brand';
            src: url('./font/NissanBrand-Regular.woff2') format('woff2'),
                url('./font/NissanBrand-Regular.woff') format('woff');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        body {
            background: url('images/fondos/fondo5.png') no-repeat center center;
            background-size: cover;
            height: 100vh;
            color: #fff;
            font-family: 'Nissan Brand', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .nissan-logo {
            position: absolute;
            bottom: 20px;
            left: 80%;
            transform: translate(-50%, -50%);
        }

        .music-container {
            text-align: center;
            overflow-y: auto;
            height: 100vh;
            width: 100%;
            padding: 0 50px;
        }

        .music-selector {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 576px) {
            .music-container {
                width: 100%;
            }
            .music-selector {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 768px) {
            .music-selector {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1200px) {
            .music-selector {
                grid-template-columns: repeat(2, 1fr);
                position: absolute;
                right: 18%;
                top: 47%;
                transform: translateY(-50%);
            }
        }

        .music-card {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            border: 2px solid #ff0000;
            border-radius: 15px;
            transition: transform 0.3s;
        }

        .music-card a{
            text-decoration: none;
            color: #fff;
        }

        .music-card img {
            width: 148px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .music-card:hover {
            transform: scale(1.05);
        }

        .music-card .card-body {
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .back-button {
            position: absolute;
            bottom: 50px;
            z-index: 9999;
            left: 0;
            right: 0;
            background-color: transparent;
            border: none;
        }

        .btn-add {
            display: flex;
            align-self: center;
            background: #ff0000;
            color: #fff;
            border: none;
            font-size: 18px;
            width: 25px;
            height: 25px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .btn-add:hover {
            background: #c30000;
        }

        /* Preloader styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #7a0026; /* Color bordó */
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #preloader.fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader"></div>

    <button class="back-button">
        <a href="./?m=es&page=4"><img src="images/volver.png" /></a>
    </button>

    <div class="music-container">
        <div class="container-fluid">
    
            <div class="music-selector">
                <div class="music-card">
                    <a href="?m=es&page=6&ritmo=electronico">
                    <img src="images/electronico.png" alt="Electrónico">
                        <div class="card-body">
                            <h5 class="card-title">Electrónico</h5>
                            <button class="btn-add">+</button>
                        </div>
                    </a>
                </div>
                <div class="music-card">
                    <a href="?m=es&page=6&ritmo=reggaeton">
                        <img src="images/reggaeton.png" alt="Reggaetón">
                        <div class="card-body">
                            <h5 class="card-title">Reggaetón</h5>
                            <button class="btn-add">+</button>
                        </div>
                    </a>
                </div>
                <div class="music-card">
                    <a href="?m=es&page=6&ritmo=rock">
                        <img src="images/rock.png" alt="Rock">
                        <div class="card-body">
                            <h5 class="card-title">Rock</h5>
                            <button class="btn-add">+</button>
                        </div>
                    </a>
                </div>
                <div class="music-card">
                    <a href="?m=es&page=6&ritmo=latino">
                        <img src="images/poplatino.png" alt="Pop Latino">
                        <div class="card-body">
                        <h5 class="card-title">Pop Latino</h5>
                        <button class="btn-add">+</button>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <footer class="row pb-3">
            
        <div class="col-2 text-end nissan-logo">
            <!--<img src="images/nissan-logo-chico.png" alt="Nissan Logo" width="50">--->
            <span style="font-size: 15px; letter-spacing: 3px;">#SensorIAbyNissan</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500); // Match this with the transition duration
        });
    </script>
</body>
</html>
