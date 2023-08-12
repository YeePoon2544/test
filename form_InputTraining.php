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
    $SQLperson = "select * from `person` where `emp_empid` = '".$emp_empid."' ";
    $PerRecords = mysqli_query($conn, $SQLperson);
    while ($rowPerson = mysqli_fetch_assoc($PerRecords)) {
            $name = $rowPerson['thai_name'];
            $id_card = $rowPerson['id_card_no'];
            $position = $rowPerson['position'].$rowPerson['tit_typename'];
            $emptype = $rowPerson['emptype_name'];
            $tel = $rowPerson['tel_no'];
            $suborgname = $rowPerson['suborgname'];
            $department = $rowPerson['department'];

        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="card card-custom"><br>
    <form action="?menu=AddHealth" name="frmAdd" id="frmAdd" method="post" enctype="multipart/form-data">   
      <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

          <!-- Main Content -->
          <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                    <fieldset class="border-primary">
                        <legend>เพิ่มรายการอบรม</legend>
                          <table class="table table-bordered" id="dynamic_field" border=none>

                                    <div class="form-group row" >
                                            <select class="custom-select col-lg-2" name="train_type" id="train_type" required>  
                                                 <option value="" selected hidden>เลือก</option>   
                                                 <option value="plan">อบรมตามกิจกรรมของหน่วยแผน</option>
                                                 <option value="cop">อบรม Cop</option>        
                                                 <option value="inlib">อบรมภายในหอสมุด มธ.</option>
                                            </select>

<!--                                             <label class="col-form-label text-right col-lg-1">ชื่อวิทยากร</label>
                                            <input class="lecturer form-control col-lg-2" type="text" value="" id="lecturer" name="lecturer" placeholder="ชื่อ - นามสกุล" maxlength="100" required> -->
                                            
                                            <label class="train_name col-form-label" name="train_name">&nbsp;&nbsp;ชื่อวิทยากร <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                             <input class="lecturer form-control col-lg-2" type="text" value="" id="lecturer" name="lecturer" placeholder="ชื่อ - นามสกุล" maxlength="100" required/>

                                    </div>            

                                    <div class="form-group row">
                                        <label class="train_name col-form-label" name="train_name">หัวข้อการอบรม <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="train_name form-control col-lg-3" type="text" value="" id="train_name" name="train_name" placeholder="หัวข้อการอบรม" maxlength="250" required/>
                                        <label class="host_name1 col-form-label" name="host_name1">&nbsp;&nbsp;รายละเอียด <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="host_name1 form-control col-lg-3" type="text" value="" id="host_name1" name="host_name1" placeholder="รายละเอียดการอบรม" maxlength="250" required/>
                                    </div> 


                                    <div class="form-group row">   
                                                    <label class="col-form-label">&nbsp;&nbsp;ระยะวันที่ <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                    <input type="datetime-local" class="start1 form-control col-2" id="start1" name="start1" value="<?php echo date('Y-m-d h:i'); ?>" required />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                                </div>
                                                    <input type="datetime-local" class="end1 form-control col-2" id="end1" name="end1" value="<?php echo date('Y-m-d h:i'); ?>" required />
                                    </div>

                                    <div class="form-group row">
                                        <label class="money1 col-form-label">&nbsp;&nbsp;สถานที่จัดอบรม <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                        <input class="place_name form-control col-lg-2" type="text" value="" id="place_name" name="place_name" placeholder="รายละเอียดการอบรม" maxlength="250" required/>
                                        
                                        <label class="place_name col-form-label">&nbsp;&nbsp;ตามใบเสร็จรับเงินที่แนบ จำนวน <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="num1 form-control col-lg-2" type="number" value="" id="num1" name="num1" placeholder="กรุณาระบุจำนวน" min="1" max="20" required/>
                                        <label class="num1 col-form-label">&nbsp;&nbsp;ฉบับ</label>            
                                    </div>                                                                                                             

                                    <input type="file" name="filUpload_pic" accept=".jpg">
                                    <span class="form-text text-muted">รูปภาพประชาสัมพันธ์ ไฟล์นามสกุล jpg ขนาดไม่เกิน 25MB</span>
                                    <input type="file" name="filUpload_sheet" accept=".pdf">
                                    <span class="form-text text-muted">เอกสารการอบรม ไฟล์นามสกุล PPT,DOC,XLS,PDF ขนาดไม่เกิน 25MB</span>
                                    <input type="file" name="filUpload_sheet2" accept=".pdf">    
                                    <span class="form-text text-muted">เอกสารการอบรม ไฟล์นามสกุล PPT,DOC,XLS,PDF ขนาดไม่เกิน 25MB</span>  
                                    <input type="hidden" name="emp_empid" id="emp_empid" value=<?=$emp_empid; ?>>
                                                                                                               
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

</body>
</html>