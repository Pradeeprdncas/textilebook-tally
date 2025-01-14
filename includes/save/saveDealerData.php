<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Database connection
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'karthi_tex_webpage';

    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get POST data
    $dealer_phno = $conn->real_escape_string($_POST['phonenumber']);
    $dealer_address = $conn->real_escape_string($_POST['dealeraddress']);
    $dealer_name = $conn->real_escape_string($_POST['dealername']);
    $dealer_role = $conn->real_escape_string($_POST['dealerrole']);
    $state_name = $conn->real_escape_string($_POST['statename']);
    $state_code = $conn->real_escape_string($_POST['statecode']);
    $invoice_number = $conn->real_escape_string($_POST['invoiceno']);
    $gst_no = $conn->real_escape_string($_POST['gstno']);
    $lorry_details = $conn->real_escape_string($_POST['lorrydetails']);

    // Use prepared statement to insert data into the table
    $stmt = $conn->prepare("INSERT INTO `karthi_tex_dealers_entry_table` 
        (`dealer_name`, `phno_1`, `role`, `address`, `state_name`, `state_code`, `invoice_number`, `gst_no`, `lorry_details`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error in SQL query: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param(
        "sssssssss",
        $dealer_name,
        $dealer_phno,
        $dealer_role,
        $dealer_address,
        $state_name,
        $state_code,
        $invoice_number,
        $gst_no,
        $lorry_details
    );

    // Execute the query
    if ($stmt->execute()) {
        echo "Dealer data saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
