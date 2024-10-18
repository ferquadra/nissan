<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensoria by Nissan</title>
    <!-- Please add fontawesome css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

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
        .language-buttons {
            position: absolute;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .language-button {
            background: none;
            border: 0;
        }
        .todo-total{
            background-image: url('images/fondos/fondo8cargando.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <div class="container-fluid min-vh-100 d-flex flex-column todo-total">
        <header class="row pt-3">
            
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
            <div class="col-12 p-0 pt-5">
                <div class="main-content position-relative">
                    <div class="language-buttons">
                        <div style="max-width: 250px; font-weight: bold; text-align: center; margin: 0 auto;">
                            <p>
                                <!-- spinner loader fontawesome-icon -->
                                <i class="fas fa-spinner fa-spin fa-5x"></i>

                            </p>
                        </div>
                        
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

    <script>
        // Redirect to the next page after 2 seconds
        setTimeout(() => {
            window.location.href = "./?m=es&page=final&key=<?=$clave;?>";
        }, 2000);
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>