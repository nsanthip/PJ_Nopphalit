<?php
session_start();
require_once('scripts/connect.php');
$db_handle = new myDBControl();


// รับค่าตัวแปร สถานะการทำ [A : add, V : view/update, D : Delete]
if (isset($_GET['work'])) {
    $wk = $_GET['work'];

    if ($wk == 'A') {
        // เพิ่มข้อมูลใหม่
        $Equipment_id           = $_POST['Equipment_id'];
        $Equipment_name         = $_POST['Equipment_name'];
        $Description            = $_POST['Description'];
        $Status                 = $_POST['Status'];


        //เพิ่มไฟล์
        $fileupload         = $_FILES['fileupload'];
        if ($fileupload <> '') {   //not select file
            //โฟลเดอร์ที่จะ upload file เข้าไป 
            $path = "img/Equipment/" . $Equipment_id . ".jpg";

            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
        }

        // $empwork = $db_handle->Execquery("INSERT INTO users (Equipment_id, firstname, lastname, address, img_user, username, password, phone_number, user_type) 
        // VALUES ('$Equipment_id', '$firstname', '$lastname', '$Quantity', '$path', '$Available_quantity', '$', )");

        $empwork = $db_handle->Execquery("INSERT INTO Equipment VALUES('$Equipment_id','$Equipment_name','$Description','$path','$Status')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'Equipment.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Equipment.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'V') {
        // แก้ไขข้อมูล
        $Equipment_id           = $_POST['Equipment_id'];
        $Equipment_name         = $_POST['Equipment_name'];
        $Description            = $_POST['Description'];
        $Status                 = $_POST['Status'];
    
        

        //โฟลเดอร์ที่จะ upload file เข้าไป 
        $path = "img/Equipment/" . $Equipment_id . ".jpg";
        $fileupload         = $_FILES['fileupload'];
        if ($_FILES['fileupload']['tmp_name'] <> '') {   //not select file
            unlink($path);
            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
            // echo "Image file " . $_FILES['fileupload']['tmp_name'] . " <br>";
        }

        $empwork = $db_handle->Execquery("UPDATE Equipment SET  
        Equipment_name = '$Equipment_name', 
        Description = '$Description', 
        Img_Equipment = '$path',
        Status = '$Status'
        WHERE (Equipment_id = '$Equipment_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'Equipment.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Equipment.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'D') {
        // ลบข้อมูล 
        $Equipment_id        = $_GET['Eid'];

        //echo "DELETE FROM EMPLOYEE WHERE (Emp_id = '$Eid')";
        $empwork = $db_handle->Execquery("DELETE FROM Equipment WHERE (Equipment_id = '$Equipment_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('ลบเรียบร้อย!');";
            echo "window.location = 'Equipment.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ลบไม่ม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Equipment.php'; ";
            echo "</script>";
        }
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คำสั่งไม่ถูกต้อง กรุณาตรวจสอบ!');";
    echo "window.location = 'Equipment.php'; ";
    echo "</script>";
}
