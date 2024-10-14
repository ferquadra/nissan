<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Nissan Form Interface</title>
    <!-- Please add fontawesome css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: url('images/fondos/fondo9final.png') no-repeat center center;
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
    <div class="container-fluid text-center">
        <div class="form-container">
            <h2 class="mb-4">¡Ya tienes tu video!</h2>
            <div style="padding:56.25% 0 0 0;position:relative;">
                <iframe src="https://player.vimeo.com/video/36711394?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Tomorrowland"></iframe>
            </div>
            <script src="https://player.vimeo.com/api/player.js"></script>

            <!-- Aquí abajo hay que añadir todos los iconos de redes sociales de fontawesome, whatsapp, facebook, instagram, pinterest, linkedin --->
            <div class="text-center mt-2">
                <label class="form-text">Compartir</label>
                <hr style="border-top: 1px dotted white;">
                <div class="d-flex justify-content-center mt-2">
                    <a href="#" class="me-4 text-white"><i class="fab fa-whatsapp fa-lg"></i></a>
                    <a href="#" class="me-4 text-white"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="me-4 text-white"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="me-4 text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-pinterest fa-lg"></i></a>
                </div>
            </div>
            
            
        </div>

        <button class="back-button">
            <a href="./"><img src="images/volver.png" /></a>
        </button>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>