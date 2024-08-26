<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from  tbldepartments  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $msg = "Registro del departamento eliminado";
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <!-- Title -->
    <title>Admin | Administrar departamentos</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!--FAVICON-->
    <link rel="shortcut icon" href="../assets\images\FaviconWF.png" type="image/x-icon">

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
    <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../assets\images\WorkFusion(letras).png" type="image/x-icon">

    <!--FUENTE DE GOOGLE PARA EL TEXTO "Admin" -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <!--FIN DE FUENTE DE GOOGLE -->

    <!-- Theme Styles -->
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
        
        /* SweetAlert2 custom styles */
        .swal2-popup {
            font-family: "Roboto", sans-serif;
        }
        .swal2-confirm {
            background-color: #5cb85c !important; /* Green */
            color: white;
            border: none;
        }
        .swal2-cancel {
            background-color: #dd3d36 !important; /* Red */
            color: white;
            border: none;
        }
    </style>
</head>

<body>

    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Administrar departamentos</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Información de Departamentos</span>
                        <?php if ($msg) { ?>
                            <div class="succWrap"><strong>SUCCESS</strong> :
                                <?php echo htmlentities($msg); ?>
                            </div>
                        <?php } ?>
                        <table id="example" class="display responsive-table ">
                            <thead>
                                <tr>
                                    <th>No.ㅤ</th>
                                    <th>Nombre del Departamento</th>
                                    <th>Nombre corto del Departamento</th>
                                    <th>Código del Departamento</th>
                                    <th>Fecha de Creación</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $sql = "SELECT * from tbldepartments";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->DepartmentName); ?></td>
                                            <td><?php echo htmlentities($result->DepartmentShortName); ?></td>
                                            <td><?php echo htmlentities($result->DepartmentCode); ?></td>
                                            <td><?php echo htmlentities($result->CreationDate); ?></td>
                                            <td>
                                                <a href="editdepartment.php?deptid=<?php echo htmlentities($result->id); ?>">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                                <a href="#" onclick="deleteDepartment(<?php echo htmlentities($result->id); ?>);">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                            </td>
                                        </tr>
                                <?php $cnt++;
                                    }
                                } ?>
                            </tbody>
                        </table>
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
    <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/alpha.min.js"></script>
    <script src="../assets/js/pages/table-data.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteDepartment(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "swal2-confirm",
                    cancelButton: "swal2-cancel"
                },
                buttonsStyling: true 
            });
            swalWithBootstrapButtons.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, elimínalo!",
                cancelButtonText: "No, cancélalo!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `managedepartments.php?del=${id}`;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelado",
                        text: "Estuvo cerca :)",
                        icon: "success"
                    });
                }
            });
        }
    </script>
</body>

</html>
<?php } ?>
