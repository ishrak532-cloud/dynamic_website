<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
 <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Add New Car</title>
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 800px;">
  <div class="d-flex justify-content-between align-items-center mb-4 mx-1">
  <h2 class="mb-0">Add New Car</h2>
  <a class="btn btn-outline-dark" href="admin_cars.php">Back</a>
  </div>

  <?php if ($error): ?>
 <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

<form method="post" class="card shadow-lg">
      <div class="card-body">
    <div class="mb-3">
      <label class="form-label"><strong>Model</strong></label>
      <input class="form-control" name="model" required>
      </div>
      <div class="mb-3">
      <label class="form-label"><strong>Description</strong></label>
   <textarea class="form-control" name="description" rows="3" required></textarea>
     </div>
      <div class="row g-3">
      <div class="col-md-4">
          <label class="form-label"><strong>Price in (€)</strong></label>
        <input class="form-control" type="number" step="0.01" name="price" required>
      </div>
      <div class="col-md-4">
        <label class="form-label"><strong>Stats</strong></label>
        <input class="form-control" name="status" placeholder="Available" required>
        </div>
      <div class="col-md-4">
        <label class="form-label"><strong>Img filename</strong></label>
          <input class="form-control" name="image" placeholder="cars1.jpg">
        </div>
      </div>
    </div>

    <div class="card-footer d-flex justify-content-end">
      <button class="btn btn-danger" type="submit" name="create"><strong>Create ad</strong></button>
    </div>
  </form>
</div>
</body>
</html>
