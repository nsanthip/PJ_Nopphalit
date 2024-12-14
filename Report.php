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

$R = "R1";
if (isset($_GET['R'])) {
    $R = $_GET['R'];
}

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

    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
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
                        <h1 class="text-primary" style="font-family: 'Arial', sans-serif;">รายงาน</h1>
                    </div>
                    <div class="row">
                        <div class="container-fluid col-sm-12">
                            <div class="card shadow-sm border-0 p-4" style="background-color: #f8f9fa; border-radius: 15px;">
                                <!-- Navigation -->
                                <ul class="nav nav-pills nav-fill" style="font-weight: bold; color: black;">
                                    <?php
                                    $tabs = [
                                        "R1" => "รายงานข้อมูลโครงการทั้งหมด",
                                        "R2" => "รายงานข้อมูลพนักงานทั้งหมด",
                                        "R3" => "รายงานข้อมูลอุปกรณ์ใช้งานทั้งหมด",
                                        "R4" => "รายงานการค้างคืนอุปกรณ์ใช้งานทั้งหมด",
                                    ];
                                    foreach ($tabs as $key => $label) {
                                        $activeClass = ($R == $key) ? 'active' : '';
                                        echo "<li class='nav-item'>
                                                <a style='color:black;' class='nav-link $activeClass' href='?R=$key'>$label</a>
                                            </li>";
                                    }
                                    ?>
                                </ul>

                                <!-- Content -->
                                <div class="row mt-4">
                                    <?php if ($R == "R1") { ?>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                    <h5 class="mb-0">รายงานข้อมูลโครงการทั้งหมด</h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                    $Project_data = $db_handle->Textquery("SELECT * FROM projects");
                                                    if (!empty($Project_data)) { ?>
                                                        <table class="table table-bordered table-striped text-center">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>รหัส</th>
                                                                    <th>ชื่อ</th>
                                                                    <th>สถานที่</th>
                                                                    <th>วันที่เริ่มต้น</th>
                                                                    <th>วันที่สิ้นสุด</th>
                                                                    <th>สถานะ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($Project_data as $project) { ?>
                                                                    <tr>
                                                                        <td><?php echo $project["Project_id"]; ?></td>
                                                                        <td><?php echo $project["Project_name"]; ?></td>
                                                                        <td><?php echo $project["Project_location"]; ?></td>
                                                                        <td><?php echo $project["Start_date"]; ?></td>
                                                                        <td><?php echo $project["End_date"]; ?></td>
                                                                        <td><?php echo $project["Status"]; ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    <?php } else { ?>
                                                        <p class="text-center text-muted">ไม่มีข้อมูลโครงการ</p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($R == "R2") { ?>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                    <h5 class="mb-0">รายงานข้อมูลพนักงานทั้งหมด</h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                    $User_data = $db_handle->Textquery("SELECT * FROM user WHERE User_type = 'พนักงาน';");
                                                    if (!empty($User_data)) { ?>
                                                        <table class="table table-bordered table-striped text-center">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>รหัส</th>
                                                                    <th>ชื่อ</th>
                                                                    <th>นามสกุล</th>
                                                                    <th>สถานที่</th>
                                                                    <th>Username</th>
                                                                    <th>Password</th>
                                                                    <th>หมายเลขโทรศัพท์</th>
                                                                    <th>ประเภทผู้ใช้</th>
                                                                    <th>เงินเดือนพื้นฐาน</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($User_data as $User) { ?>
                                                                    <tr>
                                                                        <td><?php echo $User["User_id"]; ?></td>
                                                                        <td><?php echo $User["Name"]; ?></td>
                                                                        <td><?php echo $User["Surname"]; ?></td>
                                                                        <td><?php echo $User["Address"]; ?></td>
                                                                        <td><?php echo $User["Username"]; ?></td>
                                                                        <td><?php echo $User["Password"]; ?></td>
                                                                        <td><?php echo $User["Phone_number"]; ?></td>
                                                                        <td><?php echo $User["User_type"]; ?></td>
                                                                        <td><?php echo $User["Salary_base"]; ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    <?php } else { ?>
                                                        <p class="text-center text-muted">ไม่มีข้อมูลพนักงาน</p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($R == "R3") { ?>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                    <h5 class="mb-0">รายงานข้อมูลอุปกรณ์ใช้งานทั้งหมด</h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                    $Equipment_data = $db_handle->Textquery("SELECT * FROM equipment");
                                                    if (!empty($Equipment_data)) { ?>
                                                        <table class="table table-bordered table-striped text-center">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>รหัส</th>
                                                                    <th>ชื่ออุปกรณ์</th>
                                                                    <th>คำอธิบาย</th>
                                                                    <th>สถานะ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($Equipment_data as $Equipment) { ?>
                                                                    <tr>
                                                                        <td><?php echo $Equipment["Equipment_id"]; ?></td>
                                                                        <td><?php echo $Equipment["Equipment_name"]; ?></td>
                                                                        <td><?php echo $Equipment["Description"]; ?></td>
                                                                        <td><?php echo $Equipment["Status"]; ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    <?php } else { ?>
                                                        <p class="text-center text-muted">ไม่มีข้อมูลอุปกรณ์</p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php if ($R == "R4") { ?>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header bg-dark text-white">
                                                    <h5 class="mb-0">รายงานการค้างคืนอุปกรณ์ใช้งานทั้งหมด</h5>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                        $Borrow_data = $db_handle->Textquery("SELECT b.Record_id, e.Equipment_name, u.Name , b.Borrow_date, b.Return_date, b.Status
                                                        FROM borrow_records b JOIN equipment e ON b.Equipment_id = e.Equipment_id JOIN user u ON b.User_id = u.User_id
                                                        WHERE b.Status = 'ยืม';");
                                                    if (!empty($Borrow_data)) { ?>
                                                        <table class="table table-bordered table-striped text-center">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th>รหัส</th>
                                                                    <th>ชื่ออุปกรณ์</th>
                                                                    <th>ชื่อพนักงาน</th>
                                                                    <th>วันที่ยืม</th>
                                                                    <th>วันที่คืน</th>
                                                                    <th>สถานะ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($Borrow_data as $Borrow) { ?>
                                                                    <tr>
                                                                        <td><?php echo $Borrow["Record_id"]; ?></td>
                                                                        <td><?php echo $Borrow["Equipment_name"]; ?></td>
                                                                        <td><?php echo $Borrow["Name"]; ?></td>
                                                                        <td><?php echo $Borrow["Borrow_date"]; ?></td>
                                                                        <td><?php echo $Borrow["Return_date"]; ?></td>
                                                                        <td><?php echo $Borrow["Status"]; ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    <?php } else { ?>
                                                        <p class="text-center text-muted">ไม่มีข้อมูลค้างคืนอุปกรณ์</p>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>


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