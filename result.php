<?php
require_once 'admin/connection.php'; // Include the database connection file

// Retrieve the search parameters from the AJAX request
$checkIn = $_POST['check_in'];
$checkOut = $_POST['check_out'];
$rooms = $_POST['rooms'];

// Prepare the SQL query to fetch available rooms based on the search parameters
$query = "SELECT * FROM available WHERE check_in <= :check_in AND check_out >= :check_out AND room_type = :room_type";
$stmt = $db->prepare($query);
$stmt->bindParam(':check_in', $checkIn);
$stmt->bindParam(':check_out', $checkOut);
$stmt->bindParam(':room_type', $rooms);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
    // Display the search results in a table
    echo '<table>';
    echo '<tr><th>Room Type</th><th>Price</th></tr>';
    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . $row['room_type'] . '</td>';
        echo '<td>' . $row['price'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No available rooms found.';
}
?>
