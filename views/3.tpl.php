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
        @font-face {
            font-family: 'Nissan Brand';
            src: url('./font/NissanBrand-Regular.woff2') format('woff2'),
                url('./font/NissanBrand-Regular.woff') format('woff');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        body {
            background-color: #7a0026; /* Fondo rojo oscuro */
            color: white;
            font-family: 'Nissan Brand', sans-serif;
        }
        .main-content {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .compongamos {
            position: absolute;
            left: calc(50% + 154px);
            top: 210px;
        }
        .language-button {
            background: none;
            border: 0;
            padding-top: 220px;
            padding-right: 0;
        }
        .todo-total{
            background-image: url('images/fondos/fondo3.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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
        @media (min-width: 1450px) {
            .compongamos {
                position: absolute;
                left: calc(50% + 277px);
                top: 350px;
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader"></div>

    <div class="container-fluid min-vh-100 d-flex flex-column todo-total">
        <style>
            .floating-image {
                max-width: 250px; /* Ajusta el tamaño según sea necesario */
            }
        </style>
        <main>
            <div class="compongamos">        
                <button class="language-button">
                    <a href="./?m=es&page=4"><img src="images/compongamos.png" alt="compongamo"></a>
                </button>
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
