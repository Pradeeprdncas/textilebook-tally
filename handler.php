<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page = $_POST['pageselect'];

    switch ($page) {
        case 'purchase':
            include 'modules/purchase.php';
            break;
        case 'sales':
            include 'modules/sales.php';
            break;
        case 'expense':
            include 'modules/expense.php';
            break;
        case 'dealers':
            include 'modules/dealers.php';
            break;
        case 'unacc':   
            include 'modules/unacc.php';
            break;
        case 'products':   
            include 'modules/products.php';
            break;
        case 'daybook':
            include 'modules/dayBook.php';
            break;
        case 'profitandloss':
            include 'modules/profitAndLoss.php';
            break;
            
        default:
            echo "<p>Invalid selection.</p>";
            break;
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
