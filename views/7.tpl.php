<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Nissan Form Interface</title>
    <style>
        body {
            background: url('images/fondos/fondo7.png') no-repeat center center;
            background-size: cover;
            height: 100vh;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
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
                    <label class="form-check-label" for="terms">Acepto los <a href="#" class="text-white">Términos y condiciones</a></label>
                </div>
                <img src="images/siguiente.png" alt="siguiente" id="generar">
            </form>
        </div>
    </div>

    <button class="back-button">
            <a href="./?m=es&page=6"><img src="images/volver.png" /></a>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        


        // Jquery boton generar.
        $('#generar').click(function() {
            // Validar si acepto los terminos.
            if ($('#terms').is(':checked')) {
                // Redireccionar a la pagina de carga.
                var frase = $('textarea').val();
                window.location.href = './?m=es&page=loading&frase=' + frase;
            } else {
                alert('Debes aceptar los términos y condiciones para continuar.');
            }
        });
    </script>
</body>
</html>