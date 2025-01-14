<?php
// Database connection
$host = 'localhost'; // Update as needed
$dbname = 'karthi_tex_webpage'; // Replace with your database name
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch dealer entries
    $stmt = $conn->prepare("SELECT id, dealer_name, phno_1, role, address, state_name, state_code, invoice_number, gst_no, lorry_details FROM karthi_tex_dealers_entry_table ORDER BY id DESC");
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
    echo "<th>State Code</th>";
    echo "<th>Invoice Number</th>";
    echo "<th>GST No</th>";
    echo "<th>Lorry Details</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $snovalue = 1;

    if (count($entries) > 0) {
        foreach ($entries as $entry) {
            echo "<tr onclick='showDealerDetails(\"{$entry['id']}\")'>";
            echo "<td>{$snovalue}</td>";
            echo "<td>{$entry['dealer_name']}</td>";
            echo "<td>{$entry['phno_1']}</td>";
            echo "<td>{$entry['role']}</td>";
            echo "<td>{$entry['address']}</td>";
            echo "<td>{$entry['state_name']}</td>";
            echo "<td>{$entry['state_code']}</td>";
            echo "<td>{$entry['invoice_number']}</td>";
            echo "<td>{$entry['gst_no']}</td>";
            echo "<td>{$entry['lorry_details']}</td>";
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
   
<script>
function showDealerDetails(dealerId) {
        document.getElementById('dealersdata').style.display = 'none';
        document.getElementById('specificdealersdata').style.display = 'block';

        $.ajax({
                    url: "includes/view/specificDealersData.php",
                    type: "POST",
                    data: { dealerId: dealerId }, // Dynamically send selected tab
                    success: function (response) {
                        $("#specificdealersdata").html(response);
            
                    },
                    error: function () {
                        $("#specificdealersdata").html("<p>Error loading the page!</p>");
                    }
                });
    // You can replace the alert with additional functionality like fetching more details
}
</script>
