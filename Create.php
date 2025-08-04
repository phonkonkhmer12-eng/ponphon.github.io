<?php include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $teacher_id = $_POST['teacher_id'];

    $imgName = $_FILES["image"]["name"];
    $imgTmp = $_FILES["image"]["tmp_name"];
    $uploadPath = "upload/" . basename($imgName);

    if (move_uploaded_file($imgTmp, $uploadPath)) {
        $stmt = $conn->prepare("insert into courses (title, description, image, teacher_id) value (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $description, $uploadPath, $teacher_id);
        $stmt->execute();
        header("Location: index.php");
        exit();
    } else {
        echo "Error uploading image.";
    }
}
$teacher = $conn->query("select id, username from users");
?>

<!-- Collect Value Parameter form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Course</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2>Add New Course</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" rows="4" required></textarea>
      </div>
      <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Teacher</label>
        <select name="teacher_id" class="form-control" required>
          <option value="">-- Select Teacher --</option>
          <?php while ($t = $teacher->fetch_assoc()): ?>
            <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['username']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <a href="index.php" class="btn btn-warning">Back</a>
    </form>
  </div>
</body>
</html>