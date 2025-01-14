<?php
// Database connection
$host = 'localhost'; // Update as needed
$dbname = 'karthi_tex_webpage'; // Replace with your database name
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch today's entries
    $stmt = $conn->prepare("
        SELECT id, invoice_id, buyer_name, product_name, piece_quantity, piece_rate, total_amt, entry_time, hsn_code, bale_no, piece_meter 
        FROM karthi_tex_sales_entry_table 
        WHERE DATE(entry_time) = CURDATE()
        ORDER BY id DESC
    ");
    $stmt->execute();

    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "
            <div class='div1' style='background-color:#FAF8ED'>
                <div style='width:100%;display:flex;justify-content:space-between;'>
                    <h3>GST No:33BJIPK4348D1ZF</h3>
                    <h3>Ph.No : 9095257075</h3>
                </div>
                <center> 
                    <h1>Sri Karthikeyan Textiles</h1>
                </center>
                <center>
                    <h3>290, Eswaran Kovil Street, Erode-638001, Tamil Nadu.</h3>
                </center>
                <h3 font-family:sans-serif;>Today " . date("Y/m/d") . "<h3>
            
    ";
    // Generate HTML table
    echo "<table border='1' style='width:100%; border-collapse:collapse; font-family:sans-serif;'>";
    echo "<thead>";
    echo "<tr style='background-color:#f2f2f2;'>";
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
            echo "<tr onclick='alert(\"{$entry['invoice_id']}\")'>";
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
        echo "<tr><td colspan='10' style='text-align:center;'>No entries found for today.</td></tr>";
    }

    echo "</tbody>";
    echo "</table></div>
            <br>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
