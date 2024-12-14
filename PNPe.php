<?php
session_start();

require_once('scripts/connect.php');
$db_handle = new myDBControl();

if (isset($_SESSION["UT"])) {
    $UID = $_SESSION["UID"];
    $UT = $_SESSION["UT"];
}

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation with Toggle</title>
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style2.css">

</head>

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
                    แสดง
                </li>
                <li class="sidebar-item">
                    <a href="Personal.php" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>ข้อมูลของฉัน</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="PNAd.php" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>เข้า-ออกงาน</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="PNPe.php" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>โครงการที่มอบหมาย</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="PNEb.php" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>อุปกรณ์ ยืม-คืน </span>
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
                        <h1 class="text-primary" style="font-family: 'Arial', sans-serif;">โครงการที่มอบหมาย</h1>
                    </div>

                    <div class="container-fluid col-sm-8">
                        <div class="container" style="max-width: auto; margin: 20px auto; font-family: Arial, sans-serif; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
                            <?php
                            $Assignments = $db_handle->Textquery(
                                "SELECT pa.Assignment_id, p.Project_name, u.Name AS Name, pa.Role_in_project FROM project_assignments pa INNER JOIN Projects p 
                                ON pa.Project_id = p.Project_id INNER JOIN user u ON pa.User_id = u.User_id
                                WHERE u.user_id = '$UID'"
                            );
                            if (!empty($Assignments)) { ?>
                                <div class="clearfix"></div>
                                <table class="table table-bordered table-striped text-center" style="margin-top:20px; margin-bottom:20px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>รหัสมอบหมาย</th>
                                            <th>ชื่อโครงการ</th>
                                            <th>ชื่อสมาชิก</th>
                                            <th>บทบาท</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($Assignments as $key => $value) { ?>
                                            <tr>
                                                <td><?php echo $value["Assignment_id"]; ?></td>
                                                <td><?php echo $value["Project_name"]; ?></td>
                                                <td><?php echo $value["Name"]; ?></td>
                                                <td><?php echo $value["Role_in_project"]; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <p style="text-align: center; color: #888;">ไม่มีข้อมูลที่เกี่ยวข้อง</p>
                            <?php } ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>





</body>

</html>