<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="jumbotron mt-4">
            <h1 class="display-4">Thank you for your reservation!</h1>
            <p class="lead">Your reservation has been successfully made.</p>
            <hr class="my-4">
            <p>Please find below the details of your reservation:</p>

            <?php
            // Display reservation details
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reservation_id'])) {
                require_once 'admin/connection.php'; // Include the connection.php file

                $reservationId = $_GET['reservation_id'];

                // Fetch reservation data from the database
                $stmt = $db->prepare("SELECT * FROM reservations WHERE id = :id");
                $stmt->bindParam(':id', $reservationId);
                $stmt->execute();
                $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($reservation) {
                    echo '<h5>Reservation ID: ' . $reservation['id'] . '</h5>';
                    echo '<p><strong>Name:</strong> ' . $reservation['first_name'] . ' ' . $reservation['last_name'] . '</p>';
                    echo '<p><strong>Phone:</strong> ' . $reservation['phone_number'] . '</p>';
                    echo '<p><strong>Email:</strong> ' . $reservation['email'] . '</p>';
                    echo '<p><strong>Departure Date:</strong> ' . $reservation['departure_date'] . '</p>';
                    echo '<p><strong>Arrival Date:</strong> ' . $reservation['arrival_date'] . '</p>';
                    echo '<p><strong>Guests:</strong> ' . $reservation['guests'] . '</p>';
                    echo '<p><strong>Room Type:</strong> ' . $reservation['room_type'] . '</p>';
                } else {
                    echo '<p class="text-danger">Reservation not found.</p>';
                }
            } else {
                echo '<p class="text-danger">Invalid reservation ID.</p>';
            }
            ?>

            <a href="reservation.php" class="btn btn-primary">Make Another Reservation</a>&nbsp;
            <a href="#" class="btn btn-primary" id="printButton">Print This Receipt</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            var doc = new jsPDF();
            doc.fromHTML(document.body, 15, 15, {
                'width': 170
            }, function() {
                doc.save('receipt.pdf');
            });
        });
    </script>
</body>
</html>
