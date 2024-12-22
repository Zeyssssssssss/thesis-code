<?php
  
    include '../include/thirdnav.php';
   
    include 'db.php';

    if(isset($_POST['save'])){
        $users_id = $_SESSION['userinfo']['id'];
        $roomnum = $_POST['roomNumber'];
        $roomtype = $_POST['roomType'];
        $status = $_POST['wew'];
        $capacity = $_POST['capacity'];

        $sql = "INSERT INTO addroom (`room_num`, `room_type`, `avail`, `capacity`, `user_id`) VALUES ('$roomnum', '$roomtype', '$status', '$capacity', '$users_id')";
        $result = mysqli_query($conn, $sql);

        if($result){
            $_SESSION['message'] = "Successfully Added Room";
        }
        else{
            $_SESSION['message'] = "Failed to Add Room";
            header("location: tracker.php");
        }
    }
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tenant Table</title>
    <style>
  body {
    background-color: #f9f9f9; 
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; 
    align-items: flex-start; 
    height: 91vh; 
}

.container {
    width: 100%;
    
    max-width: 1400px; 
    margin: 0 auto; 
    position: absolute;
    right: 0px;
    left: 200px;
    top: 50px;
    background: #fdf5e6;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    overflow-x: auto; 
}

table th, table td {
    border: 1px solid #ddd;
    text-align: left;
    padding: 8px;
    vertical-align: middle;
}

