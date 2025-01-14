<?php
if (isset($_GET['search'])) {
    $productquery = htmlspecialchars($_GET['productquery']); // Sanitize user input

    // Database connection
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "karthi_tex_webpage"; // Replace with your database name

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT product_name FROM karthi_tex_products_details_table WHERE product_name LIKE ? LIMIT 10"); // Replace 'entry_name' and 'your_table_name'
    $productsearchTerm = "%$productquery%";
    $stmt->bind_param("s", $productsearchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
  

    $suggestions = "";
    while ($row = $result->fetch_assoc()) {
        $suggestions .= "<div class='product-suggestion-item'>" . htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8') . "</div>";
    }
    

    echo empty($suggestions) ? "<div class='product-suggestion-item'>No results found</div>" : $suggestions;

    $stmt->close();
    $conn->close();
}
?>
