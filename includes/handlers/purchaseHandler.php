<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $purchasePage = $_POST['purchasePage'];

    switch ($purchasePage) {
        case 'purchaseEntry':
            include 'purchaseEntry.php';
            break;
        case 'purchaseRegister':
            include 'getpreviouspurchaseentries.php';
            break;
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