table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

    .photo img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
    .status-active {
        color: white;
        background-color: #28a745;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.9em;
    }
    .action-buttons button {
        background: none;
        border: none;
        cursor: pointer;
        margin-right: 5px;
    }
    .action-buttons button img {
        width: 20px;
        height: 20px;
    }
    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .pagination a {
        color: #007bff; 
        text-decoration: none;
        padding: 10px 15px;
        border: 1px solid #ddd;
        margin: 0 5px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
    }

 
    .pagination a:hover {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

 
    .pagination a.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
        cursor: default;
    }

    /* Adjust spacing on smaller screens */
    @media (max-width: 1200px) {
        .container {
            margin-left: 10px;
            margin-right: 10px;
        }
    }

    @media (max-width: 992px) {
        .container {
            margin: 20px 10px;
            padding: 15px 20px;
        }
        table th, table td {
            padding: 6px;
        }
        .pagination a {
            padding: 8px 12px;
        }
    }

    @media (max-width: 768px) {
        .pagination a {
            padding: 8px 10px;
        }

        table {
            font-size: 14px;
            overflow-x: auto; /* Enable horizontal scrolling */
            display: block;
            white-space: nowrap;
        }

        table th, table td {
            padding: 6px;
        }

        h2 {
            font-size: 18px;
        }

        .container {
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        .pagination a {
            padding: 6px 8px;
        }
        
        h2 {
            font-size: 16px;
        }

        table th, table td {
            padding: 5px;
            font-size: 12px;
        }

        .action-buttons button {
            font-size: 12px;
        }
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
        
        .wide-modal-dialog {
        max-width: 78%; 
    }
    .modal-body {
        overflow-x: auto; 
    }
    table {
        width: 100%; 
        border-collapse: collapse;
    }
    th, td {
        text-align: left;
        padding: 10px;
        font-size: 15px;
        font-family: Arial, sans-serif;
        text-transform: capitalize;
    }
    .wide-modal-dialogs {
        max-width: 55%; 
     
     
    }
    </style>
</head>
<body>
                
    <div class="container">
                                               
        <h2>Room Available Tracker</h2>
        <div class="mini-navbar">
            
            <div class="show-entries">
                <label>Show
                    <select>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select> entries
                </label>
            </div>
            <div class="search-bar">
                <label>Search: <input type="text" placeholder="Search" id="search"></label>
            </div>
        </div>
        
        <table id="tabb">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Availability</th>
                    <th>Capacity</th>
                    <th>Dates</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $img = "../ex/th.jpg";
                    include 'db.php';
                    $id = $_SESSION['userinfo']['id'];
                    $results_per_page = 6; 
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $start_from = ($page - 1) * $results_per_page;

                    $sql = "SELECT * FROM addroom WHERE user_id = '$id' LIMIT $start_from, $results_per_page";
                    $resulta = $conn->query($sql);

                    while($row = mysqli_fetch_assoc($resulta)){
                       $iid = $row['id'];
                    
                        ?>
                        
                        <tr data-idd="<?= $row['id'] ?>"  data-roomnum="<?= $row['room_num'] ?>" data-roomtype="<?= $row['room_type'] ?>" data-status="<?= $row['avail'] ?>" data-capacity="<?= $row['capacity'] ?>" data-date="<?= $row['date'] ?>">
                            <td><?= $row['id']?></td>
                            <td><img src="<?php echo !empty($row['img']) ? $row['img'] : $img; ?>" alt="Photo" width="70" height="70"></td>
                            <td><?= $row['room_num']?></td>
                            <td><?= $row['room_type']?></td>
                            <td class="<?= $row['avail'] == 'available' ? 'available' : 'booked' ?>"><?= ucfirst($row['avail']) ?></td>
                            <td><?= $row['capacity']?></td>
                            <td><?= $row['date']?></td>
                            <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bookRoomModal" id="bb" data-roomnume=<?=$row['room_num']?>> <i class="fas fa-calendar-check"></i></button>


                                    <div class="modal fade" id="bookRoomModal" tabindex="-1" aria-labelledby="bookRoomModalLabel" aria-hidden="true">
                                       
                                        <div class="modal-dialog wide-modal-dialogs">
                                            <div class="modal-content">
                                            
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="bookRoomModalLabel">Book Room</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                
                                                <div class="modal-body">
                                                    <form id="bookRoomForm" >
                                                      
                                                        <div class="mb-3">
                                                            <label for="roomNumber" class="form-label">Room Number</label>
                                                            <input type="text" class="form-control" id="roomNumber" name="roomnum"  required>

                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="roomType" class="form-label">Room Type</label>
                                                            <input type="text" class="form-control" id="roomType" name="roomtype" required>
                                                        </div>


                                                    
                                                        <div class="mb-3">
                                                            <label for="fullName" class="form-label">Full Name</label>
                                                            <input type="text" class="form-control" id="fullName" name = "name" placeholder="Enter your full name" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="contactNumber" class="form-label">Address</label>
                                                            <input type="text" class="form-control" id="addr" name = "address" placeholder="Enter your Address" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="contactNumber" class="form-label">Contact Number</label>
                                                            <input type="number" class="form-control" id="contactNumber" name = "contact" placeholder="Enter your contact number" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="checkInDate" class="form-label">DOB</label>
                                                            <input type="date"  class="form-control"id="dobs" name = "dat" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="checkInDate" class="form-label"> Date</label>
                                                            <input type="date"  class="form-control"id="checkInDate" name = "checkin" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="checkInDate" class="form-label"> end_Date</label>
                                                            <input type="date"  class="form-control"id="enddate" name = "tap" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="contactNumber" class="form-label">Emergency Name</label>
                                                            <input type="text" class="form-control" id="eme" name = "eme_name" placeholder="Enter your Address" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="contactNumber" class="form-label">Emergency Contact</label>
                                                            <input type="text" class="form-control" id="emee" name = "eme_contact" placeholder="Enter your Address" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="additionalNotes" class="form-label">Additional Notes</label>
                                                            <textarea class="form-control" id="additionalNotes" rows="3" name = "comments" ></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary" form="bookRoomForm" id="save">Confirm Booking</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bookRoomModals" id="ssave"><i class="fas fa-edit"></i></button>


                                <div class="modal fade" id="bookRoomModals" tabindex="-1" aria-labelledby="bookRoomModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="bookRoomModalLabel">Update Room</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            
                                            <div class="modal-body">
                                                <form id="bookRoomForms" >
                                                <div class="mb-3">
                                                        <label for="roomNumber" class="form-label">User Id</label>
                                                        <input type="number" class="form-control" id="userid" name="idd"  required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="roomNumber" class="form-label">Room Number</label>
                                                        <input type="text" class="form-control" id="roomnumber" name="roomnum"  required>
                                                    </div>
                                                    <label for="roomType">Room Type</label>
                                                    <select id="roomType" name="roomtype" class="form-control"required>
                                                        <option value="single">Single</option>
                                                        <option value="double">Double</option>
                                                        <option value="suite" >Suite</option>
                                                    </select>

                                                    <label for="status">Status:</label>
                                                    <select id="status" name="status" class="form-control"required>
                                                        <option value="available" >Available</option>
                                                        <option value="occupied" >Occupied</option>
                                                        <option value="maintenance" >Maintenance</option>
                                                    </select>
                                                    <div class="mb-3">
                                                        <label for="contactNumber" class="form-label">Capacity</label>
                                                        <input type="number" class="form-control" id="capacitie" name = "capacity" placeholder="Enter your contact number"  required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="checkInDate" class="form-label"> Date</label>
                                                        <input type="date" class="form-control" id="ddate" name = "date"  required>
                                                    </div>
                                                
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary" form="bookRoomForms" id="saves">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>

                                        
                                            
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-info btn-sm view-btn" data-bs-toggle="modal" data-bs-target="#myModals" data-id=<?= $row['room_num']?> >
                                    <i class="fas fa-eye"></i>
                                        </button>

                                  
                                        <div class="modal" id="myModals">
                                            <div class="modal-dialog wide-modal-dialog">
                                                <div class="modal-content">
                                              
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Already Booked</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                      
                                                    <div class="modal-body" id="modalcontent">
                                                       
                                                    </div>

                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-info btn-sm booking" data-bs-toggle="modal" data-bs-target="#myModalss" data-ronums=<?php echo $row['room_num']?> >
                                    <i class="fas fa-history"></i>
                                        </button>

                                   
                                        <div class="modal" id="myModalss">
                                            <div class="modal-dialog wide-modal-dialog">
                                                <div class="modal-content">
                                                   
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Already Booked</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                             
                                                    <div class="modal-body" id="modadal">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Room Number</th>
                                                                    <th>Full Name</th>
                                                                    <th>Address</th>
                                                                    <th>Contact</th>
                                                                    <th>Date Of Birth</th>
                                                                    <th>Date</th>
                                                                    <th>End Book</th>
                                                                    <th>Emergency Name</th>
                                                                    <th>Emergency Contact</th>
                                                                    <th>Remarks</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                               
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                  
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                <a href="del.php?id=<?= $row['id']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>

                              
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <div>Showing 1 to 2 of 2 entries</div>
            <div class="page-nav">
                <?php
                    $sql = "SELECT count(*) AS total FROM addroom";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $total_pages = ceil($row["total"] / $results_per_page);
                        
                        echo "<div class='pagination'>";
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo "<a href='?page=".$i."'"; 
                            if ($i == $page) {
                                echo " class='active'";
                            }
                            echo ">".$i."</a>";
                        }
                        echo "</div>";
                        $conn->close();
                    ?>
            </div>
        </div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#myModalse">Add Room</button>

      
        <div class="modal" id="myModalse">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        <h3>Add Room</h3>
                    </div>
                    <div class="modal-body">
                        <form id="addRoomForm" method="post">
                            <label for="roomNumber">Room Number:</label>
                            <input type="text" id="roomNumber" name="roomNumber" required>

                            <label for="roomType">Room Type:</label>
                            <select id="roomType" name="roomType" required>
                                <option value="single">Single</option>
                                <option value="double">Double</option>
                                <option value="suite">Suite</option>
                            </select>

                            <label for="status">Status:</label>
                            <select id="status" name="wew" required>
                                <option value="available">Available</option>
                                <option value="occupied">Occupied</option>
                                <option value="maintenance">Maintenance</option>
                            </select>

                            <label for="capacity">Capacity:</label>
                            <input type="number" id="capacity" name="capacity" min="1" required>

                            <button type="submit" name="save">Add Room</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
            
            
    </div>
    <script>
       $(document).ready(function(){
        $('button[data-bs-toggle="modal"]').on('click', function() {
                var row = $(this).data('roomnume');
              

                $("#roomNumber").val(row);

       
    });
                $("#bookRoomForm").on("submit", function(event){
                    event.preventDefault();  

                    $.ajax({
                        url: '../ajax/book.php',  
                        method: "POST",           
                        data: $(this).serialize(), 
                        success: function(response){
                            
                            alert("Room booked successfully!");
                            $('#bookRoomModal').modal('hide'); 
                            $("#bookRoomForm")[0].reset();  
                        },
                        error: function(xhr, status, error){
                            
                            alert("Error booking room: " + error);
                        }
                    });
                });
            });
    </script>
     <script>
        $(document).ready(function(){
  
    $('button[data-bs-toggle="modal"]').on('click', function() {
        
        var row = $(this).closest('tr'); 
        var id = row.data('idd');
        var roomnum = row.data('roomnum');
        var roompref = row.data('roomtype');
        var status = row.data('status');
        var capacity = row.data('capacity');
        var date = row.data('date');


        $('#userid').val(id);
        $('#roomnumber').val(roomnum);
        $('#roomType').val(roompref);
        $('#status').val(status);
        $('#capacitie').val(capacity);
        $('#ddate').val(date);
    });

   
    $('#bookRoomForms').on('submit', function(event) {
        event.preventDefault(); 

        $.ajax({
            url: '../ajax/update.php',  
            type: 'POST',
            data: $(this).serialize(),  
            success: function(response) {
                
                alert('Room information updated successfully!');
                
              
                var row = $('tr[data-id="' + $('#userid').val() + '"]');

                row.find('td:nth-child(2)').text($('#roomnumber').val());
                row.find('td:nth-child(3)').text($('#roomType').val());
                row.find('td:nth-child(4)').text($('#status').val());
                row.find('td:nth-child(5)').text($('#capacitie').val());
                row.find('td:nth-child(6)').text($('#ddate').val());
                
              
                $('#bookRoomModals').modal('hide');
            },
            error: function(xhr, status, error) {
                
                alert('An error occurred while updating the data: ' + error);
            }
        });
    });
});

    </script>
    <script>
    $(document).ready(function(){
        $("#search").keyup(function(){
            var input = $(this).val();
            $.ajax({
                method: "GET",
                url: "../search/search.php",
                data: {inputed: input },
                success: function(data){
                    $("#tabb").html(data);
                }
            });
        });
    });

    </script>
   
   <script>
    $(document).ready(function(){
        $(".view-btn").click(function(){
         
            var roomid = $(this).data('id');
            console.log(roomid);
            $.ajax({
                url: "../ajax/select.php",  
                method: "POST",
                data: { id: roomid },  
                success: function(response){
                    
                    $("#modalcontent").html(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            })
        })
    })
</script>
<script>
    $(document).ready(function(){
        $(".booking").click(function(){
         
            var roomnum = $(this).data('ronums');
            
            console.log(roomnum);
            $.ajax({
                url: "../ajax/bookingselect.php",  
                method: "POST",
                data: { num: roomnum },  
                success: function(response){
                    
                   $('#modadal').html(response);
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                }
            })
        })
    })
</script>
<script>
function confirmDelete() {
    return confirm('Are you sure you want to delete this booking?');
}
</script>

</body>
</html>



