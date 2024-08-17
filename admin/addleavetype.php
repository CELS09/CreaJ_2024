<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add'])) {
        $leavetype = $_POST['leavetype'];
        $description = $_POST['description'];

        if (empty($leavetype) || empty($description)) {
            $error = "Todos los campos son obligatorios.";
        } else {
            $sql = "INSERT INTO tblleavetype(LeaveType, Description) VALUES(:leavetype, :description)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':leavetype', $leavetype, PDO::PARAM_STR);
            $query->bindParam(':description', $description, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                $msg = "El tipo de permiso se agregó correctamente";
            } else {
                $error = "Algo salió mal. Inténtalo de nuevo.";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>

        <!-- Title -->
        <title>Admin | Agregar Tipo de Licencia</title>

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

        <!-- Fuente de Google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="../assets/images/FaviconWF.png" type="image/x-icon">

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function validateForm() {
                const leaveType = document.getElementById('leavetype').value.trim();
                const description = document.getElementById('textarea1').value.trim();

                if (leaveType === '' || description === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos vacíos',
                        text: 'Todos los campos son obligatorios.',
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

        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="page-title">Agregar tipo de permiso</div>
                </div>
                <div class="col s12 m12 l6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <form class="col s12" name="addLeaveType" method="post" onsubmit="return validateForm();">
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
                                            <input id="leavetype" type="text" class="validate" autocomplete="off"
                                                name="leavetype">
                                            <label for="leavetype">Tipo de permiso</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <textarea id="textarea1" name="description" class="materialize-textarea"
                                                length="500"></textarea>
                                            <label for="textarea1">Descripción</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <button type="submit" name="add"
                                                class="waves-effect waves-light btn indigo m-b-xs">AÑADIR</button>
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