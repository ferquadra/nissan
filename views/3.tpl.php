<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensoria by Nissan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #7a0026; /* Fondo rojo oscuro */
            color: white;
        }
        .main-content {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .compongamos {
            position: absolute;
            left: calc(50% + 205px);
            top: 350px;
        }
        .language-button {
            background: none;
            border: 0;
        }
        .todo-total{
            background-image: url('images/fondos/fondo3.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <div class="container-fluid min-vh-100 d-flex flex-column todo-total">
   
        <style>
            .floating-image {
                max-width: 250px; /* Ajusta el tamaño según sea necesario */
            }
        </style>
        <main>
            <div class="compongamos">        
                <button class="language-button" style="padding-top: 220px; padding-right: 0;">
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
</body>
</html>