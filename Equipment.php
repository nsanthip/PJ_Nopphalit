<?php
session_start();
require_once('scripts/connect.php');
$db_handle = new myDBControl();

if (isset($_SESSION["UT"]) && $_SESSION["UT"] == 'เจ้าหน้าที่') {
    $userLogin = $_SESSION["UF"];
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คุณไม่มีสิทธิ์กรุณา LOGIN!!!');";
    echo "window.location = 'login.php';";
    echo "</script>";
}

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
$Equipment_Data = $db_handle->Textquery("SELECT * FROM equipment LIMIT $limit OFFSET $offset");

// ดึงจำนวนรายการทั้งหมดเพื่อคำนวณจำนวนหน้า
$total_Equipments = $db_handle->Textquery("SELECT COUNT(*) as total FROM equipment")[0]['total'];
$total_pages = ceil($total_Equipments / $limit);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment</title>
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
                        <h1 class="text-primary" style="font-family: 'Arial', sans-serif;">Equipment</h1>
                    </div>
                    <div class="row">
                        <div class="container-fluid col-sm-5">
                            <div class="card leftcard shadow-sm border-0 p-4" style="background-color:#c6c2c1;">
                                <!-- Title -->
                                <h4 class="mb-4">แสดงข้อมูลอุปกรณ์ทั้งหมด</h4>

                                <!-- Action Buttons -->
                                <div class="mb-3">
                                    <a class="btn btn-primary me-2" href="Equipment.php?&work=A" role="button">
                                        <i class="fas fa-plus"></i> เพิ่มข้อมูลใหม่
                                    </a>
                                    <a class="btn btn-secondary" href="Equipment.php" role="button">
                                        <i class="fas fa-sync-alt"></i> รีเฟรช
                                    </a>
                                </div>

                                <!-- Search Form -->
                                <form method="GET" class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="ค้นหาชื่อ หรือ รหัสอุปกรณ์" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fas fa-search"></i> ค้นหา
                                        </button>
                                    </div>
                                </form>

                                <?php
                                // Get search query from URL
                                $search_query = isset($_GET['search']) ? $_GET['search'] : '';

                                // Modify query to filter equipment based on the search query
                                $Equipment_Data = $db_handle->Textquery("SELECT * FROM equipment WHERE Equipment_name LIKE '%$search_query%' OR Equipment_id LIKE '%$search_query%'");

                                $Equipment_Data = $db_handle->Textquery("SELECT * FROM equipment ");
                                if (!empty($Equipment_Data)) { ?>
                                    <div class="clearfix"></div>
                                    <table class="table table-bordered table-striped text-center" style="margin-top:20px; margin-bottom:20px;">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>รหัส</th>
                                                <th>ชื่อ</th>
                                                <th>สถานะ</th>
                                                <th>View/Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($Equipment_Data as $key => $value) { ?>
                                                <tr>
                                                    <td><?php echo $Equipment_Data[$key]["Equipment_id"]; ?></td>
                                                    <td><?php echo $Equipment_Data[$key]["Equipment_name"]; ?></td>
                                                    <td><?php echo $Equipment_Data[$key]["Status"]; ?></td>
                                                    <td>
                                                        <a href="Equipment.php?Eid=<?php echo $Equipment_Data[$key]["Equipment_id"]; ?>&work=V" class="btn btn-info btn-sm me-2">
                                                            <i class="fas fa-eye"></i> แสดง
                                                        </a>
                                                        <a href="EquipmentProcess.php?Eid=<?php echo $Equipment_Data[$key]["Equipment_id"]; ?>&work=D" class="btn btn-danger btn-sm"
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

                        <div class="container-fluid col-sm-7">
                            <?php
                            $Equipment_Data = $db_handle->Textquery("SELECT * FROM equipment WHERE Equipment_id = '" . $Ecode . "'");
                            ?>
                            <form action="EquipmentProcess.php?work=<?php echo $work; ?>" method="post" enctype="multipart/form-data">
                                <div class="card p-4 shadow-lg" style="background-color:#c6c2c1;">
                                    <h4 class="mb-4 text-center">
                                        <?php echo ($work <> 'A') ? 'แก้ไขข้อมูลอุปกรณ์' : 'เพิ่มข้อมูลอุปกรณ์'; ?>
                                    </h4>

                                    <!-- รหัสสมาชิก -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">รหัสอุปกรณ์:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="Equipment_id"
                                                required <?php if ($work <> 'A') {
                                                                echo 'readonly';
                                                            } ?> value="<?php if ($work <> 'A') {
                                                                            echo $Equipment_Data[0]["Equipment_id"];
                                                                        } ?>">
                                        </div>
                                    </div>

                                    <!-- ชื่อและประเภทสมาชิก -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">ชื่ออุปกรณ์:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control mb-2" name="Equipment_name" placeholder="ชื่อ"
                                                value="<?php if ($work <> 'A') {
                                                            echo $Equipment_Data[0]["Equipment_name"];
                                                        } ?>" required>

                                        </div>
                                    </div>

                                    <!-- ที่อยู่ -->
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">รายละเอียดอุปกรณ์:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="Description" rows="2" required><?php if ($work <> 'A') {
                                                                                                                    echo $Equipment_Data[0]["Description"];
                                                                                                                } ?></textarea>
                                        </div>
                                    </div>

                                    <!-- ที่อยู่ -->
                                    <?php $status = isset($Equipment_Data[0]["Status"]) ? $Equipment_Data[0]["Status"] : 'มีอยู่'; ?>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label text-end">สถานะ:</label>
                                        <div class="col-sm-4">
                                            <select class="form-select" name="Status" required>
                                                <option value="มีอยู่" <?php echo ($status == 'มีอยู่') ? 'selected' : ''; ?>>มีอยู่</option>
                                                <option value="ยืม" <?php echo ($status == 'ยืม') ? 'selected' : ''; ?>>ยืม</option>
                                                <option value="เสียหาย" <?php echo ($status == 'เสียหาย') ? 'selected' : ''; ?>>เสียหาย</option>
                                                <option value="ซ่อมบำรุง" <?php echo ($status == 'ซ่อมบำรุง') ? 'selected' : ''; ?>>ซ่อมบำรุง</option>
                                            </select>
                                        </div>
                                    </div>



                                    <!-- รูปภาพ -->
                                    <div class="mb-4 row">
                                        <label class="col-sm-3 col-form-label text-end fw-bold">รูปภาพ:</label>
                                        <div class="col-sm-9">
                                            <?php if ($work !== 'A') { ?>
                                                <div class="d-flex flex-column align-items-start">
                                                    <img src="<?php echo htmlspecialchars($Equipment_Data[0]["Img_equipment"]); ?>"
                                                        alt="รูปภาพอุปกรณ์" class="img-thumbnail mb-3" style="width: 150px; height: auto;">
                                                    <input type="file" class="form-control" name="fileupload" accept="image/*">
                                                </div>
                                            <?php } else { ?>
                                                <input type="file" class="form-control" name="fileupload" accept="image/*">
                                            <?php } ?>
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