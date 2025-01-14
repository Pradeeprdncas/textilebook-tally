<?php
if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']); // Sanitize user input

    // Database connection
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "karthi_tex_webpage"; // Replace with your database name

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT dealer_name FROM karthi_tex_dealers_entry_table WHERE dealer_name LIKE ? LIMIT 10"); // Replace 'entry_name' and 'your_table_name'
    $searchTerm = "%$search%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
  

    $suggestions = "";
    while ($row = $result->fetch_assoc()) {
        $suggestions .= "<div class='suggestion-item'>" . htmlspecialchars($row['dealer_name'], ENT_QUOTES, 'UTF-8') . "</div>";
    }
    

    echo empty($suggestions) ? "<div class='suggestion-item'>No results found</div>" : $suggestions;

    $stmt->close();
    $conn->close();
}
?>
