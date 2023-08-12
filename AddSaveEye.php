<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- ?php
if ($_SESSION['login'] != "TUlibrary") {
    header("location:login.php");
} -->
<?php
include('condb.php');

// string file
if (!empty($_FILES['filename']['tmp_name'])) {
    $tmp_name = $_FILES['filename']['tmp_name'];
    $temp = explode(".", $_FILES["filename"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $name = $_POST['name'];
    $position = $_POST['position'];
    $suborgname = $_POST['suborgname'];
    $tel = $_POST['tel'];
    $host_name = $_POST['host_name'];
    $date = $_POST['date'];
    $money = $_POST['money'];
    // $file = $_POST['file'];


    $sql  = "INSERT INTO glasses (name,position,suborgname,tel,host_name,date,money,filename)
    VALUES('$name','$position','$suborgname','$tel','$host_name','$date','$money','$newfilename')";
    $result = mysqli_query($conn, $sql);

    //upload file in folder
    move_uploaded_file($_FILES["filename"]["tmp_name"], "../upload/" . $newfilename);
}
echo '
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

if ($result) {
    echo '<script>
             setTimeout(function() {
              swal({
                  title: "บันทึกข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = ""; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
} else {
    echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  type: "error"
              }, function() {
                  window.location = ""; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
}



?>