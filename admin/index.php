<?php
session_start();
include('includes/config.php');

if (isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName, Password FROM admin WHERE UserName = :uname AND Password = :password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        // Establecer variable de sesión para indicar que el administrador está conectado
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['alogin'] = $uname; // Guardar el nombre de usuario en la sesión si lo necesitas
        header('Location: dashboard.php');
        exit;
    } else {
        // Agregar un valor en la variable de sesión para indicar error
        $_SESSION['login_error'] = 'Detalles no válidos';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Title -->
    <title>Login | Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
    <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />

    <!--TAILWIND-->
    <link href="../src/output.css" rel="stylesheet">


    <!-- Fuente de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Rowdies:wght@300;400;700&display=swap"
        rel="stylesheet">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../assets/images/FaviconWF.png" type="image/x-icon">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Styles -->
    <style>
        /* Estilo para mantener el formulario centrado */
        .signin-page {
            background-color: #000100;
            padding: 20px;
        }

        .select-wrapper {
            display: none !important;
        }

        /* ESTILO DEL VIDEO DE FONDO */
        .videobg {
            pointer-events: none;
            user-select: none;
            position: absolute;
            opacity: 5%;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: -1; /* Asegura que el video esté detrás del contenido */
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Elimina cualquier swal2-checkbox si existe
            let checkbox = document.querySelector('.swal2-checkbox');
            if (checkbox) {
                checkbox.remove();
            }
        });

        //Carga el video después de que la página haya cargado o solo cuando sea visible en la pantalla
        document.addEventListener("DOMContentLoaded", function() {
        var video = document.getElementById('bgVideo');
        var source = video.querySelector('source');
        source.src = source.getAttribute('data-src');
        video.load();
        video.play();
    });
        
    </script>
</head>

<body class="signin-page flex items-center justify-center min-h-screen">

    <!-- VIDEO DE FONDO -->
    <video id="bgVideo" muted loop class="videobg" disablePictureInPicture controlsList="nodownload nofullscreen noplaybackrate">
        <source data-src="../assets/images/FONDO_ADMIN.mp4" type="video/mp4">
        Tu navegador no soporta la etiqueta de video.
    </video>

    <div class="w-full max-w-2xl p-6 rounded-lg shadow-lg">
        <div class="text-left mb-4">
            <a href="../index.php"
                class="inline-block bg-blue-600 text-white text-lg font-bold py-2 px-4 rounded-xl hover:bg-blue-700 transition-colors">Regresar</a>
        </div>

        <h4 class="text-gray-500 text-center text-4xl font-extrabold mb-6">
            ADMINISTRADOR
        </h4>

        <div class="w-full max-w-2xl mx-auto">
            <div class="bg-gray-800 p-12 rounded-xl shadow-xl">
                <div class="mb-8 text-center">
                    <span class="block text-white text-2xl font-extrabold">Iniciar Sesión</span>
                </div>
                <form id="myForm" name="signin" method="post">
                    <div class="input-field col s12 mb-4">
                        <label for="username" class="flex items-center">
                            <!-- Ícono de Usuario -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="text-gray-500 mr-2">
                                <path fill="currentColor"
                                    d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2S7.5 4.019 7.5 6.5M20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1z" />
                            </svg>
                            <span class="ml-3">Usuario</span>
                        </label>
                        <input id="username" type="text" name="username" class="text-white validate w-full mt-2"
                            autocomplete="off">
                    </div>
                    <div class="input-field col s12 mb-4">
                        <label for="password" class="flex items-center">
                            <!-- Ícono de Contraseña -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 15 15" class="text-gray-500 mr-2">
                                <path fill="currentColor" d="M11 11h-1v-1h1zm-3 0h1v-1H8zm5 0h-1v-1h1z" />
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M3 6V3.5a3.5 3.5 0 1 1 7 0V6h1.5A1.5 1.5 0 0 1 13 7.5v.55a2.5 2.5 0 0 1 0 4.9v.55a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 0 13.5v-6A1.5 1.5 0 0 1 1.5 6zm1-2.5a2.5 2.5 0 0 1 5 0V6H4zM8.5 9a1.5 1.5 0 1 0 0 3h4a1.5 1.5 0 0 0 0-3z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3">Contraseña</span>
                        </label>
                        <input id="password" type="password" name="password" class="text-white validate w-full mt-2"
                            autocomplete="off">
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit" name="signin"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            INGRESAR 
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <!-- Javascripts -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            <?php if (isset($_SESSION['login_error'])) { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Admin inválido',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                <?php unset($_SESSION['login_error']); // Elimina el mensaje de error después de mostrarlo ?>
            <?php } ?>

            document.getElementById('myForm').addEventListener('submit', function (event) {
                const username = document.getElementById('username1').value.trim();
                const password = document.getElementById('password').value.trim();

                if (username === '' || password === '') {
                    event.preventDefault(); // Evita el envío del formulario
                    Swal.fire({
                        icon: 'info',
                        title: 'Complete todos los campos',
                        text: 'Hay uno o más campos vacíos.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                        focusConfirm: false, // Evita que SweetAlert le dé foco al botón de confirmación
                        allowOutsideClick: false // Evita que el usuario pueda hacer clic fuera de la alerta para cerrarla
                    }).then((result) => {
                        // Restablece el foco al primer campo de entrada (username) si el usuario cierra la alerta
                        if (result.isConfirmed || result.dismiss === Swal.DismissReason.backdrop) {
                            document.getElementById('username1').focus();
                        }
                    });
                }
            });
        });
    </script>
    <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="../assets/js/alpha.min.js"></script>

</body>

</html>