<table style='width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;'>
                <thead>
                    <tr style='background-color: #ddd;'>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 80px;'>Order No</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 130px;'>Particular</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 330px;'>Dealer Name</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>HSN Code</th>
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
                            <input id='dealername' autocomplete='off' class='no-border TabOnEnter' tabindex='2' onkeyup='fetchDealers();' name='dealername' placeholder='Dealer Name' style='width: 90%;height:50px;'>
                            <div id='dealersuggestions'></div>

                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input id='hsncode' class='no-border TabOnEnter' tabindex='3' name='hsncode' placeholder='HSN Code' style='width: 90%;height:50px;'>
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
                <button class='button-28' id='purchaseentrybtn' >Submit</button>
                </div>
        </div>
    </div>


<script>

function fetchDealers()
{

    const query = document.getElementById("dealername").value;
    if (query.length > 0) {
        $.ajax({
            url: 'includes/handlers/getSalesSuggestions.php',
            type: 'GET',
            data: { search: query },
            success: function(data) {
                document.getElementById("dealersuggestions").innerHTML = data;
            }
        });
    } else {
        document.getElementById("dealersuggestions").innerHTML = ''; // Clear suggestions
    }

}
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
function calctotamt() {
    const pieceMeter = parseFloat($("#piecemeter").val()) || 0;
    const pieceQuantity = parseInt($("#piecequantity").val()) || 0;
    const pieceRate = parseFloat($("#piecerate").val()) || 0;
    const cgstper = parseFloat($("#cgstper").val()) || 0;
    const sgstper = parseFloat($("#sgstper").val()) || 0;
    const igstper = parseFloat($("#igstper").val()) || 0;

    let totalAmount = 0;

    // Determine totalAmount based on whether pieceMeter or pieceQuantity is entered
    if (pieceMeter != 0) {
        totalAmount = pieceMeter * pieceRate; // Calculate by meter
    } else {
        totalAmount = pieceQuantity * pieceRate; // Calculate by quantity
    }

    // Add GST if applicable
    const totalGSTPercentage = cgstper + sgstper + igstper; // Total GST percentage
    if (totalGSTPercentage > 0) {
        const gstAmount = (totalAmount * totalGSTPercentage) / 100;
        totalAmount += gstAmount; // Add GST to total amount
    }

    // Round totalAmount to 2 decimal places
    totalAmount = totalAmount.toFixed(2);

    // Set the calculated value in `gettotalamt`
    $("#gettotalamt").val(totalAmount);
}



$(document).on('click', '.product-suggestion-item', function () {
    // Set the buyer name in the input and the span
    $('#productname').val($(this).text());
    $('#productsuggestions').empty();

});

$(document).on('click', '.suggestion-item', function () {
    // Set the buyer name in the input and the span
    $('#dealername').val($(this).text());
    $('#dealersuggestions').empty();

});


$(document).ready(function () {
    $("#purchaseentrybtn").on("click", function (e) {
        e.preventDefault(); // Prevent default form submission

        // Gather form data
        const serialNo = $("#serialno").val().trim();
        const productName = $("#productname").val().trim();
        const hsnCode = $("#hsncode").val().trim();
        const pieceQuantity = $("#piecequantity").val().trim();
        const pieceMeter = $("#piecemeter").val().trim();
        const pieceRate = $("#piecerate").val().trim();
        const cgstPer = $("#cgstper").val().trim();
        const sgstPer = $("#sgstper").val().trim();
        const igstPer = $("#igstper").val().trim();
        const totalAmt = $("#gettotalamt").val().trim();
        const dealerName = $("#dealername").val().trim();

        

        // Validate inputs (optional, but recommended)
        if (!productName || (!pieceQuantity && !pieceMeter) || !pieceRate) {
            alert("Please fill all required fields.");
            return;
        }

        // Prepare data object for AJAX
        const data = {
            serialNo,
            productName,
            hsnCode,
            pieceQuantity,
            pieceMeter,
            pieceRate,
            cgstPer,
            sgstPer,
            igstPer,
            totalAmt,
            dealerName
        };

        // AJAX request to savePurchaseEntry.php
        $.ajax({
            url: "includes/save/savePurchaseEntry.php",
            type: "POST",
            data: data,
            success: function (response) {
                alert(response); // Display response from the server
                // Optionally clear the form
                $("input").val("");
            },
            error: function (xhr, status, error) {
                console.error("Error occurred: ", error);
                alert("Failed to save the purchase entry. Please try again.");
            },
        });
    });
});



</script>

<style>
    #dealersuggestions,#productsuggestions {
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