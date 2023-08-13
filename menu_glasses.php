<script type="text/javascript" src="assets/js/hr/site.js"></script>
<style>
    ul,
    #myUL {
        list-style-type: none;
    }

    #myUL {
        margin: 0;
        padding: 0;
    }

    .caret {
        cursor: pointer;
        -webkit-user-select: none;
        /* Safari 3.1+ */
        -moz-user-select: none;
        /* Firefox 2+ */
        -ms-user-select: none;
        /* IE 10+ */
        user-select: none;
    }

    .caret::before {
        /*content: "\002B";*/
        color: black;
        display: inline-block;
        margin-right: 6px;
    }

    .caret-down::before {
        /*content: "\002D"; */
        color: black;
        display: inline-block;
        margin-right: 6px;
    }

    .nested {
        display: none;
    }

    .active {
        display: block;
    }
</style>
<?php

if ($_SESSION['login'] != "TUlibrary") {
    header("location:login.php");
}

$emp_empid = $_SESSION["empid"];
?>
<div class="card card-custom">
    <div class="card-body">
        <div class="card-title">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">สวัสดิการค่าแว่นสายตา</span><br>
                <span class="text-muted mt-1 font-weight-bold font-size-sm">หอสมุดแห่งมหาวิทยาลัยธรรมศาสตร์</span>
            </h3>
            <a href="?menu=แบบฟอร์มขอเบิกเงินสวัสดิการค่าแว่นสายตา" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                </span>แบบฟอร์มขอเบิกเงินสวัสดิการค่าแว่นสายตา</a>
        </div>
        <!--begin: Datatable-->

        <table class="table table-bordered table-hover table-checkable" id="kt_datatable_health" style="margin-top: 8px !important">
            <thead>
                <tr>
                    <!-- <th style="text-align:center;">ลำดับ</th> -->
                    <th style="text-align:center;">ปีงบประมาณ</th>
                    <th style="text-align:center;">ชื่อ - นามสกุล</th>
                    <th style="text-align:center;">วันที่ยืนเบิกค่าแว่นสายตา</th>
                    <!-- <th style="text-align:center;">ยอดรวม</th> -->
                    <th style="text-align:center;">สถานะ</th>
                    <!-- ?php if ( $emp_empid == "58037" || $emp_empid == "55146" ) { echo "<th style='text-align:center;'>แก้ไขรายการ</th>"; } ?> -->
                    <th style="text-align:center;">รายละเอียดรายการเบิกค่าแว่นสายตา</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include './condb.php';

                ?>
            </tbody>
            <!-- if else $name $lastname $Age $retrun $ date $prict $status $condb $password -->
        </table>
    </div>
</div>