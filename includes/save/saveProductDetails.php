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

    // Safely retrieve POST data
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $hsn_code = $conn->real_escape_string($_POST['hsn_code']);
    $price_by_category = $conn->real_escape_string($_POST['price_by_category']);
    $price_per_piece_or_meter = isset($_POST['price_per_piece']) ? (float)$_POST['price_per_piece'] : 0;

    if ($price_by_category == "price_per_piece") {
        $stmt = $conn->prepare("INSERT INTO karthi_tex_products_details_table (product_name, hsn_code, price_by_category, price_per_piece) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            die("Error in SQL query: " . $conn->error);
        }

        $stmt->bind_param("sssd", $product_name, $hsn_code, $price_by_category, $price_per_piece_or_meter);
        if ($stmt->execute()) {
            echo "Product entry saved successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } elseif ($price_by_category == "price_per_meter") {
        $stmt = $conn->prepare("INSERT INTO karthi_tex_products_details_table (product_name, hsn_code, price_by_category, price_per_meter) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            die("Error in SQL query: " . $conn->error);
        }

        $stmt->bind_param("sssd", $product_name, $hsn_code, $price_by_category, $price_per_piece_or_meter);
        if ($stmt->execute()) {
            echo "Product entry saved successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid price category.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
