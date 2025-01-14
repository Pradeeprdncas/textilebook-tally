<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Page</title>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="assets/css/mainstyles.css">
    <div id="customRedAlert" class="modalred">
        <div class="modal-content-red">
            <span class="close-btn" onclick="closeRedAlert()">&times;</span>
            <p id="alertMessage">This is a custom alert!</p>
            <button onclick="closeRedAlert()">OK</button>
        </div>
    </div>
</head>
<body style="padding:5px;">
    
    <div style='display:flex;justify-content:space-evenly;'>
        <nav class="tabs div1">
            <label for="purchase" class="tab-item" onclick="loadPageFromTab('purchase')"><span class="tab">Purchase</span></label>
            <label for="sales" class="tab-item" onclick="loadPageFromTab('sales')"><span class="tab">Sales</span></label>
            <label for="dealers" class="tab-item" onclick="loadPageFromTab('dealers')"><span class="tab">Dealers</span></label>
            <label for="expense" class="tab-item" onclick="loadPageFromTab('expense')"><span class="tab">Expense</span></label>
            <label for="statement" class="tab-item" onclick="loadPageFromTab('statement')"><span class="tab">Statement</span></label>
            <label for="daybook" class="tab-item" onclick="loadPageFromTab('daybook')"><span class="tab">Daybook</span></label>
            <label for="products" class="tab-item" onclick="loadPageFromTab('products')"><span class="tab">Products</span></label>
            <label for="profitandloss" class="tab-item" onclick="loadPageFromTab('profitandloss')"><span class="tab">Profit and Loss</span></label>
        </nav>
        <br>
        <div id="pageoutputdiv" style='background-color:#E4E4D0;width:85%;' class='div1'>
          <p>Please select a tab to load the content.</p>
        </div>
    </div>
<br>





    <br>
    <div class='div2' >
      

        <h3>Bank Details:</h3>

        <h3>PUNJAB NATIONAL BANK, R.G. Street, Erode Branch</h3>

        <h3>Account No: 3616002100042786</h3>    

        <h3>RTGS/NEFT IFSC Code: PUNB0361600</h3>
    </div>
  


</body>
</html>

    <script>
       

        // Load the selected page
        function loadPageFromTab(tabName) {
            // First, clear the current content
            $("#pageoutputdiv").html("<p>Loading...</p>");

            // Simulate the `pageselect` value from the previous function
            const pageselect = tabName;

            $.ajax({
                url: "handler.php",
                type: "POST",
                data: { pageselect: pageselect }, // Dynamically send selected tab
                success: function (response) {
                    $("#pageoutputdiv").html(response);
                
                    // Bind events dynamically based on the tab selected
                    if (pageselect === "purchase") {
                        fetchPreviousEntries("purchase");
                    }
                    if (pageselect === "sales") {
                        fetchPreviousEntries("sales");
                    }
                    if (pageselect === "expense") {
                        fetchPreviousEntries("expense");
                    }
                },
                error: function () {
                    $("#pageoutputdiv").html("<p>Error loading the page!</p>");
                }
            });
        }

        
// Fetch and display previous entries
        function fetchPreviousEntries(pagename) {
            
            if (pagename === "purchase") {
                $.ajax({
                    url: "getpreviouspurchaseentries.php",
                    type: "GET",
                    success: function (response) {
                        $("#previousentrydiv").html(response); // Populate the div with entries
                    },
                    error: function () {
                        $("#previousentrydiv").html("<p>Error fetching previous entries.</p>");
                    }
                });
            }
            if (pagename === "sales") {
                $.ajax({
                    url: "getSalesEntries.php",
                    type: "GET",
                    success: function (response) {
                        $("#previousentrydiv").html(response); // Populate the div with entries
                    },
                    error: function () {
                        $("#previousentrydiv").html("<p>Error fetching previous entries.</p>");
                    }
                });
            }
            if (pagename === "expense") {
                $.ajax({
                    url: "getExpenseEntries.php",
                    type: "GET",
                    success: function (response) {
                        $("#previousentrydiv").html(response); // Populate the div with entries
                    },
                    error: function () {
                        $("#previousentrydiv").html("<p>Error fetching previous entries.</p>");
                    }
                });
            }
           
        }

        function showRedAlert(message) {
            const alertBox = document.getElementById("customRedAlert");
            const alertMessage = document.getElementById("alertMessage");

            alertMessage.textContent = message; // Set the alert message dynamically
            alertBox.style.display = "block"; // Show the modal
        }

