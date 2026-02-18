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
     $res = $conn->query("SELECT * FROM cars ORDER BY id DESC LIMIT 3");
if (!$res) {
  die("SQL ERROR: " . $conn->error);
}

while ($car = $res->fetch_assoc()):

    ?>
      <div class="col">
        <div class="card h-100 rounded-4 shadow">
          <img src="images/<?php echo htmlspecialchars($car['image']); ?>" class="card-img-top" style="height:200px; object-fit:cover;" alt="">
          <div class="card-body">
            <h5 class="fw-bold"><?php echo htmlspecialchars($car['model']); ?></h5>
            <p class="text-muted mb-2"><?php echo htmlspecialchars($car['description']); ?></p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold text-danger">€<?php echo htmlspecialchars($car['price']); ?></span>
              <span class="badge text-bg-success"><?php echo htmlspecialchars($car['status']); ?></span>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>
<section class="container my-5">
  <h2 class="fw-bold col-12">Live Update</h2>
  <div class="row g-4 text-center">

    <div class="col-12 col-md-4">
      <div class="p-4 rounded-4 shadow bg-white">
        <div class="fs-2 fw-bold text-danger"><?php echo htmlspecialchars($stats['total_cars']); ?>


</div>
        <div class="text-muted">Total Cars</div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="p-4 rounded-4 shadow bg-white">
        <div class="fs-2 fw-bold text-danger"><?php echo htmlspecialchars($stats['available_cars']); ?></div>
        <div class="text-muted">Available Now</div>

      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="p-4 rounded-4 shadow bg-white">
        <div class="fs-2 fw-bold text-danger"><?php echo htmlspecialchars($stats['offer_requests']); ?></div>
        <div class="text-muted">Offer Requests</div>
      </div>
    </div>

  </div>
</section>

    <main>
        <section class="text-start text-md-center mt-5">
            <h1 class="rated">Updated Cars Collection</h1>
            <p class="text-danger">Best Cars</p>
            <hr class="w-25 mx-auto border-danger">
            <div class="row g-5 mt-3 row-cols-1 row-cols-sm-2 row-cols-md-3 px-5">
                <div class="col">
                    <img class="w-100 h-100" src="images/cars14.jpg" alt="">
                </div>
                <div class="col"><img class="w-100 h-100" src="images/cars6.jpg" alt=""></div>
                <div class="col"><img class="w-100 h-100" src="images/cars8.jpg" alt=""></div>
            </div>
        </section>
        <section class="chart mt-4 arrival-bg py-4 rounded">
            <h1 class="rated text-center mt-5">
            New Arrival
        </h1>
        <div class="row row-cols-1 row-cols-md-3 g-4 px-3">
            <div class="col">
              <div class="card h-100 rounded-2">
                <img src="images/cars10.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="tlel card-title">Mercedes M4</h5>
                  <p class="card-text">Our most rated car this year.</p>
                </div>
                <div class="card-footer">
                    <a href="cars.php" class="btn btn-outline-danger">Purchase</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 rounded-2">
                <img src="images/cars3.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="tlel card-title">Mercedes C63</h5>
                  <p class="card-text">This car has brand new technology engine.</p>
                </div>
                <div class="card-footer">
                    <a href="cars.php" class="btn btn-outline-danger">Purchase</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100 rounded-2">
                <img src="images/cars7.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="tlel card-title">Mercedes E5</h5>
                  <p class="card-text">This is a 2 seater mercedes.</p>
                </div>
                <div class="card-footer">
                    <a href="cars.php" class="btn btn-outline-danger">Purchase</a>
                </div>
              </div>
            </div>
          </div>
    </section>
    <section class="mt-5">
        <h1 class="rated text-center py-5">Trust <span class="rated text-warning">Indicators</span></h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="card text-center">
                <img src="images/icons/satisfaction.png" class="card-img-top w-25 mx-auto mt-3" alt="...">
                <div class="card-body">
                  <h5 class="text-primary">5 Star Rating</h5>
                  <p class="text-danger">
                </p>
                <p class="card-text">We Have More Than Ten Million Five Star Rating</p>

                </div>
              </div>
            </div>
            <div class="col">
              <div class="card text-center">
                <img src="images/icons/trust.png" class="card-img-top w-25 mx-auto mt-3" alt="...">
                <div class="card-body">
                  <h5 class="text-primary">Trusted</h5>
                  <p class="text-danger">
                </p>
                <p class="card-text">Trusted By More Than 100000 Customers and by car enthusiasts</p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card text-center">
                <img src="images/icons/followers.png" class=" card-img-top w-25 mx-auto mt-3" alt="...">
                <div class="card-body">
              <h5 class="text-primary">Selling</h5>  
                  <p class="text-danger">
                </p>
                <p class="card-text">We Sold More Than One Thousand Cars This Year</p>
                </div>
              </div>
            </div>
          </div>
    </section>
