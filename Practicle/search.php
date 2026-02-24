<?php
include 'db.php';

if (isset($_POST['search'])) {
    $search_keyword = $_POST['search'];
    
    $search_safe = $conn->real_escape_string($search_keyword);
    if (empty($search_safe)) {
        $sql = "SELECT * FROM users";
    } else {
        $sql = "SELECT * FROM users WHERE FirstName LIKE '%$search_safe%' OR Email LIKE '%$search_safe%'";
    }
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No results found.</td></tr>";
    }
}
$conn->close();
?>