<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>SensorIA by Nissan</title>
    <style>
        body {
            background: url('images/fondos/fondo6.png') no-repeat center center;
            background-size: cover;
            height: 100vh;
            color: #fff;
        }

        .text-selector {
            width: 400px;
            display: flex;
            flex-direction: column;
            gap: 40px;
            align-items: flex-start;
            margin-top: 100px;
        }

        .text-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .text-item a{
            text-decoration: none;
        }

        .btn-add {
            background: #ff0000;
            color: #fff;
            border: none;
            font-size: 1.2rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.3s;
        }

        .btn-add:hover {
            background: #c30000;
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

        @media (max-width: 768px) {
            .text-selector {
                width: 100%;
                max-width: 350px;
                margin-left: 40px;
                display: flex;
                flex-direction: column;
                gap: 40px;
                align-items: flex-start;
                margin-top: 200px;
            }

            .text-selector .text-item {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body>
    <button class="back-button">
        <a href="./?m=es&page=5"><img src="images/volver.png" /></a>
    </button>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                &nbsp;&nbsp;
            </div>
            <div class="col-lg-5">
                
                <div class="text-selector">
                    
                    <div class="text-item" style="margin-left: -40px">
                        <a href="?m=es&page=7&texto=reinventa"><button class="btn-add">+</button></a>
                        <p class="card-text">Reinventa tu año, hazlo brillar! Tienes la fuerza para cambiar.</p>
                    </div>
                    <div class="text-item"  style="margin-left: -15px">
                        <a href="?m=es&page=7&texto=uncamino"><button class="btn-add">+</button></a>
                        <p class="card-text">Un camino por andar, cruzando mil fronteras vamos a conectar. Gente buena, montañas, selva y mar.</p>
                    </div>
                    <div class="text-item">
                        <a href="?m=es&page=7&texto=lashuellas"><button class="btn-add">+</button></a>
                        <p class="card-text">Las huellas que dejamos serán la historia que contar, de una generación que nunca dejó de imaginar.</p>
                    </div>
                    <div class="text-item"  style="margin-left: -15px">
                        <a href="?m=es&page=7&texto=aevolucionar"><button class="btn-add">+</button></a>
                        <p class="card-text">¡A evolucionar!, este es el año para cambiar. ¡Con el motor encendido vamos a bailar!</p>
                    </div>
                    <div class="text-item"  style="margin-left: -40px">
                    <a href="?m=es&page=7&texto=instrumental"><button class="btn-add">+</button></a>
                        <p class="card-text">Instrumental</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>