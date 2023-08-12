<?php
  $filename = $_GET['FileHealth'];
  $file = 'fileupload/health/'.$filename;
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $filename . '"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($file);
?> 