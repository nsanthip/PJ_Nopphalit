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
                        <h1 class="text-primary" style="font-family: 'Arial', sans-serif;">Salary</h1>
                    </div>
                    <div class="row">
                        <div class="container-fluid col-sm-12">
                            <div class="card shadow-sm border-0 p-4" style="background-color: #f8f9fa; border-radius: 15px;">

                                <!-- ส่วนหัวข้อ -->
                                <h3 class="text-center mb-4" style="color: #495057;">รายงานเงินเดือนสุทธิพนักงาน</h3>

                                <!-- ฟอร์มเลือกวันที่ -->
                                <form method="GET" action="" class="row g-3">
                                    <div class="col-md-5">
                                        <label for="start_date" class="form-label">วันที่เริ่มต้น:</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="end_date" class="form-label">วันที่สิ้นสุด:</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary w-100">แสดงรายงาน</button>
                                    </div>
                                </form>

                                <div class="clearfix"></div>

                                <!-- ตารางข้อมูล -->
                                <div class="table-responsive" style="margin-top: 30px;">
                                    <table class="table table-bordered table-striped text-center">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>รหัสพนักงาน</th>
                                                <th>ชื่อพนักงาน</th>
                                                <th>เงินเดือนพื้นฐาน</th>
                                                <th>หักมาสาย</th>
                                                <th>หักลางาน</th>
                                                <th>รายได้จาก OT</th>
                                                <th>เงินเดือนสุทธิ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $conn = new mysqli("localhost", "root", "", "pj_construction");
                                            if ($conn->connect_error) {
                                                die("<tr><td colspan='7'>การเชื่อมต่อฐานข้อมูลล้มเหลว</td></tr>");
                                            }

                                            $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                                            $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

                                            if ($start_date && $end_date) {
                                                $stmt = $conn->prepare("SELECT u.User_id, CONCAT(u.Name, ' ', u.Surname) AS emp_name, u.Salary_base,
                                                        COALESCE(SUM(CASE WHEN a.Is_late = 1 THEN -50 ELSE 0 END), 0) AS total_deduction_late,
                                                        COALESCE(SUM(CASE WHEN a.Leave_type IS NOT NULL THEN -100 ELSE 0 END), 0) AS total_deduction_leave,
                                                        COALESCE(SUM(a.Hours_ot * 100), 0) AS total_ot_income,
                                                        u.Salary_base 
                                                        + COALESCE(SUM(a.Hours_ot * 100), 0)
                                                        - COALESCE(SUM(CASE WHEN a.Is_late = 1 THEN 50 ELSE 0 END), 0)
                                                        - COALESCE(SUM(CASE WHEN a.Leave_type IS NOT NULL THEN 100 ELSE 0 END), 0) AS final_salary
                                                FROM user u
                                                LEFT JOIN attendance a ON u.User_id = a.User_id
                                                WHERE a.Date BETWEEN ? AND ?
                                                GROUP BY u.User_id");
                                                $stmt->bind_param("ss", $start_date, $end_date);
                                                $stmt->execute();
                                                $result = $stmt->get_result();

                                                if ($result && $result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td>{$row['User_id']}</td>";
                                                        echo "<td>{$row['emp_name']}</td>";
                                                        echo "<td>" . number_format($row['Salary_base'], 2) . "</td>";
                                                        echo "<td>" . number_format($row['total_deduction_late'], 2) . "</td>";
                                                        echo "<td>" . number_format($row['total_deduction_leave'], 2) . "</td>";
                                                        echo "<td>" . number_format($row['total_ot_income'], 2) . "</td>";
                                                        echo "<td>" . number_format($row['final_salary'], 2) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='7'>ไม่มีข้อมูลในช่วงวันที่ที่เลือก</td></tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>กรุณาเลือกช่วงวันที่</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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