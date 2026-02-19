<?php
require_once __DIR__ . "/db.php";
$success = false;
$error = "";
if (isset($_POST['send_request'])) {
    $full  = trim($_POST['fullname'] ?? '');
    $mail     = trim($_POST['email'] ?? '');
    $number     = trim($_POST['phone'] ?? '');
    $car_model = trim($_POST['car_model'] ?? '');
    $me   = trim($_POST['message'] ?? '');

    if ($full === "" || $mail === "" || $number === "" || $car_model === "" || $me === "") {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        $stmt = $conn->prepare("INSERT INTO requests (fullname, email, phone, car_model, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full, $mail, $number, $car_model, $me);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: cars.php?sent=1#contact");
            exit;
        } else {
            $error = "Insert failed: " . $stmt->error;
        }
        $stmt->close();
    }
}

?>

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

    <div class="col-12 col-lg-7">
      <div class="p-4 rounded-4 h-100" style="background-color:#2078dc;">
        <h3 class="fw-bold mb-3 text-white">Request Offer</h3>
<?php if (isset($_GET['sent'])): ?>
  <div class="alert alert-success">✅ Request sent successfully!</div>
<?php endif; ?>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

        <form method="post" action="cars.php" id="myForm">
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-work text-white">Full Name</label>
<input type="text" id="fullname" name="fullname" class="form-control" placeholder="Your name" required>
<small id="fullnameErr" class="text-warning"></small>

            </div>

            <div class="col-md-4">
              <label class="form-work text-white">Email</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="your mail" required>
<small id="emailErr" class="text-warning"></small>

            </div>

            <div class="col-md-4">
              <label class="form-work text-white">Phone</label>
<input type="tel" id="phone" name="phone" class="form-control" placeholder="+358......." required>
<small id="phoneErr" class="text-warning"></small>

            </div>

            <div class="col-md-4">
              <label class="form-work text-white">Car Model</label>
       <select class="form-select" id="car_model" name="car_model" required>
<small id="modelErr" class="text-warning"></small>

                <option value="" selected disabled>Select a model</option>
                <?php
                  $cars2 = $conn->query("SELECT model FROM cars");
                  while($c = $cars2->fetch_assoc()){
                    echo "<option>".htmlspecialchars($c['model'])."</option>";
                  }
                ?>
              </select>
            </div>

            <div class="col-12">
              <label class="form-work text-white">Message</label>
    <textarea id="message" name="message" class="form-control" rows="4" placeholder="Write here.." required></textarea>
<small id="msgErr" class="text-warning"></small>

            </div>

            <div class="d-flex col-12 gap-2">
              <button type="submit" name="send_request" class="btn btn-danger">Send Request</button>
              <a href="index.php" class="btn btn-outline-light">Back to Home</a>
            </div>
          </div>
        </form>

      </div>
    </div>
  </section>
</section>

</main>

  <footer class="bg-dark text-light mt-5 py-4">
    <div class="container  justify-content-between d-flex gap-2">
    <div>© 2026 XCARS SHOP All rights reserved.</div>
      <div>
       <a class="text-light text-decoration-none me-4">Privacy Policy</a>
      <a class="text-light text-decoration-none">Terms of Service</a>
   </div>
    </div>
  </footer>
  <script>
  const form = document.getElementById("myForm");

  const fullname = document.getElementById("fullname");
  const email = document.getElementById("email");
  const phone = document.getElementById("phone");
  const carModel = document.getElementById("car_model");
  const message = document.getElementById("message");

  const fullnameErr = document.getElementById("fullnameErr");
  const emailErr = document.getElementById("emailErr");
  const phoneErr = document.getElementById("phoneErr");
  const modelErr = document.getElementById("modelErr");
  const msgErr = document.getElementById("msgErr");

  function setErr(el, errEl, text) {
    errEl.textContent = text;
    el.classList.add("is-invalid");
    el.classList.remove("is-valid");
  }
  function clearErr(el, errEl) {
    errEl.textContent = "";
    el.classList.remove("is-invalid");
    el.classList.add("is-valid");
  }

  
  form.addEventListener("submit", function(e) {
    let ok = true;

    if (fullname.value.trim().length < 2) { setErr(fullname, fullnameErr, "Name must be at least 2 characters."); ok = false; }
    else { clearErr(fullname, fullnameErr); }

    if (!email.value.includes("@")) { setErr(email, emailErr, "Enter a valid email."); ok = false; }
    else { clearErr(email, emailErr); }

    if (phone.value.trim().length < 7) { setErr(phone, phoneErr, "Enter a valid phone number."); ok = false; }
    else { clearErr(phone, phoneErr); }

    if (carModel.value === "") { setErr(carModel, modelErr, "Select a car model."); ok = false; }
    else { clearErr(carModel, modelErr); }

    if (message.value.trim().length < 10) { setErr(message, msgErr, "Message must be at least 10 characters."); ok = false; }
    else { clearErr(message, msgErr); }

    if (!ok) e.preventDefault(); 
  });


  fullname.addEventListener("input", () => fullname.value.trim().length >= 2 ? clearErr(fullname, fullnameErr) : setErr(fullname, fullnameErr, "Name must be at least 2 characters."));
  email.addEventListener("input", () => email.value.includes("@") ? clearErr(email, emailErr) : setErr(email, emailErr, "Enter a valid email."));
  phone.addEventListener("input", () => phone.value.trim().length >= 7 ? clearErr(phone, phoneErr) : setErr(phone, phoneErr, "Enter a valid phone number."));
  carModel.addEventListener("change", () => carModel.value !== "" ? clearErr(carModel, modelErr) : setErr(carModel, modelErr, "Select a car model."));
  message.addEventListener("input", () => message.value.trim().length >= 10 ? clearErr(message, msgErr) : setErr(message, msgErr, "Message must be at least 10 characters."));

</script>
<script>
  const searchInput = document.getElementById("searchInput");
  const searchBtn = document.getElementById("searchBtn");
  const noResults = document.getElementById("noResults");
  function filterCars() {
  const q = searchInput.value.trim().toLowerCase();
    const cars = document.querySelectorAll(".car-item");
  let shown = 0;

    cars.forEach(car => {
      const modelEl = car.querySelector(".car-model");
     const model = modelEl ? modelEl.textContent.toLowerCase() : "";
    const match = model.includes(q);
     car.style.display = match ? "" : "none";
     if (match) shown++;
    });
    noResults.style.display = (shown === 0) ? "block" : "none";
  }
  searchInput.addEventListener("input", filterCars);
  searchBtn.addEventListener("click", filterCars);
  searchInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") filterCars();
  });
</script>

</body>
</html>
