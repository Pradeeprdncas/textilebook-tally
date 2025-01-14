
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Custom Tabs</title>
      <style>
        .custom-tab-container {
          display: flex;
          border-bottom: 2px solid #ccc;
          margin-bottom: 10px;
        }
        .custom-tab {
          padding: 10px 20px;
          cursor: pointer;
          border: 1px solid #ccc;
          border-bottom: none;
          background-color: #f9f9f9;
        }
        .custom-tab.active {
          background-color: #fff;
          border-top: 2px solid #007bff;
          border-left: 2px solid #007bff;
          border-right: 2px solid #007bff;
        }
        .custom-content {
          padding: 20px;
          border: 2px solid #ccc;
          background-color: #fff;
        }
        .custom-content.hidden {
          display: none;
        }
      </style>
    </head>
    <body>
    
    <div class="custom-tab-container">
      <div class="custom-tab custom-dealers-entry-tab" onclick="showTab('dealersEntry')">dealers Entry</div>
      <div class="custom-tab custom-dealers-register-tab" onclick="showTab('dealersView')">dealers Register</div>
    </div>
    
    <div id='dealersoutdiv' class="custom-content custom-dealers-entry-content">
      <h2>dealers Entry</h2>
      <p>This is the dealers Entry content area.</p>
    </div>  
    </body>
    </html>

    <script>

    
    </script>
    
   
<script>
 function showTab(dealersTabName) {
               
    const dealersPage = dealersTabName;
                $.ajax({
                    url: "includes/handlers/dealersHandler.php",
                    type: "POST",
                    data: { dealersPage: dealersPage }, // Dynamically send selected tab
                    success: function (response) {
                        $("#dealersoutdiv").html(response);
            
                    },
                    error: function () {
                        $("#dealersoutdiv").html("<p>Error loading the page!</p>");
                    }
                });
            }
</script>




