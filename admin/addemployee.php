<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add'])) {
        $empid = $_POST['empcode'];
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $department = $_POST['department'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $mobileno = $_POST['mobileno'];
        $status = 1;

        $sql = "INSERT INTO tblemployees(EmpId,FirstName,LastName,EmailId,Password,Gender,Dob,Department,Address,City,Country,Phonenumber,Status) VALUES(:empid,:fname,:lname,:email,:password,:gender,:dob,:department,:address,:city,:country,:mobileno,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':department', $department, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':country', $country, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Registro de empleado añadido exitosamente";
        } else {
            $error = "Algo salió mal. Inténtalo de nuevo.";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <!-- Title -->
    <title>Admin | Agregar empleado</title>

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

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../assets/images/FaviconWF.png" type="image/x-icon">

    <!--FUENTE DE GOOGLE PARA EL TEXTO "Admin" -->
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

    <!-- Incluir SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        function valid() {
            var password = document.forms["addemp"]["password"].value;
            var confirmpassword = document.forms["addemp"]["confirmpassword"].value;
            
            // Check if any field is empty
            var fields = ["empcode", "firstName", "lastName", "email", "password", "confirmpassword", 
                          "department", "gender", "dob", "address", "city", "country", "mobileno"];
            for (var i = 0; i < fields.length; i++) {
                if (document.forms["addemp"][fields[i]].value === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos vacíos',
                        text: 'Por favor, completa todos los campos antes de agregar el empleado.',
                        confirmButtonColor: '#3085d6'
                    });
                    return false;
                }
            }

            // Check if passwords match
            if (password != confirmpassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Contraseña no coincide',
                    text: 'La nueva contraseña y la confirmación no coinciden.',
                    confirmButtonColor: '#3085d6'
                });
                return false;
            }

            return true;
        }
    </script>

    <script>
        function checkAvailabilityEmpid() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'empcode=' + $("#empcode").val(),
                type: "POST",
                success: function (data) {
                    $("#empid-availability").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
            });
        }
    </script>

    <script>
        function checkAvailabilityEmailid() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#email").val(),
                type: "POST",
                success: function (data) {
                    $("#emailid-availability").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
            });
        }
    </script>

</head>

<body>

    <?php include('includes/header.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Agregar empleado</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <form id="example-form" method="post" name="addemp" onsubmit="return valid();">
                            <div>
                                <h4 style="margin-left: 20px;"><b>Información del empleado</b></h4>
                                <section>
                                    <div class="wizard-content">
                                        <div class="row">
                                            <div class="col m6">
                                                <div class="row">
                                                    <?php if ($error) { ?>
                                                        <div class="errorWrap"><strong>ERROR</strong>:
                                                            <?php echo htmlentities($error); ?>
                                                        </div>
                                                    <?php } else if ($msg) { ?>
                                                        <div class="succWrap"><strong>SUCCESS</strong>:
                                                            <?php echo htmlentities($msg); ?>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="input-field col  s12">
                                                        <label for="empcode">Employee Code(Must be unique)</label>
                                                        <input name="empcode" id="empcode"
                                                            onBlur="checkAvailabilityEmpid()" type="text"
                                                            autocomplete="off" >
                                                        <span id="empid-availability" style="font-size:12px;"></span>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="firstName">Nombre</label>
                                                        <input id="firstName" name="firstName" type="text" >
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="lastName">Apellido</label>
                                                        <input id="lastName" name="lastName" type="text"
                                                            autocomplete="off" >
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="email">Email</label>
                                                        <input name="email" type="email" id="email"
                                                            onBlur="checkAvailabilityEmailid()" autocomplete="off"
                                                            >
                                                        <span id="emailid-availability" style="font-size:12px;"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="password">Password</label>
                                                        <input id="password" name="password" type="password"
                                                            autocomplete="off" >
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="confirm">Confirm password</label>
                                                        <input id="confirm" name="confirmpassword" type="password"
                                                            autocomplete="off" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col m6">
                                                <div class="row">

                                                    <div class="input-field m6 s12" style="margin-left: 14px;">
                                                        <select name="department" autocomplete="off">
                                                            <option value="">Departamento...</option>
                                                            <?php $sql = "SELECT DepartmentName from tbldepartments";
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                                                            if ($query->rowCount() > 0) {
                                                                foreach ($results as $result) { ?>
                                                                    <option
                                                                        value="<?php echo htmlentities($result->DepartmentName); ?>">
                                                                        <?php echo htmlentities($result->DepartmentName); ?>
                                                                    </option>
                                                                <?php }
                                                            } ?>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <select name="gender" autocomplete="off">
                                                            <option value="">Género...</option>
                                                            <option value="Male">Masculino</option>
                                                            <option value="Female">Hembra</option>
                                                            <option value="Other">Otro</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label style="cursor: pointer;" for="birthdate">Fecha de
                                                            nacimiento</label>
                                                        <input style="cursor: pointer;" id="birthdate" name="dob"
                                                            type="date" class="datepicker" autocomplete="off">
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="address">Dirección</label>
                                                        <input id="address" name="address" type="text"
                                                            autocomplete="off" >
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="city">Ciudad / Pueblo</label>
                                                        <input id="city" name="city" type="text" autocomplete="off"
                                                            >
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="country">País</label>
                                                        <input id="country" name="country" type="text"
                                                            autocomplete="off" >
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="phone">Número de teléfono móvil</label>
                                                        <input id="phone" name="mobileno" type="tel" maxlength="10"
                                                            autocomplete="off" >
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="input-field col s12 center-align">
                                                <button type="submit" name="add" id="add"
                                                    class="waves-effect waves-light btn indigo m-b-xs">AGREGAR
                                                    EMPLEADO</button>
                                            </div>

                                        </div>
                                    </div>
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
    <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="../assets/js/alpha.min.js"></script>
    <script src="../assets/js/pages/form_elements.js"></script>

</body>

</html>
<?php } ?>
