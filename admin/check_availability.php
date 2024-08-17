<?php
require_once("includes/config.php");
// code for empid availablity
if (!empty($_POST["empcode"])) {
	$empid = $_POST["empcode"];

	$sql = "SELECT EmpId FROM tblemployees WHERE EmpId=:empid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':empid', $empid, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		echo "<span style='color:red'> El ID del empleado ya existe .</span>";
		echo "<script>$('#add').prop('disabled',true);</script>";
	} else {

		echo "<span style='color:green'> Identificación de empleado disponible para registro .</span>";
		echo "<script>$('#add').prop('disabled',false);</script>";
	}
}

// code for emailid availablity
if (!empty($_POST["emailid"])) {
	$empid = $_POST["emailid"];
	$sql = "SELECT EmailId FROM tblemployees WHERE EmailId=:emailid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':emailid', $empid, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		echo "<span style='color:red'> El ID de correo electrónico ya existe .</span>";
		echo "<script>$('#add').prop('disabled',true);</script>";
	} else {

		echo "<span style='color:green'> ID de correo electrónico disponible para el registro .</span>";
		echo "<script>$('#add').prop('disabled',false);</script>";
	}
}
