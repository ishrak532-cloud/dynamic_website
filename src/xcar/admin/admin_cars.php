<?php
require_once __DIR__ . "/../db.php";
$result = $conn->query("SELECT * FROM cars ORDER BY id DESC");
if (!$result) {
  die("SQL ERROR: " . htmlspecialchars($conn->error));
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>XCARS Admin - Cars</title>
</head>

<body class="bg-success bg-opacity-10">
<div class="container py-4">

  <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h2 class="mb-0">Admin: Cars</h2>

  <div class="d-flex gap-2">
     <a class="btn btn-outline-success" href="admin_requests.php">Requests</a>
    <a class="btn btn-outline-success" href="../cars.php">Public Cars</a>
      <a class="btn btn-danger" href="car_create.php">Add New Car</a>
   </div>
  </div>

  <div class="card shadow-sm">
  <div class="card-body table-responsive">
    <table class="table table-striped mb-1 align-middle ">
        <thead class="table-danger">
        <tr>
          <th>ID</th>
          <th>Model</th>
            <th>Price (€)</th>
          <th>Status</th>
           <th>Image</th>
           <th class="text-end">Actions</th>
         </tr>
        </thead>
      <tbody>
      <?php while ($rows = $result->fetch_assoc()): ?>
          <tr>
          <td><?= (int)$rows['id'] ?></td>
          <td><?= htmlspecialchars($rows['model']) ?></td>
           <td><?= number_format((float)$rows['price'], 2) ?></td>
          <td>
              <?php if ($rows['status'] === "Available"): ?>
              <span class="badge bg-success">Available</span>
             <?php else: ?>
                <span class="badge bg-secondary"><?= htmlspecialchars($rows['status']) ?></span>
             <?php endif; ?>
          </td>
            <td><?= htmlspecialchars($rows['image'] ?? '') ?></td>

        <td class="text-end">
          <a class="btn btn-md btn-outline-primary"
               href="car_edit.php?id=<?= (int)$rows['id'] ?>">
              Edit
            </a>
              <a class="btn btn-md btn-outline-danger"
               href="car_delete.php?id=<?= (int)$rows['id'] ?>"
               onclick="return confirm('Delete this car?');">
                Delete
           </a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>

      </table>
    </div>
  </div>

</div>
</body>
</html>
