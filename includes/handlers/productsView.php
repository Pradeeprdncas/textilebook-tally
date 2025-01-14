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
    $stmt = $conn->prepare("SELECT product_name, hsn_code, price_by_category, price_per_piece, price_per_meter FROM karthi_tex_products_details_table ORDER BY product_id DESC");
    $stmt->execute();

    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate HTML table
    echo "<table border='1' style='width:100%; border-collapse:collapse; font-family:sans-serif;'>";
    echo "<thead>";
    echo "<tr style='height: 80px;background-color:#f2f2f2;'>";
    echo "<th>Sno</th>";
    echo "<th>Product Name</th>";
    echo "<th>HSN Code</th>";
    echo "<th>Price Category</th>";
    echo "<th>Piece</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $snovalue = 1;

    if (count($entries) > 0) {
        foreach ($entries as $entry) {
            echo "<tr onclick='getFullBillDetails(\"{$entry['invoice_id']}\")'>";
            echo "<td>{$snovalue}</td>";
            echo "<td>{$entry['product_name']}</td>";
            echo "<td>{$entry['hsn_code']}</td>";
            echo "<td>{$entry['price_by_category']}</td>";
            if ($entry['price_by_category'] == 'price_per_piece')
            {
                echo "<td>₹{$entry['price_per_piece']}(per pcs)</td>";
            }
            if ($entry['price_by_category'] == 'price_per_meter')
            {
                echo "<td>₹{$entry['price_per_meter']}(per mtr)</td>";
            }
            echo "</tr>";
            $snovalue++;
        }
    } else {
        echo "<tr><td colspan='10' style='text-align:center;'>No previous entries found.</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<script>

function getFullBillDetails(invoiceID)
{
    
}
</script>