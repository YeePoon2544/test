<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
     if ($_SESSION['login'] != "TUlibrary") {
         header("location:login.php");
       }

include('condb.php');

$Date = $_POST["bug_date"];
$NowDate = date("Ymdhis");
    $m = date("m", strtotime($Date));
    $y = date("Y", strtotime($Date));

    if ($m > 9) { $y = $y + 544; } else { $y = $y + 543; }

$emp_empid = $_POST['emp_empid'];
$Thai_name = $_POST["thai_name"];
$Position = $_POST["position"];
$Suborgname = $_POST["suborgname"];
$Tel = $_POST["tel"];

$TypeName[1] = $_POST["txtstrategy1"];
$TypeName[2] = $_POST["txtstrategy2"];
$TypeName[3] = $_POST["txtstrategy3"];
$Name[1] = $_POST["txtStrategic_obj11"];
$Name[2] = $_POST["txtStrategic_obj12"];
$Name[3] = $_POST["txtStrategic_obj13"];
$IdCard[1] = $_POST["txtStrategic_obj21"];
$IdCard[2] = $_POST["txtStrategic_obj22"];
$IdCard[3] = $_POST["txtStrategic_obj23"];
$Birth[1] = $_POST["txtStrategic_obj31"];
$Birth[2] = $_POST["txtStrategic_obj32"];
$Birth[3] = $_POST["txtStrategic_obj33"];
$Sun[1] = $_POST["txtStrategic_obj41"];
$Sun[2] = $_POST["txtStrategic_obj42"];
$Sun[3] = $_POST["txtStrategic_obj43"];
$SunType[1] = $_POST["sun_type1"];
$SunType[2] = $_POST["sun_type2"];
$SunType[3] = $_POST["sun_type3"];

$Sick[1] = $_POST["sick_name1"];
$Sick[2] = $_POST["sick_name2"];
$Sick[3] = $_POST["sick_name3"];
$Host[1] = $_POST["host_name1"];
$Host[2] = $_POST["host_name2"];
$Host[3] = $_POST["host_name3"];
$Host_Type[1] = $_POST["host_type1"];
$Host_Type[2] = $_POST["host_type2"];
$Host_Type[3] = $_POST["host_type3"];
$Start[1] = $_POST["start1"];
$Start[2] = $_POST["start2"];
$Start[3] = $_POST["start3"];
$End[1] = $_POST["end1"];
$End[2] = $_POST["end2"];
$End[3] = $_POST["end3"];

$Money[1] = $_POST["money1"];
$Money[2] = $_POST["money2"];
$Money[3] = $_POST["money3"];
$Doc[1] = $_POST["num1"];
$Doc[2] = $_POST["num2"];
$Doc[3] = $_POST["num3"];

$Total = $Money[1] + $Money[2] + $Money[3];
$TotalOld = 0;

    $SQLTotal = "select total from mst_welfare where emp_empid = '".$emp_empid."' and bug_year = '".$y."' and status <> 'unapproved'";
    $TotalRecords = mysqli_query($conn, $SQLTotal);
    while ($rowTotal = mysqli_fetch_assoc($TotalRecords)) {
            $TotalOld = $TotalOld + $rowTotal['total'];
        }

    $TotalOld = $TotalOld + $Total;

