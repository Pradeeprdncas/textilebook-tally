<?php
// Database configuration
$host = 'localhost';
$user = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password
$database = 'karthi_tex_webpage'; // Replace with your DB name

// Connect to the database
$conn = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get buyer name from POST request
 
    $buyerName = $conn->real_escape_string($_POST['buyerName']) ;

if ($buyerName) {

    // Query the database
    $query = "SELECT `state_name`, `state_code`, `invoice_number`, `gst_no`, `lorry_details` 
              FROM `karthi_tex_dealers_entry_table` 
              WHERE `dealer_name` = '$buyerName'";


    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        // Fetch the row and return the data as pipe-separated string
        $row = $result->fetch_assoc();
        echo $row['state_name'] . "|" . $row['state_code'] . "|" . $row['invoice_number'] . "|" . $row['gst_no'] . "|" . $row['lorry_details'];
    } else {
        echo "Error|No|Data|Found|!";
    }
} else {
    echo "Error|Invalid|Request|!";
}

// Close the database connection
$conn->close();
?>
