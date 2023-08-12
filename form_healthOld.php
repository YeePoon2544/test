<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<!-- js add fields -->
  <script src="js/js-input.js?v=1.1.0.6" type="text/javascript"></script>

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

<div class="card card-custom">
 <div class="card-header">
    <div class="card-title">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">แบบฟอร์มขอเบิกเงินสวัสดิการด้านสุขภาพ (6,000 บาท)</span>
        </h3>                                               
    </div>
 <?php
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
<!--   <div class="card-toolbar">
   <div class="example-tools justify-content-center">
    <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
    <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
   </div>
  </div> -->
 </div>
 
 <!--begin::Form-->

<form action="AddSaveHealth.php" name="frmAdd" id="frmAdd" method="post" enctype="multipart/form-data">   
  <!-- <div class="card-body"> -->
 <!-- Page Wrapper -->
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
            <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?=$name?>" name="thai_name" disabled="disabled"/>
            <input type="hidden" value="<?=$name;?>" id="thai_name" name="thai_name">
        </div>
        <label class="col-form-label">&nbsp;ตำแหน่ง</label>
        <div class="col-lg-3 col-xl-3">
            <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?=$position?>" name="position" disabled="disabled"/>
            <input type="hidden" value="<?=$position;?>" id="position" name="position">
        </div>                                                      
    </div>
    <div class="form-group row">
        <label class="col-form-label">สังกัด</label>
        <div class="col-lg-3 col-xl-3">
            <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?=$suborgname?>" name="suborgname" disabled="disabled"/>
            <input type="hidden" value="<?=$suborgname;?>" id="suborgname" name="suborgname">
        </div>
        <label class="col-form-label">&nbsp;โทร</label>
        <div class="col-lg-3 col-xl-3">
            <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?=$tel?>" name="tel" disabled="disabled"/>
            <input type="hidden" value="<?=$tel;?>" id="tel" name="tel">
        </div>                                                          
    </div>

   <div class="form-group row">
        <span class="card-label font-weight-bolder text-dark">ขอเบิกเงินค่ารักษาพยาบาลของ</span>
   </div> 

                    <fieldset class="border-primary">
                        <legend>ขอเบิกเงินค่ารักษาพยาบาลของ</legend>
                            <?php
                            $p = 2;
                            for ($i = 1; $i <= 3; $i++) {
                                
                            ?>
                            <div class="form-group strategy<?php echo $i; ?>">
                                <div class="product_wrapper_Results">
                                    <div class="row" >
                                        
                                        <div>
                                            <label><span class="label label-xl font-weight-boldest label-rounded label-warning "><?php echo $i; ?></span></label>
                                            <input type="hidden" value="<?=$i;?>" id="line" name="line">
                                        </div>

                                        <div class="col-lg-1">
                                            <select class="custom-select txtstrategy<?php echo $i; ?>" name="txtstrategy<?php echo $i; ?>" id="txtstrategy<?php echo $i; ?>" >  
                                                 <option value="" selected hidden>กรุณาเลือก</option>   
                                                 <option value="ตนเอง">ตนเอง</option>
                                                 <option value="คู่สมรส">คู่สมรส</option>        
                                                 <option value="บิดา">บิดา</option>
                                                 <option value="มารดา">มารดา</option>
                                                 <option value="บุตร">บุตร</option>
                                            </select>
                                            <input type="hidden" value="<?=$name;?>" id="name" name="name">
                                            <input type="hidden" value="<?=$id_card;?>" id="id_card" name="id_card">

                                        </div>

                                        <div class="col-md-2">
                                            <input class="txtStrategic_obj1<?php echo $i; ?> form-control" type="text" value="" id="txtStrategic_obj1<?php echo $i; ?>" name="txtStrategic_obj1<?php echo $i; ?>" placeholder="ชื่อ-นามสกุล" maxlength="100" >
                                        </div>

                                        <div>
                                            <input class="txtStrategic_obj2<?php echo $i; ?> form-control" type="text" value="" id="txtStrategic_obj2<?php echo $i; ?>" name="txtStrategic_obj2<?php echo $i; ?>" placeholder="เลขประจำตัวประชาชน" maxlength="100">
                                        </div>


                                        <label for="st-date" class="txtStrategic_obj3<?php echo $i; ?> col-form-label" name="txtStrategic_obj3<?php echo $i; ?>" >&nbsp;&nbsp;&nbsp;เกิดเมื่อ <span class="text-danger">*&nbsp;&nbsp;&nbsp;</span></label>
                                        <input class="txtStrategic_obj3<?php echo $i; ?> form-control col-1" type="date" value="<?php echo date('Y-m-d'); ?>" id="txtStrategic_obj3<?php echo $i; ?>" name="txtStrategic_obj3<?php echo $i; ?>"  maxlength="100" >

                                        <label for="st-date" class="txtStrategic_obj4<?php echo $i; ?> col-form-label" name="txtStrategic_obj4<?php echo $i; ?>" >&nbsp;&nbsp;&nbsp;เป็นบุตรลำดับที่ <span class="text-danger">*&nbsp;&nbsp;&nbsp;</span></label>
                                        <input class="txtStrategic_obj4<?php echo $i; ?> form-control col-1" type="number" value="" id="txtStrategic_obj4<?php echo $i; ?>" name="txtStrategic_obj4<?php echo $i; ?>"  min="1" max="15" >

                                        <select class="form-control col-2" id="sun_type" name="sun_type<?php echo $i; ?>" hidden="hidden" >
                                             <option value="" selected hidden>กรุณาเลือกสภาวะบุตร</option>   
                                             <option value="ยังไม่บรรลุนิติภาวะ">ยังไม่บรรลุนิติภาวะ</option>
                                             <option value="เป็นบุตรไร้ความสามารถหรือเสมือนไร้ความสามารถ">เป็นบุตรไร้ความสามารถหรือเสมือนไร้ความสามารถ</option>        
                                        </select>

                                        <div class="col-md-2">
                                             <div class="input-group-append">
                                                    <button type="button" name="" class="btnfeadout<?=$p;?> btn btn-danger" value=""><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    <input type="button" name="" class="btnfeadin<?=$p;?> btn btn-success" value="+">
                                             </div>
                                        </div>                           

                                    </div>

                                    <br><div class="form-group row">
                                        <label class="sick_name<?php echo $i; ?> col-form-label" name="sick_name<?php echo $i; ?>">ป่วยเป็นโรค <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="sick_name<?php echo $i; ?> form-control col-lg-3" type="text" value="" id="sick_name<?php echo $i; ?>" name="sick_name<?php echo $i; ?>" placeholder="กรุณาระบุชื่อโรค" maxlength="250" />
                                        <label class="host_name<?php echo $i; ?> col-form-label" name="host_name<?php echo $i; ?>">&nbsp;&nbsp;และได้เข้ารับการตรวจรักษาพยาบาลจาก (ชื่อสถานพยาบาล) <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="host_name<?php echo $i; ?> form-control col-lg-3" type="text" value="" id="host_name<?php echo $i; ?>" name="host_name<?php echo $i; ?>" placeholder="กรุณาระบุชื่อสถานพยาบาล" maxlength="250" />
                                    </div> 


                                    <div class="form-group row">   
                                             <div class="input-daterange input-group" id="kt_datepicker_<?php echo $i; ?>">
                                                <label class="host_type<?php echo $i; ?> col-form-label">ซึ่งเป็นสถานพยาบาลของ <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                <select class="host_type<?php echo $i; ?> form-control col-lg-1" id="host_type<?php echo $i; ?>" name="host_type<?php echo $i; ?>" >
                                                    <option value="" selected hidden>กรุณาเลือก</option>   
                                                    <option value="ทางราชการ">ทางราชการ</option>
                                                    <option value="เอกชน">เอกชน</option>        
                                                </select>
                                                    <label class="col-form-label">&nbsp;&nbsp;ระยะวันที่ <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                    <input type="text" class="start<?php echo $i; ?> form-control col-2" id="start<?php echo $i; ?>" name="start<?php echo $i; ?>" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                                </div>
                                                    <input type="text" class="end<?php echo $i; ?> form-control col-2" id="end<?php echo $i; ?>" name="end<?php echo $i; ?>" />
                                            </div>
                                    </div>  

                                    <div class="form-group row">
                                        <label class="money<?php echo $i; ?> col-form-label">&nbsp;&nbsp;เป็นเงินทั้งสิ้น <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="money<?php echo $i; ?> form-control col-lg-2" type="number" value="" id="money<?php echo $i; ?>" name="money<?php echo $i; ?>" placeholder="กรุณาระบุจำนวนเงิน" min="1" max="100000" />
                                        <label class="num<?php echo $i; ?> col-form-label">&nbsp;&nbsp;ตามใบเสร็จรับเงินที่แนบ จำนวน <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="num<?php echo $i; ?> form-control col-1" type="number" value="" id="num<?php echo $i; ?>" name="num<?php echo $i; ?>" placeholder="กรุณาระบุจำนวน" min="1" max="20" />
                                        <label class="num<?php echo $i; ?> col-form-label">&nbsp;&nbsp;ฉบับ</label>            
                                    </div>                                                                           

                                    <hr class="new">

                                </div>
                            </div>


                            <?php

                            $p++;
                            }
                            ?>
                                                                                
                                                                                        <input type="file" name="filUpload">       
                                                                                        <span class="form-text text-muted">ไฟล์นามสกุล PDF ขนาดไม่เกิน 25MB</span>                                 
                                                                                        <input type="hidden" name="emp_empid" id="emp_empid" value=<?=$emp_empid; ?>>
                                                                             

                            <div class="input_fields_Results"></div>



                            <script type="text/javascript">

                              $(document).ready(function() {
                                $(".strategy2").hide();
                                $(".btnfeadout2").hide();
                                $(".txtstrategy2").prop('disabled', true);

                                $(".btnfeadin2").click(function() {
                                  $(".strategy2").fadeIn();
                                  $(".btnfeadout2").fadeIn();
                                  $("#txtstrategy2").prop('disabled', false);
                                });
                                $(".btnfeadout2").click(function() {
                                  $(".strategy2").fadeOut();
                                  $(".btnfeadout2").fadeOut();
                                  // $("#txtstrategy2").prop('disabled', true);
                                });

                              });

                             $(document).ready(function() {
                                $(".strategy3").hide();
                                $(".btnfeadout3").show();
                                $(".txtstrategy3").prop('disabled', false);

                                $(".btnfeadin3").click(function() {
                                  $(".strategy3").fadeIn();
                                  $(".btnfeadout3").fadeIn();
                                  $("#txtstrategy3").prop('disabled', false);
                                });

                                $(".btnfeadout3").click(function() {
                                  $(".strategy3").fadeOut();
                                  $(".btnfeadout3").fadeOut();
                                  $("#txtstrategy3").prop('disabled', true);

                                });

                              });

                            $(document).ready(function() {
                                $(".strategy4").hide();
                                $(".btnfeadout4").show();
                                $(".txtstrategy4").prop('disabled', false);

                                $(".btnfeadin4").click(function() {
                                  $(".strategy4").fadeIn();
                                  $(".btnfeadout4").fadeIn();
                                  $("#txtstrategy4").prop('disabled', false);
                                });

                                $(".btnfeadout4").click(function() {
                                  $(".strategy4").fadeOut();
                                  $(".btnfeadout4").fadeOut();
                                  $("#txtstrategy4").prop('disabled', true);

                                });

                            });

                            $(document).ready(function() {
                                $(".strategy5").hide();
                                $(".btnfeadout5").show();
                                $(".txtstrategy5").prop('disabled', false);

                                $(".btnfeadin5").click(function() {
                                  $(".strategy5").fadeIn();
                                  $(".btnfeadout5").fadeIn();
                                  $("#txtstrategy5").prop('disabled', false);
                                });

                                $(".btnfeadout5").click(function() {
                                  $(".strategy5").fadeOut();
                                  $(".btnfeadout5").fadeOut();
                                  $("#txtstrategy5").prop('disabled', true);

                                });

                            });

                            </script>

                    </fieldset>
                    <div class="card-footer">
                            <input type="submit" class="btn btn-primary" id="button" name="submit" value="บันทึก" onclick="return validate();">  
                            <a href="?menu=home" class="btn btn-secondary">ยกเลิก</a>
                    </div><br>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
<!--   <div class="card-footer">
   <button type="submit" class="btn btn-primary mr-2">บันทึก</button>
   <a href="?menu=home" class="btn btn-secondary">ยกเลิก</a>
  </div> -->



 </form>
 <!--end::Form-->


<?php

       if(isset($_POST['withdraw'])){
              
    //     $SQLquery = "INSERT INTO `contract` (`id`, `contract_st_thdate`, `contract_ed_thdate`, `type_contract`) 
    //     VALUES ('".$_POST["empid"]."', '".$_POST["st-date"]."','".$_POST["end-date"]."','".$_POST["contractSelect"]."') ";
                                   
    //                                         if ($conn->query($SQLquery) === TRUE) {
                                                    echo '<script>swal("บันทึกข้อมูลเรียบร้อย", "", "success");</script>';
    //                                                 //echo "<script>window.location.replace('?menu=เพิ่มข้อมูลสัญญา');</script>";                                            
    //                                         } else {
    //                                                 echo '<script>swal("ไม่สามารถ บันทึกรายการได้", "", "error");</script>';
    //                                                 //echo "<script>window.location.replace('?menu=เพิ่มข้อมูลสัญญา');</script>";  
    //                                         } 

     }
    $conn->close();
?>