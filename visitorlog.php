<?php
    include '../include/thirdnav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Management System</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
   
            height: 100vh;
            padding-top: 50px; /* Gives top padding for the header */
        }

        header {
            background: #007BFF;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            width: 100%; /* Makes header full width */
        }

        .container {
            width: 100%; /* Adjusts width of the main content */
            max-width: 1350px; /* Sets max width */
            padding: 20px;
            background: #fff;
            position: absolute;
            right: 50px;
            top: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            
        }

        section {
            margin-bottom: 20px;
        }

        h2 {
            border-bottom: 2px solid #007BFF;
            padding-bottom: 5px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, select, textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background: #007BFF;
            color: white;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background: #007BFF;
            color: white;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>
<body>
   

    <div class="container">
        <section id="check-in">
            <h2>Visitor Check-In</h2>
            <form id="checkInForm">
                <label for="visitorName">Name:</label>
                <input type="text" id="visitorName" required>

                <label for="visitPurpose">Purpose of Visit:</label>
                <input type="text" id="visitPurpose" required>

                <button type="submit" class="btn btn-success">Check In</button>
            </form>
        </section>

        <section id="check-out">
            <h2>Visitor Check-Out</h2>
            <form id="checkOutForm">
                <label for="visitorId">Visitor Name:</label>
                <input type="text" id="visitorId" required>

                <button type="submit" class="btn btn-danger">Check Out</button>
            </form>
        </section>

        <section id="logs">
            <h2>Visitor Logs</h2>
            <table id="visitorLogs">
                <thead>
                    <tr>
                        <th>Visitor ID</th>
                        <th>Name</th>
                        <th>Purpose</th>
                        <th>Check-In Time</th>
                        <th>Check-Out Time</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Logs will be populated here -->
                </tbody>
            </table>
        </section>
    </div>
   

</body>
</html>
