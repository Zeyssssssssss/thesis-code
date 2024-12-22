<?php
    include '../include/thirdnav.php';
    include 'db.php';
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
            max-width: 1400px;
            position: absolute;
            left: 250px;
            top: 50px;
            background: #fdf5e6;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            text-align: left;
            margin-bottom: 20px;
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            animation: zoomIn 1s ease-in-out;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        table th,
        table td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
            vertical-align: middle;
            font-style: oblique;
            font-size: 16px;
            text-transform: capitalize;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        table tbody tr {
            animation: rowFadeIn 0.5s ease-in-out;
        }

        @keyframes rowFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
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
            transition: transform 0.2s ease-in-out;
        }

        .action-buttons button:hover {
            transform: scale(1.1);
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination select {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination .page-nav {
            display: flex;
            gap: 10px;
        }

        .page-nav button {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .page-nav button:hover {
            background-color: #0056b3;
        }

        .com {
            color: grey;
        }

        .mini-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Tenants</h1>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Emergency Name</th>
                    <th>Emergency Contact</th>
                    <th>Room & Bed</th>
                    <th>Status</th>
                    <th>Comments</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $image = "../ex/OIPS.jpg";
                    $id = $_SESSION['userinfo']['id'];
                    $sql = "SELECT * FROM add_tenantbooks WHERE user_id = '$id'";
                    $result = $conn->query($sql);
                    
                    foreach($result as $items){
                        ?>
                            <tr>
                                <td><?= $items['id']?></td>
                                <td><img src="<?php echo !empty($items['img']) ? $items['img'] : $image; ?>" alt="Profile Image" width="70" height="70"></td>
                                <td><?= $items['name']?></td>
                                <td><?= $items['email']?></td>
                                <td><?= $items['dob']?></td>
                                <td><?= $items['gender']?></td>
                                <td><?= $items['address']?></td>
                                <td><?= $items['contact']?></td>
                                <td><?= $items['eme_name']?></td>
                                <td><?= $items['eme_contact']?></td>
                                <td><?= $items['room']?></td>
                                <td style="color: <?= $items['status']=== 'active'? 'green': 'red' ?>"><?= $items['status']?></td>
                                <td class="com"><?= $items['comments']?></td>
                                <td class="action-buttons">
                                    <a href="../del/deltenant.php?id=<?= $items['id']?>" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                    <a href="tenantprof.php?id=<?= $items['id']?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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
                <button>Previous</button>
                <button>1</button>
                <button>Next</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#search").keyup(function(){
                var input = $(this).val();
                $.ajax({
                    method: "POST",
                    url: "../search/searchtenant.php",
                    data: {inputed: input },
                    success: function(data){
                        $("#tabb").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>