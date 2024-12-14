<?php
session_start();
session_unset();  // ลบข้อมูล session
session_destroy();  // ทำลาย session

// Redirect กลับไปยังหน้า login
header("Location: login.php");
exit;
?>
