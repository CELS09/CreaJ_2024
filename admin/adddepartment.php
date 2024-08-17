<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add'])) {
        $deptname = $_POST['departmentname'];
        $deptshortname = $_POST['departmentshortname'];
        $deptcode = $_POST['deptcode'];
        
        if (empty($deptname) || empty($deptshortname) || empty($deptcode)) {
            $error = "Todos los campos son obligatorios.";
        } else {
            $sql = "INSERT INTO tbldepartments(DepartmentName, DepartmentCode, DepartmentShortName) VALUES(:deptname, :deptcode, :deptshortname)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':deptname', $deptname, PDO::PARAM_STR);
            $query->bindParam(':deptcode', $deptcode, PDO::PARAM_STR);
            $query->bindParam(':deptshortname', $deptshortname, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if ($lastInsertId) {
                $msg = "Departamento creado con éxito";
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
    <title>Admin | Agregar departamento</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
    <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../assets/images/FaviconWF.png" type="image/x-icon">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function validateForm() {
        const departmentName = document.getElementById('departmentname').value.trim();
        const departmentShortName = document.getElementById('departmentshortname').value.trim();
        const deptCode = document.getElementById('deptcode').value.trim();

        if (departmentName === '' || departmentShortName === '' || deptCode === '') {
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
</head>

<body>
    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Agregar departamento</div>
            </div>
            <div class="col s12 m12 l6">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <form class="col s12" name="addDept" method="post" onsubmit="return validateForm();">
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
                                        <input id="departmentname" type="text" class="validate" autocomplete="off"
                                            name="departmentname" >
                                        <label for="departmentname">Nombre de Departamento</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="departmentshortname" type="text" class="validate" autocomplete="off"
                                            name="departmentshortname" >
                                        <label for="departmentshortname">Nombre corto del departamento</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input id="deptcode" type="text" name="deptcode" class="validate"
                                            autocomplete="off" >
                                        <label for="deptcode">Código del departamento</label>
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
