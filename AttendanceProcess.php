<?php
session_start();
require_once('scripts/connect.php');
$db_handle = new myDBControl();


// รับค่าตัวแปร สถานะการทำ [A : add, V : view/update, D : Delete]
if (isset($_GET['work'])) {
    $wk = $_GET['work'];

    if ($wk == 'A') {
        // เพิ่มข้อมูลใหม่
        $Attendance_id      = $_POST['Attendance_id'];
        $User_id            = $_POST['User_id'];
        $Date               = $_POST['Date'];
        $Time_in            = $_POST['Time_in'];
        $Time_out           = $_POST['Time_out'];
        $Is_late            = $_POST['Is_late'];
        $Leave_type = empty($_POST['Leave_type']) ? NULL : $_POST['Leave_type'];
        $Hours_ot           = $_POST['Hours_ot'];

        //เพิ่มไฟล์
        $fileupload         = $_FILES['fileupload'];
        if ($fileupload <> '') {   //not select file
            //โฟลเดอร์ที่จะ upload file เข้าไป 
            $path = "img/Attendance/" . $Attendance_id . ".jpg";

            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
        }

        // $empwork = $db_handle->Execquery("INSERT INTO users (Attendance_id, firstname, lastname, Time_in, img_user, Time_out, Is_late, Leave_type, Hours_ot) 
        // VALUES ('$Attendance_id', '$firstname', '$lastname', '$Time_in', '$path', '$Time_out', '$Is_late', '$Leave_type', '$Hours_ot')");

        $empwork = $db_handle->Execquery("INSERT INTO attendance VALUES('$Attendance_id','$User_id','$Date','$Time_in','$Time_out','$Is_late'," . ($Leave_type ? "'$Leave_type'" : "NULL") . ",'$Hours_ot','$path')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'Attendance.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Attendance.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'V') {
        // แก้ไขข้อมูล
        $Attendance_id      = $_POST['Attendance_id'];
        $User_id            = $_POST['User_id'];
        $Date               = $_POST['Date'];
        $Time_in            = $_POST['Time_in'];
        $Time_out           = $_POST['Time_out'];
        $Is_late            = $_POST['Is_late'];
        $Leave_type = empty($_POST['Leave_type']) ? NULL : $_POST['Leave_type'];
        $Hours_ot           = $_POST['Hours_ot'];
        

        //โฟลเดอร์ที่จะ upload file เข้าไป 
        $path = "img/Attendance/" . $Attendance_id . ".jpg";
        $fileupload         = $_FILES['fileupload'];
        if ($_FILES['fileupload']['tmp_name'] <> '') {   //not select file
            unlink($path);
            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
            // echo "Image file " . $_FILES['fileupload']['tmp_name'] . " <br>";
        }

        $empwork = $db_handle->Execquery("UPDATE attendance SET  
        User_id = '$User_id', 
        Date = '$Date', 
        Time_in = '$Time_in',
        Time_out = '$Time_out', 
        Is_late = '$Is_late' ,
        Leave_type = " . ($Leave_type ? "'$Leave_type'" : "NULL") . " ,
        Hours_ot = '$Hours_ot',
        Leave_evidence = '$path'
        WHERE (Attendance_id = '$Attendance_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'Attendance.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Attendance.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'D') {
        // ลบข้อมูล 
        $Attendance_id        = $_GET['Eid'];

        //echo "DELETE FROM Attendance WHERE (Emp_id = '$Eid')";
        $empwork = $db_handle->Execquery("DELETE FROM attendance WHERE (Attendance_id = '$Attendance_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('ลบเรียบร้อย!');";
            echo "window.location = 'Attendance.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ลบไม่ม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Attendance.php'; ";
            echo "</script>";
        }
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คำสั่งไม่ถูกต้อง กรุณาตรวจสอบ!');";
    echo "window.location = 'Attendance.php'; ";
    echo "</script>";
}
