
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

    <div style='padding:10px;border-radius:5px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;background-color:#fff'>
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
        </div>
        <br>

        <div id='dataentrydiv'>


            <div style='display:flex;justify-content:space-between;'>
                <div style='width:100%;'>
                    <td style='border: 1px solid #000; padding: 5px ;'>
                        <textarea id='buyername' class='TabOnEnter' tabindex='9' onkeyup='fetchSuggestions()' placeholder='Buyer Name' style='width: 30%; height:120px;'></textarea>
                        <div id='suggestions'></div>
                    </td>
                    <br>
                    <br>
                    <td>
                        <input style='height:50px;width:30%;' placeholder='Gst Number'  type='text' id='Gst-no-data' value='-' /></h3>
                    </td>
                </div>
                <div>
                    <table>
                        <tbody>
                            <tr style='padding:20px;'>
                                <td>
                                    <h3><strong>Date:</strong> <input class='no-border' style='height:35px;width:100%;' type='text' id='bill-date' value=''/></h3>
                                </td>
                                <td>
                                    <h3><strong>State:</strong> <input class='no-border' style='height:35px;width:100%;'  type='text' id='state-name-data' value='' /></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3><strong>bale</strong> <input class='no-border' style='height:35px;width:100%;'  type='text' id='bale' value='' /></h3>
                                </td>
                                <td>
                                    <h3><strong>State Code:</strong> <input class='no-border' style='height:35px;width:100%;'  type='text' id='State-code-data' value='' /></h3>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h3><strong>Invoice No:</strong> <input class='no-border' style='height:35px;width:100%;'  type='text' id='invoice-number-data' value='' /></h3>
                                </td>
                                <td>
                                    <h3><strong>Lorry:</strong> <input class='no-border' style='height:35px;width:100%;'  type='text' id='Lorry-data' value='' /></h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                </div>

            </div>
            <br>
            <!-- Table Headers -->
            <table style='width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;'>
                <thead>
                    <tr style='background-color: #ddd;'>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 80px;'>Order No</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 330px;'>Particular</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>HSN Code</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>Bale</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>Pcs</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>Meter</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Entry Row -->
                    <tr id='entrytablerow'>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input id='serialno' class='no-border TabOnEnter' tabindex='1' name='serialno' placeholder='Sno' style='width: 90%;height:50px;'>
                        </td>

                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input id='productname' autocomplete='off' class='no-border TabOnEnter' tabindex='2' onkeyup='fetchProducts();' name='productname' placeholder='Particular' style='width: 90%;height:50px;'>
                            <div id='productsuggestions'></div>

                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input id='hsncode' class='no-border TabOnEnter' tabindex='3' name='hsncode' placeholder='HSN Code' style='width: 90%;height:50px;'>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input id='baleno' class='no-border TabOnEnter' tabindex='7' name='baleno' placeholder='Bale' style='width: 90%;height:50px;'>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input id='piecequantity' class='no-border TabOnEnter' tabindex='4' onkeyup='calctotamt();' name='piecequantity' placeholder='Enter Pcs' style='width: 90%;height:50px;'>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input id='piecemeter' class='no-border TabOnEnter' tabindex='5' onkeyup='calctotamt();' name='piecemeter' placeholder='Enter Meter' style='width: 90%;height:50px;'>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input id='piecerate' class='no-border TabOnEnter' tabindex='6' onkeyup='calctotamt();' name='piecerate' placeholder='Enter Price' style='width: 90%;height:50px;'>
                        </td>

                    </tr>

                    <tr>
                        <td style='border: 0px solid #000; padding: 5px;' colspan='5'></td>
                  
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input class='no-border' tabindex='8' placeholder='cgst' style='width: 90%;height:40px;' onkeyup='calctotamt()' id='cgstper' type='text'  name='cgstper' />
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input class='no-border' tabindex='9' placeholder='cgst' style='width: 90%;height:40px;' id='cgstper' type='text'  name='cgstval' />
                        </td>
                    </tr>
                    <tr>
                        <td style='border: 0px solid #000; padding: 5px;' colspan='5'></td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input class='no-border' tabindex='8' placeholder='sgst' style='width: 90%;height:40px;' onkeyup='calctotamt()' id='sgstper' type='text'  name='cgstper' />
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input class='no-border' tabindex='9' placeholder='sgst' style='width: 90%;height:40px;' id='sgstval' type='text'  name='cgstval' />
                        </td>
                    </tr>
                    <tr>
                        <td style='border: 0px solid #000; padding: 5px;' colspan='5'></td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input class='no-border' tabindex='8' placeholder='Igst' style='width: 90%;height:40px;' onkeyup='calctotamt()' id='igstper' type='text'  name='igstper' />
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input class='no-border' tabindex='9' placeholder='Igst' style='width: 90%;height:40px;' id='igstval' type='text'  name='igstval' />
                        </td>
                    </tr>
                    <tr>
                        <td style='border: 0px solid #000; padding: 5px;' colspan='6'></td>
                         <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input class='no-border' id='gettotalamt' class='' name='gettotalamt' tabindex='7' placeholder='0' style='width: 90%;height:40px;' readonly>
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
                <div style='width:100%;;display: flex;justify-content: end;'>
                <button class='button-28' id='salesentrybtn' >Submit</button>
                </div>
        </div>
    </div>

