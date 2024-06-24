<?php
    require_once 'admin/connection/connection.php'; // Include the connection.php file

    $query = "SELECT * FROM events";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="fonts/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gallery.css">
    <style>
        /* Font */
        @import url('https://fonts.googleapis.com/css?family=Quicksand:400,700');
    
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            color: #272727;
            font-family: 'Quicksand', serif;
            font-style: normal;
            font-weight: 400;
            letter-spacing: 0;
        }

        h1 {
            font-size: 24px;
            font-weight: 400;
            text-align: center;
        }

        img {
            height: auto;
            max-width: 100%;
            vertical-align: middle;
        }

        .btn {
            color: #ffffff;
            padding: 0.8rem;
            font-size: 14px;
            text-transform: uppercase;
            border-radius: 4px;
            font-weight: 400;
            display: block;
            width: 100%;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: transparent;
        }

        .btn:hover {
            background-color: rgba(255, 255, 255, 0.12);
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .cards_item {
            display: flex;
            padding: 1rem;
            flex-grow: 1;
        }

        @media (min-width: 40rem) {
            .cards_item {
                width: 50%;
            }
        }

        @media (min-width: 56rem) {
            .cards_item {
                width: 33.3333%;
            }
        }

        .card {
            border-radius: 0.25rem;
            box-shadow: 0 20px 40px -14px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            height: 100%;
        }

        .card_content {
            padding: 1rem;
            background: linear-gradient(to bottom left, rgb(78, 78, 78) 40%, #213347 100%);
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card_title {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: capitalize;
            margin: 0px;
            text-align: center;
        }

        .card_text {
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1.25rem;
            font-weight: 400;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Number of lines to display before truncating */
            -webkit-box-orient: vertical;
            text-align: center;
        }

        .main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            margin-top: 150px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    <header>
        <?php include 'includes/nav.php'; ?>
    </header>

    <div class="main">
        <h1 style="font-size: 44px;">Our Events</h1>
        <ul class="cards">
            <?php foreach ($events as $event): ?>
                <li class="cards_item">
                    <div class="card">
                        <div class="card_image">
                            <img src="admin/upload/<?php echo $event['image']; ?>">
                        </div>
                        <div class="card_content">
                            <h2 class="card_title"><?php echo $event['title']; ?></h2>
                            <p class="card_text">
                                <?php
                                    $description = $event['description'];
                                    echo (strlen($description) > 140) ? substr($description, 0, 140) . '...' : $description;
                                ?>
                            </p>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <footer>
        <div class="footer"></div>
        <div class="footer2">
            <span class="foo2a">&copy;<span id="currentDate"></span> Marefiya Hotels</span>
            <span class="foo2b">Section B, Group 4</span>
        </div>
    </footer>
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
</body>
</html>
