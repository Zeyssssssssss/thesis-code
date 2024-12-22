<?php

    include '../include/thirdnav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-transform: capitalize;
            display: flex;
            justify-content: center; 
            align-items: flex-start; 
            min-height: 100vh; 
        }

        .container {
            position: absolute;
            right: 150px;
            max-width: 1200px; 
            margin-top: 20px; 
            padding: 20px;
        }

        .tab-content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
         
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <?php
                            include '../admin/db.php';
                            $iid = $_GET['id'];
                            $id = $_SESSION['userinfo']['id'];
                            $sql = "SELECT * FROM add_tenantbooks WHERE user_id = '$id' and id = '$iid'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                        ?>
                        <img src="https://via.placeholder.com/120" class="rounded-circle mb-3" alt="Profile Picture">
                        <h5 class="card-title"><?= $row['name'] ?></h5>
                        <p>ID: <?= $row['id'] ?></p>
                        <span style="color: <?= $row['status'] === 'active' ? 'green' : 'red' ?>"><?= $row['status'] ?></span>
                        <hr>
                        <p><strong>Room:</strong> <?= $row['room'] ?? 'N/A' ?></p>
                        <p><strong>Bed:</strong> <?= $row['bed'] ?? 'N/A' ?></p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h6>Tenant Stats</h6>
                        <p><strong>Total Invoices:</strong> 0</p>
                        <p><strong>Paid Invoices:</strong> 0</p>
                    </div>
                </div>
            </div>
            

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tenant-details" data-bs-toggle="tab">Tenant Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#all-invoices" data-bs-toggle="tab">All Invoices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#paid-invoices" data-bs-toggle="tab">Paid Invoices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#balance-invoices" data-bs-toggle="tab">Balance Invoices</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                          
                            <div class="tab-pane fade show active" id="tenant-details">
                                <h5>Tenant Details</h5>
                                <table class="table table-bordered">
                                    <tr><th>Name</th><td><?= $row['name'] ?></td></tr>
                                    <tr><th>Email</th><td><?= $row['email'] ?></td></tr>
                                    <tr><th>Gender</th><td><?= $row['gender'] ?></td></tr>
                                    <tr><th>DOB</th><td><?= $row['dob'] ?></td></tr>
                                    <tr><th>Address</th><td><?= $row['address'] ?></td></tr>
                                </table>
                            </div>

                           
                            <div class="tab-pane fade" id="all-invoices">
                                <h5>All Invoices</h5>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Invoice Number</th>
                                            <th>Tenant Name</th>
                                            <th>Amount</th>
                                            <th>Date Issued</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td>#INV001</td>
                                            <td>John Doe</td>
                                            <td>$500</td>
                                            <td>2024-12-10</td>
                                            <td><span class="badge bg-warning">Unpaid</span></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceDetailModal" onclick="viewInvoiceDetails('#INV001')">View</button>
                                                <button class="btn btn-success btn-sm">Mark as Paid</button>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#INV002</td>
                                            <td>Jane Smith</td>
                                            <td>$450</td>
                                            <td>2024-12-09</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceDetailModal" onclick="viewInvoiceDetails('#INV002')">View</button>
                                                <button class="btn btn-success btn-sm">Mark as Paid</button>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                         
                            <div class="tab-pane fade" id="paid-invoices">
                                <h5>Paid Invoices</h5>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Invoice Number</th>
                                            <th>Tenant Name</th>
                                            <th>Amount</th>
                                            <th>Date Issued</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample data for paid invoices - This would come from the database -->
                                        <tr>
                                            <td>#INV002</td>
                                            <td>Jane Smith</td>
                                            <td>$450</td>
                                            <td>2024-12-09</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceDetailModal" onclick="viewInvoiceDetails('#INV002')">View</button>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#INV005</td>
                                            <td>Mary Johnson</td>
                                            <td>$400</td>
                                            <td>2024-12-08</td>
                                            <td><span class="badge bg-success">Paid</span></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceDetailModal" onclick="viewInvoiceDetails('#INV005')">View</button>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="balance-invoices">
                                <h5>Balance Invoices</h5>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Invoice Number</th>
                                            <th>Tenant Name</th>
                                            <th>Total Amount</th>
                                            <th>Amount Paid</th>
                                            <th>Remaining Balance</th>
                                            <th>Date Issued</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <tr>
                                            <td>#INV003</td>
                                            <td>John Doe</td>
                                            <td>$500</td>
                                            <td>$300</td>
                                            <td>$200</td>
                                            <td>2024-12-10</td>
                                            <td><span class="badge bg-warning text-dark">Balance Due</span></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceDetailModal" onclick="viewInvoiceDetails('#INV003')">View</button>
                                                <button class="btn btn-success btn-sm">Pay</button>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#INV007</td>
                                            <td>Alice Brown</td>
                                            <td>$600</td>
                                            <td>$450</td>
                                            <td>$150</td>
                                            <td>2024-12-08</td>
                                            <td><span class="badge bg-warning text-dark">Balance Due</span></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#invoiceDetailModal" onclick="viewInvoiceDetails('#INV007')">View</button>
                                                <button class="btn btn-success btn-sm">Pay</button>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                                        <div class="modal fade" id="invoiceDetailModal" tabindex="-1" aria-labelledby="invoiceDetailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="invoiceDetailModalLabel">Invoice Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Invoice Number:</strong> <span id="invoiceNumber"></span></p>
                                                <p><strong>Tenant Name:</strong> <span id="tenantDetails"></span></p>
                                                <p><strong>Total Amount:</strong> $<span id="totalAmount"></span></p>
                                                <p><strong>Amount Paid:</strong> $<span id="amountPaid"></span></p>
                                                <p><strong>Remaining Balance:</strong> $<span id="remainingBalance"></span></p>
                                                <p><strong>Date Issued:</strong> <span id="invoiceDateDetails"></span></p>
                                                <p><strong>Status:</strong> <span id="invoiceStatus"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                             
                             
                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</body>
</html>