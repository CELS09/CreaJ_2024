<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    $eid = $_SESSION['emplogin'];
    if (isset($_POST['update'])) {

        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $department = $_POST['department'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $mobileno = $_POST['mobileno'];
        $sql = "update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,Department=:department,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where EmailId=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':department', $department, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':country', $country, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Registro de empleado actualizado exitosamente";
    }

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>

        <!-- Title -->
        <title>Empleado | Actualizar información</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

        <!--FAVICON-->
        <link rel="shortcut icon" href="../assets\images\FaviconWF.png" type="image/x-icon">

        <!--FUENTE DE GOOGLE PARA EL NOMBRE DEL PERFIL -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
        <!--FIN DE FUENTE DE GOOGLE -->


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
                    <div class="page-title">Actualizar mi información</div>
                </div>
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <form id="example-form" method="post" name="updatemp">
                                <div>
                                    <h3>Actualizar información del empleado</h3>
                                    <?php if ($error) { ?>
                                        <div class="errorWrap"><strong>ERROR</strong>:
                                            <?php echo htmlentities($error); ?>
                                        </div>
                                    <?php } else if ($msg) { ?>
                                        <div class="succWrap"><strong>ÉXITO</strong> :
                                            <?php echo htmlentities($msg); ?>
                                        </div>
                                    <?php } ?>
                                    <section>
                                        <div class="wizard-content">
                                            <div class="row">
                                                <div class="col m6">
                                                    <div class="row">
                                                        <?php
                                                        $eid = $_SESSION['emplogin'];
                                                        $sql = "SELECT * from  tblemployees where EmailId=:eid";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) { ?>
                                                                <div class="input-field col  s12">
                                                                    <label for="empcode">Código de empleado</label>
                                                                    <input name="empcode" id="empcode"
                                                                        value="<?php echo htmlentities($result->EmpId); ?>"
                                                                        type="text" autocomplete="off" readonly required>
                                                                    <span id="empid-availability" style="font-size:12px;"></span>
                                                                </div>


                                                                <div class="input-field col m6 s12">
                                                                    <label for="firstName">Nombre</label>
                                                                    <input id="firstName" name="firstName"
                                                                        value="<?php echo htmlentities($result->FirstName); ?>"
                                                                        type="text" required>
                                                                </div>

                                                                <div class="input-field col m6 s12">
                                                                    <label for="lastName">Apellido</label>
                                                                    <input id="lastName" name="lastName"
                                                                        value="<?php echo htmlentities($result->LastName); ?>"
                                                                        type="text" autocomplete="off" required>
                                                                </div>

                                                                <div class="input-field col s12">
                                                                    <label for="email">Email</label>
                                                                    <input name="email" type="email" id="email"
                                                                        value="<?php echo htmlentities($result->EmailId); ?>"
                                                                        readonly autocomplete="off" required>
                                                                    <span id="emailid-availability" style="font-size:12px;"></span>
                                                                </div>

                                                                <div class="input-field col s12">
                                                                    <label for="phone">Número de teléfono móvil</label>
                                                                    <input id="phone" name="mobileno" type="tel"
                                                                        value="<?php echo htmlentities($result->Phonenumber); ?>"
                                                                        maxlength="10" autocomplete="off" required>
                                                                </div>

                                                    </div>
                                                </div>

                                                <div class="m6">
                                                    <div class="row">

                                                        <div class="input-field col m6 s12">
                                                            <select name="gender" autocomplete="off">
                                                                <option value="">Género...</option>
                                                                <option value="Male">Masculino</option>
                                                                <option value="Female">Hembra</option>
                                                                <option value="Other">Otro</option>
                                                            </select>
                                                        </div>


                                                        <label for="birthdate">Fecha de nacimiento</label>
                                                        <div class="input-field col m6 s12">

                                                            <input id="birthdate" name="dob" class="datepicker"
                                                                value="<?php echo htmlentities($result->Dob); ?>">
                                                        </div>



                                                        <div class="input-field col m6 s12">
                                                            <select name="department" autocomplete="off">
                                                                <option
                                                                    value="<?php echo htmlentities($result->Department); ?>">
                                                                    <?php echo htmlentities($result->Department); ?>
                                                                </option>
                                                                <?php $sql = "SELECT DepartmentName from tbldepartments";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                $cnt = 1;
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $resultt) { ?>
                                                                        <option
                                                                            value="<?php echo htmlentities($resultt->DepartmentName); ?>">
                                                                            <?php echo htmlentities($resultt->DepartmentName); ?>
                                                                        </option>
                                                                <?php }
                                                                } ?>
                                                            </select>
                                                        </div>

                                                        <div class="input-field col m6 s12">
                                                            <label for="address">Dirección</label>
                                                            <input id="address" name="address" type="text"
                                                                value="<?php echo htmlentities($result->Address); ?>"
                                                                autocomplete="off" required>
                                                        </div>

                                                        <div class="input-field col m6 s12">
                                                            <label for="city">Ciudad / Pueblo </label>
                                                            <input id="city" name="city" type="text"
                                                                value="<?php echo htmlentities($result->City); ?>"
                                                                autocomplete="off" required>
                                                        </div>

                                                        <div class="input-field col m6 s12">
                                                            <label for="country">País</label>
                                                            <input id="country" name="country" type="text"
                                                                value="<?php echo htmlentities($result->Country); ?>"
                                                                autocomplete="off" required>
                                                        </div>



                                                <?php }
                                                        } ?>

                                                    </div>
                                                </div>

                                                <div class="input-field col s12 center-align">
                                                    <button type="submit" name="update" id="update"
                                                        class="waves-effect waves-light btn indigo m-b-xs">ACTUALIZAR</button>
                                                </div>

                                            </div>
                                        </div>
                                    </section>


                                    </section>
                                </div>
                            </form>
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
        <script src="assets/js/pages/form_elements.js"></script>

    </body>

    </html>
<?php } ?>