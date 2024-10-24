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
            background: url('images/fondos/fondo7.png') no-repeat center center;
            background-size: cover;
            height: 100vh;
            color: #fff;
            font-family: 'Nissan Brand', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        .nissan-logo {
            position: absolute;
            bottom: 20px;
            left: 80%;
            transform: translate(-50%, -50%);
        }

        .form-container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
        }

        @media (min-width: 992px) {
            .form-container {
                position: absolute;
                right: 5%;
                top: 50%;
                transform: translateY(-50%);
            }
        }

        .form-control, .form-check-input {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border: none;
            border-radius: 10px;
        }

        .btn-submit {
            background: #ff0000;
            color: #fff;
            border: none;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border-radius: 15px;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #c30000;
        }

        .form-text{
            color: white;
        }

        .back-button {
            position: absolute;
            bottom: 10px;
            background-color: transparent;
            border: none;
        }
        .saltar-button {
            position: absolute;
            bottom: 11px;
            background-color: transparent;
            border: none;
            right: 510px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="form-container">
            <h2 class="mb-4">Escribe tu frase</h2>
            <form>
                <div class="mb-3">
                    <textarea class="form-control" placeholder="Frase personalizada" maxlength="70" rows="3"></textarea>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="terms">
                    <label class="form-check-label" for="terms">Acepto los <a href="./images/legales-es-nissan.pdf" target="_blank" class="text-white">Términos y condiciones</a></label>
                </div>
                <img src="images/siguiente.png" alt="siguiente" id="generar" style="cursor: pointer;">
            </form>
        </div>

        <footer class="row pb-3">
            
            <div class="col-2 text-end nissan-logo">
                <!--<img src="images/nissan-logo-chico.png" alt="Nissan Logo" width="50">--->
                <span style="font-size: 15px; letter-spacing: 3px;">#SensorIAbyNissan</span>
            </div>
        </footer>
    </div>

    <button class="back-button">
            <a href="./?m=es&page=6"><img src="images/volver.png" /></a>
    </button>
    <button class="saltar-button">
            <img src="images/saltar.png" />
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        // Foco en el textarea.
        $('textarea').focus();

        $('.saltar-button').click(function() {
           $('#generar').click();
        });
        // Jquery boton generar.
        $('#generar').click(function() {
            // Validar si acepto los terminos.
            if ($('#terms').is(':checked')) {
                // Redireccionar a la pagina de carga.
                var frase = $('textarea').val();
                window.location.href = './?m=es&page=loading&frase=' + frase;
            } else {
                alert('Debes aceptar los términos y condiciones para continuar.');
                $('textarea').focus();
                return false;
            }
        });
    </script>
</body>
</html>
