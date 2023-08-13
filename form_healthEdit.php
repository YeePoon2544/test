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

    $id = $_GET["id"];

    $SQLID = "select * from mst_welfare where welfare_id = '".$id."'";
    $IDRecords = mysqli_query($conn, $SQLID);
    while ($rowID = mysqli_fetch_assoc($IDRecords)) {
            $emp_empid = $rowID['emp_empid'];
            $name = $rowID['thai_name'];
            $position = $rowID['position'];
            $tel = $rowID['tel_no'];            
            $suborgname = $rowID['suborgname'];
            $Status = $rowID['status']; 
            $y = $rowID['bug_year'];          
        }

    $SQLperson = "select * from `person` where `emp_empid` = '".$emp_empid."' ";
    $PerRecords = mysqli_query($conn, $SQLperson);
    while ($rowPerson = mysqli_fetch_assoc($PerRecords)) {
            $id_card = $rowPerson['id_card_no'];
            $emptype = $rowPerson['emptype_name'];
            $department = $rowPerson['department'];
        }

    // $m = date("m");
    // $y = date("Y");
    $Total = 0;
    // if ($m > 9) { $y = $y + 545; } else { $y = $y + 543; }

    $SQLTotal = "select total from mst_welfare where emp_empid = '".$emp_empid."' and bug_year = '".$y."' and status <> 'unapproved' ";
    $TotalRecords = mysqli_query($conn, $SQLTotal);
    while ($rowTotal = mysqli_fetch_assoc($TotalRecords)) {
            $Total = $Total + $rowTotal['total'];
        }
    $Total = 6000 - $Total;           

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
            <span class="form-text text-muted">(งบประมาณปี <?=$y;?> เบิกได้อีก <?=number_format( $Total, 2 );?> บาท)</span>
        </h4>                                                      
    </div>    
  </div>

    <!-- <form action="" name="add_name" id="add_name" method="post"> -->
    <form action="?menu=UpdateHealth" name="frmAdd" id="frmAdd" method="post" enctype="multipart/form-data">   
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
                    <div class="col-lg-1 col-xl-1">
                        <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?=$tel?>" name="tel" disabled="disabled"/>
                        <input type="hidden" value="<?=$tel;?>" id="tel" name="tel">
                    </div>  
                                                                        
                </div>

                    <fieldset class="border-primary">
                        <legend>ขอเบิกเงินค่ารักษาพยาบาลของ</legend>
                          <table class="table table-bordered" id="dynamic_field" border=none>
                            <div class="form-group strategy1">
                                <div class="product_wrapper_Results">

