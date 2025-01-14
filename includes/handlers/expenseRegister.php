<?php
// Database connection
$host = 'localhost'; // Update as needed
$dbname = 'karthi_tex_webpage'; // Replace with your database name
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch expense entries
    $stmt = $conn->prepare("SELECT id, expense_name, expense_type, expense_amount, created_at FROM karthi_tex_expense_table ORDER BY id DESC");
    $stmt->execute();

    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate HTML table
    echo "<div id='expensesData'>";
    echo "<table border='1' style='width:100%; border-collapse:collapse; font-family:sans-serif;'>";
    echo "<thead>";
    echo "<tr style='height: 50px; background-color:#f2f2f2;'>";
    echo "<th>Sno</th>";
    echo "<th>Expense Name</th>";
    echo "<th>Expense Type</th>";
    echo "<th>Amount</th>";
    echo "<th>Created At</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $snovalue = 1;

    if (count($entries) > 0) {
        foreach ($entries as $entry) {
            echo "<tr >";
            echo "<td>{$snovalue}</td>";
            echo "<td>{$entry['expense_name']}</td>";
            echo "<td>{$entry['expense_type']}</td>";
            echo "<td>₹{$entry['expense_amount']}</td>";
            echo "<td>{$entry['created_at']}</td>";
            echo "</tr>";
            $snovalue++;
        }
    } else {
        echo "<tr><td colspan='5' style='text-align:center;'>No expense entries found.</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


