<?php
    require_once 'admin/connection/connection.php'; // Include the connection.php file
    // Function to update the views count table
    include 'includes/viewers.php';

    $query = "SELECT * FROM rooms";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marefiya Hotel</title>
    <link rel="stylesheet" href="assets/fonts/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        #results {
            background-color: #f2f2f2;
            padding: 20px;
            margin-top: -1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
	<header>
		<?php include 'includes/nav_home.php'; ?>
    
    <div class="intro-section" id="home">
	<div class="bg-img"></div>
	<div class="intro-content">
		<h1>We're more than a hotel</h1></h1>
		<h6>Discover the beauty of Ethiopia from the comfort of Marefiya Hotel</h6>
		<p class="tagline">
			<span class="change-container">
				<span class="changing">get what you want</span>
				<span class="changing">how you want it</span>
				<span class="changing">when you want it</span>
			</span>
		</p>
	</div>
	<div class="booking-card">
	</div>
</div>
	
	</header>
    <div class="check">
        <div class="checklb">
            <label>Check In</label>
            <input type="date" name="check_in" class="checkinp" id="check_in">
        </div>
        <div class="checklb">
            <label>Check Out</label>
            <input type="date" name="check_out" class="checkinp" id="check_out">
        </div>
        <div class="checklb">
            <label class="checklb">Rooms</label>
            <select class="secroom" name="rooms" id="rooms">
                <option class="optroom" value="royal room">Royal Room</option>
                <option class="optroom" value="delux room">Delux Room</option>
                <option class="optroom" value="double room">Double Room</option>
                <option class="optroom" value="single room">Single Room</option>
            </select>
        </div>
       
        <input type="button" value="SEARCH" id="sbtn">
    </div>

    <div id="results"></div><div class="rooms">
    <h1>OUR ROOMS</h1>
    <p>Explore quality of our rooms here, come and visit us! </p>
<div class="roomimages" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 20px;">
    <?php foreach ($rooms as $room) { ?>
        <span class="innerimg" style="display: flex; flex-direction: column; align-items: center; text-align: center; border-radius: 10px">
            <img style="width: 100%; max-width: 400px; border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" src="admin/upload/<?php echo $room['image']; ?>" class="img2">
            <p class="h11" style="margin: 10px 0 0; font-size: 1.25rem; color: #333;"><?php echo $room['title']; ?></p>
            <p class="pricetag" style="margin: 0; font-size: 1rem; color: #666;"><?php echo $room['amount']; ?> / <?php echo $room['type']; ?></p>
        </span>
    <?php } ?>
</div>

</div>
    <div class="room-deal">
        <br><br><br>
        <h6>We are more than a hotel, we're your home away from home.</h6>
    </div>
    <div class="about">
        <img src="assets/images/about-us-2.jpg">
        <div class='about-p'>
            <h1>WHY CHOOSE US</h1>
            <p>Warm Hospitality, Our friendly and attentive staff are dedicated to making your stay at Marefiya Hotel a memorable experience.</p>
            <ol>
                <li>Stunning Location: Located in the heart of Ethiopia, Marefiya Hotel offers breathtaking views of the surrounding natural beauty.</li>
                <li>Exceptional Accommodations: Our hotel offers spacious, comfortable and well-appointed rooms that are perfect for a relaxing and rejuvenating stay..</li>
                <li>Authentic Dining: We offer a variety of dining options featuring authentic Ethiopian cuisine and international dishes, prepared with fresh local ingredients.</li>
            </ol>
            <br>
        </div>
    </div>
    <div class="clirev">
        <span class="espan"><i class="fspan fa-4x far fa-smile-beam"></i><p>Join as on Telegram.</p></span>
        <span class="espan"><i class="fspan fa-4x far fa-heart"></i><p>Thank you for visting.</p></span>
        <span class="espan"><i class="fspan fa-4x far fa-thumbs-up"></i><p>Like our facebook</p></span>
        <span class="espan"><i class="fspan fa-4x far fa-star"></i><p>Enjoy our service.</p></span>
    </div>
    <div class="learn">
        <h1 style="color:coral;">Learn More About Us</h1>
        <p>Welcome to our hotel! We offer room and meal service for our guests to ensure their stay is comfortable and convenient.</p>
        <div class="parent">
            <div class="left">
                <video poster="assets/images/slider1.jpg" controls>
                    <source src="assets/video.mp4" type="video/mp4">
                    <source src="assets/video.webm" type="video/webm">
                    Your browser does not support the video tag.
                  </video>
                  
            
            </div>
            <div class="right" style="align-items:center;">
              <h2 >About Us</h2>
              <p style="text-align:justify;">Welcome to Marefiya Hotel, located in the heart of Ethiopia, where breathtaking natural beauty and warm hospitality come together to create an unforgettable experience. Our hotel offers spacious, comfortable and well-appointed rooms, with stunning views of the surrounding landscape, making it the perfect destination for those seeking a tranquil and rejuvenating getaway.

                At Marefiya Hotel, we pride ourselves on exceptional service and authentic Ethiopian cuisine, using fresh local ingredients to deliver a true taste of Ethiopia. Whether you're indulging in a relaxing spa treatment or taking a dip in the pool, our hotel offers a range of amenities to help you unwind and recharge. </p>
              <audio controls style="width: 350px; ">
                <source src="horse.ogg" type="audio/ogg">
                <source src="assets/voice.mp3" type="audio/mpeg">
              Your browser does not support the audio element.
              </audio>
            </div>
          </div>
          
    </div>
<?php include 'includes/footer.php'; ?>

<script src="fonts/all.js"></script>
<script>
    var currentDate = new Date();  // Create a new date object
    var options = { year: 'numeric'};  // Set the date options
    var formattedDate = currentDate.toLocaleDateString('en-US', options);  // Format the date as a string
    document.getElementById('currentDate').innerHTML = formattedDate;  // Set the formatted date as the text content of the <p> element
    window.onscroll = function() {scrollFunction()};
    function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.querySelector('.navigation').classList.add('scrolled');
    } else {
        document.querySelector('.navigation').classList.remove('scrolled');
    }
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sbtn').click(function() {
                var checkIn = $('#check_in').val();
                var checkOut = $('#check_out').val();
                var rooms = $('#rooms').val();

                $.ajax({
                    url: 'result.php',
                    type: 'POST',
                    data: {
                        check_in: checkIn,
                        check_out: checkOut,
                        rooms: rooms
                    },
                    success: function(response) {
                        $('#results').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>