<?php
    include '../include/thirdnav.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .custom-container {
            background-color: #ffffff; 
            padding: 20px;           
            border-radius: 10px;     
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
            position: absolute;
            right: 20px;
            top: 20px;
           width: 85%;
            
        }
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
    </style>
</head>
<body>


    <div class="custom-container">
            <div class="card-header bg-secondary text-white">
                <h5>Payment Tracking & Invoicing</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="paymentHistory">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Resident Name</th>
                            <th>Amount Paid</th>
                            <th>Payment Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Payment records will be dynamically loaded -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <!-- Late Payment Alerts -->
        <div class="alert alert-danger d-none" id="latePaymentAlert">
            <strong>Warning:</strong> The following residents have overdue payments. Please take action.
        </div>
    </div>
</body>
</html>