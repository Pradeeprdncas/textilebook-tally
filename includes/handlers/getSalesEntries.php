<?php
// Database connection
$host = 'localhost'; // Update as needed
$dbname = 'karthi_tex_webpage'; // Replace with your database name
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch previous entries
    $stmt = $conn->prepare("SELECT customer_name, product_name, piece_quantity, piece_rate, total_amt FROM karthi_tex_sales_entry_table ORDER BY id DESC");
    $stmt->execute();

    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo("
        <div style='display:flex;justify-content:space-between;font-family: sans-serif;'>
            <strong>Sno</strong>
            <strong>Seller</strong>
            <strong>Product</strong>
            <strong>Quantity</strong>
            <strong>Rate</strong>
            <strong>Total</strong>
        </div>
    ");
    $snovalue=1;
    // Generate HTML for each entry
    if (count($entries) > 0) {
        foreach ($entries as $entry) {
            echo "
                <div class='entry".$snovalue."' style='display:flex;justify-content:space-between;font-family: sans-serif;'>
                    <p>{$snovalue}</p>
                    <p>{$entry['customer_name']}</p>
                    <p>{$entry['product_name']}</p>
                    <p>{$entry['piece_quantity']}</p>
                    <p>₹{$entry['piece_rate']}</p>
                    <p>₹{$entry['total_amt']}</p>
                </div>
                <hr>
            ";
            $snovalue+=1;
        }
    } else {
        echo "<p>No previous entries found.</p>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
