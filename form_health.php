<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    fieldset {
        border: 3px solid #cecfd5;
        border-radius: 6px;
        padding: 24px 30px;

    }

    hr.new {
        border-top: 1px dotted red;
    }
</style>

<?php
if ($_SESSION['login'] != "TUlibrary") {
    header("location:login.php");
}

include './condb.php';

$emp_empid = $_SESSION["empid"];
$SQLperson = "select * from person where emp_empid = '" . $emp_empid . "' ";
$PerRecords = mysqli_query($conn, $SQLperson);
while ($rowPerson = mysqli_fetch_assoc($PerRecords)) {
    $name = $rowPerson['thai_name'];
    $id_card = $rowPerson['id_card_no'];
    $position = $rowPerson['position'] . $rowPerson['tit_typename'];
    $emptype = $rowPerson['emptype_name'];
    $tel = $rowPerson['tel_no'];
    $suborgname = $rowPerson['suborgname'];
    $department = $rowPerson['department'];
}

$m = date("m");
$y = date("Y");
$Total = 0;
if ($m > 9) {
    $y = $y + 544;
} else {
    $y = $y + 543;
}

$SQLTotal = "select total from mst_welfare where emp_empid = '" . $emp_empid . "' and bug_year = '" . $y . "' and status <> 'unapproved' ";
$TotalRecords = mysqli_query($conn, $SQLTotal);
while ($rowTotal = mysqli_fetch_assoc($TotalRecords)) {
    $Total = $Total + $rowTotal['total'];
}
$Total = 6000 - $Total;

// if (isset($_POST['submit'])) {

//   for ($ii = 1; $ii <= 3; $ii++) {
//       if ($ii == 1) { $F = $_FILES["filUpload1"];} else if ($ii == 2) { $F = $_FILES["filUpload2"];} else if ($ii == 3) { $F = $_FILES["filUpload3"];} else { $F = ""; }
//         if($F["size"]>0)
//               {
//                  if($F["size"]>1024*25000)  ///ขนาดของไฟล์ที่อัพโหลด 
//                    {
//                      //echo "<script>alert('ขนาดไฟล์ห้ามเกิน 25 Mb');</script>";
//                      echo '<script type="text/javascript">
//                             swal("ขนาดไฟล์ห้ามเกิน 25 Mb", "", "warning");
//                            </script>';
//                      exit();
//                    }

