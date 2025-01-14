<?php
// Database connection
$host = 'localhost'; // Update as needed
$dbname = 'karthi_tex_webpage'; // Replace with your database name
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch previous entries
    $stmt = $conn->prepare("SELECT seller_name, product_name, piece_quantity, piece_rate, total_amt FROM karthi_tex_purchase_entry_table ORDER BY id DESC");
    $stmt->execute();

    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate HTML table
    echo "<table border='1' style='width:100%; border-collapse:collapse; font-family:sans-serif;'>";
    echo "<thead>";
    echo "<tr style='height: 80px; background-color:#f2f2f2;'>";
    echo "
        <th>Sno</th>
        <th>Seller</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Rate</th>
        <th>Total</th>
    ";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $snoValue = 1; // Initialize serial number
    if (count($entries) > 0) {
        foreach ($entries as $entry) {
            if($entry[''])
            echo "<tr style='font-family: sans-serif;'>";
            echo "<td>{$snoValue}</td>";
            echo "<td>{$entry['seller_name']}</td>";
            echo "<td>{$entry['product_name']}</td>";
            echo "<td>{$entry['piece_quantity']}</td>";
            echo "<td>₹{$entry['piece_rate']}</td>";
            echo "<td>₹{$entry['total_amt']}</td>";
            echo "</tr>";
            $snoValue++;
        }
    } else {
        echo "<tr><td colspan='6'>No previous entries found.</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
