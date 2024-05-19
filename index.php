<?php
session_start();
error_reporting(0);
include ('includes/config.php');
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
            $msg = "Your account is Inactive. Please contact admin";
        } else {
            $_SESSION['emplogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location = 'emp-changepassword.php'; </script>";
        }
    } else {

        echo "<script>alert('Invalid Details');</script>";

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


    <!-- Theme Styles -->
    <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

    <!--FAVICON-->
    <link rel="shortcut icon" href="../CreaJ_2024/assets/images/Favicon.png" type="image/x-icon">


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
                        <a href="#" data-activates="slide-out"
                            class="button-collapse show-on-large material-design-hamburger__icon">
                            <span class="material-design-hamburger__layer"></span>
                        </a>
                    </section>
                    <div class="header-title col s5">
                        <span class="chapter-title">WorkFusion | Sistema del empleado
                        </span>
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
                        <a class="waves-effect waves-grey" href="index.php">
                            <i class="material-icons">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA/ElEQVR4nMWUv0rEQBCH0yn6DFrcI2hhJakCgfl+2VofwForO62vutpGfAnviivSCorN+Qb2NleqKIN7EEISLhfUgR/DDrvfzp9lk+QvDdiXdOa+90FgAtxUNJP05b4Wn4QQ9lphkqaS3iW9rQQsI2xZjetn331XZi+SymqsKIojYO6+dnHp+3vBOqoo/xcGXEhaSDofBEvTdBv4jAP48HUyJDNJTxH2OLjMLMt2zewY2NkYluf5FnANPEt6dQ9cebw3DBh7eXUB494wSUHSZYPCxj1rM60DAx7MbNQk4MDMDl1xyosu2F1Tnzp02wqLj/TU/681dLKa7K/YN8Y95sWbSMkoAAAAAElFTkSuQmCC">
                            </i>Login empleado
                        </a>
                    </li>

                    <hr color="gray" size="0.3px" style="margin-left: 20px; margin-right: 20px;">

                    <li class="no-padding">
                        <a class="waves-effect waves-grey" href="admin/">
                            <i class="material-icons">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAACXBIWXMAAAsTAAALEwEAmpwYAAABUElEQVR4nM2TvUpDQRCFRfAVFNTWQgsVRJ8h3D3fQlKJNv6RRmuxS2OniE0QFAJ5Bi200UKbQB5Ae21tVIigQQb2xk3CvREEceDAcubMmbl3doeG/iqSJJl3zs39ykTSOvAq6QVYG1jgnJuQdChpu1KpDKc8UANOAmopbxpgx2q89+MdI+AKuJT05L1fjhosAW8GSYvRpCvAY1oXf8IdUAcegM3IaApoGewc6beC1mpuO0be+xmgCbSBUjRpPUbEl4K2mSTJdNd/CmZtSR9AFZhNJ3HfkxlXDZp2n0nU6QY4ABqS3numqAeuYRpJ15nb895vmKBcLo8451aLxeJomrOzcZYLDbOvQ6FQmLSxY4PeAMYkfdqV6Uv2CG0byspLQtJ9rkkQXgC7Ofk9SecDjYAz4CjH6FjS6U+M9sOqnzPQMs1AI3s7zrmFPHS9r38bX94JttXznMwZAAAAAElFTkSuQmCC">
                            </i>Admin login
                        </a>
                    </li>

                    <hr color="gray" size="0.3px" style="margin-left: 20px; margin-right: 20px;">

                    <li class="no-padding">
                        <a class="waves-effect waves-grey" href="forgot-password.php">
                            <i class="material-icons">
                                <img
                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAATCAYAAAByUDbMAAAACXBIWXMAAAsTAAALEwEAmpwYAAABVUlEQVR4nJXUT0sWURTH8Y+pSeJOBNtJLloEthBy48pdKLWyJIj0BSRCu4xEUNSVEIobEdtIK6FFughFRStR6MX4BmTgPA+Xca7D84XLzDn3d87cPz+G+5nAEa7iOaFFOvAWp1hHf+QfR3yKN6Gr5BHGsYVzzKM3o+2N+fPQj0d9k//4gqEWd/E86or6Jn8z4odYxgmWIq7iTxoU59BVIfqKWTzAXKyiTHdcTpPveHpHxnFy0J3louAZtiV8xus0gW+4wXUybiKf8g6f0sQY1kqis1Kcy+/iRXnfF5miNvyKZ7lZW9zkHc/9iP2rKFrJ5EexqYKRuIgG/zBcMS4TzT6eyHCAwXifwmrFmEoMu5Nr1Fjdz+R8cnSETQZqdBbxsUazgA91jRpfPcTLzPz7sknr6MFvvCrlZ7CH9laaNRoWdils0RcW2LjvP1ZHcRHTYczJOvUttRU+T/juX+oAAAAASUVORK5CYII=">
                            </i>Contraseña de recuperación
                        </a>
                    </li>

                </ul>
                <div class="footer">
                    <p class="copyright"><a href="https://linktab.co/WorkFusion">WorkFusion</a> ©</p>
                </div>
            </div>
        </aside>

        <!-- FIN DEL SIDEBAR-->

        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="page-title">
                        <h4><b>Bienvenido al sistema de gestión de permisos de empleados WorkFusion</b></h4>
                    </div>

                    <div class="col s12 m6 l8 offset-l2 offset-m3">
                        <div class="card white darken-1">

                            <div class="card-content ">
                                <span class="card-title" style="font-size:20px;">Login del empleado</span>
                                <?php if ($msg) { ?>
                                    <div class="errorWrap"><strong>Error</strong> :
                                        <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <form class="col s12" name="signin" method="post">
                                        <div class="input-field col s12">
                                            <input id="username" type="text" name="username" class="validate"
                                                autocomplete="off" required>
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="password" type="password" class="validate" name="password"
                                                autocomplete="off" required>
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="col s12 right-align m-t-sm">

                                            <input type="submit" name="signin" value="INGRESAR" class="waves-effect waves-light btn teal">
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
    <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="assets/js/alpha.min.js"></script>

</body>
</html>
