<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensoria by Nissan</title>
    <!-- Add favicon -->
    <link rel="icon" type="image/jpg" href="./images/favicon-nissan.jpg">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #7a0026;
            color: white;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }
        .main-content {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .circle-text {
            position: absolute;
            top: 22%;
            /* left: 50%; */
            transform: translate(-100%, -55%);
            text-align: center;
        }
        .nissan-logo {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translate(-50%, -50%);
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
        .hashtag {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }
        .todo-total{
            background-image: url('images/fondos/fondo4.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <button class="back-button">
        <a href="./?m=es&page=2"><img src="images/volver.png" /></a>
    </button>

    <div class="container-fluid min-vh-100 todo-total">
       
        <main class="row flex-grow-1">
            <div class="col-12 p-0">
                <div class="main-content">
                    
                    <style>
                        .image-gallery {
                            position: absolute;
                            right: 3%;
                            top: 140px;
                            display: flex;
                            flex-direction: row;
                            gap: 10px;
                            flex-wrap: wrap;
                        }
                        .image-item {
                            width: 180px;
                            height: 360px;
                            background-size: cover;
                            background-position: center;
                            border-radius: 10px;
                            position: relative;
                            text-align: center;
                            padding-top: 10px;
                            font-weight: bold;
                            display: flex;
                            align-items: flex-start;
                            justify-content: center;
                        }
                        .image-item span {
                            display: block;
                            margin-top: 10px;
                            font-weight: 400;
                        }
                        .btn-add {
                            position: absolute;
                            bottom: -6px;
                            /* right: 60px; */
                            background-color: red;
                            border-radius: 50%;
                            display: flex;
                            width: 25px;
                            height: 25px;
                            font-size: 20px;
                            font-weight: 300;
                            line-height: 20px;
                            justify-content: center;
                            align-items: center;
                            color: white;
                        }
                        /* @media (max-width: 768px) {
                            .image-gallery {
                                position: static;
                                transform: none;
                                justify-content: center;
                            }
                            .image-gallery a{
                                width: 100px;
                                height: 200px;
                            }
                            .image-gallery a::after {
                                right: 30px;
                                width: 20px;
                                height: 20px;
                            }
                            
                        } */
                        @media (max-width: 768px) {
                            .main-content {
                                height: 100vh;
                                overflow-y: auto;
                            }
                            .image-gallery {
                                right: 0;
                                left: 0;
                                top: 20px;
                                flex-direction: column;
                                align-items: center;
                            }    
                        }
                    </style>
                    <div class="image-gallery">
                        <a href="./?m=es&page=5&op=brazo" style="text-decoration: none; color: white;">
                            <div class="image-item" style="background-image: url('images/img-robot.png');">
                                <span>Brazo Robótico</span>
                                <div class="btn-add">+</div>
                            </div>
                        </a>
                        <a href="./?m=es&page=5&op=personas" style="text-decoration: none; color: white;">
                            <div class="image-item" style="background-image: url('images/img-personas.png');">
                                <span>Personas</span>
                                <div class="btn-add">+</div>
                            </div>
                        </a>
                        <a href="./?m=es&page=5&op=motor" style="text-decoration: none; color: white;">
                            <div class="image-item" style="background-image: url('images/img-encendido.png');">
                                <span>Encendido de Motor</span>
                                <div class="btn-add">+</div>
                            </div>
                        </a>
                        <a href="./?m=es&page=5&op=puertas" style="text-decoration: none; color: white;">
                            <div class="image-item" style="background-image: url('images/img-puerta.png');">
                                <span>Apertura de Puertas</span>
                                <div class="btn-add">+</div>
                            </div>
                        </a>
                    </div>
                    <!---
                    <div class="hashtag">
                        #SensorIAbyNissan
                    </div>
                    --->
                </div>
            </div>
        </main>
        <footer class="row pb-3">
            <div class="col-12 text-end nissan-logo">
                <img src="images/nissan-logo-chico.png" alt="Nissan Logo" width="50">
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
