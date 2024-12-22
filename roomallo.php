<?php

include '../include/thirdnav.php';
include 'db.php';

if (isset($_POST['save'])) {
    $id = $_SESSION['userinfo']['id'];
    $stud_name = $_POST['student_name'];
    $gender = $_POST['gender'];
    $floor = $_POST['floor'];
    $room_type = $_POST['room_type'];
    $date = $_POST['date'];
    $sql = "INSERT INTO roomallolog (`name`, `gender`, `pref_floor`, `pref_type`, `dates`, `user_id`) 
            VALUES ('$stud_name', '$gender', '$floor', '$room_type', '$date', '$id')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['message'] = "Allocate Successfully";
    } else {
        $_SESSION['message'] = "Allocate Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Allocation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Base Styles */
        body {
            font-family: Arial, sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: flex-start; /* Align to the top */
    height: 100vh; /* Full viewport height */
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px; /* Adjust for form width */
            box-sizing: border-box;
  
            position: absolute;
            left: 250px;
          
        }

        .form-container label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #444;
        }

        .form-container input, 
        .form-container select {
            width: 100%;
            padding: 12px;
            margin: 8px 0 20px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-container button {
           
            background-color: grey;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        .form-container button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .form-container button:active {
            transform: translateY(2px);
        }

        /* Modal Styles */
        .modal-dialog {
            max-width: 500px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
                padding: 20px;
            }

            .form-container label {
                font-size: 14px;
            }

            .form-container input, 
            .form-container select {
                font-size: 14px;
            }

            .form-container button {
                padding: 15px 20px;
            }
           
        }
            #moda{
                width: 150px;
            }
    </style>
</head>
<body>
    <div class="form-container">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal" id="moda">
            Room Change History
        </button>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">History</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Floor Preference</th>
                            <th>Preference Type</th>
                            <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $id = $_SESSION['userinfo']['id'];
                            $sql = "SELECT name , gender, pref_floor, pref_type, dates  FROM roomallolog Where user_id = '$id' ";
                            $res = $conn->query($sql);
                            while($row = $res->fetch_assoc()){
                                ?>
                                    <tr>
                                        <th><?= $row['name']?></th>
                                        <th><?= $row['gender']?></th>
                                        <th><?= $row['pref_floor']?></th>
                                        <th><?= $row['pref_type']?></th>
                                        <th><?= $row['dates']?></th>
                                    </tr>
                                <?php
                            }
                        ?>
                        </tbody>
                        </table>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <hr>
    
  
        <form method="POST">
            <h2>Room Allocation</h2>
            <label for="student-name">Full Name:</label>
            <input type="text" id="student-name" name="student_name" placeholder="Enter Your Full Name" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>

            <label for="floor">Preferred Floor:</label>
            <select id="floor" name="floor" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>

            <label for="room-type">Preferred Room Type:</label>
            <select id="room-type" name="room_type" required>
                <option value="single">Single</option>
                <option value="double">Double</option>
            </select>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <button type="submit" name="save" class="btn btn-primary w-100">Allocate Room</button>
        </form>
    </div>
</div>
</body>
</html>
