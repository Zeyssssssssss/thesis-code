<?php
session_start();
include 'authetication.php';
include 'auth.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thesis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for the bar chart
$sql = "SELECT category, COUNT(*) as count FROM bar GROUP BY category";
$result = $conn->query($sql);

$categories = [];
$counts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category'];
        $counts[] = $row['count'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Dormitory Management System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
    background-color: #343a40;
    color: #fff;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
}

.sidebar {
    background-color: #1a1a1a;
    color: #fff;
    height: 100vh;
    padding-top: 20px;
    position: fixed;
    top: 56px; /* Adjust for navbar height */
    left: 0;
    width: 240px;
    z-index: 1000;
}

main {
    margin-left: 260px;
    margin-top: 76px; /* Adjust for navbar height */
    padding: 20px;
}


        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            border-radius: 4px;
            margin: 5px 0;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }

        main {
            margin-left: 260px;
            padding: 20px;
        }

        .card {
            border-radius: 10px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                left: -260px;
                transition: all 0.3s ease;
            }

            .sidebar.show {
                left: 0;
            }

            main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <a class="navbar-brand" href="admin.php">Fina's Dormitory </a>
        <button class="btn btn-outline-light d-md-none" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Sidebar -->
<div class="sidebar" id="sidebarMenu">
    <a href="admin.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    
    <!-- Room Tracker Dropdown -->
    <div class="dropdown">
        <a href="#" class="dropdown-toggle" id="roomTrackerDropdown" data-bs-toggle="collapse" data-bs-target="#roomTrackerMenu" aria-expanded="false" aria-controls="roomTrackerMenu">
            <i class="fas fa-bed"></i> Room Tracker
        </a>
        <div class="collapse" id="roomTrackerMenu">
            <a href="tracker1.php" class="ms-3"><i class="fas fa-door-open"></i> Tracker 1</a>
            <a href="tracker2.php" class="ms-3"><i class="fas fa-door-closed"></i> Tracker 2</a>
            <a href="tracker3.php" class="ms-3"><i class="fas fa-users"></i> Tracker 3</a>
        </div>
    </div>
    
    <a href="tenanttable.php"><i class="fas fa-user"></i> Tenant Management</a>
    <a href="bill.php"><i class="fas fa-file-invoice"></i> Billing</a>
    <a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>


    <!-- Main Content -->
    <main>
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">10</h5>
                            <p class="card-text">Total Tenants</p>
                            <a href="#" class="btn btn-light btn-sm">View More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">5</h5>
                            <p class="card-text">Total Rooms</p>
                            <a href="#" class="btn btn-light btn-sm">View More</a>
                        </div>
                    </div>
                </div>
                
            </div>

            <canvas id="barChart" style="max-width: 600px;"></canvas>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const categories = <?php echo json_encode($categories); ?>;
        const counts = <?php echo json_encode($counts); ?>;

        const ctx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categories,
                datasets: [{
                    label: 'Category Count',
                    data: counts,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebarMenu').classList.toggle('show');
        });
    </script>
</body>
</html>
