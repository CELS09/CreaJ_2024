<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $did = intval($_GET['deptid']);
        $deptname = $_POST['departmentname'];
        $deptshortname = $_POST['departmentshortname'];
        $deptcode = $_POST['deptcode'];

        // Verificar que todos los campos están llenos
        if (empty($deptname) || empty($deptshortname) || empty($deptcode)) {
            $error = "Por favor, complete todos los campos.";
        } else {
            $sql = "update tbldepartments set DepartmentName=:deptname,DepartmentCode=:deptcode,DepartmentShortName=:deptshortname where id=:did";
            $query = $dbh->prepare($sql);
            $query->bindParam(':deptname', $deptname, PDO::PARAM_STR);
            $query->bindParam(':deptcode', $deptcode, PDO::PARAM_STR);
            $query->bindParam(':deptshortname', $deptshortname, PDO::PARAM_STR);
            $query->bindParam(':did', $did, PDO::PARAM_STR);
            $query->execute();
            $msg = "Departamento actualizado exitosamente";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <!-- Title -->
        <title>Admin | Departamento de actualización</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- FAVICON -->
        <link rel="shortcut icon" href="../assets/images/FaviconWF.png" type="image/x-icon">

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
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
        <!-- SweetAlert CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    </head>

    <body>
        <?php include('includes/header.php'); ?>
        <?php include('includes/sidebar.php'); ?>

        <main class="mn-inner">
            <div class="row">
                <div class="col s12">
                    <div class="page-title">Departamento de actualización</div>
                </div>
                <div class="col s12 m12 l6">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <form class="col s12" name="chngpwd" method="post" onsubmit="return validateForm()">
                                    <?php if ($error) { ?>
                                        <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div>
                                    <?php } else if ($msg) { ?>
                                        <div class="succWrap"><strong>ÉXITO</strong>: <?php echo htmlentities($msg); ?></div>
                                    <?php } ?>
                                    <?php
                                    $did = intval($_GET['deptid']);
                                    $sql = "SELECT * from tbldepartments WHERE id=:did";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':did', $did, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input id="departmentname" type="text" class="validate" autocomplete="off" name="departmentname" value="<?php echo htmlentities($result->DepartmentName); ?>" >
                                                    <label for="departmentname">Nombre de Departamento</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input id="departmentshortname" type="text" class="validate" autocomplete="off" value="<?php echo htmlentities($result->DepartmentShortName); ?>" name="departmentshortname" >
                                                    <label for="departmentshortname">Nombre corto del departamento</label>
                                                </div>
                                                <div class="input-field col s12">
                                                    <input id="deptcode" type="text" name="deptcode" class="validate" autocomplete="off" value="<?php echo htmlentities($result->DepartmentCode); ?>" >
                                                    <label for="deptcode">Código del departamento</label>
                                                </div>
                                            <?php }
                                    } ?>
                                        <div class="input-field col s12">
                                            <button type="submit" name="update" class="waves-effect waves-light btn indigo m-b-xs">ACTUALIZAR</button>
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

        <!-- SweetAlert JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
        <script>
            function validateForm() {
                const deptname = document.querySelector('#departmentname').value;
                const deptshortname = document.querySelector('#departmentshortname').value;
                const deptcode = document.querySelector('#deptcode').value;

                if (!deptname || !deptshortname || !deptcode) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Por favor, complete todos los campos.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                    return false; // Previene el envío del formulario
                }
                return true; // Permite el envío del formulario
            }
        </script>
    </body>
    </html>
<?php } ?>
