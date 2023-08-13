<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<!-- js add fields -->
<!--   <script src="js/js-input.js?v=1.1.0.6" type="text/javascript"></script> -->

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
                <span class="card-label font-weight-bolder text-dark">แบบฟอร์มขอเบิกเงินสวัสดิการค่าแว่นสายตา</span>
            </h3>
        </div>

        <?php
        if ($_SESSION['login'] != "TUlibrary") {
            header("location:login.php");
        }

        include './condb.php';

        $emp_empid = $_SESSION["empid"];
        $SQLperson = "select * from person where emp_empid = '" . $_SESSION["empid"] . "' ";
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
            $y = $y = 543;
        }

        // $SQLTotal = "select total from mst_welfare where emp_empid = '" . $emp_empid . "' and bug_year = '" . $y . "' and status <> 'unapproved' ";
        // $TotalRecords = mysqli_query($conn, $SQLTotal);
        // while ($rowTotal = mysqli_fetch_assoc($TotalRecords)) {
        //     $Total = $Total + $rowTotal['total'];
        // }
        // $Total = 2000 - $Total;

        // ?>
    </div>

    <!--begin::Form-->
    <form action="AddSaveEye.php" name="frmAdd" id="frmAdd" method="POST" enctype="multipart/form-data">
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
                                <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?= $name ?>" disabled="disabled" />
                            </div>
                            <label class="col-form-label">&nbsp;ตำแหน่ง</label>
                            <div class="col-lg-3 col-xl-3">
                                <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?= $position ?>" disabled="disabled" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">สังกัด</label>
                            <div class="col-lg-3 col-xl-3">
                                <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?= $suborgname ?>" disabled="disabled" />
                            </div>
                            <label class="col-form-label">&nbsp;โทร</label>
                            <div class="col-lg-3 col-xl-3">
                                <input class="form-control form-control-sm form-control-solid" type="text" placeholder="<?= $tel ?>" disabled="disabled" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label">ประสงค์ขอเบิกเงินค่าแว่นตา ตามใบเสร็จรับเงินของ(ชื่อร้าน/สถานพยาบาล)&nbsp;&nbsp;</label>
                            <input class="form-control col-lg-2" type="text" value="" id="host_name" name="host_name" placeholder="กรุณาระบุชื่อร้าน/สถานพยาบาล" maxlength="350" required>

                            <label class="col-form-label"> &nbsp;&nbsp; วันที่ &nbsp;&nbsp;</label>
                            <input class="form-control col-2" type="date" value="<?php echo date('Y-m-d'); ?>" id="date_in" name="date_in" maxlength="100" required>


                            <label class="col-form-label">&nbsp;&nbsp;เป็นเงินรวมทั้งสิ้น <span class="text-danger">* &nbsp;&nbsp;</span></label>
                            <input class="form-control col-lg-2" type="number" value="" id="money" name="money" placeholder="กรุณาระบุจำนวนเงิน" min="1" max="100000" required>
                            <label class="col-form-label">&nbsp; บาท</label>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label">ไฟล์แนบเอกสารประกอบการเบิกค่าแว่นสายตา <span class="text-danger">* &nbsp;&nbsp;</label>
                            <input class="form-control col-lg-3" type="file" value="" id="file" name="file" maxlength="350" required>


                        </div>

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

    </form>
    <!--end::Form-->
</div>
<?php

if (isset($_POST['withdraw'])) {

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