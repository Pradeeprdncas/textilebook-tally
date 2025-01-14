<?php
// Database connection
$host = 'localhost'; // Update as needed
$dbname = 'karthi_tex_webpage'; // Replace with your database name
$username = 'root'; // Replace with your DB username
$password = '';
 $dealerId = $_POST['dealerId'];
 echo $dealerId;


 try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch dealer entries
    $stmt = $conn->prepare("SELECT product_name, piece_quantity, piece_rate, piece_meter, hsn_code, total_amt, bale_no, entry_time FROM karthi_tex_sales_entry_table WHERE id = '$dealerId' ");
    $stmt->execute();

    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate HTML table
    echo "<div id='dealersdata'>";
    echo "<table border='1' style='width:100%; border-collapse:collapse; font-family:sans-serif;'>";
    echo "<thead>";
    echo "<tr style='height: 50px; background-color:#f2f2f2;'>";
    echo "<th>Sno</th>";
    echo "<th>Dealer Name</th>";
    echo "<th>Phone Number</th>";
    echo "<th>Role</th>";
    echo "<th>Address</th>";
    echo "<th>State Name</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $snovalue = 1;

    if (count($entries) > 0) {
        foreach ($entries as $entry) {
            echo "<tr onclick='showDealerDetails(\"{$entry['id']}\")'>";
            echo "<td>{$snovalue}</td>";
            echo "<td>{$entry['product_name']}</td>";
            echo "<td>{$entry['piece_quantity']}</td>";
            echo "<td>{$entry['piece_rate']}</td>";
            echo "<td>{$entry['piece_meter']}</td>";
            echo "<td>{$entry['total_amt']}</td>";
            echo "</tr>";
            $snovalue++;
        }
    } else {
        echo "<tr><td colspan='10' style='text-align:center;'>No dealer entries found.</td></tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "<div id='specificdealersdata' style='display:none;'></div>";


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
