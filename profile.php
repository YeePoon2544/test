<?php
include './condb.php';

if ($_SESSION['login'] != "TUlibrary") {
    header("location:login.php");
}

$SQLperson = "select * from person where emp_empid = '" . $_SESSION["empid"] . "' ";
$PerRecords = mysqli_query($conn, $SQLperson);
while ($rowPerson = mysqli_fetch_assoc($PerRecords)) {
    //$_SESSION["empid"] = $rowPerson['emp_empid'].'.jpg';
    $name = $rowPerson['thai_name'];
    $NewName = $rowPerson['pic'];
    $TimeName = $rowPerson['thai_name'];
    $nameEng = $rowPerson['english_name'];
    $position = $rowPerson['position'] . $rowPerson['tit_typename'];
    $emptype = $rowPerson['emptype_name'];
    $mail = $rowPerson['email'];
    $address = $rowPerson['curr_address'];
    $tel = $rowPerson['tel_no'];
    $suborgname = $rowPerson['suborgname'];
    $department = $rowPerson['department'];
    $start_date = $rowPerson['fst_emp_date'];
    //$end_date = $rowPerson['retire60'];
    $life_date = $rowPerson['retire60'] - $start_date;

    //$end_date = new DateTime($rowPerson['retire60']);
    $end_date = $rowPerson['retire60'];
    //echo $end_date->format('d.m.Y');

    //------------ แสดงวันเดือนปี อายุงาน ------------
    $birthday = $rowPerson['fst_emp_date'];      //รูปแบบการเก็บค่าข้อมูลวันเกิด
    $today = date("Y-m-d");   //จุดต้องเปลี่ยน

    list($byear, $bmonth, $bday) = explode("-", $birthday);       //จุดต้องเปลี่ยน
    list($tyear, $tmonth, $tday) = explode("-", $today);                //จุดต้องเปลี่ยน

    $mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear);
    $mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear);
    $mage = ($mnow - $mbirthday);

    $u_y = date("Y", $mage) - 1970;
    $u_m = date("m", $mage) - 1;
    $u_d = date("d", $mage) - 1;

    if ($life_date != null) {
        $percen_date =  (($u_y * 100) / $life_date) . "%";
    } else {
        $percen_date = "0%";
    }
}

$SQLContract = "select * from contract where id = '" . $_SESSION["empid"] . "' order by contract_ed_thdate desc LIMIT 1";
$ConRecords = mysqli_query($conn, $SQLContract);

if (mysqli_num_rows($ConRecords) > 0) {
    while ($rowContract = mysqli_fetch_assoc($ConRecords)) {
        $type_contract = $rowContract['type_contract'];
        $contract_ed_date = $rowContract['contract_ed_thdate'];
        //$contract_ed_date = $contract_ed_date->format('d.M.Y');
    }
} else {
    $type_contract = "";
    $contract_ed_date = "";
}

$news = "2022-8-31";
?>

