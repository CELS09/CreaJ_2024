<?php
session_start();
error_reporting(0);
include('includes/config.php');
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
            $msg = "Su cuenta está inactiva. Por favor contacte al administrador";
        } else {
            $_SESSION['emplogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location = 'emp-changepassword.php'; </script>";
        }
    } else {
        echo "<script>alert('DATOS INVÀLIDOS');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loggin Empleado</title>

    <!--FAVICON-->
    <link rel="shortcut icon" href="../assets\images\FaviconWF.png" type="image/x-icon">

    <!--TAILWIND-->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-300">


    <div class="flex justify-center items-center h-screen">
        <div class="w-full sm:w-10/12 md:w-8/12 lg:w-6/12 xl:w-4/12">
            <div class="bg-teal-700 shadow-md rounded-md p-8">
                <h2 class="text-2xl text-center font-semibold mb-6">Login del empleado</h2>
                <?php if ($msg) { ?>
                    <div class="bg-red-100 text-red-600 p-3 rounded-md mb-4">
                        <strong>Error:</strong> <?php echo htmlentities($msg); ?>
                    </div>
                <?php } ?>
                <form class="space-y-4" name="signin" method="post">
                    <div>
                        <label for="username" class="block text-gray-700">Email</label>
                        <input id="username" type="text" name="username" class="block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-teal-500" autocomplete="off" required>
                    </div>
                    <div>
                        <label for="password" class="block text-gray-700">Password</label>
                        <input id="password" type="password" name="password" class="block w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-teal-500" autocomplete="off" required>
                    </div>
                    <div class="flex flex-col">
                        <button type="submit" name="signin" class="inline-block bg-teal-500 hover:bg-teal-600 text-black font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out">INGRESAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>