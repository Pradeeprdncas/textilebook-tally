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
    $baleNo = $_POST['bale_no'];
    $pieceMeter = $_POST['piece_meter'];
    $buyerName = $conn->real_escape_string($_POST['buyer_name']);
    $productName = $conn->real_escape_string($_POST['product_name']);
    $pieceQuantity = (int) ($_POST['piece_quantity']);
    $pieceRate = (float) ($_POST['piece_rate']);
    $totalAmt = (float) ($_POST['total_amt']);
    $dealerRole = "buyer";
    $entryTime = date("Y-m-d H:i:s");
    if ($pieceMeter == "")
    {
        $pieceMeter == 0;
    }

    // Generate a random invoice ID
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $invoiceID = '';
    for ($i = 0; $i < 8; $i++) {
        $invoiceID .= $characters[rand(0, strlen($characters) - 1)];
    }

    // First query: Insert into sales entry table
    $stmt = $conn->prepare("INSERT INTO karthi_tex_sales_entry_table 
        (invoice_id, buyer_name, product_name, piece_quantity, piece_rate, piece_meter, total_amt, hsn_code, bale_no, entry_time) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error in SQL query: " . $conn->error);
    }

    $stmt->bind_param(
        "sssiddssss",
        $invoiceID,
        $buyerName,
        $productName,
        $pieceQuantity,
        $pieceRate,
        $pieceMeter,
        $totalAmt,
        $hsnCode,
        $baleNo,
        $entryTime
    );

    if ($stmt->execute()) {
        // First query successful, proceed with stock update
        $quantityToReduce = $pieceQuantity ?: $pieceMeter;
        $boughtOrSold = 'sold';

        // Second query: Insert into stock management table
        $stockQuery = "INSERT INTO karthi_tex_stock_management_table 
            (product_name, current_stock, bought_or_sold) 
            VALUES (?, ?, ?)";

        $stockStmt = $conn->prepare($stockQuery);
        if (!$stockStmt) {
            die("Error in SQL query for stock management: " . $conn->error);
        }

        // Store the negative stock change for "sold" items
        $reducedStock = $quantityToReduce;

        $stockStmt->bind_param(
            "sis",
            $productName,
            $reducedStock,
            $boughtOrSold
        );

        if ($stockStmt->execute()) {
            echo "Sales entry saved successfully, and stock updated.";
        } else {
            echo "Error updating stock: " . $stockStmt->error;
        }

        $stockStmt->close();
    } else {
        echo "Error saving sales entry: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} 
else {
    echo "Invalid request.";
}
?>
