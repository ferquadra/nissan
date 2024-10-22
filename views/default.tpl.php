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
            background-color: #7a0026; /* Fondo rojo oscuro */
            color: white;
            height: 100dvh;
            overflow: hidden;
        }
        .main-content {
            height: 100dvh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .language-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 100%;
        }
        .language-button {
            background: none;
            border: 0;
        }
        .todo-total{
            background-image: url('images/fondos/fondo1.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <div class="container-fluid min-vh-100 d-flex flex-column todo-total">
        <header class="row pt-3">
            <!---
            <div class="col-12 position-relative">
                <img src="sensoria-bynissan.png" alt="Sensoria by Nissan" class="floating-image">
            </div>
            --->
        </header>
        
        <style>
            .floating-image {
                position: absolute;
                top: 30px;
                left: 30px;
                max-width: 100px; /* Ajusta el tamaño según sea necesario */
            }
        </style>
        
        <main class="row flex-grow-1">
            <div class="col-12 p-0">
                <div class="main-content">
                    <div class="language-buttons">
                        <div class="col"></div>
                        <button class="language-button">
                            <a href="./?m=es"><img src="images/es-boton.png" alt="español"></a>
                        </button>
                        <div class="col"></div>
                        <button class="language-button">
                            <a href="./?m=es"><img src="images/pt-boton.png" alt="português"></a>
                        </button>
                        <div class="col"></div>
                    </div>
                </div>
            </div>
        </main>
        
        <footer class="row pb-3">
            <div class="col-12 text-end">
                <img src="images/nissan-logo-chico.png" alt="Nissan Logo" width="50">
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
