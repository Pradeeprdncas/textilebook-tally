<?php
// Database connection
$host = 'localhost'; // Update as needed
$dbname = 'karthi_tex_webpage'; // Replace with your database name
$username = 'root'; // Replace with your DB username
$password = ''; // Replace with your DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Time range filter
    $timeRange = isset($_POST['time_range']) ? $_POST['time_range'] : 'this_month';
    $dateCondition = '';

    // Calculate date condition based on the selected time range
    switch ($timeRange) {
        case '3_months':
            $dateCondition = "DATE(entry_time) >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)";
            break;
        case '6_months':
            $dateCondition = "DATE(entry_time) >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)";
            break;
        case '1_year':
            $dateCondition = "DATE(entry_time) >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
            break;
        default: // this_month
            $dateCondition = "MONTH(entry_time) = MONTH(CURDATE()) AND YEAR(entry_time) = YEAR(CURDATE())";
            break;
    }

    // Fetch purchases within the selected range
    $purchaseStmt = $conn->prepare("
        SELECT product_name, SUM(piece_quantity) AS total_quantity, SUM(total_amt) AS total_amount
        FROM karthi_tex_purchase_entry_table
        WHERE $dateCondition
        GROUP BY product_name
    ");
    $purchaseStmt->execute();
    $purchases = $purchaseStmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch sales within the selected range
    $salesStmt = $conn->prepare("
        SELECT product_name, SUM(piece_quantity) AS total_quantity, SUM(total_amt) AS total_amount
        FROM karthi_tex_sales_entry_table
        WHERE $dateCondition
        GROUP BY product_name
    ");
    $salesStmt->execute();
    $sales = $salesStmt->fetchAll(PDO::FETCH_ASSOC);

    // Process data for profit/loss calculation
    $profitLossData = [];
    foreach ($purchases as $purchase) {
        $product = $purchase['product_name'];
        $purchaseTotal = $purchase['total_amount'];
        $salesTotal = 0;

        // Find matching sales entry for the same product
        foreach ($sales as $sale) {
            if ($sale['product_name'] == $product) {
                $salesTotal = $sale['total_amount'];
                break;
            }
        }

        $profitOrLoss = $salesTotal - $purchaseTotal;
        $profitLossData[] = [
            'product_name' => $product,
            'purchase_total' => $purchaseTotal,
            'sales_total' => $salesTotal,
            'profit_loss' => $profitOrLoss,
        ];
    }

    // Display HTML
    echo "<form method='POST'>";
    echo "<label for='time_range'>Select Time Range:</label>";
    echo "<select name='time_range' id='time_range' onchange='this.form.submit()'>";
    echo "<option value='this_month' " . ($timeRange == 'this_month' ? 'selected' : '') . ">This Month</option>";
    echo "<option value='3_months' " . ($timeRange == '3_months' ? 'selected' : '') . ">Last 3 Months</option>";
    echo "<option value='6_months' " . ($timeRange == '6_months' ? 'selected' : '') . ">Last 6 Months</option>";
    echo "<option value='1_year' " . ($timeRange == '1_year' ? 'selected' : '') . ">Last 1 Year</option>";
    echo "</select>";
    echo "</form>";
    echo "<br>";

    echo "<table border='1' style='width:100%; border-collapse:collapse; font-family:sans-serif;'>";
    echo "<thead>";
    echo "<tr style='height: 50px; background-color:#f2f2f2;'>";
    echo "<th>Product Name</th>";
    echo "<th>Total Purchase Amount</th>";
    echo "<th>Total Sales Amount</th>";
    echo "<th>Profit / Loss</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($profitLossData as $data) {
        $profitLossStyle = $data['profit_loss'] >= 0 ? 'color:green;' : 'color:red;';
        echo "<tr>";
        echo "<td>{$data['product_name']}</td>";
        echo "<td>₹" . number_format($data['purchase_total'], 2) . "</td>";
        echo "<td>₹" . number_format($data['sales_total'], 2) . "</td>";
        echo "<td style='$profitLossStyle'>₹" . number_format($data['profit_loss'], 2) . "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
