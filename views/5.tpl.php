<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Nissan Musical Interface</title>
    <style>
        body {
            background: url('images/fondos/fondo5.png') no-repeat center center;
            background-size: cover;
            height: 100vh;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
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
                right: 5%;
                top: 50%;
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

        .music-card img {
            width: 100%;
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
            bottom: 0;
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
    </style>
</head>
<body>
    <div class="music-container">
    <div class="container-fluid">
 
        <div class="music-selector">
            <div class="music-card">
                <img src="images/raggaeton.png" alt="Electrónico">
                <div class="card-body">
                    <h5 class="card-title">Electrónico</h5>
                    <a href="?m=es&page=6"><button class="btn-add">+</button></a>
                </div>
            </div>
            <div class="music-card">
                <img src="images/poplatino.png" alt="Reggaetón">
                <div class="card-body">
                    <h5 class="card-title">Reggaetón</h5>
                    <button class="btn-add">+</button>
                </div>
            </div>
            <div class="music-card">
                <img src="images/rock.png" alt="Rock">
                <div class="card-body">
                    <h5 class="card-title">Rock</h5>
                    <button class="btn-add">+</button>
                </div>
            </div>
            <div class="music-card">
                <img src="images/electronico.png" alt="Pop Latino">
                <div class="card-body">
                    <h5 class="card-title">Pop Latino</h5>
                    <button class="btn-add">+</button>
                </div>
            </div>

        </div>
        <button class="back-button">
            <a href="./?m=es&page=4"><img src="images/volver.png" /></a>
        </button>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>