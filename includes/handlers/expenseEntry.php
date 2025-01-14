<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Entry</title>
    <style>
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Expense Entry Page</h2>

<table>
    <tr>
        <th>Expense Name</th>
        <th>Expense Type</th>
        <th>Amount</th>
        <th>Action</th>
    </tr>
    <tr>
        <td><input type="text" id="expenseName" class='no-border' placeholder="Enter expense name"></td>
        <td><input type="text" id="expenseType" class='no-border' placeholder="Enter expense type"></td>
        <td><input type="number" id="expenseAmount" class='no-border' placeholder="Enter amount"></td>
        <td><button onclick="saveExpense()">Save Expense</button></td>
    </tr>
</table>

<script>
    function saveExpense() {
        const expenseName = document.getElementById('expenseName').value;
        const expenseType = document.getElementById('expenseType').value;
        const expenseAmount = document.getElementById('expenseAmount').value;

        if (!expenseName || !expenseType || !expenseAmount) {
            alert('Please fill all fields');
            return;
        }

        // Send data to the server via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/save/saveExpenseEntry.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert(xhr.responseText); // Show response from the server
                // Clear inputs after successful submission
                document.getElementById('expenseName').value = '';
                document.getElementById('expenseType').value = '';
                document.getElementById('expenseAmount').value = '';
            } else {
                alert('Error saving expense');
            }
        };
        xhr.send(`expenseName=${encodeURIComponent(expenseName)}&expenseType=${encodeURIComponent(expenseType)}&expenseAmount=${encodeURIComponent(expenseAmount)}`);
    }
</script>

</body>
</html>