// Function to close the custom alert
        function closeRedAlert() {
            const alertBox = document.getElementById("customRedAlert");
            alertBox.style.display = "none"; // Hide the modal
        }
        

        // // alt+u+a tp unaccounted 
        // document.addEventListener("keydown", (event) => {
        //     // Check if Alt (or Option on Mac), U, and A are pressed
        //     if (event.altKey && event.code === "KeyU") {
        //         // Check for the "A" key after "Alt + U"
        //         document.addEventListener("keydown", (secondEvent) => {
        //             if (secondEvent.code === "KeyA") {
        //                 performAction(); // Call your function
        //                 secondEvent.preventDefault(); // Prevent default behavior
        //             }
        //         }, { once: true }); // Only listen for the next key press
        //     }
        //     if (event.altKey && event.code === "KeyA") {
        //         // Check for the "A" key after "Alt + U"
        //         document.addEventListener("keydown", (secondEvent) => {
        //             if (secondEvent.code === "KeyU") {
        //                 performAction(); // Call your function
        //                 secondEvent.preventDefault(); // Prevent default behavior
        //             }
        //         }, { once: true }); // Only listen for the next key press
        //     }
        // });

        // Function to perform action
         function performAction() {
            // Prompt user for a password
            const password = prompt("Enter the password:");

            // Validate password
            if (password === "unacc123") { // Replace "yourPassword123" with your desired password
                onPasswordSuccess(); // Call the intended function if the password is correct
            } else {
                alert("Incorrect password. Access denied.");
            }
        }

        // Function to execute when the password is correct
        function onPasswordSuccess() {
            const valueforunacc = "unacc";
            $.ajax({
                url: "handler.php",
                type: "POST",
                data: { pageselect: valueforunacc }, // Dynamically send selected page
                success: function(response) {
                    $("#pageoutputdiv").html(response);

                },
                error: function() {
                    $("#pageoutputdiv").html("<p>Error loading the page!</p>");
                }
            });
            // Add your intended functionality here
        }


        const date = new Date().toLocaleDateString();
        $("#bill-date").text(date);
    </script>
</body>



<style>
    table {
        border-collapse: collapse;
    }

    tbody td {
        border: 3px solid #000;
        padding: 5px;
        height: 30px; /* Adjust the height of table rows */
    }

    /* Optional: Reduce padding if you want to further decrease the height */
    tbody td h3 {
        margin: 0;
        font-size: 16px; /* Adjust font size if needed */
    }

    .tabs {
        width:15%;
        height:70%;
        display: inline-grid;
        background-color: #333;
        padding: 10px;
    }

.tab-item {
  flex: 1;
  text-align: center;
  padding: 50px 10px 50px 10px;
  font-family: sans-serif;
  font-weight: bold;
  font-size: large;
  color: white;
  cursor: pointer;
  border: 1px solid #555;
  background-color: #444;
  transition: background-color 0.3s;
}

.tab-item:hover {
  background-color: #555;
}

.tab-item.active {
  background-color: #666;
  font-weight: bold;
}

</style>













<!-- bill hidden div -->

<script>
     document.addEventListener('keydown', function (event) {
            if (event.altKey && event.code === 'KeyA') {
                // Wait for the next key after Alt+A
                document.addEventListener('keydown', function (e) {
                    if (e.code === 'KeyP') {
                        // Alt+A+U detected
                        event.preventDefault(); // Prevent default behavior
                        loadPageFromTab('purchase'); // Call the desired function
                    }
                    if (e.code === 'KeyS') {
                        // Alt+A+U detected
                        event.preventDefault(); // Prevent default behavior
                        loadPageFromTab('sales'); // Call the desired function
                    } if (e.code === 'KeyD') {
                        // Alt+A+U detected
                        event.preventDefault(); // Prevent default behavior
                        loadPageFromTab('dealers'); // Call the desired function
                    } if (e.code === 'KeyE') {
                        // Alt+A+U detected
                        event.preventDefault(); // Prevent default behavior
                        loadPageFromTab('expense'); // Call the desired function
                    } if (e.code === 'KeyB') {
                        // Alt+A+U detected
                        event.preventDefault(); // Prevent default behavior
                        loadPageFromTab('daybook'); // Call the desired function
                    }
                }, { once: true });
            }
        });



</script>

