<?php
session_start();
include('includes/config.php');
if (isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        echo "<script>alert('Detalles no válidos');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Title -->
    <title>Inicio de Sesión | Administración</title>
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!--Fuente de Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">

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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #27233B;
            /* Color de fondo opcional */
            padding: 20px
        }
    </style>
</head>

<body class="signin-page">

    <div class="container mx-auto p-4">
        <main class="flex flex-col items-center">
            <a href="../index.php" class="text-cyan-400 text-center">
                <h5 class="bg-green-600 w-32 rounded-xl text-lg font-bold p-2">Regresar</h5>
            </a>

            <h4 class="text-white text-3xl font-bold mt-8 mb-6" style="font-family: averia libre;">Login de administrador</h4>

            <div class="w-full max-w-xs sm:max-w-sm">
                <div class="bg-white w-full shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <span class="block text-gray-700 text-center text-3xl font-bold pb-4">Iniciar sesión</span>
                    </div>
                    <form id="myForm" name="signin" method="post">
                        <div class="mb-4">
                            <label for="username" class="block text-gray-700 text-base font-bold mb-2">Nombre de usuario</label>
                            <input id="username" type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" autocomplete="off" placeholder="Ingrese su usuario">
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 text-base font-bold mb-2">Contraseña</label>
                            <input id="password" type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" autocomplete="off" placeholder="Ingrese su contraseña">
                        </div>
                        <div class="flex items-center justify-center">
                            <button type="submit" name="signin" class="w-full bg-green-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>


    <!-- Javascripts -->
    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            const form = event.target;
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (username === '' || password === '') {
                event.preventDefault(); // Evita el envío del formulario
                Swal.fire({
                    icon: 'error',
                    title: 'Debe ingresar los datos',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    focusConfirm: false, // Evita que SweetAlert le dé foco al botón de confirmación
                    allowOutsideClick: false, // Evita que el usuario pueda hacer clic fuera de la alerta para cerrarla
                    customClass: {
                        popup: 'my-popup', // Clase personalizada para el contenedor de la alerta
                    }
                }).then((result) => {
                    // Restablece el foco al primer campo de entrada (username) si el usuario cierra la alerta
                    if (result.isConfirmed || result.dismiss === Swal.DismissReason.backdrop) {
                        document.getElementById('username').focus();
                    }
                });
            }
        });
    </script>
    <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="../assets/js/alpha.min.js"></script>

</body>

</html>