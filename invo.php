<?php
    include '../include/thirdnav.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing System - Invoice Tenants</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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
            margin-top: 20px;
            position: absolute;
            right: 5px;
            width: 100%;
            max-width: 1400px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-file-invoice-dollar"></i> Invoice Tenants</h4>
        </div>
        <div class="card-body">
         
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Tenant ID</th>
                        <th>Tenant Name</th>
                        <th>Email</th>
                        <th>Room Number</th>
                        <th>Monthly Rent</th>
                    </tr>
                </thead>
                <tbody>
                 
                    <tr>
                        <td><input type="checkbox" class="form-check-input" id="tenant1"></td>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john.doe@example.com</td>
                        <td>101</td>
                        <td>$500</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="form-check-input" id="tenant2"></td>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane.smith@example.com</td>
                        <td>102</td>
                        <td>$600</td>
                    </tr>
                </tbody>
            </table>

       
            <form id="invoiceForm">
                <div class="mb-3">
                    <label for="invoiceDate" class="form-label">Invoice Date</label>
                    <input type="date" class="form-control" id="invoiceDate" required>
                </div>
                <div class="mb-3">
                    <label for="dueDate" class="form-label">Due Date</label>
                    <input type="date" class="form-control" id="dueDate" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Invoices</button>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>




</body>
</html>