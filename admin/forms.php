<?php
error_reporting(0); 
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

	
if(isset($_REQUEST['delete_id']))
{
    // select image from db to delete
    $id=$_REQUEST['delete_id'];	//get delete_id and store in $id variable
    
    $select_stmt= $db->prepare('SELECT * FROM news WHERE id =:id');	//sql select query
    $select_stmt->bindParam(':id',$id);
    $select_stmt->execute();
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    unlink("upload/".$row['image']); //unlink function permanently remove your file
    
    //delete an orignal record from db
    $delete_stmt = $db->prepare('DELETE FROM news WHERE id =:id');
    $delete_stmt->bindParam(':id',$id);
    $delete_stmt->execute();
    
    header("Location:./forms.php");
}
	
?>
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Forms - MAREFIYA</title>
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
                    <h2></h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>forms</li>
                    </ol>
                </div>

            </div>
        </section>

        <section id="contact" class="contact sections-bg">
        <div   class="container"> 
                      
               
        <h1 class="mt-4">Online Booked Forms</h1>
        <table class="table mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 

                // Fetch all users from the database
                $stmt = $db->query("SELECT * FROM reservations");
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($users as $user) {
                    echo '<tr>';
                    echo '<td>' . $user['first_name'] . '</td>';
                    echo '<td>' . $user['phone_number'] . '</td>';
                    echo '<td>' . $user['email'] . '</td>';
                    echo '<td><a href="view-detail.php?id=' . $user['id'] . '" class="btn btn-primary btn-sm">View Detail</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
           
          
        </section>

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
    </footer> <div id="preloader"></div>
    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
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
  placeholder: 'Enter Scholarship Description...',
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