";
?>

<script>

    
    const today = new Date();
    const todaydate = `${today.getFullYear()}-${String(today.getMonth() + 1).padStart(2, '0')}-${String(today.getDate()).padStart(2, '0')}`;
    $("#bill-date").val(todaydate);

    function calctotamt() {
        const pieceMeter = parseFloat($("#piecemeter").val()) || 0;
        const pieceQuantity = parseInt($("#piecequantity").val()) || 0;
        const pieceRate = parseFloat($("#piecerate").val()) || 0;
        const isByMeter = $("#piecebymeter").prop("checked");
        const cgstper = parseFloat($("#cgstper").val()) || 0;
        const sgstper = parseFloat($("#sgstper").val()) || 0;
        const igstper = parseFloat($("#igstper").val()) || 0;


        totalAmount = 0;

        if (pieceMeter != 0) {
            totalAmount = pieceMeter * pieceRate; // Calculate by meter
        } else {
            totalAmount = pieceQuantity * pieceRate; // Calculate by quantity
        }
        const totalGSTPercentage = cgstper + sgstper + igstper; // Total GST percentage
        if (totalGSTPercentage > 0) {
            const gstAmount = (totalAmount * totalGSTPercentage) / 100;
            totalAmount += gstAmount; // Add GST to total amount
        }

          // Round totalAmount to 2 decimal places
        totalAmount = totalAmount.toFixed(2);

        // Set the calculated value in `gettotalamt`
        $("#gettotalamt").val(totalAmount); // Set the calculated value in `gettotalamt`
    }
    
    $(document).on("keypress", ".TabOnEnter", function (e) {
        // Only do something when the user presses the Enter key
        if (e.keyCode === 13) {
            e.preventDefault(); // Prevent default Enter key behavior

            if (e.shiftKey) {
                // If Shift is held, move to the previous element
                var prevElement = $('[tabindex="' + (this.tabIndex - 1) + '"]');
                console.log(this, prevElement);

                if (prevElement.length) {
                    prevElement.focus();
                }
            } else {
                // Move to the next element
                var nextElement = $('[tabindex="' + (this.tabIndex + 1) + '"]');
                console.log(this, nextElement);

                if (nextElement.length) {
                    nextElement.focus();
                } else {
                    // If no next element, perform the click on the specified button
                    $("#purchaseentrybtn").click();
                }
            }
        }
    });




//search box function
function fetchProducts()
{
    const productquery = document.getElementById("productname").value;
    if (productquery.length > 0) {
        $.ajax({
            url: 'includes/handlers/getProductSuggestions.php',
            type: 'GET',
            data: { search: productquery },
            success: function(data) {
                document.getElementById("productsuggestions").innerHTML = data;
            }
        });
    } else {
        document.getElementById("productsuggestions").innerHTML = ''; // Clear suggestions
    }
}   