if ($TotalOld > 6000){ 
    echo '<script type="text/javascript">
          swal("ขออภัย", "จำนวนเงินเบิก เกินงบประมาณ", "warning");
          setTimeout("window.history.go(-1)",2500);
         </script>';
    exit();
} else {

    if ( $TypeName[1] != "" && $TypeName[2] == "" && $TypeName[3] == "" ) { $i = 1; } else if (  $TypeName[1] != "" && $TypeName[2] != "" && $TypeName[3] == "" ) { $i = 2; } else if (  $TypeName[1] != "" && $TypeName[2] != "" && $TypeName[3] != "" ) { $i = 3; } else { $i = 0; }

    $fileup = date("Ymdhis");
    $fileup = $emp_empid."_".$fileup;


    for ($ii = 1; $ii <= $i; $ii++) {
        if ($ii == 1) { $A = $_FILES["filUploadA1"]; $B = $_FILES["filUploadB1"]; $C = $_FILES["filUploadC1"];} else if ($ii == 2) {  $A = $_FILES["filUploadA2"]; $B = $_FILES["filUploadB2"]; $C = $_FILES["filUploadC2"];} else if ($ii == 3) { $A = $_FILES["filUploadA3"]; $B = $_FILES["filUploadB3"]; $C = $_FILES["filUploadC3"];} else { $A = ""; $B = ""; $C = ""; }

             if($A["size"]>0)
            {
             if($A["size"]>1024*25000)  ///ขนาดของไฟล์ที่อัพโหลด 
             {
               //echo "<script>alert('ขนาดไฟล์ห้ามเกิน 25 Mb');</script>";
               echo '<script type="text/javascript">
                      swal("ขนาดไฟล์ห้ามเกิน 25 Mb", "", "warning");
                      setTimeout("window.history.go(-1)",2500);
                     </script>';
               exit();
             }
              
             if($A["type"]!="application/pdf") //file .doc
             {
                echo '<script type="text/javascript">
                      swal("รายการที่ '.$ii.' รองรับเฉพาะ file PDF ", "", "warning");
                      setTimeout("window.history.go(-1)",3000);
                     </script>';
             exit();
             } 
            }

             if($B["size"]>0)
            {
                 if($B["size"]>1024*25000)  ///ขนาดของไฟล์ที่อัพโหลด 
                 {
                   //echo "<script>alert('ขนาดไฟล์ห้ามเกิน 25 Mb');</script>";
                   echo '<script type="text/javascript">
                          swal("ขนาดไฟล์ห้ามเกิน 25 Mb", "", "warning");
                          setTimeout("window.history.go(-1)",2500);
                         </script>';
                   exit();
                 }
                  
                 if($B["type"]!="application/pdf") //file .doc
                 {
                    echo '<script type="text/javascript">
                          swal("รายการที่ '.$ii.' รองรับเฉพาะ file PDF ", "", "warning");
                          setTimeout("window.history.go(-1)",3000);
                         </script>';
                 exit();
                 } 
            }                  

             if($C["size"]>0)
            {
                 if($C["size"]>1024*25000)  ///ขนาดของไฟล์ที่อัพโหลด 
                 {
                   //echo "<script>alert('ขนาดไฟล์ห้ามเกิน 25 Mb');</script>";
                   echo '<script type="text/javascript">
                          swal("ขนาดไฟล์ห้ามเกิน 25 Mb", "", "warning");
                          setTimeout("window.history.go(-1)",2500);
                         </script>';
                   exit();
                 }
                  
                 if($C["type"]!="application/pdf") //file .doc
                 {
                    echo '<script type="text/javascript">
                          swal("รายการที่ '.$ii.' รองรับเฉพาะ file PDF ", "", "warning");
                          setTimeout("window.history.go(-1)",3000);
                         </script>';
                 exit();
                 } 
            }

     }       

        $Sql_Head = "INSERT INTO mst_welfare (`emp_empid`, `thai_name`, `position`, `suborgname`, `tel_no`, `welfare_desc`, `welfare_type`, `welfare_date`, `tran_date`, `bug_year`,`welfare_no`,`total`,`status`) 
        VALUES ('".$emp_empid."','".$Thai_name."','".$Position."','".$Suborgname."','".$Tel."','สวัสดิการด้านสุขภาพ (6,000 บาท)','health','".$Date."','".$NowDate."','".$y."','".$fileup."','".$Total."','wait') ";	
        $Result_Head = mysqli_query($conn, $Sql_Head); 

        $Sql_welfare = "select * from mst_welfare where welfare_no = '".$fileup."' ";
        $PerRecords = mysqli_query($conn, $Sql_welfare);
        while ($RowWelfare = mysqli_fetch_assoc($PerRecords)) {
                $welfare_id = $RowWelfare['welfare_id'];
            }

        $Sql_Log = "INSERT INTO log_transection (`type`, `id`, `emp_empid`, `description`, `tran_date`, `status`, `name`) 
        VALUES ('health','".$welfare_id."','".$emp_empid."','".'ยื่นแบบฟอร์ม'."','".$NowDate."','wait','".$Thai_name."') "; 
        $Result_Log = mysqli_query($conn, $Sql_Log);          

    for ($ii = 1; $ii <= $i; $ii++) {
        if ($ii == 1) { $A = $_FILES["filUploadA1"]; $B = $_FILES["filUploadB1"]; $C = $_FILES["filUploadC1"]; } 
        else if ($ii == 2) { $A = $_FILES["filUploadA2"]; $B = $_FILES["filUploadB2"]; $C = $_FILES["filUploadC2"]; } 
        else if ($ii == 3) { $A = $_FILES["filUploadA3"]; $B = $_FILES["filUploadB3"]; $C = $_FILES["filUploadC3"]; } 
        else { $A = ""; $B = ""; $C = ""; }

             if($A["size"]>0)
            {              
             if(($A["type"]=="application/pdf")) //file .doc
             {
                $fileupA = date("Ymdhis");
               move_uploaded_file($A["tmp_name"],"fileupload/health/".$emp_empid."_".$ii."_A".iconv('UTF-8', 'TIS-620', $fileupA).".pdf");
               $fileupA = $emp_empid."_".$ii."_A".$fileupA.".pdf";
             } 
            } else {
             $fileupA = "";
            } 

             if($B["size"]>0)
            {              
             if(($B["type"]=="application/pdf")) //file .doc
             {
                $fileupB = date("Ymdhis");
               move_uploaded_file($B["tmp_name"],"fileupload/health/".$emp_empid."_".$ii."_B".iconv('UTF-8', 'TIS-620', $fileupB).".pdf");
               $fileupB = $emp_empid."_".$ii."_B".$fileupB.".pdf";
             }                  
            } else {
             $fileupB = "";
            }  

             if($C["size"]>0)
            {              
             if(($C["type"]=="application/pdf")) //file .doc
             {
                $fileupC = date("Ymdhis");
               move_uploaded_file($C["tmp_name"],"fileupload/health/".$emp_empid."_".$ii."_C".iconv('UTF-8', 'TIS-620', $fileupC).".pdf");
               $fileupC = $emp_empid."_".$ii."_C".$fileupC.".pdf";
             }                  
            } else {
             $fileupC = "";
            }                   


            $Sql_Detail = "INSERT INTO detail_welfare (`welfare_id`, `welfare_line`, `type_name`, `name`, `id_card`, `birthday`, `sun_line`, `sun_type`, `sick`,`host`,`host_type`, `start_date`,`end_date`, `money`,`doc`,`welfare_file1`,`welfare_file2`,`welfare_file3`, `bug_year`) 
            VALUES ('".$welfare_id."','".$ii."','".$TypeName[$ii]."','".$Name[$ii]."','".$IdCard[$ii]."','".$Birth[$ii]."','".$Sun[$ii]."','".$SunType[$ii]."','".$Sick[$ii]."','".$Host[$ii]."','".$Host_Type[$ii]."','".$Start[$ii]."','".$End[$ii]."','".$Money[$ii]."','".$Doc[$ii]."','".$fileupA."','".$fileupB."','".$fileupC."','".$y."') ";	
            $Result_Detail = mysqli_query($conn, $Sql_Detail);
     }    

    echo  '<script>$(document).ready(function(e) { Swal.fire({ title: "บันทึกข้อมูลเรียบร้อย", icon: "success", showConfirmButton: false, confirmButtonText: " ตกลง ",timer: 1500 }).then(function() {KTUtil.scrollTop(); window.location = "index.php?menu=แบบฟอร์มขอเบิกเงินสวัสดิการด้านสุขภาพ"}); }); </script>';


    // $Ex_p_id = mysqli_insert_id($conn);

    //ปิดการเชื่อมต่อ database
    mysqli_close($conn);
}

?>