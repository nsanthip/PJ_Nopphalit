<?php
session_start();
require_once('scripts/connect.php');
$db_handle = new myDBControl();

// if (isset($_SESSION["UT"]) && $_SESSION["UT"] == 1) {
//     $userLogin = $_SESSION["UF"];
// } else {
//     echo "<script type='text/javascript'>";
//     echo "alert('คุณไม่มีสิทธิ์กรุณา LOGIN!!!');";
//     echo "window.location = 'login.php';";
//     echo "</script>";
// }

if (isset($_GET['Eid'])) {
    $Ecode = $_GET['Eid'];
} else {
    $Ecode = '1';
}

if (isset($_GET['work'])) {
    $work = $_GET['work'];
} else {
    $work = 'V';
}

// กำหนดจำนวนรายการต่อหน้า
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// ดึงข้อมูลผู้ใช้งานจากฐานข้อมูล (เฉพาะ 10 รายการ)
$user_Data = $db_handle->Textquery("SELECT * FROM attendance LIMIT $limit OFFSET $offset");

// ดึงจำนวนรายการทั้งหมดเพื่อคำนวณจำนวนหน้า
$total_users = $db_handle->Textquery("SELECT COUNT(*) as total FROM attendance")[0]['total'];
$total_pages = ceil($total_users / $limit);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style2.css">


</head>
<style>
    .container {
        margin-top: 50px;
    }

    .modal-header {
        background-color: #007bff;
        color: white;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }
</style>