function fetchSuggestions() {
    const query = document.getElementById("buyername").value;
    $("#bill-buyer-name-data").val(query);
    
    if (query.length > 0) {
        $.ajax({
            url: 'includes/handlers/getSalesSuggestions.php',
            type: 'GET',
            data: { search: query },
            success: function(data) {
                document.getElementById("suggestions").innerHTML = data;
            }
        });
    } else {
        document.getElementById("suggestions").innerHTML = ''; // Clear suggestions
    }
}




$(document).on('click', '.suggestion-item', function () {
    // Set the buyer name in the input and the span
    $('#buyername').val($(this).text());
    const query = document.getElementById("buyername").value;
    $("#bill-buyer-name-data").val(query);
    $('#suggestions').empty();

    // AJAX call to fetch dealer details
    $.ajax({
        url: 'includes/handlers/getDealersData.php', // Path to the PHP file
        type: 'POST',
        data: { buyerName: query }, // Send the buyer name as data
        success: function (response) {
            // Parse and update the spans with data
            const data = response.split('|'); // Expecting pipe-separated values in the response
            if (data.length === 5) {
                $("#state-name-data").val(data[0]);        // State
                $("#State-code-data").val(data[1]);       // State Code
                $("#invoice-number-data").val(data[2]);   // Invoice No
                $("#Gst-no-data").val(data[3]);           // GSTIN
                $("#Lorry-data").val(data[4]);            // Lorry
            } else {
                alert("Invalid data format received from the server.");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error occurred: " + error);
            alert("Failed to fetch dealer data. Please try again.");
        }
    });
});







// product suggessions 




$(document).on('click', '.product-suggestion-item', function () {
    // Set the buyer name in the input and the span
    $('#productname').val($(this).text());
    $('#productsuggestions').empty();

});








        // Add event listener to the input box
        document.getElementById('entrytablerow').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                $("#salesentrybtn").click();// Call the function
            }
        });





$("#salesentrybtn").on("click", function () {
                const oldbuyerName = ($("#buyername").val());
                const buyerName = oldbuyerName.replace(/%/g, ' ');
// This should capture the full input, including spaces
                const productName = $("#productname").val();
                const hsnCode = $("#hsncode").val();
                const pieceMeter = $("#piecemeter").val();
                const baleNo = parseInt($("#baleno").val());
                const pieceQuantity = parseInt($("#piecequantity").val()) || 0;
                const pieceRate = parseFloat($("#piecerate").val()) || 0;
                const totalAmt = parseFloat($("#gettotalamt").val()) || 0;

                //Validate input
                    document.addEventListener("keydown", function (event) {
                    if (event.key === "Enter") {
                        event.preventDefault(); // Prevent default Enter key behavior
                        salesEntryButton.click(); // Trigger button click
                    }
                    });

                // AJAX request to save data
                $.ajax({
                    url: "includes/save/saveSalesEntry.php",
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
                        printsalesBill();
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: ", xhr.responseText); // Debugging output
                        alert("Error saving the entry. Please try again.");
                    }
                });

            });






// print-bill





function generateSalesBill() {
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
    $("#bill-buyer-name").val(buyerName);
    $("#bill-date").val(date);

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
    window.location.reload();
}

function printsalesBill() {
    generateSalesBill(); // Call to populate the bill

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

    <div>
        <div style="display:flex;justify-content:space-between;">
            <div>
                <h2>GST No:33BJIPK4348D1ZF</h2>
                <h2>Ph.N0 : 9095257075</h2>
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

<!-- <input id='sellername' class=' TabOnEnter'  tabindex='9' name='sellername' placeholder='Enter seller name here'> -->



<style>
    #suggestions,#productsuggestions {
    border: 1px solid #ccc;
    max-height: 200px;
    overflow-y: auto;
    position: absolute;
    background: #fff;
    z-index: 1000;
}
.suggestion-item,.product-suggestion-item {
    height:20px; padding: 5px ;
    cursor: pointer;
}
.suggestion-item,.product-suggestion-item:hover {
    background-color: #f0f0f0;
}


</style>