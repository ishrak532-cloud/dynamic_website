<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . "/../db.php";
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid id");
$stmt = $conn->prepare("SELECT * FROM cars WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$car = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$car) die("Car not found");

$error = "";

if (isset($_POST['save'])) {
  $model  = trim($_POST['model'] ?? "");
  $desc   = trim($_POST['description'] ?? "");
  $price  = (float)($_POST['price'] ?? 0);
  $status = trim($_POST['status'] ?? "");
  $image  = trim($_POST['image'] ?? "");

  if ($model === "" || $desc === "" || $status === "") {
    $error = "Please fill up all required fields.";
  } else {
    $stmt = $conn->prepare("UPDATE cars SET model=?, description=?, price=?, status=?, image=? WHERE id=?");
    $stmt->bind_param("ssdssi", $model, $desc, $price, $status, $image, $id);
  if ($stmt->execute()) {
      $stmt->close();
    header("Location: admin_cars.php");
    exit;
    } else {
      $error = "Update failed: " . $stmt->error;
    $stmt->close();
    }
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Edit Car</title>
</head>
<body class="bg-light">
<div class="py-4 container" style="max-width: 900px;">
  <div class="justify-content-between d-flex align-items-center mx-3 mb-3">
  <h2 class="mb-0">Edit Car #<?= (int)$car['id'] ?></h2>
  <a class="btn btn-outline-dark" href="admin_cars.php">Back</a>
  </div>

 <?php if ($error): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
 <?php endif; ?>
  <form method="post" class="card shadow-lg">
  <div class="card-body bg-warning bg-opacity-15">
        <div class="mb-3">
      <label class="form-label"><strong>Model</strong></label>
        <input class="form-control" name="model" value="<?= htmlspecialchars($car['model']) ?>" required>
      </div>
   <div class="mb-3">
       <label class="form-label"><strong>Description</strong></label>
      <textarea class="form-control" name="description" rows="3" required><?= htmlspecialchars($car['description']) ?></textarea>
      </div>

      <div class="row g-2">
       <div class="col-md-2">
         <label class="form-label"><strong>Price in (€)</strong></label>
        <input class="form-control" type="number" step="0.01" name="price" value="<?= htmlspecialchars($car['price']) ?>" required>
        </div>
        <div class="col-md-3">
        <label class="form-label"><strong>Stats</strong></label>
        <input class="form-control" name="status" value="<?= htmlspecialchars($car['status']) ?>" required>
        </div>
      <div class="col-md-2">
          <label class="form-label"><strong>Img filename</strong></label>
        <input class="form-control" name="image" value="<?= htmlspecialchars($car['image'] ?? "") ?>" required>
        </div>
      </div>
  </div>

    <div class="card-footer justify-content-end d-flex gap-4">
    <button class="btn btn-primary" type="submit" name="save"><strong>Save</strong></button>
    </div>
  </form>
</div>
</body>
</html>
