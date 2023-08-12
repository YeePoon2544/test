<?php
if (isset($_GET['menu'])) {
	$menu = $_GET['menu'];
} else {
	$menu = '';
}
switch ($menu) {
	case "dasboard":
		$src_page = 'dasboard.php';
		$page_name = 'Overview';
		break;

	case "รายชื่อบุคลากร":
		$src_page = 'person.php';
		$page_name = 'รายชื่อบุคลากร';
		break;

	case "ประวัติส่วนตัว":
		$src_page = 'person-edit.php';
		$page_name = 'ประวัติส่วนตัว';
		break;

	case "ประวัติการศึกษา":
		$src_page = 'pop.php';
		$page_name = 'ประวัติการศึกษา';
		break;

	case "ประวัติสัญญาการจ้างงาน":
		$src_page = 'contract.php';
		$page_name = 'ประวัติสัญญาการจ้างงาน';
		break;

	case "ประวัติการรับเครื่องราชอิสริยาภรณ์":
		$src_page = 'insignia.php';
		$page_name = 'ประวัติการรับเครื่องราชอิสริยาภรณ์';
		break;

	case "สัญญาจ้าง":
		$src_page = 'contract_person.php';
		$page_name = 'สัญญาจ้าง';
		break;

	case "ข้อมูลสัญญา":
		$src_page = 'contract_view.php';
		$page_name = 'ข้อมูลสัญญา';
		break;

	case "อัพโหลดสัญญา":
		$src_page = 'contract_person_upload.php';
		$page_name = 'อัพโหลดสัญญา';
		break;

	case "เพิ่มข้อมูลสัญญา":
		$src_page = 'contract_person_add.php';
		$page_name = 'เพิ่มข้อมูลสัญญา';
		break;

	case "แบบฟอร์มขอเบิกเงินสวัสดิการค่าแว่นสายตา":
		$src_page = 'form_eye.php';
		$page_name = 'แบบฟอร์มขอเบิกเงินสวัสดิการค่าแว่นสายตา';
		break;

	case "สวัสดิการด้านสุขภาพ":
		$src_page = 'menu_health.php';
		$page_name = 'สวัสดิการด้านสุขภาพ';
		break;

	case "สวัสดิการค่าแว่นสายตา":
		$src_page = 'menu_glasses.php';
		$page_name = 'สวัสดิการค่าแว่นสายตา';
		break;

	case "อนุมัติสวัสดิการด้านสุขภาพ":
		$src_page = 'App_Health.php';
		$page_name = 'อนุมัติสวัสดิการด้านสุขภาพ';
		break;

	case "แบบฟอร์มขอเบิกเงินสวัสดิการด้านสุขภาพ":
		$src_page = 'form_health.php';
		$page_name = 'แบบฟอร์มขอเบิกเงินสวัสดิการด้านสุขภาพ';
		break;

	case "แก้ไขเบิกเงินสวัสดิการด้านสุขภาพ":
		$src_page = 'form_healthEdit.php';
		$page_name = 'แก้ไขเบิกเงินสวัสดิการด้านสุขภาพ';
		break;

	case "รายการลงเวลาเข้างาน":
		$src_page = 'timestamps.php';
		$page_name = 'รายการลงเวลาเข้างาน';
		break;

	case "รายการลงชื่อในหน่วยงาน":
		$src_page = 'timestamps-team.php';
		$page_name = 'รายการลงชื่อเข้าออกงานของคนในหน่วยงาน';
		break;

	case "รายการวันWFH":
		$src_page = 'timestamp-team-wfh.php';
		$page_name = 'รายการลงชื่อวันWFHของคนในหน่วยงาน';
		break;

	case "test":
		$src_page = 'test.php';
		$page_name = 'test';
		break;

	case "InputTraining":
		$src_page = 'form_InputTraining.php';
		$page_name = 'InputTraining';
		break;

	case "AddHealth":
		$src_page = 'AddSaveHealth.php';
		$page_name = 'AddHealth';
		break;

	case "UpdateHealth":
		$src_page = 'UpdateHealth.php';
		$page_name = 'UpdateHealth';
		break;

	case "AddProfile":
		$src_page = 'AddSaveProfile.php';
		$page_name = 'AddProfile';
		break;

	case "DelContract":
		$src_page = 'DelContract.php';
		$page_name = 'DelContract';
		break;

	case "DelHealth":
		$src_page = 'DelHealth.php';
		$page_name = 'DelHealth';
		break;

	case "PrintHealth":
		$src_page = 'PrintHealth.php';
		$page_name = 'PrintHealth';
		break;

	case "PrintRegTrain":
		$src_page = 'PrintRegTrain.php';
		$page_name = 'PrintRegTrain';
		break;

	case "TrainingOut":
		$src_page = 'menu_train_out.php';
		$page_name = 'TrainingOut';
		break;

	case "Training":
		$src_page = 'Training.php';
		$page_name = 'Training';
		break;

	case "ListTrain":
		$src_page = 'ListTraining.php';
		$page_name = 'ListTrain';
		break;

	case "AddTrain":
		$src_page = 'form_add_train_in.php';
		$page_name = 'AddTrain';
		break;

	case "AddTrainOut":
		$src_page = 'form_add_train_out.php';
		$page_name = 'AddTrainOut';
		break;

	case "AddTrainSave":
		$src_page = 'Add_Train.php';
		$page_name = 'AddTrainSave';
		break;

	case "AddTrainOutSave":
		$src_page = 'Add_Train_Out.php';
		$page_name = 'AddTrainOutSave';
		break;

	case "RegTrainSave":
		$src_page = 'Add_Train_Detail.php';
		$page_name = 'RegTrainSave';
		break;

	case "ShowTrain":
		$src_page = 'Show_Train.php';
		$page_name = 'ShowTrain';
		break;

	case "ShowTrainMember":
		$src_page = 'Reg_Train.php';
		$page_name = 'ShowTrainMember';
		break;

	case "DelTrainDetail":
		$src_page = 'Del_Train_Detail.php';
		$page_name = 'DelTrainDetail';
		break;

	case "EditTrain":
		$src_page = 'form_edit_train.php';
		$page_name = 'EditTrain';
		break;

		// case "logout-admin":
		// 		$src_page = 'login_admin.php';
		// 		$page_name = 'logout-admin';
		// 		break;

		// case "logout":
		// 		$src_page = 'login.php';
		// 		$page_name = 'logout';
		// 		break;						

	default:
		$src_page = 'profile.php';
		$page_name = 'หน้าหลัก';
}
