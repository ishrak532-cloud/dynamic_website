<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../db.php";
if (isset($_GET['done'])) {
  $id = (int)$_GET['done'];
  $stmt = $conn->prepare("UPDATE requests SET status='Done' WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_requests.php");
  exit;
}
if (isset($_GET['del'])) {
  $id = (int)$_GET['del'];
  $stmt = $conn->prepare("DELETE FROM requests WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_requests.php");
  exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>XCARS Admin - Requests</title>
</head>
<body class="bg-danger bg-opacity-10">
<div class="container py-4">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Offer Requests</h2>


    <a class="btn btn-outline-dark" href="../cars.php">Back to Cars</a>
    <a class="btn btn-outline-dark" href="admin_cars.php">admin cars</a>
    <a class="btn btn-outline-dark" href="admin_stats.php">Live Stats</a>

  </div>

  <div class="card shadow-md">
    <div class="card-body table-responsive">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>ID</th>
          <th>Customer Name</th>
          <th>Email Address</th>
          <th>Number</th>
          <th>Model</th>
            <th>Status</th>
            <th>Time</th>
          <th class="text-end">Actions</th>
        </tr>
       </thead>
       <tbody>
        <?php
        $result = $conn->query("SELECT * FROM requests ORDER BY id DESC");
        while($r = $result->fetch_assoc()):
      ?>
        <tr>
          <td><?= (int)$r['id'] ?></td>
          <td><?= htmlspecialchars($r['fullname']) ?></td>
          <td><?= htmlspecialchars($r['email']) ?></td>
          <td><?= htmlspecialchars($r['phone']) ?></td>
        <td><?= htmlspecialchars($r['car_model']) ?></td>
          <td>
              <?php if ($r['status'] === 'Done'): ?>
             <span class="badge bg-success">Done ✓</span>
           <?php else: ?>
               <span class="badge bg-warning text-dark">latest</span>
         <?php endif; ?>
           </td>

<td><?= $r['created_at'] ?? '—' ?></td>



          <td class="text-end">
              <a class="btn btn-sm btn-outline-success" href="admin_requests.php?done=<?= (int)$r['id'] ?>">Mark Done</a>
            <a class="btn btn-sm btn-outline-danger"
               href="admin_requests.php?del=<?= (int)$r['id'] ?>"
            onclick="return confirm('Do you want to delete this request?');">
               Delete
              </a>
          </td>
          </tr>
         <tr>
            <td class="bg-secondary bg-opacity-25" colspan="8">
           <strong>Messages:</strong> <?= nl2br(htmlspecialchars($r['message'])) ?>
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
