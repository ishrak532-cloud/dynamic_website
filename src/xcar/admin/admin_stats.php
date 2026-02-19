<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>XCARS Admin - Live Stats</title>
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 850px;">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Live Stats</h2>
    <a class="btn btn-outline-dark" href="admin_requests.php">Back</a>
  </div>
  <?php if (isset($_GET['saved'])): ?>
    <div class="alert alert-success">Stats updated! ✅</div>
  <?php endif; ?>

  <div class="card shadow-lg">
    <div class="card-body">
      <form method="post">
        <div class="mb-3 mx-1">
     <label class="form-label">Total Cars count</label>
        <input type="number" class="form-control" name="total_cars"
         value="<?= (int)$stats['total_cars'] ?>" required>
      </div>

      <div class="mb-3 mx-1">
        <label class="form-label">Available Now</label>
          <input type="number" class="form-control" name="available_cars"
                value="<?= (int)$stats['available_cars'] ?>" required>
      </div>

      <div class="mb-3 mx-1">
        <label class="form-label">Offer Requests count</label>
          <input type="number" class="form-control" name="offer_requests"
               value="<?= (int)$stats['offer_requests'] ?>" required>
        </div>
      <button class="btn btn-warning" type="submit" name="save_stats">Save</button>
      <div class="text-muted mt-3">
        Last update D&T: <?= htmlspecialchars($stats['updated_at'] ?? '') ?>
    </div>
    </form>
   </div>
  </div>
</div>
</body>
</html>
