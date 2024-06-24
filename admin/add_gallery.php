<?php

require_once "connection/connection.php";
session_start();
if (isset($_SESSION["admin_id"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    session_unset();
    session_write_close();
    $url = "./login.php";
    header("Location: $url");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];

    // Upload image file
    $targetDir = 'upload/';
    $targetFile = $targetDir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

    // Insert gallery data into the database
    $stmt = $db->prepare("INSERT INTO gallery (title, image) VALUES (:title, :image)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':image', $image);
    $stmt->execute();

    // Redirect to the gallery page
    header('Location: add_gallery.php');
    exit();
}

// Delete a gallery image from the database
if (isset($_GET['image_id'])) {
    $imageId = $_GET['image_id'];

    // Retrieve the image details before deletion
    $stmt = $db->prepare("SELECT image FROM gallery WHERE id = :id");
    $stmt->bindParam(':id', $imageId);
    $stmt->execute();
    $imageData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Delete the image from the database
    $stmt = $db->prepare("DELETE FROM gallery WHERE id = :id");
    $stmt->bindParam(':id', $imageId);
    $stmt->execute();

    // Delete the associated image file
    $imageFile = 'uploads/' . $imageData['image'];
    if (file_exists($imageFile)) {
        unlink($imageFile);
    }

    // Redirect to the gallery page
    header('Location: add_gallery.php');
    exit();
}

// Fetch all gallery images from the database
$stmt = $db->query("SELECT * FROM gallery");
$gallery = $stmt->fetchAll(PDO::FETCH_ASSOC);?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add Blogs - MAREFIYA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.0/highlight.min.js" rel="stylesheet">

        <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>
    <style>
        
@import url("https://fonts.googleapis.com/css?family=Montserrat:700,500,800");
        @font-face {
            font-family: customfont;
            src: url(font/gotham_light.ttf);
        }
        
        @font-face {
            font-family: customfontbold;
            src: url(font/gothambold.ttf);
        }
        
        @font-face {
            font-family: google;
            src: url(font/google_sans.ttf);
        }
    </style>
</head>

<body>
 <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <h3 style="font-size:23px;"  class="logo">
                <a href="index.php">MAREFIYA - ADMIN PANEL</a>
            </h3>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
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
            <!-- .navbar -->

        </div>
    </header>
    
    <!-- ======= Hero Section ======= -->
    <!-- End Hero -->
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section style="margin-top:80px;" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    
<?php
		if(isset($errorMsg))
		{
			?>
            <div class="alert alert-danger">
            	<strong>WRONG ! <?php echo $errorMsg; ?></strong><br>
            </div>
            <?php
		}
		if(isset($insertMsg)){
		?>
			<div class="alert alert-success">
				<strong>SUCCESS ! <?php echo $insertMsg; ?></strong><br>
			</div>
        <?php
		}
		?>   
                    <h2>Add Project & Images</h2>
                    <ol>
                        <li><a href="../index.php">Home</a></li>
                        <li>add news</li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->
        <div class="container mt-4">
        <h2>Add New Image to Gallery</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" required>
             </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>

        <h2 class="mt-4">Gallery</h2>
        <div class="row">
            <?php foreach ($gallery as $image): ?>
                <div class="col-md-3 mt-3">
                    <div class="card">
                        <img  src="upload/<?php echo $image['image']; ?>" class="card-img-top" alt="Gallery Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $image['title']; ?></h5>
                            <a href="add_gallery.php?image_id=<?php echo $image['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<br><br><br><br><br>
    </main>
    <!-- End #main -->
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
    </footer>   <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/purecounter/purecounter.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/quill.min.js"></script>
    <script>
        
        
        // Initialize QUill editor
var quill = new Quill('#editor-container', {
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, 4, 5, 6,  false] }],
      ['bold', 'italic', 'underline','strike'],
      ['image', 'code-block'],
      ['link'],
      [{ 'script': 'sub'}, { 'script': 'super' }],
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      ['clean']
    ]
  },
  placeholder: 'Enter News Here...',
  theme: 'snow'  // or 'bubble'
});
quill.on('text-change', function(delta, source) {
    
    let html =  quill.root.innerHTML;
    console.log ( html );
    document.getElementById('description').innerText = html;


  
})







    </script>
    
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
</body>

</html>