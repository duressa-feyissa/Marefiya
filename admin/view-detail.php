<?php

require_once 'connection/connection.php';
require_once "connection/connection2.php";
if(isset($_REQUEST['form_id']))
{
	try
	{
		$id = $_REQUEST['form_id']; 
		$select_stmt = $db->prepare('SELECT * FROM reg WHERE id =:id'); //sql select query
		$select_stmt->bindParam(':id',$id);
		$select_stmt->execute(); 
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
	}
	catch(PDOException $e)
	{
		$e->getMessage();
	}
}
error_reporting(0); // For not showing any error

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Forms - MAREFIYA HOTEL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
 
</head>

<body>
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 style="font-size:23px;" class="logo">
                <a href="index.php">MAREFIYA HOTEL ADMIN</a>
            </h1>
            <nav id="navbar" class="navbar">
                <ul >
                    <li><a class="nav-link scrollto active" href="index.php">Admin Home</a></li>
                    <li><a class="nav-link scrollto" href="add_gallery.php">Add Gallery</a></li>
                    <li><a class="nav-link scrollto" href="forms.php">Booking</a></li>
                    <li><a class="nav-link scrollto " href="add_event.php">Add Events</a></li>
                    <li><a class="getstarted scrollto" href="logout.php">Logout</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <main id="main">
    <section style="margin-top:80px;" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2><?php echo $row['fname']; echo $row['lname']; ?></h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>forms</li>
                    </ol>
                </div>

            </div>
        </section>
            <?php
                    if(isset($errorMsg))
                    {
                        ?>
                        <div class="alert alert-danger">
                            <strong>WRONG ! <?php echo $errorMsg; ?></strong>
                        </div>
                        <?php
                    }
                    if(isset($insertMsg)){
                    ?>
                        <div class="alert alert-success">
                            <strong>SUCCESS ! <?php echo $insertMsg; ?></strong>
                        </div>
                <?php  } ?>  
             
        <div class="container">
        <h1 class="mt-4">User Details</h1>
        <table class="table mt-4">
            <tbody>
                <?php 

                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                    $userId = $_GET['id'];

                    // Fetch user details from the database
                    $stmt = $db->prepare("SELECT * FROM reservations WHERE id = :id");
                    $stmt->bindParam(':id', $userId);
                    $stmt->execute();
                    $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($reservation) {
                        echo '<p><strong>Name:</strong> ' . $reservation['first_name'] . ' ' . $reservation['last_name'] . '</p>';
                    echo '<p><strong>Phone:</strong> ' . $reservation['phone_number'] . '</p>';
                    echo '<p><strong>Email:</strong> ' . $reservation['email'] . '</p>';
                    echo '<p><strong>Departure Date:</strong> ' . $reservation['departure_date'] . '</p>';
                    echo '<p><strong>Arrival Date:</strong> ' . $reservation['arrival_date'] . '</p>';
                    echo '<p><strong>Guests:</strong> ' . $reservation['guests'] . '</p>';
                    echo '<p><strong>Room Type:</strong> ' . $reservation['room_type'] . '</p>';
                    } else {
                        echo '<tr><td colspan="2">User not found.</td></tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">Invalid user ID.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
             
    </main>
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4 class="logo">
                           Our Mission 
                        </h4>
                        <p>
                   TO be best hotel in Ethiopia <br>
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="../index.php">Home Site</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Subscribe to our newsletter</h4>
                        <div class="custom-search">
                            <input type="text" class="custom-search-input" placeholder="Email">
                            <button class="custom-search-botton" type="submit">OK</button>  
                          </div>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Our Address</h4>
                        <p>Addis Ababa Science and Technology University<br>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">

            <div class="copyright-wrap d-md-flex py-4">
                <div class="me-md-auto text-center text-md-start">
                    <div class="copyright">
                        &copy;2022 <strong><span>MAREFIYA ALLIANCE</span></strong>. All Rights Reserved
                    </div>
                </div>
                <div class="social-links text-center text-md-right pt-3 pt-md-0">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>