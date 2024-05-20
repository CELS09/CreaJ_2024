<?php
session_start();
include ('includes/config.php');
if (isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'changepassword.php'; </script>";
    } else {

        echo "<script>alert('Invalid Details');</script>";

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <!-- Title -->
    <title>Inicio de Sesión | Administración</title>

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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!--FAVICON-->
    <link rel="shortcut icon" href="../assets/images/Favicon.png" type="image/x-icon">

</head>

<body class="signin-page bg-gray-900 flex items-center justify-center h-screen">

<div class="container mx-auto p-4">
        <main class="flex flex-col items-center">
            <a href="../index.php" class="text-cyan-400 text-center">
                <h5 class="bg-green-600 w-32 font-bold rounded-xl text-xl font-bold">Regresar</h5>
            </a>
            <h4 class="text-white text-2xl font-bold mt-2 mb-6">Login de administrador</h4>
            <div class="w-full max-w-sm">
                <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <span class="block text-gray-700 text-center text-xl font-bold mb-2">Iniciar sesión</span>
                    </div>
                    <form name="signin" method="post">
                        <div class="mb-4">
                            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Nombre de usuario</label>
                            <input id="username" type="text" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" autocomplete="off" required>
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                            <input id="password" type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" autocomplete="off" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <input type="submit" name="signin" value="INGRESAR" class="bg-green-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- Javascripts -->
    <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="../assets/js/alpha.min.js"></script>

</body>
</html>