<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-toggle">
            <div class="sidebar-logo">
                <a href="#">Buntan Construction</a>
            </div>
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav p-0">
                <li class="sidebar-header">
                    จัดการ
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#employee" aria-expanded="true" aria-controls="employee">
                        <i class="lni lni-id-card"></i>

                        <span>สมาชิก</span>
                    </a>
                    <ul id="employee" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="Employee.php" class="sidebar-link">รายชื่อสมาชิก</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="Attendance.php" class="sidebar-link">เข้า-ออกงาน</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="Salary.php" class="sidebar-link">เงินเดือน</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#project" aria-expanded="true" aria-controls="project">
                        <i class="lni lni-gears-3"></i>
                        <span>โครงการ</span>
                    </a>
                    <ul id="project" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="Project.php" class="sidebar-link">โครงการ</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="ProjectEmp.php" class="sidebar-link">โครงการที่มอบหมาย</a>
                        </li>
                    </ul>
                </li>


                </li>
                <!-- <li class="sidebar-header">
                    Pages
                </li> -->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#equipment" aria-expanded="true" aria-controls="equipment">
                        <i class="lni lni-slice-2"></i>

                        <span>อุปกรณ์</span>
                    </a>
                    <ul id="equipment" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="Equipment.php" class="sidebar-link">อุปกรณ์</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="Equipmentborrowing.php" class="sidebar-link">อุปกรณ์ยืม-คืน</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-header">
                    รายงาน
                </li>
                <li class="sidebar-item">
                    <a href="Report.php" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>รายงาน</span>
                    </a>
                </li>
            </ul>
            <!-- Sidebar Navigation Ends -->
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <!-- Sidebar Ends -->
        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand">
                <button class="toggler-btn" type="button">
                    <i class="lni lni-menu-hamburger-1"></i>
                </button>
            </nav>
            <main class="p-3">
                <div class="container-fluid">
                    <div class="mb-3 text-center" style="border: 2px solid #007bff; border-radius: 10px; padding: 20px; background-color: #f8f9fa;">
                        <h1 class="text-primary" style="font-family: 'Arial', sans-serif;">Attendance</h1>
                    </div>
                    <div class="row">
                        <div class="container-fluid col-sm-6">
                            <div class="card leftcard shadow-sm border-0 p-4" style="background-color:#c6c2c1;">
                                <!-- Title -->
                                <h4 class="mb-4">แสดงข้อมูลเช็คชื่อทั้งหมด</h4>

                                <!-- Action Buttons -->
                                <div class="mb-3">
                                    <a class="btn btn-primary me-2" href="Attendance.php?&work=A" role="button">
                                        <i class="fas fa-plus"></i> เพิ่มข้อมูลใหม่
                                    </a>
                                    <a class="btn btn-secondary" href="Attendance.php" role="button">
                                        <i class="fas fa-sync-alt"></i> รีเฟรช
                                    </a>
                                </div>

                                <!-- Search Form -->
                                <form method="GET" class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="ค้นหาวัน หรือ รหัสผู้เข้าร่สม" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i> ค้นหา
                                        </button>
                                    </div>
                                </form>

                                <?php
                                // Get search query from URL
                                $search_query = isset($_GET['search']) ? $_GET['search'] : '';

                                // Modify query to filter users based on the search query
                                $user_Data = $db_handle->Textquery("SELECT * FROM attendance WHERE Attendance_id LIKE '%$search_query%' OR Date LIKE '%$search_query%' OR User_id LIKE '%$search_query%'");

                                $user_Data = $db_handle->Textquery("SELECT u.name AS Name, a.Attendance_id, a.date AS Date, a.Time_in, a.Time_out, u.user_id 
                                    FROM user u
                                    JOIN attendance a ON u.user_id = a.user_id;");
                                if (!empty($user_Data)) { ?>
                                    <div class="clearfix"></div>
                                    <table class="table table-bordered table-striped text-center" style="margin-top:20px; margin-bottom:20px;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>รหัส</th>
                                                <th>ชื่อ</th>
                                                <th>วันเช็คชื่อ</th>
                                                <th>เข้า</th>
                                                <th>ออก</th>
                                                <th>View/Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($user_Data as $key => $value) { ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($user_Data[$key]["Attendance_id"]); ?></td>
                                                    <td><?php echo htmlspecialchars($user_Data[$key]["Name"]); ?></td>
                                                    <td><?php echo htmlspecialchars($user_Data[$key]["Date"]); ?></td>
                                                    <td><?php echo htmlspecialchars($user_Data[$key]["Time_in"]); ?></td>
                                                    <td><?php echo htmlspecialchars($user_Data[$key]["Time_out"]); ?></td>
                                                    <td>
                                                        <a href="Attendance.php?Eid=<?php echo urlencode($user_Data[$key]["Attendance_id"]); ?>&work=V" class="btn btn-info btn-sm me-2">
                                                            <i class="fas fa-eye"></i> แสดง
                                                        </a>
                                                        <a href="AttendanceProcess.php?Eid=<?php echo urlencode($user_Data[$key]["Attendance_id"]); ?>&work=D" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?')">
                                                            <i class="fas fa-trash-alt"></i> ลบ
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <!-- Pagination -->
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            <?php if ($page > 1) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo $search_query; ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                            <?php } ?>

                                            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search_query; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php } ?>

                                            <?php if ($page < $total_pages) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo $search_query; ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>

                                <?php } else { ?>
                                    <p class="text-center text-muted">ไม่พบข้อมูล</p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="container-fluid col-sm-6">
                            <?php
                            $AttendanceData = $db_handle->Textquery("SELECT * FROM attendance WHERE Attendance_id = '" . $Ecode . "'");
                            ?>
                            <form action="AttendanceProcess.php?work=<?php echo $work; ?>" method="post" enctype="multipart/form-data">
                                <div class="card p-4 shadow-lg" style="background-color:#c6c2c1;">
                                    <h4 class="mb-4 text-center">
                                        <?php echo ($work <> 'A') ? 'แก้ไขข้อมูลเช็คชื่อ' : 'เพิ่มข้อมูลเช็คชื่อ'; ?>
                                    </h4>

                                    <!-- รหัสสมาชิก -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">รหัสผู้เข้าร่วม:</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="Attendance_id"
                                                required <?php if ($work <> 'A') {
                                                                echo 'readonly';
                                                            } ?> value="<?php if ($work <> 'A') {
                                                                            echo $AttendanceData[0]["Attendance_id"];
                                                                        } ?>">
                                        </div>

                                        <label class="col-sm-3 col-form-label text-end">รหัสสมาชิก:</label>
                                        <div class="col-sm-3">
                                            <?php
                                            // Fetching active user
                                            $ADData = $db_handle->Textquery("SELECT * FROM user");
                                            ?>
                                            <select name="User_id" class="form-select">
                                                <option value="-">โปรดเลือก</option>
                                                <?php foreach ($ADData as $key => $value) { ?>
                                                    <!-- Mark selected user if editing -->
                                                    <option value="<?php echo $value["User_id"]; ?>"
                                                        <?php if ($work !== 'A' && $AttendanceData[0]["User_id"] == $value["User_id"]) {
                                                            echo 'selected';
                                                        } ?>>
                                                        <?php echo $value["User_id"] . " - " . $value["Name"]; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">วันที่ทำงาน:</label>
                                        <div class="col-sm-4">
                                            <input type="date" class="form-control" name="Date"
                                                value="<?php if ($work <> 'A') {
                                                            echo $AttendanceData[0]["Date"];
                                                        } ?>" required>
                                        </div>
                                    
                                    </div>

                                    <!-- Time_in และ Time_out -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">เข้างาน:</label>
                                        <div class="col-sm-3">
                                            <input type="time" class="form-control" name="Time_in"
                                                value="<?php if ($work <> 'A') {
                                                            echo $AttendanceData[0]["Time_in"];
                                                        } ?>" required>
                                        </div>
                                        <label class="col-sm-3 col-form-label text-end">ออกงาน:</label>
                                        <div class="col-sm-3">
                                            <input type="time" class="form-control" name="Time_out"
                                                value="<?php if ($work <> 'A') {
                                                            echo $AttendanceData[0]["Time_out"];
                                                        } ?>">
                                        </div>
                                    </div>

                                    <!-- สาย -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">สาย:</label>
                                        <div class="col-sm-4">
                                            <select class="form-select" name="Is_late" required>
                                                <option value="0" <?php echo ($AttendanceData[0]["Is_late"] == '0') ? 'selected' : ''; ?>>ไม่สาย</option>
                                                <option value="1" <?php echo ($AttendanceData[0]["Is_late"] == '1') ? 'selected' : ''; ?>>สาย</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Ot -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">ประเภทการลา:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control mb-2" name="Leave_type" placeholder=""
                                                value="<?php if ($work <> 'A') {
                                                            echo $AttendanceData[0]["Leave_type"];
                                                        } ?>">

                                        </div>
                                    </div>

                                   

                                    <!-- รูปภาพ -->
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label text-end fw-bold">หลักฐานการลา:</label>
                                        <div class="col-sm-9">
                                            <?php if ($work !== 'A') { ?>
                                                <div class="d-flex flex-column align-items-start">
                                                    <img src="<?php echo htmlspecialchars($AttendanceData[0]["Leave_evidence"]); ?>"
                                                        alt="รูปภาพผู้ดูแล" class="img-thumbnail mb-3" style="width: 150px; height: auto;">
                                                    <input type="file" class="form-control" name="fileupload" accept="image/*">
                                                </div>
                                            <?php } else { ?>
                                                <input type="file" class="form-control" name="fileupload" accept="image/*">
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <!-- Ot -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">ชั่วโมง OT:</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control mb-2" name="Hours_ot" placeholder=""
                                                value="<?php if ($work <> 'A') {
                                                            echo $AttendanceData[0]["Hours_ot"];
                                                        } ?>">

                                        </div>
                                    </div>

                                    <!-- ปุ่มบันทึก -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">
                                            <?php echo ($work !== 'A') ? 'บันทึกการแก้ไข' : 'เพิ่มข้อมูล'; ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

        </div>
    </div>
    </main>
    </div>
    </div>

    <script>
        const toggler = document.querySelector(".toggler-btn");
        toggler.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });
    </script>






</body>

</html>