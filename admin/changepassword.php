<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    // Code for change password 
    if (isset($_POST['change'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $confirmpassword = md5($_POST['confirmpassword']);
        $username = $_SESSION['alogin'];

        // Check if the new password matches the confirm password
        if ($newpassword != $confirmpassword) {
            $error = "Las contraseñas nuevas no coinciden.";
        } else {
            // Verify current password
            $sql = "SELECT Password FROM admin WHERE UserName=:username AND Password=:password";
            $query = $dbh->prepare($sql);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            
            if ($query->rowCount() > 0) {
                // Update password
                $con = "UPDATE admin SET Password=:newpassword WHERE UserName=:username";
                $chngpwd1 = $dbh->prepare($con);
                $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
                $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
                $chngpwd1->execute();
                $msg = "Su Contraseña cambió exitosamente";
            } else {
                $error = "Tu contraseña actual es incorrecta";
            }
        }
    }
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Title -->
    <title>Admin | Cambia la contraseña</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Enlaces de Estilos -->
    <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
    <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />

    <!-- FUENTE DE GOOGLE PARA EL TEXTO "Admin" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <!-- FIN DE FUENTE DE GOOGLE -->

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../assets/images/FaviconWF.png" type="image/x-icon">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function valid() {
        var newPassword = document.getElementById('newpassword').value.trim();
        var confirmPassword = document.getElementById('confirmpassword').value.trim();

        if (newPassword === '' || confirmPassword === '') {
            Swal.fire({
                icon: 'error',
                title: 'Campos vacíos',
                text: 'Por favor, rellene todos los campos.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                focusConfirm: false,
                allowOutsideClick: false,
                customClass: {
                    popup: 'my-popup',
                }
            }).then(() => {
                if (!newPassword) document.getElementById('newpassword').focus();
                else if (!confirmPassword) document.getElementById('confirmpassword').focus();
            });
            return false; // Evita el envío del formulario
        } 

        if (newPassword !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Las contraseñas no coinciden',
                text: 'Las contraseñas nuevas deben coincidir.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
                focusConfirm: false,
                allowOutsideClick: false,
                customClass: {
                    popup: 'my-popup',
                }
            });
            return false; // Evita el envío del formulario
        }

        return true; // Permite el envío del formulario
    }
    </script>
</head>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title"><b>Cambiar contraseña</b></div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <form class="col s12" name="chngpwd" method="post" onsubmit="return valid();">
                                <?php if ($error): ?>
                                    <div class="errorWrap"><strong>ERROR</strong>:
                                        <?php echo htmlentities($error); ?>
                                    </div>
                                <?php elseif ($msg): ?>
                                    <div class="succWrap"><strong>ÉXITO</strong>:
                                        <?php echo htmlentities($msg); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="validate" autocomplete="off" name="password" >
                                        <label for="password">Contraseña actual</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="newpassword" type="password" name="newpassword" class="validate" autocomplete="off" >
                                        <label for="newpassword">Nueva contraseña</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="confirmpassword" type="password" name="confirmpassword" class="validate" autocomplete="off" >
                                        <label for="confirmpassword">Confirmar contraseña</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <button type="submit" name="change" class="waves-effect waves-light btn indigo m-b-xs">Confirmar</button>
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
    <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="../assets/js/alpha.min.js"></script>
    <script src="../assets/js/pages/form_elements.js"></script>

</body>

</html>

<?php } ?>
