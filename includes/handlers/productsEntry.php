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
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 80px;'>Product Name</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 330px;'>HSN Code</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>price_by_category</th>
                        <th style='border: 1px solid #000; height:20px; padding: 5px ; width: 100px;'>Price Per Piece:</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Entry Row -->
                    <tr id='entrytablerow'>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border' type="text" id="product_name" name="product_name" required><br><br>
                        </td>

                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border' type="text" id="hsn_code" name="hsn_code" required><br><br>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <select id="price_by_category" name="price_by_category" required>
                                <option value="price_per_piece">Price Per Piece</option>
                                <option value="price_per_meter">Price Per Meter</option> 
                            </select>
                        </td>
                        <td style='border: 1px solid #000; height:60px; padding: 5px ;'>
                            <input style='height:80%;width:90%;' class='no-border'type="number" id="price_per_piece" name="price_per_piece" step="0.01"><br><br>
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

                   const product_name = $('#product_name').val();
                   const hsn_code = $('#hsn_code').val();
                   const price_by_category = $('#price_by_category').val();
                   const price_per_piece = $('#price_per_piece').val();
                   const price_per_meter = $('#price_per_meter').val();

                // Send data to saveProductDetails.php via AJAX
                $.ajax({
                    url: 'includes/save/saveProductDetails.php',
                    type: 'POST',
                    data:{
                        product_name : product_name,
                        hsn_code : hsn_code,
                        price_by_category : price_by_category,
                        price_per_piece : price_per_piece
                    } ,
                    success: function (response) {
                        alert('Product details saved successfully: ' + response);
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