//                  if(($F["type"]!="application/pdf")) //file .doc
//                     {
//                     echo '<script type="text/javascript">
//                           swal("รองรับเฉพาะ file .pdf ", "", "warning");
//                          </script>';
//                    exit();
//                    } 
//               } 
//   }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <h4 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">แบบฟอร์มขอเบิกเงินสวัสดิการด้านสุขภาพ (6,000 บาท)</span>
                    <span class="form-text text-muted">(งบประมาณปี <?= $y; ?> เบิกได้อีก <?= number_format($Total, 2); ?> บาท)</span>
                </h4>
            </div>
        </div>

        <!-- <form action="" name="add_name" id="add_name" method="post"> -->
        <form action="?menu=AddHealth" name="frmAdd" id="frmAdd" method="post" enctype="multipart/form-data">
            <div id="wrapper">

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Begin Page Content -->
                        <div class="container-fluid"><br>
                            <div class="form-group row">
                                <label class="col-form-label">ข้าพเจ้า</label>
                                <div class="col-lg-3 col-xl-3">
                                    <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?= $name ?>" name="thai_name" disabled="disabled" />
                                    <input type="hidden" value="<?= $name; ?>" id="thai_name" name="thai_name">
                                </div>

                                <label class="col-form-label">&nbsp;ตำแหน่ง</label>
                                <div class="col-lg-3 col-xl-3">
                                    <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?= $position ?>" name="position" disabled="disabled" />
                                    <input type="hidden" value="<?= $position; ?>" id="position" name="position">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label">สังกัด</label>
                                <div class="col-lg-3 col-xl-3">
                                    <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?= $suborgname ?>" name="suborgname" disabled="disabled" />
                                    <input type="hidden" value="<?= $suborgname; ?>" id="suborgname" name="suborgname">
                                </div>
                                <label class="col-form-label">&nbsp;โทร</label>
                                <div class="col-lg-1 col-xl-2">
                                    <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?= $tel ?>" name="tel" disabled="disabled" />
                                    <input type="hidden" value="<?= $tel; ?>" id="tel" name="tel">
                                </div>
                                <!--                     <label class="col-form-label">วันที่ยืนเอกสาร</label>
                    <div class="col-lg-1 col-xl-1">
                        <input class="form-control form-control-sm" type="hidden" value="<?php echo date('Y-m-d'); ?>" id="bug_date" name="bug_date" >
                    </div>  -->
                            </div>

                            <fieldset class="border-primary">
                                <legend>ขอเบิกเงินค่ารักษาพยาบาลของ</legend>
                                <table class="table table-bordered" id="dynamic_field" border=none>
                                    <div class="form-group strategy1">
                                        <div class="product_wrapper_Results">
                                            <div class="row">
                                                <div>
                                                    <button type="button" name="add" id="add" class="btn btn-icon btn-success label label-xl">+</button>
                                                    <label><span class="label label-xl font-weight-boldest label-rounded label-warning ">1</span></label>
                                                    <!-- <input type="hidden" value="<?= $i; ?>" id="line" name="line"> -->
                                                </div>

                                                <div class="col-lg-1">
                                                    <select class="custom-select txtstrategy1" name="txtstrategy1" id="txtstrategy1" required>
                                                        <option value="" selected hidden>เลือก</option>
                                                        <option value="ตนเอง">ตนเอง</option>
                                                        <option value="คู่สมรส">คู่สมรส</option>
                                                        <option value="บิดา">บิดา</option>
                                                        <option value="มารดา">มารดา</option>
                                                        <option value="บุตร">บุตร</option>
                                                    </select>
                                                    <input type="hidden" value="<?php echo date('Y-m-d'); ?>" id="bug_date" name="bug_date">
                                                    <input type="hidden" value="<?= $name; ?>" id="name" name="name">
                                                    <input type="hidden" value="<?= $id_card; ?>" id="id_card" name="id_card">

                                                </div>

                                                <div>
                                                    <input class="txtStrategic_obj11 form-control col-11" type="text" value="" id="txtStrategic_obj11" name="txtStrategic_obj11" placeholder="ชื่อ-นามสกุล" maxlength="100" required>
                                                </div>

                                                <div>
                                                    <input class="txtStrategic_obj21 form-control col-10" type="text" value="" id="txtStrategic_obj21" name="txtStrategic_obj21" placeholder="เลขประจำตัวประชาชน" maxlength="100" required>
                                                </div>


                                                <label for="st-date" class="txtStrategic_obj31 col-form-label" name="txtStrategic_obj31">เกิดเมื่อ <span class="text-danger">*&nbsp;&nbsp;&nbsp;</span></label>
                                                <input class="txtStrategic_obj31 form-control col-2" type="date" value="<?php echo date('Y-m-d'); ?>" id="txtStrategic_obj31" name="txtStrategic_obj31">

                                                <label for="st-date" class="txtStrategic_obj41 col-form-label" name="txtStrategic_obj41">&nbsp;&nbsp;&nbsp;เป็นบุตรลำดับที่ <span class="text-danger">*&nbsp;&nbsp;&nbsp;</span></label>
                                                <input class="txtStrategic_obj41 form-control col-1 mr-2" type="number" value="" id="txtStrategic_obj41" name="txtStrategic_obj41" min="1" max="15">

                                                <select class="form-control col-lg-1 sun_type1" id="sun_type1" name="sun_type1">
                                                    <option value="" selected hidden>สภาวะบุตร</option>
                                                    <option value="ยังไม่บรรลุนิติภาวะ">ยังไม่บรรลุนิติภาวะ</option>
                                                    <option value="เป็นบุตรไร้ความสามารถหรือเสมือนไร้ความสามารถ">เป็นบุตรไร้ความสามารถหรือเสมือนไร้ความสามารถ</option>
                                                </select>

                                            </div>

                                            <br>
                                            <div class="form-group row">
                                                <label class="sick_name1 col-form-label" name="sick_name1">ป่วยเป็นโรค <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                <input class="sick_name1 form-control col-lg-3" type="text" value="" id="sick_name1" name="sick_name1" placeholder="กรุณาระบุชื่อโรค" maxlength="250" required />
                                                <label class="host_name1 col-form-label" name="host_name1">&nbsp;&nbsp;และได้เข้ารับการตรวจรักษาพยาบาลจาก (ชื่อสถานพยาบาล) <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                <input class="host_name1 form-control col-lg-3" type="text" value="" id="host_name1" name="host_name1" placeholder="กรุณาระบุชื่อสถานพยาบาล" maxlength="250" required />
                                            </div>


                                            <div class="form-group row">
                                                <label class="host_type1 col-form-label">ซึ่งเป็นสถานพยาบาลของ <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                <select class="host_type1 form-control col-lg-1" id="host_type1" name="host_type1" required>
                                                    <option value="" selected hidden>เลือก</option>
                                                    <option value="ทางราชการ">ทางราชการ</option>
                                                    <option value="เอกชน">เอกชน</option>
                                                </select>
                                                <label class="col-form-label">&nbsp;&nbsp;ระยะวันที่ <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                <input type="date" class="start1 form-control col-2" id="start1" name="start1" value="<?php echo date('Y-m-d'); ?>" required />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                                </div>
                                                <input type="date" class="end1 form-control col-2" id="end1" name="end1" value="<?php echo date('Y-m-d'); ?>" required />
                                            </div>

                                            <div class="form-group row">
                                                <label class="money1 col-form-label">&nbsp;&nbsp;เป็นเงินทั้งสิ้น <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                <input class="money1 form-control col-lg-2" type="number" step='0.01' value='0.00' id="money1" name="money1" placeholder="กรุณาระบุจำนวนเงิน" min="0.01" max="100000" required />
                                                <label class="num1 col-form-label">&nbsp;&nbsp;ตามใบเสร็จรับเงินที่แนบ จำนวน <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                <input class="num1 form-control col-2" type="number" value="" id="num1" name="num1" placeholder="กรุณาระบุจำนวน" min="1" max="20" required />
                                                <label class="num1 col-form-label">&nbsp;&nbsp;ฉบับ</label>
                                            </div>

                                            <input type="file" name="filUploadA1" accept=".pdf">
                                            <input type="file" name="filUploadB1" accept=".pdf">
                                            <input type="file" name="filUploadC1" accept=".pdf">
                                            <span class="form-text text-muted">ไฟล์นามสกุล PDF ขนาดไม่เกิน 25MB</span>
                                            <input type="hidden" name="emp_empid" id="emp_empid" value=<?= $emp_empid; ?>>

                                            <hr class="new">

                                        </div>
                                    </div>



                                </table>
                            </fieldset><br>
                            <input type="submit" name="submit" id="submit" class="btn btn-primary" value="บันทึกส่ง">
                            <input type="button" onclick="location.href='?menu=สวัสดิการด้านสุขภาพ'" class="btn btn-warning" value="ยกเลิก">
                        </div>
                    </div>
                </div>
            </div><br>
        </form>
    </div>

    <!-- <script src="js/js-input.js?v=1.1.0.6" type="text/javascript"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            let i = 1;
            $('#add').click(function() {
                i++;
                if (i > 3) {
                    swal.fire({
                        icon: "error",
                        title: 'ขออภัย! จำกัดรายการไม่เกิน 3 รายการ',
                        buttonsStyling: false,
                        confirmButtonText: "ตกลง",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-danger"
                        }
                    })
                    script.stop;
                }

                $('.btn_remove').hide();

                // $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="skill[]" placeholder="Enter your skill" class="form-control name_list" required=""/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>')  
                $('#dynamic_field').append('<tr id="row' + i + '"><td style="border:1px solid white;">' +
                    // '<table class="table table-bordered" id="dynamic_field">'+
                    '<div class="form-group strategy' + i + '">' +
                    '<div class="product_wrapper_Results">' +
                    '<div class="row" >' +
                    '<button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove label label-xl mr-1">&nbsp;<i class="fa fa-trash icon-xs" aria-hidden="true" ></i></button>' +
                    '<div><label><span class="label label-xl font-weight-boldest label-rounded label-warning ">' + i + '</span></label></div>' +
                    '<div class="col-lg-1">' +
                    '<select class="custom-select txtstrategy' + i + '" name="txtstrategy' + i + '" id="txtstrategy' + i + '" required>' +
                    '<option value="" selected hidden>เลือก</option>' +
                    '<option value="ตนเอง">ตนเอง</option>' +
                    '<option value="คู่สมรส">คู่สมรส</option>' +
                    '<option value="บิดา">บิดา</option>' +
                    '<option value="มารดา">มารดา</option>' +
                    '<option value="บุตร">บุตร</option>' +
                    '</select>' +

                    '</div>' +
                    '<div>' +
                    '<input class="txtStrategic_obj1' + i + ' form-control col-11" type="text" value="" id="txtStrategic_obj1' + i + '" name="txtStrategic_obj1' + i + '" placeholder="ชื่อ-นามสกุล" maxlength="100" required>' +
                    '</div>' +
                    '<div>' +
                    '<input class="txtStrategic_obj2' + i + ' form-control col-10" type="text" value="" id="txtStrategic_obj2' + i + '" name="txtStrategic_obj2' + i + '" placeholder="เลขประจำตัวประชาชน" maxlength="100" required>' +
                    '</div>' +

                    '<label for="st-date" class="txtStrategic_obj3' + i + ' col-form-label" name="txtStrategic_obj3' + i + '" >เกิดเมื่อ <span class="text-danger">*&nbsp;&nbsp;</span></label>' +
                    '<input class="txtStrategic_obj3' + i + ' form-control col-2" type="date" value="<?php echo date('Y-m-d'); ?>" id="txtStrategic_obj3' + i + '" name="txtStrategic_obj3' + i + '" >' +

                    '<label for="st-date" class="txtStrategic_obj4' + i + ' col-form-label" name="txtStrategic_obj4' + i + '" >&nbsp;&nbsp;&nbsp;เป็นบุตรลำดับที่ <span class="text-danger">*&nbsp;</span></label>' +
                    '<input class="txtStrategic_obj4' + i + ' form-control col-1 mr-2" type="number" value="" id="txtStrategic_obj4' + i + '" name="txtStrategic_obj4' + i + '"  min="1" max="15" >' +

                    '<select class="form-control col-lg-1 sun_type' + i + '" id="sun_type' + i + '" name="sun_type' + i + '">' +
                    '<option value="" selected hidden>เลือกสภาวะบุตร</option>' +
                    '<option value="ยังไม่บรรลุนิติภาวะ">ยังไม่บรรลุนิติภาวะ</option>' +
                    '<option value="เป็นบุตรไร้ความสามารถหรือเสมือนไร้ความสามารถ">เป็นบุตรไร้ความสามารถหรือเสมือนไร้ความสามารถ</option>' +
                    '</select>' +

                    '</div>' +

                    '<br><div class="form-group row">' +
                    '<label class="sick_name' + i + ' col-form-label" name="sick_name' + i + '">ป่วยเป็นโรค <span class="text-danger">*&nbsp;&nbsp;</span></label>' +
                    '<input class="sick_name' + i + ' form-control col-lg-3" type="text" value="" id="sick_name' + i + '" name="sick_name' + i + '" placeholder="กรุณาระบุชื่อโรค" maxlength="250" required/>' +
                    '<label class="host_name' + i + ' col-form-label" name="host_name' + i + '">&nbsp;&nbsp;และได้เข้ารับการตรวจรักษาพยาบาลจาก (ชื่อสถานพยาบาล) <span class="text-danger">*&nbsp;&nbsp;</span></label>' +
                    '<input class="host_name' + i + ' form-control col-lg-3" type="text" value="" id="host_name' + i + '" name="host_name' + i + '" placeholder="กรุณาระบุชื่อสถานพยาบาล" maxlength="250" required/>' +
                    '</div> ' +

                    '<div class="form-group row">' +
                    '<label class="host_type' + i + ' col-form-label">ซึ่งเป็นสถานพยาบาลของ <span class="text-danger">*&nbsp;&nbsp;</span></label>' +
                    '<select class="host_type' + i + ' form-control col-lg-1" id="host_type' + i + '" name="host_type' + i + '" required>' +
                    '<option value="" selected hidden>เลือก</option>' +
                    '<option value="ทางราชการ">ทางราชการ</option>' +
                    '<option value="เอกชน">เอกชน</option>' +
                    '</select>' +
                    '<label class="col-form-label">&nbsp;&nbsp;ระยะวันที่ <span class="text-danger">*&nbsp;&nbsp;</span></label>' +
                    '<input type="date" class="start' + i + ' form-control col-2" id="start' + i + '" name="start' + i + '" value="<?php echo date('Y-m-d'); ?>" required/>' +
                    '<div class="input-group-append">' +
                    '<span class="input-group-text"><i class="la la-ellipsis-h"></i></span>' +
                    '</div>' +
                    '<input type="date" class="end' + i + ' form-control col-2" id="end' + i + '" name="end' + i + '" value="<?php echo date('Y-m-d'); ?>" required/>' +
                    '</div>' +


                    '<div class="form-group row">' +
                    '<label class="money1 col-form-label">&nbsp;&nbsp;เป็นเงินทั้งสิ้น <span class="text-danger">*&nbsp;&nbsp;</span></label>' +
                    '<input class="money' + i + ' form-control col-lg-2" type="number" step="0.01" value="0.00" id="money' + i + '" name="money' + i + '" placeholder="กรุณาระบุจำนวนเงิน" min="0.01" max="100000" required/>' +
                    '<label class="num1 col-form-label">&nbsp;&nbsp;ตามใบเสร็จรับเงินที่แนบ จำนวน <span class="text-danger">*&nbsp;&nbsp;</span></label>' +
                    '<input class="num' + i + ' form-control col-2" type="number" value="" id="num' + i + '" name="num' + i + '" placeholder="กรุณาระบุจำนวน" min="1" max="20" required/>' +
                    '<label class="num1 col-form-label">&nbsp;&nbsp;ฉบับ</label>' +
                    '</div>' +

                    '<input type="file" name="filUploadA' + i + '" accept=".pdf">' +
                    '<input type="file" name="filUploadB' + i + '" accept=".pdf">' +
                    '<input type="file" name="filUploadC' + i + '" accept=".pdf">' +
                    '<span class="form-text text-muted">ไฟล์นามสกุล PDF ขนาดไม่เกิน 25MB</span>' +

                    '<hr class="new">' +
                    '</div>' +
                    '</div>' +
                    '</td></tr>'

                )

                for (let ii = 2; ii <= 3; ii++) {


                    if ((i == 2 && ii == 2) || (i == 3 && ii == 3)) {
                        $('.txtStrategic_obj1' + ii).show();
                        $('.txtStrategic_obj2' + ii).show();
                        $('.txtStrategic_obj3' + ii).hide();
                        $('.txtStrategic_obj4' + ii).hide();
                        $('.sun_type' + ii).hide();
                        $('.txtStrategic_obj5' + ii).show();
                        $('.txtStrategic_obj6' + ii).show();

                        // alert ('p'+ii);

                        $(".txtstrategy" + i).change(function() {
                            var value = $(".txtstrategy" + ii + " option:selected").val();
                            var name = document.getElementById("name").value;
                            var id_card = document.getElementById("id_card").value;

                            if (value == "ตนเอง") {
                                // $('.Strategic_obj1').show();
                                $('.txtStrategic_obj1' + ii).show();
                                $('.txtStrategic_obj1' + ii).val(name);
                                $(".txtStrategic_obj1" + ii).prop('disabled', false);

                                $('.txtStrategic_obj2' + ii).show();
                                $('.txtStrategic_obj2' + ii).val(id_card);
                                $(".txtStrategic_obj2" + ii).prop('disabled', false);

                                $('.txtStrategic_obj3' + ii).hide();
                                $('.txtStrategic_obj3' + ii).val("");
                                $('.txtStrategic_obj4' + ii).hide();
                                $('.txtStrategic_obj4' + ii).val("");
                                $('.sun_type' + ii).hide();
                                $('.sun_type' + ii).val('');


                            } else if (value == "บุตร") {
                                // $('.Strategic_obj1').show();
                                $('.txtStrategic_obj1' + ii).show();
                                $('.txtStrategic_obj1' + ii).val("");
                                $(".txtStrategic_obj1" + ii).prop('disabled', false);

                                $('.txtStrategic_obj2' + ii).show();
                                $('.txtStrategic_obj2' + ii).val("");
                                $(".txtStrategic_obj2" + ii).prop('disabled', false);

                                $('.txtStrategic_obj3' + ii).show();
                                $('.txtStrategic_obj4' + ii).show();
                                $('.sun_type' + ii).show();

                            } else {
                                // $('.Strategic_obj1').show();
                                $('.txtStrategic_obj1' + ii).show();
                                $('.txtStrategic_obj1' + ii).val("");
                                $(".txtStrategic_obj1" + ii).prop('disabled', false);

                                $('.txtStrategic_obj2' + ii).show();
                                $('.txtStrategic_obj2' + ii).val("");
                                $(".txtStrategic_obj2" + ii).prop('disabled', false);

                                $('.txtStrategic_obj3' + ii).hide();
                                $('.txtStrategic_obj3' + ii).val("");
                                $('.txtStrategic_obj4' + ii).hide();
                                $('.txtStrategic_obj4' + ii).val("");
                                $('.sun_type' + ii).hide();
                                $('.sun_type' + ii).val('');
                            }
                        })
                    }

                }




            })


            $(document).on('click', '.btn_remove', function() {
                let button_id = $(this).attr('id');
                $('#row' + button_id + '').remove();
                if (button_id == 2) {
                    i = 1;
                } else {
                    i = 2;
                    $('.btn_remove').show();
                };

            })
        })




        $(document).ready(function() {
            // var name = document.getElementById("name").value;

            $('.txtStrategic_obj11').show();
            $('.txtStrategic_obj21').show();
            $('.txtStrategic_obj31').hide();
            $('.txtStrategic_obj41').hide();
            $('.sun_type1').hide();
            $('.txtStrategic_obj51').show();
            $('.txtStrategic_obj61').show();

            //$('.Strategic_obj1').hide()
            $(".txtstrategy1").change(function() {
                var value = $(".txtstrategy1 option:selected").val();
                var name = document.getElementById("name").value;
                var id_card = document.getElementById("id_card").value;

                if (value == "ตนเอง") {
                    // $('.Strategic_obj1').show();
                    $('.txtStrategic_obj11').show();
                    $('.txtStrategic_obj11').val(name);
                    $(".txtStrategic_obj11").prop('disabled', false);

                    $('.txtStrategic_obj21').show();
                    $('.txtStrategic_obj21').val(id_card);
                    $(".txtStrategic_obj21").prop('disabled', false);

                    $('.txtStrategic_obj31').hide();
                    $('.txtStrategic_obj31').val('');
                    $('.txtStrategic_obj41').hide();
                    $('.txtStrategic_obj41').val('');
                    $('.sun_type1').hide();
                    $('.sun_type1').val('');


                } else if (value == "บุตร") {
                    // $('.Strategic_obj1').show();
                    $('.txtStrategic_obj11').show();
                    $('.txtStrategic_obj11').val("");
                    $(".txtStrategic_obj11").prop('disabled', false);

                    $('.txtStrategic_obj21').show();
                    $('.txtStrategic_obj21').val("");
                    $(".txtStrategic_obj21").prop('disabled', false);

                    $('.txtStrategic_obj31').show();
                    $('.txtStrategic_obj31').val("<?php echo date('Y-m-d'); ?>");
                    $('.txtStrategic_obj41').show();
                    $('.sun_type1').show();

                } else {
                    // $('.Strategic_obj1').show();
                    $('.txtStrategic_obj11').show();
                    $('.txtStrategic_obj11').val("");
                    $(".txtStrategic_obj11").prop('disabled', false);

                    $('.txtStrategic_obj21').show();
                    $('.txtStrategic_obj21').val("");
                    $(".txtStrategic_obj21").prop('disabled', false);

                    $('.txtStrategic_obj31').hide();
                    $('.txtStrategic_obj31').val('');
                    $('.txtStrategic_obj41').hide();
                    $('.txtStrategic_obj41').val('');
                    $('.sun_type1').hide();
                    $('.sun_type1').val('');
                }
            });

        })
    </script>




    <!--  <script src="assets/js/pages/features/miscellaneous/sweetalert2.js"></script> -->

</body>

</html>