<?php
session_start();
require_once('scripts/connect.php');
$db_handle = new myDBControl();


// รับค่าตัวแปร สถานะการทำ [A : add, V : view/update, D : Delete]
if (isset($_GET['work'])) {
    $wk = $_GET['work'];

    if ($wk == 'A') {
        // เพิ่มข้อมูลใหม่
        $Project_id           = $_POST['Project_id'];
        $Project_name         = $_POST['Project_name'];
        $Project_location     = $_POST['Project_location'];
        $Start_date           = $_POST['Start_date'];
        $End_date             = $_POST['End_date'];
        $Status               = $_POST['Status'];


        //เพิ่มไฟล์
        $fileupload         = $_FILES['fileupload'];
        if ($fileupload <> '') {   //not select file
            //โฟลเดอร์ที่จะ upload file เข้าไป 
            $path = "img/Project/" . $Project_id . ".jpg";

            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
        }

        // $empwork = $db_handle->Execquery("INSERT INTO users (Project_id, firstname, lastname, address, img_user, username, password, phone_number, user_type) 
        // VALUES ('$Project_id', '$firstname', '$lastname', '$Start_date', '$path', '$End_date', '$Status', )");

        $empwork = $db_handle->Execquery("INSERT INTO projects VALUES('$Project_id','$Project_name','$Project_location','$Start_date','$End_date','$Status','$path')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'Project.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Project.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'V') {
        // แก้ไขข้อมูล
        $Project_id           = $_POST['Project_id'];
        $Project_name         = $_POST['Project_name'];
        $Project_location     = $_POST['Project_location'];
        $Start_date           = $_POST['Start_date'];
        $End_date             = $_POST['End_date'];
        $Status               = $_POST['Status'];
        

        //โฟลเดอร์ที่จะ upload file เข้าไป 
        $path = "img/Project/" . $Project_id . ".jpg";
        $fileupload         = $_FILES['fileupload'];
        if ($_FILES['fileupload']['tmp_name'] <> '') {   //not select file
            unlink($path);
            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
            // echo "Image file " . $_FILES['fileupload']['tmp_name'] . " <br>";
        }

        $empwork = $db_handle->Execquery("UPDATE projects SET  
        Project_name = '$Project_name', 
        Project_location = '$Project_location', 
        Start_date = '$Start_date', 
        End_date = '$End_date',
        Status = '$Status' ,
        Img_project = '$path'
        WHERE (Project_id = '$Project_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'Project.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Project.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'D') {
        // ลบข้อมูล 
        $Project_id        = $_GET['Eid'];

        //echo "DELETE FROM EMPLOYEE WHERE (Emp_id = '$Eid')";
        $empwork = $db_handle->Execquery("DELETE FROM projects WHERE (Project_id = '$Project_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('ลบเรียบร้อย!');";
            echo "window.location = 'Project.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ลบไม่ม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Project.php'; ";
            echo "</script>";
        }
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คำสั่งไม่ถูกต้อง กรุณาตรวจสอบ!');";
    echo "window.location = 'Project.php'; ";
    echo "</script>";
}