<div class="card card-custom gutter-b">
    <div class="card-body">
        <!--begin::Top-->
        <div class="d-flex">
            <!--begin::Pic-->
            <div class="flex-shrink-0 mr-7">
                <div class="symbol symbol-50 symbol-lg-120">
                    <img alt="Pic" src="picture/<?= $NewName . '.jpg' ?>" />
                </div>
            </div>
            <!--end::Pic-->
            <!--begin: Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                    <!--begin::User-->
                    <div class="mr-3">
                        <!--begin::Name-->
                        <a href="?menu=ประวัติส่วนตัว" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $name . ' (' . $nameEng . ')' ?></a>
                        <!--end::Name-->
                        <!--begin::Contacts-->
                        <div class="d-flex flex-wrap my-2">
                            <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span><span class="text-muted font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"><?= $emptype . ' ตำแหน่ง ' . $position ?></span>

                            <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                                        <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span><span class="text-muted font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"><?= 'สังกัด ' . $suborgname . ' ' . $department ?></span>
                        </div>
                        <!--end::Contacts-->
                    </div>
                    <!--begin::User-->
                    <!--begin::Actions-->
                    <div class="my-lg-0 my-1">
                        <a href="?menu=ประวัติส่วนตัว" class="btn btn-sm btn-light-primary font-weight-bolder">แก้ไข&nbsp;&nbsp;<i class="far fa-edit icon-nm"></i></a>
                        <!-- <a href="#" class="btn btn-sm btn-primary font-weight-bolder"><i class="fas fa-user-edit text-white icon-nm"></i></a> -->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Title-->
                <!--begin::Content-->
                <div class="d-flex align-items-center flex-wrap justify-content-between">
                    <!--begin::Description-->
                    <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5"><?= $address ?><br />
                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span><span class="text-muted font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"><?= $mail ?></span>

                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M11.914857,14.1427403 L14.1188827,11.9387145 C14.7276032,11.329994 14.8785122,10.4000511 14.4935235,9.63007378 L14.3686433,9.38031323 C13.9836546,8.61033591 14.1345636,7.680393 14.7432841,7.07167248 L17.4760882,4.33886839 C17.6713503,4.14360624 17.9879328,4.14360624 18.183195,4.33886839 C18.2211956,4.37686904 18.2528214,4.42074752 18.2768552,4.46881498 L19.3808309,6.67676638 C20.2253855,8.3658756 19.8943345,10.4059034 18.5589765,11.7412615 L12.560151,17.740087 C11.1066115,19.1936265 8.95659008,19.7011777 7.00646221,19.0511351 L4.5919826,18.2463085 C4.33001094,18.1589846 4.18843095,17.8758246 4.27575484,17.613853 C4.30030124,17.5402138 4.34165566,17.4733009 4.39654309,17.4184135 L7.04781491,14.7671417 C7.65653544,14.1584211 8.58647835,14.0075122 9.35645567,14.3925008 L9.60621621,14.5173811 C10.3761935,14.9023698 11.3061364,14.7514608 11.914857,14.1427403 Z" fill="#000000" />
                                </g>
                            </svg><!--end::Svg Icon-->
                        </span><span class="text-muted font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2"><?= $tel ?></span>
                    </div>
                    <!--end::Description-->
                    <!--begin::Progress-->
                    <div class="d-flex mt-4 mt-sm-0">
                        <span class="font-weight-bold mr-4">วันปฏิบัติงาน<br><?= thai_date($start_date); ?></span>
                        <div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= $percen_date ?>;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="font-weight-bolder text-dark ml-4">วันเกษียณ<br><?= thai_date($end_date); ?></span>
                    </div>
                    <!--end::Progress-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Top-->
        <!--begin::Separator-->
        <div class="separator separator-solid my-7"></div>
        <!--end::Separator-->
        <!--begin::Bottom-->
        <div class="d-flex align-items-center flex-wrap">
            <!--begin: Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                <span class="mr-4">
                    <i class="flaticon2-time icon-2x text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm">อายุงาน</span>
                    <span class="font-weight-bolder font-size-h6">
                        <?php
                        echo "$u_y  ปี    $u_m เดือน  $u_d วัน";
                        ?></span>
                </div>
            </div>
            <!--end: Item-->
            <!--begin: Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                <span class="mr-4">
                    <i class="flaticon2-contract icon-2x text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm"><?php if ($type_contract != "") {
                                                                        echo "ปัจจุบัน" . $type_contract;
                                                                    } else {
                                                                        echo "ไม่มีสัญญา";
                                                                        $contract_ed_date = "-";
                                                                    } ?></span>
                    <span class="font-weight-bolder font-size-h6">
                        <span class="text-dark-50 font-weight-bold">Exp </span><?php if ($type_contract != "") {
                                                                                    echo thai_date($contract_ed_date);
                                                                                } else {
                                                                                    echo "-";
                                                                                } ?></span>
                </div>
            </div>
            <!--end: Item-->

            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                <span class="mr-4">
                    <a href="http://203.131.211.57/ThaiCom-TUHR/" target="_blank" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"><i class="flaticon-presentation-1 icon-2x text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    ชั่วโมงอบรมประจำปี</a>
                    <span class="font-weight-bolder font-size-h6">
                        <span class="font-weight-bolder font-size-h6">33 ชั่วโมง 30 นาที</span>
                </div>
            </div>

            <!--begin: Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                <span class="mr-4">
                    <a href="http://203.131.211.57/ThaiCom-TUHR/" target="_blank" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"><i class="flaticon-calendar-with-a-clock-time-tools icon-2x text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    ระบบลางานออนไลน์</a>
                    <span class="font-weight-bolder font-size-h6">
                        <span class="text-dark-50 font-weight-bold">มหาวิทยาลัยธรรมศาสตร์</span></span>
                </div>
            </div>
            <!--end: Item-->
            <!--begin: Item-->
            <!--                                             <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                                                <span class="mr-4">
                                                    <a href="https://slip.tu.ac.th/Login.aspx" target="_blank" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"><i class="flaticon-coins icon-2x text-muted font-weight-bold"></i>
                                                </span>
                                                <div class="d-flex flex-column text-dark-75">
                                                    ใบแจ้งการจ่ายเงินเดือน/ค่าจ้าง</a>
                                                    <span class="font-weight-bolder font-size-h6">
                                                    <span class="text-dark-50 font-weight-bold">มหาวิทยาลัยธรรมศาสตร์</span></span>
                                                </div>
                                            </div> -->
            <!--end: Item-->
            <!--begin: Item-->

            <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <div class="card-title collapsed text-hover-primary" data-toggle="collapse" data-target="#collapseOne">
                            <i class="fas fa-award"></i> เครื่องราชอิสริยาภรณ์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div id="collapseOne" class="collapse" data-parent="#accordionExample4">
                        <div class="card-body">

                            <div class="card card-custom gutter-b card-stretch">
                                <!--begin::Body-->
                                <div class="card-body pt-1">
                                    <!--begin::Info-->
                                    <div class="mb-0">
                                        <?php
                                        $SQLinsignia = "select * from insignia where emp_empid = '" . $_SESSION["empid"] . "' ORDER BY decor_thaidate DESC";
                                        $insigniaRecords = mysqli_query($conn, $SQLinsignia);

                                        while ($rowInsignia = mysqli_fetch_assoc($insigniaRecords)) {
                                            // if ($rowContract['thprefix'] == "นาย") { $imgINS = $rowInsignia['dec_title'].'ชาย.png'; } else { $imgINS = $rowInsignia['dec_title'].'.png'; }
                                            $imgINS = $rowInsignia['dec_title'] . '.png';
                                        ?>
                                            <div class="d-flex align-items-left">
                                                <div class="symbol symbol-40 mr-1">
                                                    <img class="" src="picture/insignia/<?= $imgINS ?>" alt="photo">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="d-flex justify-content-between align-items-left flex-column mb-7">
                                                        <span class="text-dark-75 font-weight-bolder"><?= $rowInsignia['dec_title'] ?></span>
                                                        <span class="text-muted font-weight-bolder"><?= thai_date($rowInsignia['decor_thaidate']); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Body-->
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <!--end: Item-->
        </div>
        <!--end::Bottom-->
    </div>
</div>


<div class="row">
    <div class="col-xl-6">
        <!--begin::Advance Table Widget 1-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">ประชาสัมพันธ์</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">หอสมุดแห่งมหาวิทยาลัยธรรมศาสตร์</span>
                </h3>

                <!--begin::Table-->
                <!-- <div class="table-responsive"> -->
                <table class="table table-head-custom table-vertical-center">
                    <thead>
                        <tr class="text-left">
                            <th class="pr-0" style="width: 50px"></th>
                            <th style="min-width: 150px"></th>
                            <th style="min-width: 150px"></th>
                            <th class="pr-0 text-center" style="min-width: 150px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $HealthQuery = "select * from mst_welfare where emp_empid = '" . $_SESSION["empid"] . "' ORDER BY `mst_welfare`.`welfare_date` DESC";
                        $HealthRecords = mysqli_query($conn, $HealthQuery);
                        while ($rowHealth = mysqli_fetch_assoc($HealthRecords)) {
                        ?>

                            <tr>
                                <td class="pr-0">
                                    <div class="btn btn-icon btn-lg pulse pulse-success">
                                        <span class="svg-icon svg-icon-xl svg-icon-success">
                                            <i class="fas fa-user-md text-success"></i>
                                        </span>
                                        <span class="pulse-ring"></span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <a href="?menu=สวัสดิการด้านสุขภาพ" class="text-dark-75 font-weight-bolder text-hover-success mb-1 font-size-lg"><?= $rowHealth['welfare_desc'] ?></a>
                                    <span class="text-muted font-weight-bold text-muted d-block">วันที่ยื่นเบิก <?= thai_date($rowHealth['welfare_date']); ?> ยอดเงิน ฿<?= number_format($rowHealth['total'], 2) ?></span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">วันที่สถานะ</span>
                                    <span class="text-muted font-weight-bold"><?= thai_date($rowHealth['welfare_date']); ?></span>
                                </td>
                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">สถานะ</span>
                                    <span class="text-muted font-weight-bold text-muted d-block">


                                        <?php if ($rowHealth['status'] == 'wait') {
                                            $alert = "primary";
                                        } else if ($rowHealth['status'] == 'unapproved') {
                                            $alert = "danger";
                                        } else if ($rowHealth['status'] == 'approved') {
                                            $alert = "success";
                                        } else if ($rowHealth['status'] == 'in process') {
                                            $alert = "warning";
                                        } else if ($rowHealth['status'] == 'in send') {
                                            $alert = "info";
                                        } ?>

                                        <span class="label label-<?= $alert; ?> label-dot mr-2"></span>
                                        <span class="font-weight-bold text-<?= $alert; ?>"><?= $rowHealth['status'] ?></span></span>
                                </td>
                            </tr>

                        <?php }
                        mysqli_close($conn);

                        include 'ConTime.php';
                        $TimeQuery = "select * from tb_timestamp where fullname LIKE '" . $TimeName . "' order by date_stamp desc LIMIT 1";
                        $TimeRecords = mysqli_query($conT, $TimeQuery);
                        while ($rowTime = mysqli_fetch_assoc($TimeRecords)) {
                        ?>

                            <tr>
                                <td class="pr-0">
                                    <div class="btn btn-icon btn-clean btn-lg pulse pulse-danger">
                                        <span class="svg-icon svg-icon-xl svg-icon-danger">
                                            <i class="far fa-clock text-danger"></i>
                                        </span>
                                        <span class="pulse-ring"></span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-danger mb-1 font-size-lg">เวลาเข้าออกงาน</a>
                                    <span class="text-muted font-weight-bold text-muted d-block">เวลาเข้างาน <?= $rowTime['time_in'] ?> น. เวลาออกงาน <?= $rowTime['time_out'] ?> น.</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">วันที่ลงเวลา</span>
                                    <span class="text-muted font-weight-bold"><?= thai_date($rowTime['date_stamp']); ?><?php //$date=date_create($rowTime['date_stamp']); echo date_format($date,'d-M-Y'); 
                                                                                                                        ?></span>
                                </td>
                                <td class="pl-0">
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">สถานที่</span>
                                    <span class="text-muted font-weight-bold text-muted d-block"><?= $rowTime['location'] ?></span>
                                </td>
                            </tr>

                        <?php }
                        mysqli_close($conT); ?>
                        <tr>
                            <td class="pr-0">
                                <div class="btn btn-icon btn-clean btn-lg pulse pulse-info">
                                    <span class="svg-icon svg-icon-xl svg-icon-info">
                                        <i class="flaticon2-paperplane text-info icon-xl"></i>
                                    </span>
                                    <span class="pulse-ring"></span>
                                </div>
                            </td>
                            <td class="pl-0">
                                <a href="https://www.facebook.com/Icehrofficial/photos/a.291493754292079/5367091110065626/" target="_blank" class="text-dark-75 font-weight-bolder text-hover-info mb-1 font-size-lg">สถาบันเสริมศึกษาและทรัพยากรมนุษย์ เปิดรับสมัครหลักสูตรอบรมออนไลน์เดือนกันยายน 2565</a>
                                <span class="text-muted font-weight-bold text-muted d-block">กองทรัพยากรมนุษย์</span>
                            </td>
                            <td>
                                <span class="text-dark-75 font-weight-bolder d-block font-size-lg">วันที่ลงประกาศ</span>
                                <span class="text-muted font-weight-bold"><?= thai_date($news); ?></span>
                            </td>
                            <td>

                            </td>

                        </tr>
                    </tbody>
                </table>
                <!--  </div> -->
                <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 1-->
    </div>

    <?php if ($_SESSION["name"] == "กมลวรรณ ปัญญาชนวัฒน์") { ?>

        <div class="col-xl-6">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header border-0 py-5">
                    <p class="font-size-sm">
                        <!-- <span class="card-label font-weight-bolder text-dark">แจ้งเตือน</span> -->
                        <!-- <span class="text-muted mt-3 font-weight-bold font-size-sm">หอสมุดแห่งมหาวิทยาลัยธรรมศาสตร์</span> -->
                        <!-- </h3> -->

                        <!--begin::Table-->
                        <!-- <div class="table-responsive"> -->
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_profile">
                        <thead>
                            <tr>
                                <th class="pr-0" style="width: 280px;"></th>
                                <th style="text-align:center;">ประเภท</th>
                                <th style="text-align:center;">ปีงบประมาณ</th>
                                <th style="width: 250px; text-align:center;">ชื่อ - นามสกุล</th>
                                <th style="width: 50px; text-align:center;">วันที่ยืนเบิก</th>
                                <th style="text-align:center;">สถานะ</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include './condb.php';

                            $HealthQuery = "select * from mst_welfare where status = 'wait'";
                            $HealthRecords = mysqli_query($conn, $HealthQuery);

                            $y = date("Y");
                            $y = $y + 543;

                            while ($rowHealth = mysqli_fetch_assoc($HealthRecords)) {

                            ?>

                                <tr>
                                    <td class="pr-0" style="width:5%;">
                                        <div class="btn btn-icon btn-lg pulse pulse-success">
                                            <span class="svg-icon svg-icon-xl svg-icon-success">
                                                <?php if ($rowHealth['welfare_type'] == "health") { ?>
                                                    <i class="fas fa-user-md text-success"></i>
                                                <?php } ?>
                                            </span>
                                            <span class="pulse-ring"></span>
                                        </div>
                                    </td>
                                    <td style="width:30%;">
                                        <a href="?menu=สวัสดิการด้านสุขภาพ" class="text-dark-75 font-weight-bolder text-hover-success mb-1 font-size-lg"><?= $rowHealth['welfare_desc'] ?></a>
                                        <span class="text-muted font-weight-bold text-muted d-block">ยอดเงิน ฿<?= number_format($rowHealth['total'], 2) ?></span>
                                    </td>
                                    <td style="text-align:center; width:10%;">
                                        <span class="label label-lg font-weight-bold label-light-<?php if ($rowHealth['bug_year'] == $y) {
                                                                                                        echo "success";
                                                                                                    } else {
                                                                                                        echo "primary";
                                                                                                    } ?> label-inline p-6"><?= $rowHealth['bug_year'] ?></span>
                                    </td>

                                    <td style="width:30%;">
                                        <div class="d-flex align-items-center">
                                            <div class="ml-4">
                                                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0"> <?= $rowHealth['thai_name'] ?> </div>
                                                <div class="text-muted font-weight-bold font-size-lg"><?= $rowHealth['suborgname']; ?></div>
                                            </div>
                                        </div>
                                    </td>

                                    <td style="text-align:center; width:15%;"><?= thai_date($rowHealth['welfare_date']); ?></td>
                                    <td style="text-align:center; width:6%;">
                                        <?php if ($rowHealth['status'] == 'wait') {
                                            $alert = "primary";
                                        } else if ($rowHealth['status'] == 'unapproved') {
                                            $alert = "danger";
                                        } else if ($rowHealth['status'] == 'approved') {
                                            $alert = "success";
                                        } else if ($rowHealth['status'] == 'in process') {
                                            $alert = "warning";
                                        } else if ($rowHealth['status'] == 'in send') {
                                            $alert = "info";
                                        } ?>
                                        <span class="font-weight-bold text-<?= $alert; ?>"><?= $rowHealth['status'] ?></span>
                                    </td>

                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                    <!--  </div> -->
                    <!--end::Table-->
                    </p>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Advance Table Widget 1-->
        </div>




    <?php } else { ?>

        <div class="col-xl-6">
            <!--begin::List Widget 14-->
            <div class="card card-custom card-stretch gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title font-weight-bolder text-dark">แบบฟอร์มสวัสดิการ</h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-2">

                    <a href="?menu=สวัสดิการด้านสุขภาพ">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far flaticon-file-2 mr-2"></i>สวัสดิการด้านสุขภาพ (6,000 บาท)</span>
                            </div>
                        </div>
                    </a>

                    <!--  <a href="document.php?title=eyeglasses" target="_blank"> <div class="d-flex flex-wrap align-items-center mb-4"> -->
                    <!-- <a href="#"> -->
                    <div class="d-flex flex-wrap align-items-center mb-4">

                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                            <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far flaticon-file-2 mr-2"></i>แบบฟอร์มขอเบิกเงินสวัสดิการค่าแว่นสายตา (SOON)</span>
                        </div>
                    </div>
                    <!-- </a> -->
                    <!-- <div class="separator separator-dashed separator-border-2"></div> -->

                    <a href="document.php?title=visit" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>ใบเบิกค่าเยี่ยมไข้</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- <div class="separator separator-dashed separator-border-2"></div> -->

                    <a href="document.php?title=medical-government" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>ใบเบิกค่ารักษาพยาบาล(ข้าราชการ)</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>


                    <a href="document.php?title=education" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>ใบเบิกเงินการศึกษาบุตร</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>


                    <a href="document.php?title=education-government" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>ใบเบิกเงินการศึกษาบุตร (ข้าราชการ)</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="document.php?title=home" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>สวัสดิการเพื่อที่อยู่อาศัย</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="document.php?title=thai_ocean-medical" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>สวัสดิการค่ารักษาพยาบาลไทยสมุทร</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="document\assessment.docx" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>แบบประเมิน พนักงานมหาวิทยาลัย</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="document\employee.docx" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>แบบประเมินพนักงานเงินรายได้ ลูกจ้างประจำ</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="document.php?title=request" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>แบบฟอร์มหนังสือรับรองการทำงาน/เงินเดือน/<br>เพิ่มวุฒิ/เปลี่ยนชื่อ</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSdkGDrFzqZ9ToNo9ib61w1qELyiihJtTcG5A31WAddhvrzn6Q/viewform" target="_blank">
                        <div class="d-flex flex-wrap align-items-center mb-4">
                            <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                <span class="text-dark-75 font-weight-bolder font-size-lg"><i class="far fa-file-pdf text-danger mr-2"></i>แบบฟอร์มขอบัตรอนุญาตนำรถเข้า <br>มหาวิทยาลัยธรรมศาสตร์</span>
                            </div>
                            <div class="d-flex align-items-center py-lg-0 py-2">
                                <div class="d-flex flex-column text-right">
                                    <span class="text-muted font-size-sm font-weight-bolder">Download</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::List Widget 14-->
        </div>
    <?php } ?>
</div>