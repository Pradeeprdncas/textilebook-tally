<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dealersPage = $_POST['dealersPage'];

    switch ($dealersPage) {
        case 'dealersEntry':
            include 'dealersEntry.php';
            break;
        case 'dealersView':
            include 'dealersRegister.php';
            break;
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>

