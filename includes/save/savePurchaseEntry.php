<?php
// Database connection
$host = 'localhost'; // Change if needed
$user = 'root'; // Change if needed
$password = ''; // Change if needed
$database = 'karthi_tex_webpage'; // Change to your database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from POST request
$serialNo = $_POST['serialNo'] ?? null;
$productName = $_POST['productName'] ?? null;
$hsnCode = $_POST['hsnCode'] ?? null;
$pieceQuantity = $_POST['pieceQuantity'] ?? null;
$pieceMeter = $_POST['pieceMeter'] ?? null;
$pieceRate = $_POST['pieceRate'] ?? null;
$totalAmt = $_POST['totalAmt'] ?? null;
$entryTime = date("Y-m-d H:i:s"); // Current timestamp
$dealerName = $_POST['dealerName'] ?? null;

// Validate required fields
if (!$productName || (!$pieceQuantity && !$pieceMeter) || !$pieceRate) {
    echo "Invalid input. Please provide all required fields.";
    exit;
}

// Prepare and execute the first INSERT query
$query = "INSERT INTO karthi_tex_purchase_entry_table 
    (seller_name, product_name, hsn_code, piece_quantity, piece_meter, piece_rate, total_amt, entry_time) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param(
    "sssiddss",
    $dealerName,
    $productName,
    $hsnCode,
    $pieceQuantity,
    $pieceMeter,
    $pieceRate,
    $totalAmt,
    $entryTime
);

if ($stmt->execute()) {
    // First query successful, prepare the second query
    $currentStock = $pieceQuantity ?: $pieceMeter; // Use either quantity or meter
    $boughtOrSold = 'bought'; // Fixed value for this query

    $stockQuery = "INSERT INTO karthi_tex_stock_management_table 
        (product_name, current_stock, bought_or_sold) 
        VALUES (?, ?, ?)";

    $stockStmt = $conn->prepare($stockQuery);
    $stockStmt->bind_param(
        "sis",
        $productName,
        $currentStock,
        $boughtOrSold
    );

    if ($stockStmt->execute()) {
        echo "Purchase entry and stock updated successfully.";
    } else {
        echo "Failed to update stock: " . $stockStmt->error;
    }

    // Close the second statement
    $stockStmt->close();
} else {
    echo "Failed to save purchase entry: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
