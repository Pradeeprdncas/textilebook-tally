<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <h2>Product Details Form</h2>


    <table style='width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;'>
                <thead>
                    <tr style='background-color: #ddd;'>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 80px;'>Dealer Name</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 120px;'>Mobile Number</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 330px;'>Address</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>State Name</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>State Code</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>Invoice Number</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>GSTIN</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>Lorry Details</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 80px;'>Dealer Role</th>



                    </tr>
                </thead>
                <tbody>
                    <!-- Data Entry Row -->
                    <tr id='entrytablerow'>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border' type="text" id="dealer_name" name="dealer_name" required><br><br>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border' type="text" id="mobileno" name="mobileno" required><br><br>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border' type="text" id="dealeraddress" name="dealeraddress" required><br><br>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border' type="text" id="statename" name="statename" required><br><br>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border' type="text" id="statecode" name="statecode" required><br><br>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border' type="text" id="invoiceno" name="invoiceno" required><br><br>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border' type="text" id="gstno" name="gstno" required><br><br>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border'type="text" id="lorrydetails" name="lorrydetails" ><br><br>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <select id="dealerrole" name="dealerrole" required>
                                <option value="null">Select a Role</option>
                                <option value="buyer">Buyer</option>
                                <option value="seller">Seller</option> 
                                <option value="Both">Both</option>

                            </select>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <br>
                <div style='width:100%;;display: flex;justify-content: end;'>
                <button class='button-28' id='productsentrybtn' >Submit</button>
                </div>

    <script>
        $(document).ready(function () {
            $('#productsentrybtn').click(function () {
                // Gather form data

                   const dealername = $('#dealer_name').val();
                   const phonenumber = $('#mobileno').val();
                   const dealerrole = $('#dealerrole').val();
                   const dealeraddress = $('#dealeraddress').val();
                   const statename = $('#statename').val();
                   const statecode = $('#statecode').val();
                   const invoiceno = $('#invoiceno').val();
                   const gstno = $('#gstno').val();
                   const lorrydetails = $('#lorrydetails').val();

                // Send data to saveProductDetails.php via AJAX
                $.ajax({
                    url: 'includes/save/saveDealerData.php',
                    type: 'POST',
                    data:{
                        dealername:dealername, 
                        phonenumber:phonenumber,
                        dealerrole:dealerrole,
                        dealeraddress:dealeraddress,
                        statename:statename,
                        statecode:statecode,
                        invoiceno:invoiceno,
                        gstno:gstno,
                        lorrydetails:lorrydetails
                    } ,
                    success: function (response) {
                        alert('Dealers details saved successfully: ' + response);
                    },
                    error: function (xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        });
    </script>
</body>
</html>
