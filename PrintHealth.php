<?php

    if($_SESSION['menu'] != "admin-TUlibrary"){
        header("location:login_admin.php");
      }
?>


<style>
      fieldset {
  border: 1px solid #cecfd5;
  border-radius: 6px;
  padding: 24px 30px;
}

    </style>

<!-- เลือกช่วงวันที่ที่ -->
<?php
  $strKeyword = null;

  if(isset($_GET["id"]))
  {
    $strKeyword = $_GET['id'];
  }

?>

<?php

 if($strKeyword != "")
   {
 ?>         
<script type="text/javascript">

function printSelection(node){
 
  var content=node.innerHTML
  var pwin=window.open('');
  var cStyls = document.getElementsByTagName('stylesheet')

  pwin.document.open();
  pwin.document.write('<html><body onload="window.print()">'+content+'</body></html>');
  pwin.document.close();
 

if(document.getElementById("print").style.display=="inline")   
{   
document.getElementById("print").style.display="none";   
}
  setTimeout(function(){pwin.close();},0);

}

</script>
<DIV id="report">                        
  
<?php

include 'condb.php';
    //$date = date("YmdHis");

$sql = "select * from `mst_welfare` where `welfare_id` = '".$_GET['id']."' ";

$result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) == 0){
                        echo "<script>
                        alert('ไม่พบรายการ ตามช่วงวันดังกล่าว');</script>";
                    } else {
 //-----------------------------------พบรายการปริ้น-------------------------------------
 ?>
                                <div class="card card-custom">
                                    <div class="card-body">
                                            <a class="btn btn-success" name="button" id="print" onClick="printSelection(document.getElementById('report'))">
                                                <i class="flaticon2-printer"></i> ปริ้นแบบฟอร์ม
                                            </a>
                                            <input type="button" onclick="location.href='?menu=สวัสดิการด้านสุขภาพ'" class="btn btn-warning" value="ยกเลิก">




<?php

$RowHealth = mysqli_fetch_assoc($result);
$date = $RowHealth['welfare_date'];
$MstName = $RowHealth['thai_name'];

$m = date("m");
    $y = date("Y");
    $Total = 0;
    if ($m > 9) { $y = $y + 544; } else { $y = $y + 543; }

    $SQLTotal = "select total from `mst_welfare` where `emp_empid` = '".$emp_empid."' and `bug_year` = '".$y."' and `status` <> 'unapproved' ";
    $TotalRecords = mysqli_query($conn, $SQLTotal);
    while ($rowTotal = mysqli_fetch_assoc($TotalRecords)) {
            $Total = $Total + $rowTotal['total'];
        }
    $TotalA = 6000 - $Total;

?>
<h4 class="card-title align-items-start flex-column">
    <div align="center">แบบฟอร์มขอเบิกเงินสวัสดิการด้านสุขภาพ</div><br>
    <div align="center">โปรดทำเครื่องหมาย &check; ลงในช่อง &#9723; พร้อมทั้งกรอกข้อความเท่าที่จำเป็น</div>
</h4>    

<table align="center" width="100%" border="1" cellspacing="0" cellpadding="0">

<tr><br>
    <td colspan="2">
        <span class="font-size-sm" align="left"><br>&nbsp;&nbsp;1.ข้าพเจ้า..................<?=$MstName;?>...........................................ตำแหน่ง......<?=$RowHealth['position'];?>...........</span>  
        <span class="font-size-sm" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สังกัด...............<?=$RowHealth['suborgname'];?>.....................................โทร........<?=$RowHealth['tel_no'];?>............................<br><br></span>
    </td>
</tr>

<tr><td colspan="2">
        <div align="left"><br>&nbsp;&nbsp;2.ขอเบิกเงินค่ารักษาพยาบาลของ<br><br></div> 
<?php 
        $sqlTable = "SELECT * FROM `detail_welfare` WHERE `welfare_id` = '".$_GET['id']."' ORDER BY `welfare_line` asc";
        $resultTable = mysqli_query($conn, $sqlTable);
        
        while ($rs = mysqli_fetch_assoc($resultTable)) {
            $name = $rs['name'];
            $type_name = $rs['type_name'];
            $id_card = $rs["id_card"];
            $birthday = $rs["birthday"];
            $sun_line = $rs["sun_line"];
            $sun_type = $rs["sun_type"];
            $sick = $rs["sick"];
            $host = $rs["host"];
            $host_type = $rs["host_type"];
            $start_date = $rs["start_date"];
            $end_date = $rs["end_date"];
            $money = $rs["money"];
            $doc = $rs["doc"];
?>
        <div align="left">
                <span class="font-weight-bold font-size-h3">&nbsp;&nbsp;&nbsp;&nbsp;&#9745;</span>
                <span class="font-size-sm">&nbsp;<?=$type_name;?> &nbsp;ชื่อ.....<?=$name;?>..........................เลชประจำตัวประชาชน..........<?=$id_card;?>........................</span><br>
            <?php 
              if ($type_name == "บุตร") {
            ?>
                <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;เกิดเมื่อ.....<?=thai_date($birthday);?>.........เป็นบุตรลำดับที่..........<?=$sun_line;?>.........<?=$sun_type;?></span><br><br>
            <?php
              }
              ?>
                <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;ป่วยเป็นโรค........<?=$sick?>.................</span><br>
                <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;และได้เข้ารับการตรวจรักษาพยาบาลจาก (ชื่อสถานพยาบาล).....<?=$host;?>.....</span><br>
                <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;ซึ่งเป็นสถานพยาบาลของ.....<?=$host_type;?>..... ตั้งแต่วันที่.....<?=thai_date($start_date);?>.....ถึงวันที่.....<?=thai_date($end_date);?>.....</span><br>
                <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;เป็นเงินทั้งสิ้น.....<?=number_format($money, 2);?>.....บาท (<?=Convert($money);?>)</span><br>
                <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;ตามใบเสร็จรับเงินที่แนบ จำนวน.....<?=$doc;?>.....ฉบับ</span><br>
                <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขอรับรองว่าข้อความข้างต้นเป็นจริงทุกประการ</span><br><br><br>
        </div>                              
            <?php    
            }
            ?>
        <div align="right">         
            <span class="font-size-sm">ลงชื่อ.....<?=$MstName;?>.....ผู้ขอรับเงินสวัสดิการด้านสุขภาพ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br>
            <span class="font-size-sm">(.....<?=$MstName;?>.....)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br>
            <span class="font-size-sm">วันที่.....<?=thai_date($date);?>.....&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br><br>
        </div>
    </td>
</tr>
            <tr>
                <td style="width:53%" align="left"> 
                    <span class="font-size-sm">&nbsp;&nbsp;สำหรับเจ้าหน้าที่</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ได้ตรวจสอบคำขอเบิกและหลักฐานประกอบแล้วเห็นว่า</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;ถูกต้องควรอนุมัติจ่ายเงินได้ตามระเบียบ มธ. ว่าด้วยหลักเกณฑ์</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;และอัตราการจ่ายเงินของหอสมุดแห่งมธ.จำนวน...<?=number_format($money, 2);?>..บาท</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เบิกไปแล้ว ....<?=number_format($Total, 2);?>.....</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คงเหลือ ....<?=number_format($TotalA, 2);?>....</span><br><br>

                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ....<?=$_SESSION['name'];?>.....</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;งานอำนวยการ</span><br><br>
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่.......เดือน............พ.ศ..........</span><br><br>                                                             
                    
                </td>
                <td style="width:47%" align="left"> 
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;คำอนุมัติ</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;อนุมัติให้เบิกจ่ายได้</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;</span><br>
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ลงชื่อ).............................................ผู้อนุมัติ</span><br><br>
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(.......ฐิติมา เธียรอนันตกุล.......)</span><br><br>
                    <span class="font-size-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่.......เดือน............พ.ศ..........</span><br><br>                    
                </td>
            </tr>

</table>    
         
<style>
@media print {
#print {display: none;}
}
</style>
</div></div>
</DIV>

<?php   
}                 
  mysqli_close($conn);
} 
?>