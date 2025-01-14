<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expensePage = $_POST['expensePage'];

    switch ($expensePage) {
        case 'expenseEntry':
            include 'expenseEntry.php';
            break;
        case 'expenseRegister':
            include 'expenseRegister.php';
            break;
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
