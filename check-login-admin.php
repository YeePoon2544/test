<?php
include './condb.php';
session_start();
date_default_timezone_set("Asia/Bangkok");
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://restapi.tu.ac.th/api/v1/auth/Ad/verify",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => false,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_POSTFIELDS => "{\n\t\"UserName\":\"" . $_POST['username'] . "\",\n\t\"PassWord\":\"" . $_POST['password'] . "\"\n}",
	CURLOPT_HTTPHEADER => array(
		"Content-Type: application/json",
		"Application-Key: TUd64c19fe6e0070533de8ffb3e6091601e494a8f66c1cebcbff2d3f9f1ad2eae92ad7308112731ca99d861514f1d77ee1"
		//TUd64c19fe6e0070533de8ffb3e6091601e494a8f66c1cebcbff2d3f9f1ad2eae92ad7308112731ca99d861514f1d77ee1
		//ODNjYTUwOTg0Y2M2ZDE4ZDhkMzEyM2Q4NmE4ZjgyYTRlNzVjMTBhNmViYjViZmI0ZTY3YjMzZjY3MmZhNzU5YQ==
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$response = json_decode($response, true);

$status = $response["status"];
$statusWork = $response["StatusWork"];
$message_api = $response["message"];
$organization = $response["organization"];
$username = $response["username"];
$name = $response["displayname_th"];
$email = $response["email"];


// $pos= strpos($email,"@");
// $pop = substr($email,0,$pos);

if ($status === true) {
	//if ($organization == "หอสมุดแห่งมหาวิทยาลัยธรรมศาสตร์" && $statusWork == 1) {
		if ($username == "rapee" || $username == "titima" || $username == "janya" || $username == "joyo" || $username == "awae" || $username == "kamolwan" || $username == "janepp29" && $statusWork == 1) {
	$responseData['statusCode'] = 200;
	$_SESSION["status"] = $message_api;
	$_SESSION["username"] = $username;
	$_SESSION["organization"] = $organization;
	$_SESSION["menu"] = "admin-TUlibrary";
	$_SESSION["login"] = "TUlibrary";

	 //if( $username == "rapee" ) { $name = "กมลวรรณ ปัญญาชนวัฒน์";} 
	 //if( $username == "rapee" ) { $name = "รุ่งทิวา กรีวาส";} 
	//if( $username == "rapee" ) { $name = "ฐิติมา เธียรอนันตกุล";}
//if( $username == "rapee" ) { $name = "เจนจิรา อาบสีนาค";}

	$_SESSION["name"] = $name;

	$SQLPic = "select * from `person` where `thai_name` = '".$name."' ";
	$PicRecords = mysqli_query($conn, $SQLPic);
	while ($rowContract = mysqli_fetch_assoc($PicRecords)) {
			$_SESSION["empid"] = $rowContract['emp_empid'];
			$_SESSION["pic"] = $rowContract['pic'];
			$_SESSION["name"] = $rowContract['thai_name'];
		} 

	echo json_encode($responseData);
	} else {
		$responseData['statusCode'] = 202;
		$_SESSION["login"] = "202";
		echo json_encode($responseData);
	}

} else {
	$responseData['statusCode'] = 201;
	$_SESSION["login"] = "201";
	echo json_encode($responseData);
}