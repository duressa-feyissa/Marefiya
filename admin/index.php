<?php

require_once "connection/connection.php";
session_start();

// Check if the admin session does not exist
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    session_unset();
    session_write_close();
    exit();
} 
// disable error reporting
error_reporting(0);
include '../includes/viewers.php';

// Fetch the views data from the database
$stmt = $db->prepare("SELECT today_view, last_month FROM views WHERE date = :date");
$stmt->bindParam(':date', getCurrentDate());
$stmt->execute();
$viewData = $stmt->fetch(PDO::FETCH_ASSOC);

// Set the default values if no data is available
$todayViews = $viewData['today_view'] ?? 0;
$lastMonthViews = $viewData['last_month'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Administration - MAREFIYA</title>
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
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">

</head>

<body>
    <header id="header" class="fixed-top header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <h3 style="font-size:23px;"  class="logo">
                <a href="index.php">MAREFIYA - ADMIN PANEL</a>
            </h3>
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
                    <h2> </h2>
                    <ol>
                        <li><a href="../index.php">Home</a></li>
                        <li>Admin</li>
                    </ol>
                </div>

            </div>
        </section>

        <section id="contact" class="contact sections-bg">
            <div class="container">
                <div class="row">
                    
            <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="150">
                <div class="card">
                    <div class="card-header">
                        <h4>Website Visit</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <svg class="bi text-primary" width="32" height="32" fill="blue" style="width:10px">
                                        <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                    </svg>
                                    <h5 class="mb-0 ms-3">Today</h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 class="mb-0"><?php echo $todayViews; ?></h5>
                            </div>
                            <div class="col-12">
                                <div id="chart-europe"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <svg class="bi text-success" width="32" height="32" fill="blue" style="width:10px">
                                        <use xlink:href="assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                    </svg>
                                    <h5 class="mb-0 ms-3">Last Month</h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <h5 class="mb-0"><?php echo $lastMonthViews; ?></h5>
                            </div>
                            <div class="col-12">
                                <div id="chart-america"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
                    
                    <div class="row">
                        
                        <div class="col-lg-6 order-1 order-lg-2">
                            <a href="add_event.php" >
                            <div class="info-box  mb-4">
                                <i class="bx bx-news"></i>
                                <h3 style="color: #3e2013;">Add Event</h3>
                                <p style="padding: 10px;">Write blogs and new on your website with best editor.</p>
                            </div></a>
                        </div>
                        
                        <div class="col-lg-6 order-1 order-lg-2">
                            <a href="forms.php">
                            <div class="info-box  mb-4">
                                <i class="bx bx-folder"></i>
                                <h3 style="color: #3e2013;">Online Booked</h3>
                                <p style="padding: 10px;">See List of forms registered online on your website</p>
                            </div></a>
                        </div>
					
                        <div class="col-lg-6 order-1 order-lg-2">
                            <a href="add_rooms.php">
                            <div class="info-box  mb-4">
                                <i class="bx bxs-contact"></i>
                                <h3 style="color: #3e2013;">Add Rooms</h3>
                                <p style="padding: 10px;">All List of announcement messages on website.</p>
                            </div></a>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2">
                            <a href="add_gallery.php">
                            <div class="info-box  mb-4">
                                <i class="bx bxs-image"></i>
                                <h3 style="color: #3e2013;">Add Gallery (Image)</h3>
                                <p style="padding: 10px;">Add Projects on the website.<br><br></p>
                            </div></a>
                        </div>
						 
                        </div>
                    </div>
                </div>
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
    </footer>
    <!-- End Footer -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    
    
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboarsd.js"></script>

    <script src="../assets/vendor/purecounter/purecounter.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    
    <script src="assets/js/main.js"></script>

    <script>
            var optionsProfileVisit = {
            annotations: {
                position: 'back'
            },
            dataLabels: {
                enabled:false
            },
            chart: {
                type: 'bar',
                height: 300
            },
            fill: {
                opacity:1
            },
            plotOptions: {
            },
            series: [{
                name: 'Visit',
                data: [9,20,30,20,10,20,30,20,10,20,30,20]
            }],
            colors: '#435ebe',
            xaxis: {
                categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul", "Aug","Sep","Oct","Nov","Dec"],
            },
        }
        let optionsVisitorsProfile  = {
            series: [60, 40],
            labels: ['Male', 'Female'],
            colors: ['#435ebe','#55c6e8'],
            chart: {
                type: 'donut',
                width: '100%',
                height:'350px'
            },
            legend: {
                position: 'bottom'
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '30%'
                    }
                }
            }
        }

        var optionsEurope = {
            series: [{
                name: 'Visit',
                data: [310, 800, 600, 430, 540, 340, 605, 805,430, 540, 340, 605]
            }],
            chart: {
                height: 80,
                type: 'area',
                toolbar: {
                    show:false,
                },
            },
            colors: ['#5350e9'],
            stroke: {
                width: 2,
            },
            grid: {
                show:false,
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z","2018-09-19T07:30:00.000Z","2018-09-19T08:30:00.000Z","2018-09-19T09:30:00.000Z","2018-09-19T10:30:00.000Z","2018-09-19T11:30:00.000Z"],
                axisBorder: {
                    show:false
                },
                axisTicks: {
                    show:false
                },
                labels: {
                    show:false,
                }
            },
            show:false,
            yaxis: {
                labels: {
                    show:false,
                },
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        let optionsAmerica = {
            ...optionsEurope,
            colors: ['#008b75'],
        }
        let optionsIndonesia = {
            ...optionsEurope,
            colors: ['#dc3545'],
        }



        var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
        var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile)
        var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
        var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
        var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);

        chartIndonesia.render();
        chartAmerica.render();
        chartEurope.render();
        chartProfileVisit.render();
        chartVisitorsProfile.render()
</script>
</body>

</html>