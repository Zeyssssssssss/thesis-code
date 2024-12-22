<?php
    session_start();
    include '../include/thirdnav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization & Approval</title>
    <style>
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

       
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            
            justify-content: center;
            align-items: center;
            min-height: 100vh;
         
        }

       
        section#authorization {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1100px;
            margin: -750px auto;
            margin-left: 400px;

        }

        h2 {
            text-align: center;
            color: #007BFF;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 24px;
        }

        
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            font-size: 16px;
            color: #333;
        }

        input, select, textarea {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            color: #333;
        }

        input, select {
            width: 100%;
        }

        textarea {
            width: 100%;
            resize: vertical;
            min-height: 100px;
        }

        /* Submit button */
        button {
            padding: 12px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        /* Footer styles */
        footer {
            text-align: center;
            padding: 10px 0;
            background: #007BFF;
            color: white;
            font-size: 14px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            section#authorization {
                width: 100%;
                padding: 20px;
            }

            h2 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

    <section id="authorization">
        <h2>Authorization & Approval Process</h2>
        <form id="authorizationForm">
            <label for="requesterName">Requester Name:</label>
            <input type="text" id="requesterName" name="requesterName" placeholder="Enter requester's name" required>

            <label for="approvalStatus">Approval Status:</label>
            <select id="approvalStatus" name="approvalStatus" required>
                <option value="">Select Status</option>
                <option value="approved">Approved</option>
                <option value="denied">Denied</option>
            </select>

            <label for="approverComments">Comments:</label>
            <textarea id="approverComments" name="approverComments" placeholder="Enter any comments or notes"></textarea>

            <button type="submit">Submit Approval</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Company Name | All Rights Reserved</p>
    </footer>

</body>
</html>
