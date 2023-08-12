<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
    if($_SESSION['menu'] != "admin-TUlibrary"){
        header("location:login.php");
      }

    $id = $_GET['id_del_no'];
    $emp_empid = $_GET['id'];
    $NowDate = date("Ymdhis");

if($id != "")
  {
                    include('condb.php');
                    $query ="DELETE FROM `mst_welfare` WHERE `mst_welfare`.`welfare_id` = $id";  

                        if ($conn->query($query) === TRUE ) {

                            $SQLWelfare = "select * from `detail_welfare` where `welfare_id` = '".$id."' ";
                            $WelfareRecords = mysqli_query($conn, $SQLWelfare);
                            while ($RowWelfare = mysqli_fetch_assoc($WelfareRecords)) { 
                                $welfare_no = $RowWelfare['welfare_no'];
                                $welfare_file1 = $RowWelfare['welfare_file1'];
                                $welfare_file2 = $RowWelfare['welfare_file2'];
                                $welfare_file3 = $RowWelfare['welfare_file3'];

                                $path="fileupload/health/"; //path ที่ไว้เก็บรูปภาพ        
                                $file=$path.$welfare_file1;
                                if($welfare_file1 != "") { unlink($file); }
                                if($welfare_file2 != "" ) { $file=$path.$welfare_file2; unlink($file); }  
                                if($welfare_file3 != "" ) { $file=$path.$welfare_file3; unlink($file); }

                                $SQLDelDet ="DELETE FROM `detail_welfare` WHERE `detail_welfare`.`welfare_no` = $welfare_no";

                                if ($conn->query($SQLDelDet) === TRUE ) { }
                            }

                                $Sql_Log = "INSERT INTO `log_transection` (`type`, `id`, `emp_empid`, `description`, `tran_date`, `status`, `name`) 
                                VALUES ('health','".$id."','".$emp_empid."','".'ลบข้อมูล'."','".$NowDate."','".'Delete'."','".$_SESSION["name"]."') "; 
                                $Result_Log = mysqli_query($conn, $Sql_Log);                             

                                echo  '<script>$(document).ready(function(e) { Swal.fire({ title: "ลบข้อมูลเรียบร้อย", icon: "success", showConfirmButton: false, confirmButtonText: " ตกลง ",timer: 1500 }).then(function() {KTUtil.scrollTop(); window.location = "index.php?menu=สวัสดิการด้านสุขภาพ"}); }); </script>';
                                mysqli_close($conn);

                        } else {
                                   echo '<script type="text/javascript">
                                          swal("Error รายการนี้ไม่สามารถทำการลบข้อมูลได้", "", "warning");
                                          setTimeout("window.history.go(-1)",2500);
                                         </script>';
                                   exit();                                
                                }

} else {   
    echo '<script type="text/javascript">
        swal("Error รายการนี้ไม่สามารถทำการลบข้อมูลได้", "", "error");
        setTimeout("window.history.go(-1)",2500);
    </script>';
    exit();   
}

?>