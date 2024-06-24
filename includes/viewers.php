<?php
global $db;
// Function to get the current date and time
function getCurrentDateTime() {
    return date('Y-m-d H:i:s');
}
function getCurrentDate() {
    return date('Y-m-d');
}
function getPreviousMonthRange() {
    $firstDay = date('Y-m-01', strtotime('last month'));
    $lastDay = date('Y-m-t', strtotime('last month'));
    return array($firstDay, $lastDay);
}
// Get the current date and time
$currentDateTime = getCurrentDateTime();
$currentDate = getCurrentDate();

// Check if a row exists for today's date in the views table
$stmt = $db->prepare("SELECT * FROM views WHERE date = :date");
$stmt->bindParam(':date', $currentDate);
$stmt->execute();

// If a row exists, update the today_view count
if ($stmt->rowCount() > 0) {
    $stmt = $db->prepare("UPDATE views SET today_view = today_view + 1, last_updated = :datetime WHERE date = :date");
    $stmt->bindParam(':datetime', $currentDateTime);
    $stmt->bindParam(':date', $currentDate);
    $stmt->execute();
} else { // If no row exists, insert a new row with today's date and set today_view to 1
    $stmt = $db->prepare("INSERT INTO views (date, today_view, last_updated) VALUES (:date, 1, :datetime)");
    $stmt->bindParam(':date', $currentDate);
    $stmt->bindParam(':datetime', $currentDateTime);
    $stmt->execute();
}

// Check if a row exists for the previous month in the views table
list($firstDay, $lastDay) = getPreviousMonthRange();
$stmt = $db->prepare("SELECT * FROM views WHERE date >= :firstday AND date <= :lastday");
$stmt->bindParam(':firstday', $firstDay);
$stmt->bindParam(':lastday', $lastDay);
$stmt->execute();

// If a row exists, update the last_month count
if ($stmt->rowCount() > 0) {
    $stmt = $db->prepare("UPDATE views SET last_month = last_month + 1, last_updated = :datetime WHERE date >= :firstday AND date <= :lastday");
    $stmt->bindParam(':datetime', $currentDateTime);
    $stmt->bindParam(':firstday', $firstDay);
    $stmt->bindParam(':lastday', $lastDay);
    $stmt->execute();
} else { // If no row exists, insert a new row with the previous month's range and set last_month to 1
    $stmt = $db->prepare("INSERT INTO views (date, last_month, last_updated) VALUES (:date, 1, :datetime)");
    $stmt->bindParam(':date', $firstDay);
    $stmt->bindParam(':datetime', $currentDateTime);
    $stmt->execute();
}
?>