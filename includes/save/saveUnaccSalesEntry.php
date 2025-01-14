
<?php 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $hsnCode = $conn->real_escape_string($_POST['hsn_code']);
    $baleNo = $conn->real_escape_string($_POST['bale_no']);
    $pieceMeter = $conn->real_escape_string($_POST['piece_meter']);
    $buyerName = $conn->real_escape_string($_POST['buyer_name']);
    $productName = $conn->real_escape_string($_POST['product_name']);
    $pieceQuantity = (int) $_POST['piece_quantity'];
    $pieceRate = (float) $_POST['piece_rate'];
    $totalAmt = (float) $_POST['total_amt'];
    $dealerRole = "seller";


    // Use prepared statement to insert data into the table
    $stmt = $conn->prepare("INSERT INTO karthi_tex_unacc_sales_entry_table 
    (buyer_name, product_name, piece_quantity, piece_rate, total_amt, hsn_code, bale_no, piece_meter) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");


    if (!$stmt) {
        die("Error in SQL query: " . $conn->error);
    }

    $stmt->bind_param("ssiddsss", $buyerName, $productName, $pieceQuantity, $pieceRate, $totalAmt, $hsnCode, $baleNo, $pieceMeter);

    if ($stmt->execute()) {
        echo "Sales entry saved successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}

?>