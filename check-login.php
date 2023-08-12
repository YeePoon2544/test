<?php
include './condb.php';
session_start();


if ($_POST['username'] == "japan" && $_POST['password'] == "Japan2023") {

	$responseData['statusCode'] = 200;
	$_SESSION["status"] = "ปกติ";
	$_SESSION["username"] = "rapee";
	$_SESSION["organization"] = "หอสมุดแห่งมหาวิทยาลัยธรรมศาสตร์";
	$_SESSION["login"] = "TUlibrary";
	$_SESSION["menu"] = "menu";
	$_SESSION["name"] = "รพีพร บูรณะเสน";


		$SQLPic = "select * from person where thai_name = '".$_SESSION["name"]."' ";
		$PicRecords = mysqli_query($conn, $SQLPic);

		if (mysqli_num_rows($PicRecords) > 0) {

			while ($rowContract = mysqli_fetch_assoc($PicRecords)) {
				$_SESSION["empid"] = $rowContract['emp_empid'];
				$_SESSION["pic"] = $rowContract['pic'];
			} 
				echo json_encode($responseData);
		} else {
				$responseData['statusCode'] = 203;
				$_SESSION["login"] = "203";
				echo json_encode($responseData);
		} 

} else {
	$responseData['statusCode'] = 201;
	$_SESSION["login"] = "201";
	echo json_encode($responseData);
}