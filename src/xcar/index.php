<?php
require_once __DIR__ . "/db.php";

$stats = [
  "total_cars" => 0,
  "available_cars" => 0,
  "offer_requests" => 0
];

$res = $conn->query("SELECT total_cars, available_cars, offer_requests FROM site_stats WHERE id=1");
if ($res && $res->num_rows > 0) {
  $stats = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="cars.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/0d966b1905.js" crossorigin="anonymous"></script>
    <title>XCARS SHOP</title>
</head>
<body class="container-lg">
    <header>
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">XCARS SHOP</a>
              <a href="cars.php" class="btn btn-outline-danger text-start w-10">Buy cars</a>
              
            </div>
          </nav>
          <div id="carouselExample" class="carousel slide bg-primary-subtle p-5 rounded rounded-2" data-bs-ride="carousel" data-bs-interval="2700" data-bs-pause="false">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row">
                  <div class="col-12 col-md-6 d-flex justify-content-center">
                    <div>
                        <h1 class="made">Have a test drive on our brand new mercedes</h1>
                        <p class="Eqt">Our new mercedes comes with V5 engine</p>
                        <a class="btn btn-danger mb-4" href="cars.php">Buy now</a>
                        </div>
                        </div>
                    <div class="col-12 col-md-6">
                        <img src="images/cars1.jpg" class="d-block w-100" alt=""></div>
                </div>
                </div>
              <div class="carousel-item">
                <div class="row">
                  <div class="col-12 col-md-6 d-flex justify-content-center">
                    <div>
                        <h1 class="made">Mercedes X1 series come with luxurious interior design</h1>
                        <p class="Eqt">This car has all new twin turbo engine</p>
                       <a href="cars.php" class="btn btn-danger mb-4">Buy now</a>
                        </div>
                        </div>
                    <div class="col-12 col-md-6">
                        <img src="images/carsh1.jpg" class="d-block w-100" alt=""></div>
                </div>
                </div>
              <div class="carousel-item">
                <div class="row">
                  <div class="col-12 col-md-6 d-flex justify-content-center">
                    <div>
                        <h1 class="made">New Arrivals of the M1 Series with luxury</h1>
                        <p class="Eqt">Be the king of the roads. Drive our ultimate drift king.</p>
                        <a href="cars.php" class="btn btn-danger mb-4">Buy now</a>
                        </div>
                        </div>
                    <div class="col-12 col-md-6">
                        <img src="images/carsh2.jpg" class="d-block w-100" alt="">
                    </div>
                </div>
                </div>
              </div>
            </div>

          </div>
    </header>
    <section class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold mb-0">Featured Cars</h2>
    <a href="cars.php" class="btn btn-danger">View All</a>
  </div>

  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php