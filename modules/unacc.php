
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
    $stmt = $conn->prepare("SELECT dealer_name FROM  `karthi_tex_dealers_entry_table` WHERE role='buyer'");
    $stmt->execute();

    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $snovalue=1;
    // Generate HTML for each entry

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>












<?php
echo "
    <div style='display:flex;'>
        <div style='
    width: 80px;'>
            <h3>Sno</h3>
        </div>
        <div style='width:330px'>
            <h3>Particular</h3>
        </div>
        <div style='width:100px'>
            <h3>HSN code</h3>
        </div>
        <div style='width:100px'>
            <h3>Pcs</h3>
        </div>
        <div style='width:100px'>
            <h3>Meter</h3>
        </div>
        <div style='width:100px'>
            <h3>Price</h3>
        </div>
        <div style='width:100px'>
            <h3>Bale</h3>
        </div>
        <div style='width:150px'>
            <h3>Total Amount</h3>
        </div>
         <div style='width:350px'>
            <h3>Buyer Name</h3>
        </div>

    </div>
    <div id='dataentrydiv' style='display:flex;'>
        <div style='width:80px'>
            <input id='serialno' class='input1no TabOnEnter'  tabindex='1' name='serialno'  placeholder='Sno'>
        </div>
        <div style='width:330px'>
            <input id='productname' style='width: 275px;' class='input1text TabOnEnter'  tabindex='2' name='productname' placeholder='Particular'>
        </div>
        <div style='width:100px'>
            <input id='hsncode' class='input1no TabOnEnter'  tabindex='3' name='hsncode' placeholder='HSN code'>
        </div>
        <div style='width:100px'>
            <input id='piecequantity' class='input1no TabOnEnter'  tabindex='4' name='piecequantity'  placeholder='Enter the piece quantity here'>
        </div>
        <div style='width:100px'>
            <input id='piecemeter' class='input1no TabOnEnter'  tabindex='5' name='piecemeter'  placeholder='Enter meter'>
        </div> 
        <div style='width:100px'>   
            <input id='piecerate' class='input1no TabOnEnter'  tabindex='6' name='piecerate'  placeholder='Enter Price'>
        </div>
        <div style='width:100px'>
            <input id='baleno' class='input1no TabOnEnter'  tabindex='7' name='baleno'  placeholder='Bale'>
        </div>
        <div style='width:150px'><input id='gettotalamt' name='gettotalamt' class='input1no' tabindex='7'  placeholder='0'></input></div>
        <div style='width:300px;'>
            <select id='buyername' style='width:250px;'>
                <option value='null'>Select Seller</option>
                    ";
                    if (count($entries) > 0) {
                        foreach ($entries as $entry) {
                            echo "
                                <option value=".$entry['dealer_name'].">{$entry['dealer_name']}</option>
                            ";
                    }
                    } else {
                        echo "<p>No previous entries found.</p>";
                    }
            echo "</select>    
        </div>
        <button class='button-17'  id='salesentrybtn'>Submit Purchase Entry</button>
        
    </div>
";
?>

<script>

$(document).on("keypress", ".TabOnEnter", function (e) {
    // Only do something when the user presses the Enter key
    if (e.keyCode === 13) {
        e.preventDefault(); // Prevent default Enter key behavior
        var nextElement = $('[tabindex="' + (this.tabIndex + 1) + '"]');
        console.log(this, nextElement);

        if (nextElement.length) {
            nextElement.focus();
        } else {
            // If no next element, focus on the first element with tabindex="1"
                document.getElementById("#purchaseentrybtn").click();
        }
        if(this.tabIndex == 4)
        {
            
        }
    }
});






