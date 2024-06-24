<?php
require_once 'admin/connection/connection.php'; // Include the database connection file

// Hide error reporting
error_reporting(0);

// Fetch gallery items from the database
$query = "SELECT * FROM gallery";
$stmt = $db->prepare($query);
$stmt->execute();
$galleryItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
     @import url('https://fonts.googleapis.com/css?family=Quicksand:400,700');
        body {
            background: #f4f4f4;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 150px auto 50px;
            padding: 20px;
                max-width: 1200px;
        }

         h1 {
            font-size: 24px;
            font-weight: 400;
            text-align: center;
            margin-bottom: 50px ;
        }


        .portfolio-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .portfolio-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .portfolio-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.15);
        }

        .portfolio-item img {
            width: 100%;
            height: auto;
            display: block;
        }

        .portfolio-info {
      
            text-align: center;
        }

        .portfolio-info h4 {
            font-size: 2.0 rem;
            margin: 0;
            color: #333;
        }

        .portfolio-info a {
            color: #007bff;
            text-decoration: none;
            margin: 10px;
            display: inline-block;
            font-size: 1.25rem;
        }

        .portfolio-info a:hover {
            color: #0056b3;
        }

       

        @media (max-width: 768px) {
            .portfolio-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .portfolio-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
     <header>
        <?php include 'includes/nav.php'; ?>
    </header>
    
    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">
           <h1 style="font-size: 44px;">Gallery</h1>
            <div class="portfolio-container">
                <?php foreach ($galleryItems as $item) { ?>
                    <div class="portfolio-item">
                        <img src="admin/upload/<?php echo $item['image']; ?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                         
                            <a href="admin/upload/<?php echo $item['image']; ?>" data-gallery="portfolioGallery" class="" title="<?php echo $item['title']; ?>"><i class="fa fa-plus"></i>
                            
                               <h4><?php echo $item['title']; ?></h4>
                            
                            </a>
                        
                
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer"></div>
        <div class="footer2">
            <span class="foo2a">&copy;<span id="currentDate"></span> Marefiya Hotels</span>
            <span class="foo2b">Section B, Group 4</span>
        </div>
    </footer>
    <script src="fonts/all.js"></script>
    <script src="https://unpkg.com/glightbox@3/dist/js/glightbox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize GLightbox
            const portfolioLightbox = GLightbox({
                selector: '.portfolio-lightbox'
            });

            // Display current year
            document.getElementById('currentDate').textContent = new Date().getFullYear();
        });
    </script>
</body>
</html>
