<?php
session_start();
require_once('scripts/connect.php');
$db_handle = new myDBControl();


// รับค่าตัวแปร สถานะการทำ [A : add, V : view/update, D : Delete]
if (isset($_GET['work'])) {
    $wk = $_GET['work'];

    if ($wk == 'A') {
        // เพิ่มข้อมูลใหม่
        $User_id           = $_POST['User_id'];
        $Name               = $_POST['Name'];
        $Surname            = $_POST['Surname'];
        $Address            = $_POST['Address'];
        $Username           = $_POST['Username'];
        $Password           = $_POST['Password'];
        $Phone_number       = $_POST['Phone_number'];
        $User_type          = $_POST['User_type'];
        $Salary_base        = $_POST['Salary_base'];

        //เพิ่มไฟล์
        $fileupload         = $_FILES['fileupload'];
        if ($fileupload <> '') {   //not select file
            //โฟลเดอร์ที่จะ upload file เข้าไป 
            $path = "img/Employee/" . $User_id . ".jpg";

            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
        }

        // $empwork = $db_handle->Execquery("INSERT INTO users (User_id, firstname, lastname, address, img_user, username, password, phone_number, user_type) 
        // VALUES ('$User_id', '$firstname', '$lastname', '$address', '$path', '$username', '$password', '$phone_number', '$user_type')");

        $empwork = $db_handle->Execquery("INSERT INTO user VALUES('$User_id','$Name','$Surname','$Address','$path','$Username','$Password','$Phone_number','$User_type','$Salary_base')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'Employee.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Employee.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'V') {
        // แก้ไขข้อมูล
        $User_id           = $_POST['User_id'];
        $Name               = $_POST['Name'];
        $Surname            = $_POST['Surname'];
        $Address            = $_POST['Address'];
        $Username           = $_POST['Username'];
        $Password           = $_POST['Password'];
        $Phone_number       = $_POST['Phone_number'];
        $User_type          = $_POST['User_type'];
        $Salary_base        = $_POST['Salary_base'];
        

        //โฟลเดอร์ที่จะ upload file เข้าไป 
        $path = "img/Employee/" . $User_id . ".jpg";
        $fileupload         = $_FILES['fileupload'];
        if ($_FILES['fileupload']['tmp_name'] <> '') {   //not select file
            unlink($path);
            //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์
            move_uploaded_file($_FILES['fileupload']['tmp_name'], $path);
            // echo "Image file " . $_FILES['fileupload']['tmp_name'] . " <br>";
        }

        $empwork = $db_handle->Execquery("UPDATE user SET  
        Name = '$Name', 
        Surname = '$Surname', 
        Address = '$Address', 
        Phone_number = '$Phone_number' ,
        Password = '$Password' ,
        Img_User = '$path',
        User_type = '$User_type',
        Salary_base = '$Salary_base'
        WHERE (User_id = '$User_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'Employee.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Employee.php'; ";
            echo "</script>";
        }
    }

    if ($wk == 'D') {
        // ลบข้อมูล 
        $User_id        = $_GET['Eid'];

        //echo "DELETE FROM EMPLOYEE WHERE (Emp_id = '$Eid')";
        $empwork = $db_handle->Execquery("DELETE FROM user WHERE (User_id = '$User_id')");

        if ($empwork) {
            echo "<script type='text/javascript'>";
            echo "alert('ลบเรียบร้อย!');";
            echo "window.location = 'Employee.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ลบไม่ม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Employee.php'; ";
            echo "</script>";
        }
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คำสั่งไม่ถูกต้อง กรุณาตรวจสอบ!');";
    echo "window.location = 'Employee.php'; ";
    echo "</script>";
}