$("#salesentrybtn").on("click", function () {

                const buyerName = $("#buyername").val();
                const productName = $("#productname").val();
                const hsnCode = $("#hsncode").val();
                const pieceMeter = $("#piecemeter").val();
                const baleNo = parseInt($("#baleno").val());
                const pieceQuantity = parseInt($("#piecequantity").val()) || 0;
                const pieceRate = parseFloat($("#piecerate").val()) || 0;
                const totalAmt = pieceQuantity * pieceRate;

                //Validate input
                if (buyerName == 'null' || !productName || pieceQuantity <= 0 || pieceRate <= 0) {
                    showRedAlert("Please fill all fields with valid data.");
                    return;
                }
                else
                {
                    document.addEventListener("keydown", function (event) {
                    if (event.key === "Enter") {
                        event.preventDefault(); // Prevent default Enter key behavior
                        salesEntryButton.click(); // Trigger button click
                    }
        });
                }

                // AJAX request to save data
                $.ajax({
                    url: "includes/save/saveUnaccSalesEntry.php",
                    type: "POST",
                    data: {
                        buyer_name: buyerName,
                        product_name: productName,
                        piece_quantity: pieceQuantity,
                        piece_rate: pieceRate,
                        total_amt: totalAmt,
                        hsn_code: hsnCode,
                        bale_no: baleNo,
                        piece_meter: pieceMeter
                    },
                    success: function (response) {
                        console.log("Success:", response); // Debugging output
                        alert(response); // Show server response
                        printunaccsalesBill();
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: ", xhr.responseText); // Debugging output
                        alert("Error saving the entry. Please try again.");
                    }
                });

            });


// print-bill





function generateunaccSalesBill() {
    // Get data from your form or database
    const buyerName = $("#buyername").val();
    const productName = $("#productname").val();
    const hsnCode = $("#hsncode").val();
    const pieceMeter = $("#piecemeter").val();
    const baleNo = parseInt($("#baleno").val());
    const pieceQuantity = parseInt($("#piecequantity").val()) || 0;
    const pieceRate = parseFloat($("#piecerate").val()) || 0;
    const totalAmt = pieceQuantity * pieceRate;
    const date = new Date().toLocaleDateString();
    const items = [
        // Example data, replace this with actual data
        { sno: 1, product: productName, hsn: hsnCode, qty: pieceQuantity, rate: pieceRate,piecemeter :pieceMeter , total: totalAmt,baleno: baleNo }
    ];

    let grandTotal = 0;

    // Populate the bill
    $("#bill-buyer-name").text(buyerName);
    $("#bill-date").text(date);

    const billItems = $("#bill-items");
    billItems.empty(); // Clear previous items
    items.forEach((item) => {
        grandTotal += item.total;
        billItems.append(`
            <tr>
                <td>${item.sno}</td>
                <td>${item.product}</td>
                <td>${item.hsn}</td>
                <td>${item.qty}</td>
                <td>${item.piecemeter}</td>
                <td>${item.rate}</td>
                <td>${item.baleno}</td>
                <td>${item.total}</td>
            </tr>
        `);
    });

    $("#grand-total").text(grandTotal);
}

function printunaccsalesBill() {
    generateunaccSalesBill(); // Call to populate the bill

    const billSection = document.getElementById("bill-section").innerHTML;
    const originalContent = document.body.innerHTML;

    // Replace the body content with the bill section
    document.body.innerHTML = billSection;

    window.print(); // Trigger print

    // Restore the original page content
    document.body.innerHTML = originalContent;
}

</script>

<html>




<div id="bill-section" style="display:none;">
    <div style="display:flex;justify-content:space-between;">
        <h2>GST No:33BJIPK4348D1ZF</h2>
        <h2>Ph.N0 : 9095257075</h2>
   </div>
    <div>
        <div style="display:flex;justify-content:space-between;">
            <div>
                <h1>Sri karthikeyan Textiles</h1>
                <h3>290,Eswaran Kovil Street</h3>
                <h3>Erode-638001, Tamil Nadu.</h3>
            </div>
            <div>
                <p><strong>Date:</strong> <span id="bill-date"></span></p>
                <p><strong>Buyer Name:</strong> <span id="bill-buyer-name"></span></p>
            </div>
        </div>
    </div>

    <table border="1" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Product Name</th>
                <th>HSN Code</th>
                <th>Pieces</th>
                <th>Meter</th>
                <th>Rate</th>
                <th>Bale</th>
                <th>Total</th>

            </tr>
        </thead>
        <tbody id="bill-items"></tbody>
    </table>

    <h3 style="text-align: right;">Grand Total: ₹<span id="grand-total"></span></h3>
</div>




</html>

<!-- <input id='sellername' class='input1text TabOnEnter'  tabindex='9' name='sellername' placeholder='Enter seller name here'> -->




