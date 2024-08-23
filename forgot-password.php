<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code for change password 
if (isset($_POST['change'])) {
    $newpassword = md5($_POST['newpassword']);
    $empid = $_SESSION['empid'];

    $con = "update tblemployees set Password=:newpassword where id=:empid";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1->bindParam(':empid', $empid, PDO::PARAM_STR);
    $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();
    $msg = "Su contraseña ha sido cambiada con éxito";
}

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <!-- Title -->
    <title>WorkFusion | Recuperación de contraseña</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../CreaJ_2024/assets/images/FaviconWF.png" type="image/x-icon">

    <!-- Theme Styles -->
    <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

    <!--TAILWIND-->
    <link rel="stylesheet" href="src/output.css">

    <!--Fuente de Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style>

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


                    </form>


                </div>
            </nav>
        </header>

                <!-- SIDEBAR-->

                <aside id="slide-out" class="side-nav white fixed">
            <div class="side-nav-wrapper">

                <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

                    <li>&nbsp;</li>

                    <li class="no-padding">
                        <a class="waves-effect waves-grey" href="index.php">
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
                        <a class="waves-effect waves-grey" href="#">
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

        <main class="flex flex-col items-center justify-center pt-8 bg-gray-100">
            <div class="w-full max-w-4xl p-6">
                <h1 class="text-center text-4xl font-extrabold pb-10 text-gray-500">
                    Recuperación de contraseña para empleado
                </h1>

                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h2 class="text-2xl font-extrabold mb-6 text-center text-gray-500">DIGITE SUS CREDENCIALES</h2>

                    <?php if ($msg) { ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                            <strong>Éxito:</strong> <?php echo htmlentities($msg); ?>
                        </div>
                    <?php } ?>

                    <form name="signin" method="post" class="space-y-6 m-6">
                        <div>
                            <label for="empid" class="block text-lg font-medium text-gray-600">ID Empleado</label>
                            <input id="empid" type="text" name="empid"
                                class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                autocomplete="off" required>
                        </div>
                        <div>
                            <label for="emailid" class="block text-lg font-medium text-gray-600">Email</label>
                            <input id="emailid" type="text" name="emailid"
                                class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                autocomplete="off" required>
                        </div>
                        <div>
                            <input type="submit" name="submit" value="Iniciar sesión"
                                class="w-full py-3 bg-indigo-500 text-white font-bold rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </form>
                </div>

                <?php if (isset($_POST['submit'])) {
                    $empid = $_POST['empid'];
                    $email = $_POST['emailid'];
                    $sql = "SELECT id FROM tblemployees WHERE EmailId=:email and EmpId=:empid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->bindParam(':empid', $empid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {
                            $_SESSION['empid'] = $result->id;
                        }
                        ?>

                        <div class="bg-white mt-8 rounded-lg shadow-lg p-8 max-w-4xl mx-auto">
                            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">DIGITE SU NUEVO CAMBIO DE CONTRASEÑA</h2>
                            <form name="udatepwd" method="post" class="space-y-6">
                                <div>
                                    <label for="newpassword" class="block text-lg font-medium text-gray-800">Nueva
                                        contraseña</label>
                                    <input id="newpassword" type="password" name="newpassword"
                                        class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                        autocomplete="off" required>
                                </div>
                                <div>
                                    <label for="confirmpassword" class="block text-lg font-medium text-gray-800">Confirmar
                                        contraseña</label>
                                    <input id="confirmpassword" type="password" name="confirmpassword"
                                        class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500"
                                        autocomplete="off" required>
                                </div>
                                <div>
                                    <button type="submit" name="change"
                                        class="w-full py-3 bg-indigo-500 text-white font-bold rounded-lg hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                        onclick="return valid();">Cambiar</button>
                                </div>
                            </form>
                        </div>

                    <?php } else { ?>
                        <div
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-6 max-w-lg mx-auto">
                            <strong>ERROR:</strong> <?php echo htmlentities("Datos inválidos"); ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </main>


    </div>
    <div class="left-sidebar-hover"></div>

    <!-- Javascripts -->
    <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="assets/js/alpha.min.js"></script>

</body>

</html>