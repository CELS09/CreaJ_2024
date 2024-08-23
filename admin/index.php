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
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
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
    <title>Login | Admin</title>
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

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
            background-color: #27233B;
            padding: 20px;
        }

        .select-wrapper {
            display: none !important;
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
    </script>
</head>

<body class="signin-page flex items-center justify-center min-h-screen">

    <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-lg">
        <div class="text-left mb-4">
            <a href="../index.php"
                class="inline-block bg-blue-600 text-white text-lg font-bold py-2 px-4 rounded-xl hover:bg-blue-700 transition-colors">Regresar</a>
        </div>

        <h4 class="text-gray-700 text-center text-4xl font-extrabold mb-6">
            Administrador
        </h4>

        <div class="w-full max-w-2xl mx-auto">
            <div class="bg-gray-900 p-12 rounded-xl shadow-xl">
                <div class="mb-8 text-center">
                    <span class="block text-white text-2xl font-extrabold">Iniciar sesión</span>
                </div>
                <form id="myForm" name="signin" method="post">
                    <div class="mb-6">
                        <label for="username" class="block text-gray-300 text-sm font-medium mb-2"></label>
                        <input id="username1" type="text" name="username"
                            class="block w-full bg-gray-800 text-white border border-gray-700 rounded-md py-2 px-4 placeholder-gray-500 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                            autocomplete="off" placeholder="Nombre de usuario">
                    </div>
                    <div class="mb-8">
                        <label for="password" class="block text-gray-300 text-sm font-medium mb-2"></label>
                        <input id="password" type="password" name="password"
                            class="block w-full bg-gray-800 text-white border border-gray-700 rounded-md py-2 px-4 placeholder-gray-500 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                            autocomplete="off" placeholder="Contraseña">
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit" name="signin"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:ring focus:ring-blue-500 focus:ring-opacity-50">Ingresar</button>
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