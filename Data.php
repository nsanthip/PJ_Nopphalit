<?php
session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// var_dump($_POST);
require_once 'scripts/connect.php';
$db_handle = new myDBControl();

if (isset($_POST['username'])) {
  $UN = $_POST['username'];
  $PW = $_POST['password'];

  $User = $db_handle->Textquery(
    query: "SELECT * FROM user WHERE Username = '" .
      $UN .
      "' and Password = '" .
      $PW .
      "' "
  );

  if (!empty($User)) {
    $_SESSION['UT'] = $User[0]['User_type'];
    $_SESSION['UN'] = $User[0]['Username'];
    $_SESSION['UF'] = $User[0]['Password'];
    $_SESSION["UID"] = $User[0]["User_id"];

    $UserType = $User[0]['User_type'];
    if ($UserType == 'เจ้าหน้าที่') {
      echo "<script type='text/javascript'>";
      echo "alert('คุณคือ เจ้าหน้าที่');";
      echo "window.location = 'Employee.php'; ";
      echo '</script>';
    } else {
      echo "<script type='text/javascript'>";
      echo "alert('คุณคือ สมาชิก');";
      echo "window.location = 'Personal.php'; ";
      echo '</script>';
    }
  } else {
    echo "<script type='text/javascript'>";
    echo "alert('User หรือ Password ไม่ถูกต้อง...กรุณาตรวจสอบ');";
    echo "window.location = 'Login.php'; ";
    echo '</script>';
  }
}
?>