<?php
    include '../include/thirdnav.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay with GCash</title>
    <!-- Bootstrap CSS for styling (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
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
</style>
<body>

<div class="container mt-5">
    <button id="payButton" class="btn btn-primary">Pay with GCash</button>
</div>

<script>
    $(document).ready(function() {
        $('#payButton').click(function() {
            // Send AJAX request to PHP script to create payment intent
            $.ajax({
                url: 'create_payment_intent.php',
                method: 'POST',
                success: function(response) {
                    // Parse JSON response
                    var data = JSON.parse(response);
                    if (data.status === 'success') {
                        // Redirect to PayMongo checkout URL
                        window.location.href = data.checkout_url;
                    } else {
                        alert('Error creating payment intent: ' + data.message);
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>

</body>
</html>