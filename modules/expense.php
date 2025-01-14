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
  <div class="custom-tab custom-expense-entry-tab" onclick="showTab('expenseEntry')">Expense Entry</div>
  <div class="custom-tab custom-expense-register-tab" onclick="showTab('expenseRegister')">Expense Register</div>
</div>

<div id='expenseoutdiv' class="custom-content custom-expense-entry-content">
  <h2>expense Entry</h2>
  <p>This is the expense Entry content area.</p>
</div>


<script>
function showTab(expenseTabName) {



            const expensePage = expenseTabName;
            $.ajax({
                url: "includes/handlers/expenseHandler.php",
                type: "POST",
                data: { expensePage: expensePage }, // Dynamically send selected tab
                success: function (response) {
                    $("#expenseoutdiv").html(response);
        
                },
                error: function () {
                    $("#expenseoutdiv").html("<p>Error loading the page!</p>");
                }
            });

}

</script>

</body>
</html>
