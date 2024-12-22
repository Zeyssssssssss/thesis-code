<?php
  
    include '../include/thirdnav.php';
    include 'db.php';

    if (isset($_POST['save'])) {
        $id = $_SESSION['userinfo']['id'];
        $stud_id = $_POST['student_id'];
        $current = $_POST['current_room'];
        $new = $_POST['new_room'];
        $date = $_POST['date'];
        $pending = "Pending";

        $sql = "INSERT INTO roomchanges (`name`, `room_num`, `room_pref`, `created_at`, `user_id`, `status`) 
                VALUES ('$stud_id', '$current', '$new', '$date', '$id', '$pending')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['message'] = "Request Successfully Submitted";
        } else {
            $_SESSION['message'] = "Request Submission Failed";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Change Request</title>
    <style>
    /* Base Styles */
    body {
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
    background-color: #f4f7fc;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: flex-start; /* Align to the top */
    height: 100vh; /* Full viewport height */
    
      
        min-height: 100vh;
        margin: 0;
    }

    h1, h2, h3 {
        color: #333;
        margin-bottom: 20px;
    }

    .section {
        width: 100%;
        max-width: 1200px;
        padding: 0 15px;
    }

    /* Form Container Styling */
    .form-container {
        background-color: #fdf5e6;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 1300px; /* Adjust max width for responsiveness */
        position: absolute;
        right: 100px;
        top: 30px;
        box-sizing: border-box;
    }

    .form-container label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
    }

    .form-container input, .form-container select, .form-container textarea {
        width: 100%;
        padding: 12px;
        margin: 8px 0 20px 0;
        border: 1px solid #ddd;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .form-container input[type="date"] {
        font-size: 16px;
    }

    /* Button Styling */
    .form-container button {
        padding: 12px 20px;
      
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        width: 100%; /* Make button full width on smaller screens */
    }

    .form-container button:hover {
        background-color: #45a049;
        transform: translateY(-2px);
    }

    .form-container button:active {
        transform: translateY(2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
            margin: 20px; /* Reduce margin on smaller screens */
        }

        .form-container label,
        .form-container input,
        .form-container button {
            font-size: 14px; /* Smaller font size for better readability */
        }

        .form-container button {
            padding: 15px 20px; /* Adjust button padding */
        }

        .form-container input, .form-container select, .form-container textarea {
            padding: 10px; /* Adjust input field padding */
        }
    }

    /* Success/ Error Message Styling */
    .message {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        text-align: center;
        font-size: 16px;
    }

    .message.success {
        background-color: #d4edda;
        color: #155724;
    }

    .message.error {
        background-color: #f8d7da;
        color: #721c24;
    }
    .mini-navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        height: 80px;
    }
    .mini-navbar .search-bar input {
        width: 200px;
        padding: 5px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    .mini-navbar .show-entries select {
        padding: 5px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    #moda{
        width: 200px;
    }
  
 
</style>

<body>

    <div class="section">
       
        <div class="form-container">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal" id= "moda">
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
                <th>Room Number</th>
                <th>Room Preference</th>
                <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $id = $_SESSION['userinfo']['id'];
                $sql = "SELECT name , room_num, room_pref, created_at FROM roomchanges Where user_id = '$id' ";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()){
                    ?>
                        <tr>
                            <th><?= $row['name']?></th>
                            <th><?= $row['room_num']?></th>
                            <th><?= $row['room_pref']?></th>
                            <th><?= $row['created_at']?></th>
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
                <?php 
                    if (isset($_SESSION['message'])) {
                        $message_type = (strpos($_SESSION['message'], 'Successfully') !== false) ? 'success' : 'error';
                        echo "<div class='message $message_type'>{$_SESSION['message']}</div>";
                        unset($_SESSION['message']);
                    }
                ?>
                
              
                <h2>Room Change Request</h2>
                
                <label for="student-id">Full Name:</label>
                <input type="text" id="student-id" name="student_id" placeholder="Enter Your Full Name" required>

                <label for="current-room">Current Room Number:</label>
                <input type="text" id="current-room" name="current_room" placeholder="Enter current room number" required>

                <label for="new-room">New Room Preference:</label>
                <input type="text" id="new-room" name="new_room" placeholder="Enter preferred room number">

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>

                <button type="submit" name="save" class="btn btn-success">Submit Request</button>
            </form>
        </div>
    </div>
</body>
</html>
