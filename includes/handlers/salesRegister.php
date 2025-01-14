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
    $stmt = $conn->prepare("SELECT buyer_name, product_name, piece_quantity, piece_rate, total_amt, entry_time, hsn_code, bale_no, piece_meter, invoice_id FROM karthi_tex_sales_entry_table ORDER BY id DESC");
    $stmt->execute();

    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate HTML table
    echo "<table border='1' style='width:100%; border-collapse:collapse; font-family:sans-serif;'>";
    echo "<thead>";
    echo "<tr style='height: 80px;background-color:#f2f2f2;'>";
    echo "<th>Sno</th>";
    echo "<th>Buyer Name</th>";
    echo "<th>Product Name</th>";
    echo "<th>Piece Quantity</th>";
    echo "<th>Piece Rate</th>";
    echo "<th>Total Amount</th>";
    echo "<th>Entry Time</th>";
    echo "<th>HSN Code</th>";
    echo "<th>Bale No</th>";
    echo "<th>Piece Meter</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $snovalue = 1;

    if (count($entries) > 0) {
        foreach ($entries as $entry) {
            echo "<tr onclick='getFullBillDetails(\"{$entry['invoice_id']}\")'>";
            echo "<td>{$snovalue}</td>";
            echo "<td>{$entry['buyer_name']}</td>";
            echo "<td>{$entry['product_name']}</td>";
            echo "<td>{$entry['piece_quantity']}</td>";
            echo "<td>₹{$entry['piece_rate']}</td>";
            echo "<td>₹{$entry['total_amt']}</td>";
            echo "<td>{$entry['entry_time']}</td>";
            echo "<td>{$entry['hsn_code']}</td>";
            echo "<td>{$entry['bale_no']}</td>";
            echo "<td>{$entry['piece_meter']}</td>";
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