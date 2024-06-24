<?php
require_once 'admin/connection/connection.php'; // Include the connection.php file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phoneNumber = $_POST['phone_number'];
    $email = $_POST['email'];
    $departureDate = $_POST['departure_date'];
    $arrivalDate = $_POST['arrival_date'];
    $guests = $_POST['guests'];
    $roomType = $_POST['room_type'];

    // Insert reservation data into the database
    $stmt = $db->prepare("INSERT INTO reservations (first_name, last_name, phone_number, email, departure_date, arrival_date, guests, room_type) VALUES (:first_name, :last_name, :phone_number, :email, :departure_date, :arrival_date, :guests, :room_type)");
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':phone_number', $phoneNumber);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':departure_date', $departureDate);
    $stmt->bindParam(':arrival_date', $arrivalDate);
    $stmt->bindParam(':guests', $guests);
    $stmt->bindParam(':room_type', $roomType);
    $stmt->execute();

    // Redirect to the confirmation page
    header('Location: confirmation.php?reservation_id=' . $db->lastInsertId());
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resort booking form</title>
    <link rel="stylesheet" href="css/reservation.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Quicksand', sans-serif;
            background: #f4f4f4;
            display: flex;
            flex-direction: column;
              background: linear-gradient(45deg, rgba(0, 0, 0, 0.562) 0%, rgba(0, 0, 0, 0.24) 100%), url("../assets/images/form-bg.jpg") center center no-repeat;
    height: 100%;
  background-size: cover;
        }
        
        
        
        </style>
</head>
<body>
    <header>
       <?php include 'includes/nav.php'; ?>
    </header>

    <div class="container" style="margin-top: 120px; height: 100%; "  >
        <form class="form-group" method="POST" action="reservation.php">
            <div id="form">
                <h1 style="color:#fff; text-align:center;" class="text-white text-center">Booking Now</h1>

                <div id="first-group">
                    <div id="content">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" name="first_name" id="input-group" placeholder="First name" required>
                    </div>

                    <div id="content">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <input type="tel" name="phone_number" id="input-group" placeholder="Phone number" required>
                    </div>

                    <div id="content">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <input type="text" name="departure_date" id="input-group" placeholder="Departure Date" required>
                    </div>

                    <div id="content">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <select name="guests" id="input-group" style="background-color: black;" required>
                            <option value="">No.of guests</option>
                            <option value="1-5">1-5</option>
                            <option value="6-10">6-10</option>
                            <option value="11-20">11-20</option>
                        </select>
                    </div>
                </div>

                <div id="second-group">
                    <div id="content">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" name="last_name" id="input-group" placeholder="Last name" required>
                    </div>

                    <div id="content">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <input type="email" name="email" id="input-group" placeholder="Email" required>
                    </div>

                    <div id="content">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <input type="text" name="arrival_date" id="input-group" placeholder="Arrival Date" required>
                    </div>

                    <div id="content">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <select name="room_type" id="input-group" style="background-color: black;" required>
                            <option value="">Room Type</option>
                            <option value="AC">AC</option>
                            <option value="Non-AC">Non-AC</option>
                            <option value="Single Bed">Single Bed</option>
                            <option value="Double Bed">Double Bed</option>
                        </select>
                    </div>
                </div>

                <button type="submit" id="submit-btn">Book Now</button>
            </div>
        </form>
    </div>

  

      
<br>

</body>

</html>
