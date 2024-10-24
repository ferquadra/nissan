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
    <!-- Please add fontawesome css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
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
            background: url('images/fondos/fondo9final.png') no-repeat center center;
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
            padding: 10px;
            border-radius: 15px;
            width: 100%;
            max-width: 247px;
        }
        @media (min-width: 992px) {
            .form-container {
                position: absolute;
                right: 15%;
                top: 44%;
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
    </style>

    <!-- Título que aparecerá en la previsualización del enlace -->
    <meta property="og:title" content="Sensoria By Nissan" />
    <!-- Descripción que aparecerá debajo del título en la previsualización -->
    <meta property="og:description" content="<?=$creacion['frase'];?>" />
    <!-- URL de la imagen que se mostrará como vista previa (debe ser una URL absoluta) -->
    <meta property="og:image" content="https://sensoriabynissan.com/images/foto-whatsapp-nissan.jpg" />
    <!-- URL de la página que se está compartiendo -->
    <meta property="og:url" content="https://sensoriabynissan.com/?m=es&page=final&key=<?=$_GET['key'];?>" />
    <!-- Tipo de contenido, normalmente 'website' para sitios web -->
    <meta property="og:type" content="website" />
    <!-- Opcional: Título del sitio que aparecerá en la previsualización -->
    <meta property="og:site_name" content="sensoriabynissan.com" />
</head>
<body>
    <!-- Preloader -->
    <div id="preloader"></div>

    <div class="container-fluid text-center">
        <div class="form-container">
            <?if(strlen($creacion['frase'])>20):?>
                <h2 class="mb-4" style="font-size: 17px;"><?=$creacion['frase'];?></h2>
            <?else:?>
                <h2 class="mb-4"><?=$creacion['frase'];?></h2>
            <?endif;?>

            <div style="padding:135% 0 0 0;position:relative;">
                <iframe src="https://player.vimeo.com/video/1022201212?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="PRUEBA"></iframe>
            </div>
            <script src="https://player.vimeo.com/api/player.js"></script>

            <!-- Aquí abajo hay que añadir todos los iconos de redes sociales de fontawesome, whatsapp, facebook, instagram, pinterest, linkedin --->
            <div class="text-center mt-2">
                <label class="form-text">Compartir</label>
                <hr style="border-top: 1px dotted white;">
                <div class="d-flex justify-content-center mt-2">
                    <a href="#" onclick="shareWhatsApp()" class="me-3 text-white"><i class="fab fa-whatsapp fa-lg"></i></a>
                    <a href="#" onclick="shareFacebook()" class="me-3 text-white"><i class="fab fa-facebook fa-lg"></i></a>
                    <!-- <a href="#" onclick="shareInstagram()" class="me-3 text-white"><i class="fab fa-instagram fa-lg"></i></a> -->
                    <a href="#" onclick="shareLinkedIn()" class="me-3 text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                    <a href="#" onclick="sharePinterest()" class="me-3 text-white"><i class="fab fa-pinterest fa-lg"></i></a>
                    <a href="#" onclick="shareEmail()" class="me-3 text-white"><i class="fas fa-envelope fa-lg"></i></a>
                    <a href="#" onclick="copyLink()" class="text-white"><i class="fas fa-link fa-lg"></i></a>
                </div>
            </div>
        </div>

        <footer class="row pb-3">
            <div class="col-2 text-end nissan-logo">
                <!--<img src="images/nissan-logo-chico.png" alt="Nissan Logo" width="50">--->
                <span style="font-size: 15px; letter-spacing: 3px;">#SensorIAbyNissan</span>
            </div>
        </footer>
    </div>

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

        function getShareUrl() {
            return encodeURIComponent(window.location.href);
        }

        function shareWhatsApp() {
            window.open('https://api.whatsapp.com/send?text=' + getShareUrl(), '_blank');
        }

        function shareFacebook() {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + getShareUrl(), '_blank');
        }

        function shareInstagram() {
            alert('Instagram no permite compartir directamente. Copia este enlace: ' + decodeURIComponent(getShareUrl()));
        }

        function shareLinkedIn() {
            window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + getShareUrl(), '_blank');
        }

        function sharePinterest() {
            window.open('https://pinterest.com/pin/create/button/?url=' + getShareUrl(), '_blank');
        }

        function shareEmail() {
            window.open('mailto:?subject=Sensoria by Nissan&body=' + getShareUrl(), '_blank');
        }

        function copyLink() {
            navigator.clipboard.writeText(window.location.href)
                .then(() => {
                    alert('Enlace copiado al portapapeles');
                })
                .catch(err => {
                    console.error('Error al copiar el enlace: ', err);
                    alert('No se pudo copiar el enlace. Por favor, cópialo manualmente.');
                });
        }
    </script>
</body>
</html>
