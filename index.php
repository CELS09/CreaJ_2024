<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['signin'])) {
    $uname = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    $passwordHash = md5($password); // Considera usar password_hash() para mayor seguridad

    $sql = "SELECT EmailId, Password, Status, id FROM tblemployees WHERE EmailId = :uname AND Password = :password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $passwordHash, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $status = $result->Status;
            $_SESSION['eid'] = $result->id;
        }

        if ($status == 0) {
            $_SESSION['login_error'] = "Su cuenta está inactiva. Póngase en contacto con el administrador";
        } else {
            $_SESSION['emplogin'] = $uname;
            echo "<script type='text/javascript'> document.location = 'emp-changepassword.php'; </script>";
        }
    } else {
        $_SESSION['login_error'] = "Email o contraseña incorrectos";
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Title -->
    <title>Inicio de Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />
    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">

    <!--Fuente de Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Rowdies:wght@300;400;700&display=swap"
        rel="stylesheet">

    <!-- Theme Styles -->
    <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

    <!-- TAILWIND-->
    <link rel="stylesheet" href="src/output.css">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../CreaJ_2024/assets/images/FaviconWF.png" type="image/x-icon">

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
            padding: 20px;
            position: relative;
            /* Añadir esta línea */
        }

        .select-wrapper {
            display: none !important;
        }

        /* ESTILO DEL VIDEO DE FONDO */
        .videobg {
            pointer-events: none;
            user-select: none;
            position: absolute;
            opacity: 10%;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: -1;
            /* Asegura que el video esté detrás del contenido */
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <script>
        //Carga el video después de que la página haya cargado o solo cuando sea visible en la pantalla
            document.addEventListener("DOMContentLoaded", function () {
            var video = document.getElementById('bgVideo');
            var source = video.querySelector('source');
            source.src = source.getAttribute('data-src');
            video.load();
            video.play();
        });
    </script>
</head>

<body>

    <!-- VIDEO DE FONDO -->
    <video id="bgVideo" muted loop class="videobg" controlsList="nodownload nofullscreen noplaybackrate" disablePictureInPicture>
        <source data-src="assets/images/FONDO_FORMS.mp4" type="video/mp4">
        Tu navegador no soporta la etiqueta de video.
    </video>

    <div class="loader-bg"></div>
    <div class="loader">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-spinner-teal lighten-1">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="mn-content fixed-sidebar">

        <!--HEADER-->
        <header class="mn-header navbar-fixed">
            <nav class="cyan darken-1">
                <div class="nav-wrapper row">
                    <section class="material-design-hamburger navigation-toggle">
                        <a href="#" data-activates="slide-out"
                            class="button-collapse show-on-large material-design-hamburger__icon">
                            <span class="material-design-hamburger__layer"></span>
                        </a>
                    </section>
                    <div class="header-title col s10">
                        <span class="chapter-title">WorkFusion | Sistema de gestión de empleados</span>
                    </div>
                </div>
            </nav>
        </header>


        <!-- SIDEBAR-->
        <aside id="slide-out" class="side-nav white fixed">
            <div class="side-nav-wrapper">

                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

                    <li>&nbsp;</li>

                    <li class="no-padding">
                        <a class="waves-effect waves-grey" href="#">
                            <i class="material-icons">
                                <img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA/ElEQVR4nMWUv0rEQBCH0yn6DFrcI2hhJakCgfl+2VofwForO62vutpGfAnviivSCorN+Qb2NleqKIN7EEISLhfUgR/DDrvfzp9lk+QvDdiXdOa+90FgAtxUNJP05b4Wn4QQ9lphkqaS3iW9rQQsI2xZjetn331XZi+SymqsKIojYO6+dnHp+3vBOqoo/xcGXEhaSDofBEvTdBv4jAP48HUyJDNJTxH2OLjMLMt2zewY2NkYluf5FnANPEt6dQ9cebw3DBh7eXUB494wSUHSZYPCxj1rM60DAx7MbNQk4MDMDl1xyosu2F1Tnzp02wqLj/TU/681dLKa7K/YN8Y95sWbSMkoAAAAAElFTkSuQmCC">
                            </i>Login de Empleado
                        </a>
                    </li>

                    <hr class="border-gray-300 my-0.5 mx-5">

                    <li class="no-padding">
                        <a class="waves-effect waves-grey" href="admin/">
                            <i class="material-icons">
                                <img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAACXBIWXMAAAsTAAALEwEAmpwYAAABUElEQVR4nM2TvUpDQRCFRfAVFNTWQgsVRJ8h3D3fQlKJNv6RRmuxS2OniE0QFAJ5Bi200UKbQB5Ae21tVIigQQb2xk3CvREEceDAcubMmbl3doeG/iqSJJl3zs39ykTSOvAq6QVYG1jgnJuQdChpu1KpDKc8UANOAmopbxpgx2q89+MdI+AKuJT05L1fjhosAW8GSYvRpCvAY1oXf8IdUAcegM3IaApoGewc6beC1mpuO0be+xmgCbSBUjRpPUbEl4K2mSTJdNd/CmZtSR9AFZhNJ3HfkxlXDZp2n0nU6QY4ABqS3numqAeuYRpJ15nb895vmKBcLo8451aLxeJomrOzcZYLDbOvQ6FQmLSxY4PeAMYkfdqV6Uv2CG0byspLQtJ9rkkQXgC7Ofk9SecDjYAz4CjH6FjS6U+M9sOqnzPQMs1AI3s7zrmFPHS9r38bX94JttXznMwZAAAAAElFTkSuQmCC">
                            </i>Login de Admin
                        </a>
                    </li>

                    <hr class="border-gray-300 my-0.5 mx-5">

                    <li class="no-padding">
                        <a class="waves-effect waves-grey" href="forgot-password.php">
                            <i class="material-icons">
                                <img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAACXBIWXMAAAsTAAALEwEAmpwYAAABVUlEQVR4nJXUT0sWURTH8Y+pSeJOBNtJLloEthBy48pdKLWyJIj0BSRCu4xEUNSVEIobEdtIK6FFughFRStR6MX4BmTgPA+Xca7D84XLzDn3d87cPz+G+5nAEa7iOaFFOvAWp1hHf+QfR3yKN6Gr5BHGsYVzzKM3o+2N+fPQj0d9k//4gqEWd/E86or6Jn8z4odYxgmWIq7iTxoU59BVIfqKWTzAXKyiTHdcTpPveHpHxnFy0J3louAZtiV8xus0gW+4wXUybiKf8g6f0sQY1kqis1Kcy+/iRXnfF5miNvyKZ7lZW9zkHc/9iP2rKFrJ5EexqYKRuIgG/zBcMS4TzT6eyHCAwXifwmrFmEoMu5Nr1Fjdz+R8cnSETQZqdBbxsUazgA91jRpfPcTLzPz7sknr6MFvvCrlZ7CH9laaNRoWdils0RcW2LjvP1ZHcRHTYczJOvUttRU+T/juX+oAAAAASUVORK5CYII=">
                            </i>Recuperación de Contraseña
                        </a>
                    </li>

                </ul>
                <div class="footer">
                    <p class="copyright"><a href="https://www.instagram.com/workfusionhr?igsh=MXNrMjZhZWQ3amdmag=="
                            target="_blank">WorkFusion</a> ©</p>
                </div>
            </div>
        </aside>
        <!-- FIN DEL SIDEBAR-->


        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="font-bold text-3xl mb-12 mt-20">
                        <p class="text-gray-700 text-center text-5xl font-extrabold">¡BIENVENIDO A WORKFUSION!</p>
                    </div>

                    <div class="col s14 m6 l8 offset-l2 offset-m3">
                        <div class="card white darken-1">

                            <div class="card-content h-auto ">
                                <p class="text-gray-600 pt-4 text-2xl text-center mx-auto font-extrabold">Login de
                                    Empleado
                                <p>
                                    <?php if ($msg) { ?>
                                    <div class="errorWrap"><strong>Error</strong> :
                                        <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <div class="row">

                                    <form id="myForm" class="mx-auto px-8 pt-6 mb-4" name="signin" method="post">
                                        <div class="input-field col s12 mb-4">
                                            <label for="username" class="flex items-center">
                                                <!-- Ícono de Email -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 20 20" class="text-gray-500 mr-2">
                                                    <path fill="currentColor"
                                                        d="M14.608 12.172c0 .84.239 1.175.864 1.175c1.393 0 2.28-1.775 2.28-4.727c0-4.512-3.288-6.672-7.393-6.672c-4.223 0-8.064 2.832-8.064 8.184c0 5.112 3.36 7.896 8.52 7.896c1.752 0 2.928-.192 4.727-.792l.386 1.607c-1.776.577-3.674.744-5.137.744c-6.768 0-10.393-3.72-10.393-9.456c0-5.784 4.201-9.72 9.985-9.72c6.024 0 9.215 3.6 9.215 8.016c0 3.744-1.175 6.6-4.871 6.6c-1.681 0-2.784-.672-2.928-2.161c-.432 1.656-1.584 2.161-3.145 2.161c-2.088 0-3.84-1.609-3.84-4.848c0-3.264 1.537-5.28 4.297-5.28c1.464 0 2.376.576 2.782 1.488l.697-1.272h2.016v7.057zm-2.951-3.168c0-1.319-.985-1.872-1.801-1.872c-.888 0-1.871.719-1.871 2.832c0 1.68.744 2.616 1.871 2.616c.792 0 1.801-.504 1.801-1.896z" />
                                                </svg>
                                                <span class="ml-3">Email</span>
                                            </label>
                                            <input id="username" type="text" name="username"
                                                class="validate w-full mt-2" autocomplete="off">
                                        </div>
                                        <div class="input-field col s12 mb-4">
                                            <label for="password" class="flex items-center">
                                                <!-- Ícono de Contraseña -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 15 15" class="text-gray-500 mr-2">
                                                    <path fill="currentColor"
                                                        d="M11 11h-1v-1h1zm-3 0h1v-1H8zm5 0h-1v-1h1z" />
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M3 6V3.5a3.5 3.5 0 1 1 7 0V6h1.5A1.5 1.5 0 0 1 13 7.5v.55a2.5 2.5 0 0 1 0 4.9v.55a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 0 13.5v-6A1.5 1.5 0 0 1 1.5 6zm1-2.5a2.5 2.5 0 0 1 5 0V6H4zM8.5 9a1.5 1.5 0 1 0 0 3h4a1.5 1.5 0 0 0 0-3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-3">Contraseña</span>
                                            </label>
                                            <input id="password" type="password" name="password"
                                                class="validate w-full mt-2" autocomplete="off">
                                        </div>
                                        <div class="items-center justify-center">
                                            <button type="submit" name="signin"
                                                class="w-full mt-8 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                INGRESAR
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
    <div class="left-sidebar-hover"></div>

    <!-- Javascripts -->

    <script>
        document.getElementById('myForm').addEventListener('submit', function (event) {
            const form = event.target;
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (username === '' || password === '') {
                event.preventDefault(); // Evita el envío del formulario
                Swal.fire({
                    icon: 'error',
                    title: '¡Campos Vacíos!',
                    text: 'Por favor, complete todos los campos para poder acceder.',
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

        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['login_error'])) { ?>
                Swal.fire({
                    title: '¡Error!',
                    text: '<?php echo $_SESSION['login_error']; ?>',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                <?php unset($_SESSION['login_error']); // Elimina el mensaje de error después de mostrarlo ?>
            <?php } ?>
        });

    </script>

    <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="assets/js/alpha.min.js"></script>
</body>

</html>