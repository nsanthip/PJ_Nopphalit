<?php
session_start();
require_once('scripts/connect.php');
$db_handle = new myDBControl();


// รับค่าตัวแปร สถานะการทำ [A : add, V : view/update, D : Delete]
if (isset($_GET['work'])) {
    $wk = $_GET['work'];

    if ($wk == 'A') {
        // เพิ่มข้อมูลใหม่
        $Assignment_id      = $_POST['Assignment_id'];
        $Project_id         = $_POST['Project_id'];
        $User_id            = $_POST['User_id'];
        $Role_in_project    = $_POST['Role_in_project'];



        // //เพิ่มไฟล์
        // $fileupload         = $_FILES['fileupload'];
        // if ($fileupload <> '') {   //not select file
        //     //โฟลเดอร์ที่จะ upload file เข้าไป 
        //     $path = "img/Project/" . $Assignment_id . ".jpg";

        //     //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
        //     move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
        // }

        // $empwork = $db_handle->Execquery("INSERT INTO users (Assignment_id, firstname, lastname, address, img_user, username, password, phone_number, user_type) 
        // VALUES ('$Assignment_id', '$firstname', '$lastname', '$Role_in_project', '$path', '$End_date', '$Status', )");

        $empwork = $db_handle->Execquery("INSERT INTO project_assignments VALUES('$Assignment_id','$Project_id','$User_id','$Role_in_project')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'ProjectEmp.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'ProjectEmp.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'V') {
        // แก้ไขข้อมูล
        $Assignment_id      = $_POST['Assignment_id'];
        $Project_id         = $_POST['Project_id'];
        $User_id            = $_POST['User_id'];
        $Role_in_project    = $_POST['Role_in_project'];

        

        // //โฟลเดอร์ที่จะ upload file เข้าไป 
        // $path = "img/Project/" . $Assignment_id . ".jpg";
        // $fileupload         = $_FILES['fileupload'];
        // if ($_FILES['fileupload']['tmp_name'] <> '') {   //not select file
        //     unlink($path);
        //     //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
        //     move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
        //     // echo "Image file " . $_FILES['fileupload']['tmp_name'] . " <br>";
        // }

        $empwork = $db_handle->Execquery("UPDATE project_assignments SET  
        Project_id = '$Project_id', 
        User_id = '$User_id', 
        Role_in_project = '$Role_in_project', 
        WHERE (Assignment_id = '$Assignment_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'ProjectEmp.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'ProjectEmp.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'D') {
        // ลบข้อมูล 
        $Assignment_id        = $_GET['Eid'];

        //echo "DELETE FROM EMPLOYEE WHERE (Emp_id = '$Eid')";
        $empwork = $db_handle->Execquery("DELETE FROM project_assignments WHERE (Assignment_id = '$Assignment_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('ลบเรียบร้อย!');";
            echo "window.location = 'ProjectEmp.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ลบไม่ม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'ProjectEmp.php'; ";
            echo "</script>";
        }
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คำสั่งไม่ถูกต้อง กรุณาตรวจสอบ!');";
    echo "window.location = 'ProjectEmp.php'; ";
    echo "</script>";
}
