<link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="css/style2.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Sidebar -->
<aside id="sidebar" class="sidebar-toggle">
    <div class="sidebar-logo">
        <a href="#">CodzSword</a>
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
                    <a href="Schedules.php" class="sidebar-link">ตารางเวลา</a>
                </li>
                <li class="sidebar-item">
                    <a href="Attendance.php" class="sidebar-link">เข้า-ออกงาน</a>
                </li>
                <li class="sidebar-item">
                    <a href="Leaverequests.php" class="sidebar-link">การขอลา</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">เงินเดือน</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#project" aria-expanded="true" aria-controls="project">
                <i class="lni lni-gears-3"></i>
                <span>โครงงาน</span>
            </a>
            <ul id="project" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">โครงงาน</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">โครงงานที่พนักงานทำอยู่</a>
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
                    <a href="#" class="sidebar-link">อุปกรณ์</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">อุปกรณ์ยืม-คืน</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-header">
            รายงาน
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-popup"></i>
                <span>Notification</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-cog"></i>
                <span>Setting</span>
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
<script>
    const toggler = document.querySelector(".toggler-btn");
    toggler.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("collapsed");
    });
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script> -->