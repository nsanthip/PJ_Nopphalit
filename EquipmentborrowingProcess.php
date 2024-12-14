
<?php
session_start();
require_once('scripts/connect.php');
$db_handle = new myDBControl();


// รับค่าตัวแปร สถานะการทำ [A : add, V : view/update, D : Delete]
if (isset($_GET['work'])) {
    $wk = $_GET['work'];

    if ($wk == 'A') {
        // เพิ่มข้อมูลใหม่
        $Record_id   = $_POST['Record_id'];
        $Equipment_id = $_POST['Equipment_id'];
        $User_id      = $_POST['User_id'];
        $Borrow_date  = $_POST['Borrow_date'];
        $Return_date  = $_POST['Return_date'];
        $Status       = $_POST['Status'];
        // "ยืม"; // สถานะเป็น "ยืม" ทันทีที่เพิ่ม


        // ตรวจสอบว่าอุปกรณ์พร้อมใช้งานก่อนเพิ่มข้อมูล
        $equipment_check = $db_handle->Textquery("SELECT * FROM equipment WHERE Equipment_id = '$Equipment_id' AND Status = 'มีอยู่'");
        if (count($equipment_check) > 0) {
            // บันทึกข้อมูลใน borrow_records
            $insertBorrow = $db_handle->Execquery("INSERT INTO borrow_records VALUES ('$Record_id', '$Equipment_id', '$User_id', '$Borrow_date', '$Return_date', '$Status')");

            // อัพเดตสถานะอุปกรณ์เป็น "ยืม"
            $updateEquipment = $db_handle->Execquery("UPDATE equipment SET Status = 'ยืม' WHERE Equipment_id = '$Equipment_id'");


            if ($insertBorrow && $updateEquipment) {
                echo "<script type='text/javascript'>";
                echo "alert('บันทึกเรียบร้อย!');";
                echo "window.location = 'Equipmentborrowing.php'; ";
                echo "</script>";
            } else {
                echo "<script type='text/javascript'>";
                echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
                echo "window.location = 'Equipmentborrowing.php'; ";
                echo "</script>";
            }
        }
    }
}

if ($wk == 'V') {

    // คืนข้อมูล
    $Record_id   = $_POST['Record_id'];
    $Equipment_id = $_POST['Equipment_id'];
    $User_id      = $_POST['User_id'];
    $Borrow_date  = $_POST['Borrow_date'];
    $Return_date  = $_POST['Return_date'];
    $Status       = $_POST['Status'];
    // "คืน"; // สถานะเป็น "คืน"

    // ตรวจสอบข้อมูลใน borrow_records ก่อนคืน
    $borrow_check = $db_handle->Textquery("SELECT * FROM borrow_records WHERE Record_id = '$Record_id' AND Equipment_id = '$Equipment_id' AND Status = 'ยืม'");
    if (count($borrow_check) > 0) {
        // อัพเดตสถานะใน borrow_records
        $updateBorrow = $db_handle->Execquery("UPDATE borrow_records SET Status = '$Status', Return_date = CURDATE() WHERE Record_id = '$Record_id'");

        // อัพเดตสถานะอุปกรณ์เป็น "มีอยู่"
        $updateEquipment = $db_handle->Execquery("UPDATE equipment SET Status = 'มีอยู่' WHERE Equipment_id = '$Equipment_id'");

        if ($updateBorrow && $updateEquipment) {
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกเรียบร้อย!');";
            echo "window.location = 'Equipmentborrowing.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ไม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Equipmentborrowing.php'; ";
            echo "</script>";
        }
    }
}

if ($wk == 'D') {
    // รับ Record_id ที่จะลบ
    $Record_id = $_GET['Eid'];

    // ดึงข้อมูลการยืมก่อนลบ
    $borrow_check = $db_handle->Textquery("SELECT * FROM borrow_records WHERE Record_id = '$Record_id'");
    if (count($borrow_check) > 0) {
        $Equipment_id = $borrow_check[0]['Equipment_id'];
        $Status = $borrow_check[0]['Status'];

        // หากสถานะเป็น "ยืม" ต้องเปลี่ยนสถานะอุปกรณ์กลับเป็น "มีอยู่"
        if ($Status == 'ยืม') {
            $updateEquipment = $db_handle->Execquery("UPDATE equipment SET Status = 'มีอยู่' WHERE Equipment_id = '$Equipment_id'");
        }

        // ลบข้อมูลจาก borrow_records
        $deleteBorrow = $db_handle->Execquery("DELETE FROM borrow_records WHERE Record_id = '$Record_id'");
        
        if ($deleteBorrow) {
            echo "<script type='text/javascript'>";
            echo "alert('ลบเรียบร้อย!');";
            echo "window.location = 'Equipmentborrowing.php'; ";
            echo "</script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('ลบไม่ม่สำเร็จ กรุณาตรวจสอบ!');";
            echo "window.location = 'Equipmentborrowing.php'; ";
            echo "</script>";
        }
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คำสั่งไม่ถูกต้อง กรุณาตรวจสอบ!');";
    echo "window.location = 'Equipmentborrowing.php'; ";
    echo "</script>";
}
