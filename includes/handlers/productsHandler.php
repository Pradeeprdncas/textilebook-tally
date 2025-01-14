<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];

    switch ($productName) {
        case 'productsEntry':
            include 'productsEntry.php';
            break;
        case 'productsView':
            include 'productsView.php';
            break;
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
