<?php
// Database connection
$host = 'localhost';
$dbname = 'karthi_tex_webpage'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get POST data
    $expenseName = $_POST['expenseName'] ?? '';
    $expenseType = $_POST['expenseType'] ?? '';
    $expenseAmount = $_POST['expenseAmount'] ?? 0;

    // Validate data
    if (empty($expenseName) || empty($expenseType) || $expenseAmount <= 0) {
        echo 'Invalid input';
        exit;
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO karthi_tex_expense_table (expense_name, expense_type, expense_amount) VALUES (:expenseName, :expenseType, :expenseAmount)");
    $stmt->bindParam(':expenseName', $expenseName);
    $stmt->bindParam(':expenseType', $expenseType);
    $stmt->bindParam(':expenseAmount', $expenseAmount);

    if ($stmt->execute()) {
        echo 'Expense saved successfully';
    } else {
        echo 'Error saving expense';
    }

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
