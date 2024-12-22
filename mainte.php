<?php
 
     include '../include/thirdnav.php';
     include 'db.php';

     if (isset($_POST['save'])) {
        $id = $_SESSION['userinfo']['id'];
        $name = $_POST['name'];
        $room_number = $_POST['room_number'];
        $issue = $_POST['issue'];
        $date = $_POST['date'];
        $pending = "Pending";
        $sql = "INSERT INTO mainrequest(`name`, `room_num`, `dates`, `description` , `status`, `user_id`) 
                VALUES ('$name', '$room_number', '$date', '$issue', '$pending', '$id')";
        $result = $conn->query($sql);

        if ($result) {
            $_SESSION['message'] = "Request Successfully Submitted";
        } else {
            $_SESSION['message'] = "Request Failed";
        }
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Request</title>
    <style>
    html, body {
    height: 100%; /* Ensure full height of the viewport */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; /* Horizontally center */
    align-items: center; /* Vertically center */
    font-family: Arial, sans-serif;
}

.main-container {
  
    margin: 0 auto; /* Center horizontally */
    position: absolute;
    right: 0px;
    left: 200px;
    top: 50px;
    width: 80%; /* Full width of the viewport */
    height: 80vh; /* Full height of the viewport */
    background-color: #fdf5e6;
   
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    box-sizing: border-box; /* Make padding count towards width */
    padding: 20px;
}



input, textarea {
    width: 100%;
    padding: 15px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

button {
    padding: 15px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #218838;
}


    </style>
</head>
<body>

<div class="main-container">
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#myModal" id="moda">
            Maintenance Request History
        </button>

       
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Room Change History</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    <table class="table table-bordered">
            <thead>
                <tr>
                <th>Name</th>
                <th>Room Number</th>
                <th>Date</th>
                <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $id = $_SESSION['userinfo']['id'];
                $sql = "SELECT name , room_num,  dates, description FROM mainrequest Where user_id = '$id' ";
                $res = $conn->query($sql);
                while($row = $res->fetch_assoc()){
                    ?>
                        <tr>
                            <th><?= $row['name']?></th>
                            <th><?= $row['room_num']?></th>
                            <th><?= $row['dates']?></th>
                            <th><?= $row['description']?></th>
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

        <form>
            <?php 
                        if (isset($_SESSION['message'])) {
                            $message_type = (strpos($_SESSION['message'], 'Successfully') !== false) ? 'success' : 'error';
                            echo "<div class='message $message_type'>{$_SESSION['message']}</div>";
                            unset($_SESSION['message']);
                        }
                    ?>
        <h2>Submit Maintenance Request</h2>
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" placeholder="Enter your full name">
        
        <label for="roomNumber">Room Number:</label>
        <input type="text" id="roomNumber" placeholder="Enter your room number">
        
        <label for="date">Date:</label>
        <input type="text" id="date" placeholder="dd/mm/yyyy">
        
        <label for="description">Issue Description:</label>
        <textarea id="description" placeholder="Describe the issue..."></textarea>
        
        <button type="submit">Submit Maintenance Request</button>
    </form>
</div>

</body>
</html>
