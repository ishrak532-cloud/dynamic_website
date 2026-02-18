<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="cars.css">   
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
   integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/0d966b1905.js" crossorigin="anonymous"></script>
  <title>Buy Cars - XCARS SHOP</title>
</head>
<body>
  <header class="one-header py-4">
    <div class="container">
      <section class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
     <div>
      <h1 class="fw-bold mb-3" style="color: #212A31;"><i class="fa-solid fa-car"></i> Buy Cars</h1>
     <p class="mb-0 text-muted">Choose your next car.</p>
        </div>
    <div class="d-flex gap-4">
      <a class="btn btn-outline-secondary" href="admin/admin_requests.php">Admin</a>
      <a class="btn btn-danger" href="index.php">Home</a>
<input id="searchInput" class="form-control" type="text" placeholder="Search model..." aria-label="Search">
<button id="searchBtn" type="button" class="btn btn-danger">Search</button>

     </div>
      </section>
    </div>
  </header>
<main class="container my-3 p-4">

  <section class="row row-cols-1 row-cols-md-3 g-5">

    <?php
    $result = $conn->query("SELECT * FROM cars");
if (!$result) {
    echo "<div class='alert alert-danger'>Something went wrong loading cars.</div>";
}


    while ($row = $result->fetch_assoc()):
    ?>
      <div class="col car-item">
        <div class="card h-100 rounded-4 shadow">

          <img src="images/<?php echo htmlspecialchars($row['image']); ?>"
               class="imag-img rounded-top-4" alt="">

          <div class="card-body">
  <h5 class="tle fw-bold car-model"><?php echo htmlspecialchars($row['model']); ?></h5>

            <p class="text-muted mb-2"><?php echo htmlspecialchars($row['description']); ?></p>

            <div class="d-flex justify-content-between align-items-center">
              <span class="fw-bold text-danger">€<?php echo htmlspecialchars($row['price']); ?></span>
              <span class="badge text-bg-success"><?php echo htmlspecialchars($row['status']); ?></span>
            </div>
          </div>

          <div class="card-footer bg-white border-0 pb-3">
            <a class="btn btn-danger w-100" href="#contact">Request Offer</a>
          </div>

        </div>
      </div>
    <?php endwhile; ?>

  </section>
  <p id="noResults" class="text-danger fw-bold mt-3" style="display:none;">
  No cars found.
</p>

<section class="mt-4" id="contact">
  <section class="row g-4">
    <div class="col-12 col-lg-5">
      <section class="chart p-4 h-100 rounded-4 bg-primary-subtle border">
        <h3 class="fw-bold">Contact XCARS SHOP</h3>
        <p class="text-muted mb-3">Give us your details and the car you want.</p>
        <p class="ut mb-2"><i class="uty me-2 fa-solid fa-phone-volume"></i>+35865745154</p>
        <p class="ut mb-2"><i class="uty fa-solid fa-envelope-circle-check me-2"></i> xcars43@gmail.com</p>
        <p class="ut mb-0"><i class="uty me-2 fa-solid fa-location-arrow"></i>Finland</p>

        <img src="images/cars11.png" alt="Car"
             style="margin-top:60px; width: 400px; height: 120px;">
      </section>
    </div>
