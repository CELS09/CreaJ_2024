<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT EmailId,Password,Status,id FROM tblemployees WHERE EmailId=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $status = $result->Status;
            $_SESSION['eid'] = $result->id;
        }
        if ($status == 0) {
            $msg = "Su cuenta está inactiva. Póngase en contacto con el administrador";
        } else {
            $_SESSION['emplogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location = 'emp-changepassword.php'; </script>";
        }
    } else {

        echo "<script>alert('DATOS INVÀLIDOS');</script>";
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
    <link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../CreaJ_2024/assets/images/FaviconWF.png" type="image/x-icon">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>


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
                        <a href="#" data-activates="slide-out" class="button-collapse show-on-large material-design-hamburger__icon">
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
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA/ElEQVR4nMWUv0rEQBCH0yn6DFrcI2hhJakCgfl+2VofwForO62vutpGfAnviivSCorN+Qb2NleqKIN7EEISLhfUgR/DDrvfzp9lk+QvDdiXdOa+90FgAtxUNJP05b4Wn4QQ9lphkqaS3iW9rQQsI2xZjetn331XZi+SymqsKIojYO6+dnHp+3vBOqoo/xcGXEhaSDofBEvTdBv4jAP48HUyJDNJTxH2OLjMLMt2zewY2NkYluf5FnANPEt6dQ9cebw3DBh7eXUB494wSUHSZYPCxj1rM60DAx7MbNQk4MDMDl1xyosu2F1Tnzp02wqLj/TU/681dLKa7K/YN8Y95sWbSMkoAAAAAElFTkSuQmCC">
                            </i>Login empleado
                        </a>
                    </li>

                    <hr class="border-gray-300 my-0.5 mx-5">

                    <li class="no-padding">
                        <a class="waves-effect waves-grey" href="admin/">
                            <i class="material-icons">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAACXBIWXMAAAsTAAALEwEAmpwYAAABUElEQVR4nM2TvUpDQRCFRfAVFNTWQgsVRJ8h3D3fQlKJNv6RRmuxS2OniE0QFAJ5Bi200UKbQB5Ae21tVIigQQb2xk3CvREEceDAcubMmbl3doeG/iqSJJl3zs39ykTSOvAq6QVYG1jgnJuQdChpu1KpDKc8UANOAmopbxpgx2q89+MdI+AKuJT05L1fjhosAW8GSYvRpCvAY1oXf8IdUAcegM3IaApoGewc6beC1mpuO0be+xmgCbSBUjRpPUbEl4K2mSTJdNd/CmZtSR9AFZhNJ3HfkxlXDZp2n0nU6QY4ABqS3numqAeuYRpJ15nb895vmKBcLo8451aLxeJomrOzcZYLDbOvQ6FQmLSxY4PeAMYkfdqV6Uv2CG0byspLQtJ9rkkQXgC7Ofk9SecDjYAz4CjH6FjS6U+M9sOqnzPQMs1AI3s7zrmFPHS9r38bX94JttXznMwZAAAAAElFTkSuQmCC">
                            </i>Admin login
                        </a>
                    </li>

                    <hr class="border-gray-300 my-0.5 mx-5">

                    <li class="no-padding">
                        <a class="waves-effect waves-grey" href="forgot-password.php">
                            <i class="material-icons">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAACXBIWXMAAAsTAAALEwEAmpwYAAABVUlEQVR4nJXUT0sWURTH8Y+pSeJOBNtJLloEthBy48pdKLWyJIj0BSRCu4xEUNSVEIobEdtIK6FFughFRStR6MX4BmTgPA+Xca7D84XLzDn3d87cPz+G+5nAEa7iOaFFOvAWp1hHf+QfR3yKN6Gr5BHGsYVzzKM3o+2N+fPQj0d9k//4gqEWd/E86or6Jn8z4odYxgmWIq7iTxoU59BVIfqKWTzAXKyiTHdcTpPveHpHxnFy0J3louAZtiV8xus0gW+4wXUybiKf8g6f0sQY1kqis1Kcy+/iRXnfF5miNvyKZ7lZW9zkHc/9iP2rKFrJ5EexqYKRuIgG/zBcMS4TzT6eyHCAwXifwmrFmEoMu5Nr1Fjdz+R8cnSETQZqdBbxsUazgA91jRpfPcTLzPz7sknr6MFvvCrlZ7CH9laaNRoWdils0RcW2LjvP1ZHcRHTYczJOvUttRU+T/juX+oAAAAASUVORK5CYII=">
                            </i>Contraseña de recuperación
                        </a>
                    </li>

                </ul>
                <div class="footer">
                    <p class="copyright"><a href="https://www.instagram.com/workfusionhr?igsh=MXNrMjZhZWQ3amdmag==" target="_blank">WorkFusion</a> ©</p>
                </div>
            </div>
        </aside>

        <!-- FIN DEL SIDEBAR-->

        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="font-bold text-3xl mb-7 mt-24">
                        <p class="text-center text-5xl" style="font-family: averia libre;">¡BIENVENIDO A WORKFUSION!</p>
                    </div>

                    <div class="col s12 m6 l8 offset-l2 offset-m3">
                        <div class="card white darken-1">

                            <div class="card-content h-auto">
                                <span class="mt-4 card-title text-xl text-center">Login del empleado</span>
                                <?php if ($msg) { ?>
                                    <div class="errorWrap"><strong>Error</strong> :
                                        <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>

                                <div class="row">
                                    <form id="myForm" class="mx-auto max-w-4xl px-8 pt-6 pb-8 mb-4" name="signin" method="post">
                                        <div class="input-field col s12">
                                            <input id="username" type="text" name="username" class="validate" autocomplete="off">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="password" type="password" name="password" class="validate" autocomplete="off">
                                            <label for="password">Contraseña</label>
                                        </div>
                                        <div class=" items-center justify-center">
                                            <button type="submit" name="signin" class="w-full mt-8 bg-green-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">INGRESAR</button>
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
        document.getElementById('myForm').addEventListener('submit', function(event) {
            const form = event.target;
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (username === '' || password === '') {
                event.preventDefault(); // Evita el envío del formulario
                Swal.fire({
                    icon: 'error',
                    title: 'Debe ingresar todos los datos',
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

    <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="assets/js/alpha.min.js"></script>
</body>
</html>
