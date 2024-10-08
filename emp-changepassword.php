<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    // Code for change password 
    if (isset($_POST['change'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $username = $_SESSION['emplogin'];
        $sql = "SELECT Password FROM tblemployees WHERE EmailId=:username and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $con = "update tblemployees set Password=:newpassword where EmailId=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Su contraseña ha sido cambiada exitosamente";
        } else {
            $error = "Su contraseña actual es incorrecta";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Title -->
    <title>Empleado | Cambio de contraseña</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!--FUENTE DE GOOGLE PARA EL TEXTO "Admin" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <!--FIN DE FUENTE DE GOOGLE -->

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
    <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../includes/style-traductor.css">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../CreaJ_2024/assets/images/FaviconWF.png" type="image/x-icon">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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

    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <!--INICIO DEL SCRIPT DEL TRADUCTOR DE GOOGLE-->
    <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: "es",
                    includedLanguages: "fr,en,es,pt,zh-CN,ru",
                },
                "google_translate_element"
            );
        }
    </script>
    <!--FIN DEL SCRIPT DEL TRADUCTOR DE GOOGLE-->

    <main class="mn-inner">
        <div class="row">

            <div class="col s12">
                <div class="page-title">Cambiar contraseña</div>
            </div>

            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">

                        <div class="row">
                            <form class="col s12" name="chngpwd" method="post" onsubmit="return valid();">
                                <?php if ($error) { ?>
                                    <div class="errorWrap"><strong>ERROR</strong>:
                                        <?php echo htmlentities($error); ?>
                                    </div>
                                <?php } else if ($msg) { ?>
                                    <div class="succWrap"><strong>ÉXITO</strong>:
                                        <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="validate" autocomplete="off" name="password">
                                        <label for="password">Contraseña actual</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="newpassword" type="password" name="newpassword" class="validate" autocomplete="off">
                                        <label for="newpassword">Nueva contraseña</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="confirmpassword" type="password" name="confirmpassword" class="validate" autocomplete="off">
                                        <label for="confirmpassword">Confirmar contraseña</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <button type="submit" name="change" class="waves-effect waves-light btn indigo m-b-xs">Cambiar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div class="left-sidebar-hover"></div>

    <!-- Javascripts -->
    <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="assets/js/alpha.min.js"></script>
    <script src="assets/js/pages/form_elements.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function valid() {
            var password = document.querySelector('input[name="password"]').value;
            var newpassword = document.querySelector('input[name="newpassword"]').value;
            var confirmpassword = document.querySelector('input[name="confirmpassword"]').value;

            if (!password || !newpassword || !confirmpassword) {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Campos Vacíos!',
                    text: 'Por favor, complete todos los campos para poder cambiar su contraseña.',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (newpassword !== confirmpassword) {
                Swal.fire({
                    icon: 'info',
                    title: '¡Contraseñas No Coinciden!',
                    text: 'La nueva contraseña y su confirmación no coinciden. ¡Vuelva a intentarlo!',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            return true;
        }
    </script>

</body>

</html>
<?php } ?>