<?php
    $SQLDetail = "select * from `detail_welfare` where `welfare_id` = '".$id."' ORDER BY `welfare_line` ASC ";
    $DetailRecords = mysqli_query($conn, $SQLDetail);
    $i = 1;
    while ($rowDetail = mysqli_fetch_assoc($DetailRecords)) {
?>

                                    <div class="row" >
                                        <div>
                                            <label><span class="label label-xl font-weight-boldest label-rounded label-warning "><?=$rowDetail['welfare_line'];?></span></label>
                                            <input type="hidden" value="<?=$rowDetail['welfare_line'];?>" id="id_line<?=$i;?>" name="id_line<?=$i;?>">
                                            <input type="hidden" value="<?=$id;?>" id="id_no" name="id_no">
                                            <input type="hidden" value="<?=$y;?>" id="bug_year" name="bug_year">
                                            <input type="hidden" value="<?=$Status;?>" id="status" name="status">
                                        </div>

                                        <div class="col-lg-1">
                                            <input class="form-control col-10" type="text" value="<?=$rowDetail['type_name'];?>" disabled>  

<!--                                             <input type="hidden" value="<?php echo date('Y-m-d'); ?>" id="bug_date" name="bug_date" >
                                            <input type="hidden" value="<?=$name;?>" id="name" name="name">-->
                                            <input type="hidden" name="txtstrategy<?=$i;?>" id="txtstrategy<?=$i;?>" value="<?=$rowDetail['type_name'];?>">

                                        </div>

                                        <div >
                                            <input class="txtStrategic_obj1<?=$i;?> form-control col-11" type="text" value="<?=$rowDetail['name'];?>" id="txtStrategic_obj1<?=$i;?>" name="txtStrategic_obj1<?=$i;?>" placeholder="ชื่อ-นามสกุล" maxlength="100" required>
                                        </div>

                                        <div>
                                            <input class="txtStrategic_obj2<?=$i;?> form-control col-10" type="text" value="<?=$rowDetail['id_card'];?>" id="txtStrategic_obj2<?=$i;?>" name="txtStrategic_obj2<?=$i;?>" placeholder="เลขประจำตัวประชาชน" maxlength="100" required>
                                        </div>

                                        <?php if ( $rowDetail['birthday'] != "" ) { ?> 
                                            <label for="st-date" class="txtStrategic_obj3<?=$i;?> col-form-label" name="txtStrategic_obj3<?=$i;?>" >เกิดเมื่อ <span class="text-danger">*&nbsp;&nbsp;&nbsp;</span></label>
                                            <input class="txtStrategic_obj3<?=$i;?> form-control col-2" type="date" value="<?=$rowDetail['birthday'];?>" id="txtStrategic_obj3<?=$i;?>" name="txtStrategic_obj3<?=$i;?>" >


                                            <label for="st-date" class="txtStrategic_obj4<?=$i;?> col-form-label" name="txtStrategic_obj4<?=$i;?>" >&nbsp;&nbsp;&nbsp;เป็นบุตรลำดับที่ <span class="text-danger">*&nbsp;&nbsp;&nbsp;</span></label>
                                            <input class="txtStrategic_obj4<?=$i;?> form-control col-1 mr-2" type="number" value="<?=$rowDetail['sun_line'];?>" id="txtStrategic_obj4<?=$i;?>" name="txtStrategic_obj4<?=$i;?>"  min="1" max="5" >

                                            <input class="sun_type<?=$i;?> form-control col-lg-1" type="text" id="sun_type<?=$i;?>" name="sun_type<?=$i;?>" value="<?=$rowDetail['sun_type'];?>">                                           
                                        <?php } ?>
                      

                                    </div>

                                    <br><div class="form-group row">
                                        <label class="sick_name<?=$i;?> col-form-label" name="sick_name<?=$i;?>">ป่วยเป็นโรค <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="sick_name<?=$i;?> form-control col-lg-3" type="text" value="<?=$rowDetail['sick'];?>" id="sick_name<?=$i;?>" name="sick_name<?=$i;?>" placeholder="กรุณาระบุชื่อโรค" maxlength="250" required/>
                                        <label class="host_name<?=$i;?> col-form-label" name="host_name<?=$i;?>">&nbsp;&nbsp;และได้เข้ารับการตรวจรักษาพยาบาลจาก (ชื่อสถานพยาบาล) <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="host_name<?=$i;?> form-control col-lg-3" type="text" value="<?=$rowDetail['host'];?>" id="host_name<?=$i;?>" name="host_name<?=$i;?>" placeholder="กรุณาระบุชื่อสถานพยาบาล" maxlength="250" required/>
                                    </div> 


                                    <div class="form-group row">   
                                                <label class="host_type<?=$i;?> col-form-label">ซึ่งเป็นสถานพยาบาลของ <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                <input class="host_type<?=$i;?> form-control col-lg-1" type="text" id="host_type<?=$i;?>" name="host_type<?=$i;?>" value="<?=$rowDetail['host_type'];?>" required>
                                                    <label class="col-form-label">&nbsp;&nbsp;ระยะวันที่ <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                                    <input type="date" class="start<?=$i;?> form-control col-2" id="start<?=$i;?>" name="start<?=$i;?>" value="<?=$rowDetail['start_date'];?>" required />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                                </div>
                                                    <input type="date" class="end<?=$i;?> form-control col-2" id="end<?=$i;?>" name="end<?=$i;?>" value="<?=$rowDetail['end_date'];?>" required />
                                    </div>  

                                    <div class="form-group row">
                                        <label class="money<?=$i;?> col-form-label">&nbsp;&nbsp;เป็นเงินทั้งสิ้น <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="money<?=$i;?> form-control col-lg-2" type="number" step='0.01' value="<?=$rowDetail['money'];?>" id="money<?=$i;?>" name="money<?=$i;?>" placeholder="กรุณาระบุจำนวนเงิน" min="0.01" max="50000" required/>
                                            <input type="hidden" value="<?=$rowDetail['money'];?>" id="moneyOld<?=$i;?>" name="moneyOld<?=$i;?>" />
                                        <label class="num<?=$i;?> col-form-label">&nbsp;&nbsp;ตามใบเสร็จรับเงินที่แนบ จำนวน <span class="text-danger">*&nbsp;&nbsp;</span></label>
                                            <input class="num<?=$i;?> form-control col-2" type="number" value="<?=$rowDetail['doc'];?>" id="num<?=$i;?>" name="num<?=$i;?>" placeholder="กรุณาระบุจำนวน" min="1" max="20" required/>
                                        <label class="num<?=$i;?> col-form-label">&nbsp;&nbsp;ฉบับ</label>            
                                    </div>                                                                                                             

                                    <?php if($rowDetail['welfare_file1'] != "") { ?>
                                        <a href="health_view.php?FileHealth=<?=$rowDetail['welfare_file1']?>" target="_blank" class="btn btn-light-success font-weight-bold mr-2"><i class="flaticon-file-2"></i> File 1</a>
                                    <?php } ?>                                        
                                    <input type="file" name="filUploadA<?=$i;?>" accept=".pdf">
                                    <input type="hidden" name="filUploadOldA<?=$i;?>" id="filUploadOldA<?=$i;?>" value="<?=$rowDetail['welfare_file1']?>">

                                    <?php if($rowDetail['welfare_file2'] != "") { ?>
                                        <a href="health_view.php?FileHealth=<?=$rowDetail['welfare_file2']?>" target="_blank" class="btn btn-light-success font-weight-bold mr-2"><i class="flaticon-file-2"></i> File 2</a>
                                    <?php } ?>
                                    <input type="file" name="filUploadB<?=$i;?>" accept=".pdf">
                                    <input type="hidden" name="filUploadOldB<?=$i;?>" id="filUploadOldB<?=$i;?>" value="<?=$rowDetail['welfare_file2']?>">

                                    <?php if($rowDetail['welfare_file3'] != "") { ?>
                                        <a href="health_view.php?FileHealth=<?=$rowDetail['welfare_file3']?>" target="_blank" class="btn btn-light-success font-weight-bold mr-2"><i class="flaticon-file-2"></i> File 3</a>
                                    <?php } ?>
                                    <input type="file" name="filUploadC<?=$i;?>" accept=".pdf">
                                    <input type="hidden" name="filUploadOldC<?=$i;?>" id="filUploadOldC<?=$i;?>" value="<?=$rowDetail['welfare_file3']?>">

                                    <span class="form-text text-muted">ไฟล์นามสกุล PDF ขนาดไม่เกิน 25MB</span>  
                                    <input type="hidden" name="emp_empid" id="emp_empid" value=<?=$emp_empid;?>>

                                    <hr class="new">
<?php $i++; } ?>                                    

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

</body>
</html>