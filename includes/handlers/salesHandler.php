<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $salesPage = $_POST['salesPage'];

    switch ($salesPage) {
        case 'salesEntry':
            include 'salesEntry.php';
            break;
        case 'salesRegister':
            include 'salesRegister.php';
            break;
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
