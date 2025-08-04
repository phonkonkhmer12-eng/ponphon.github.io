<?php
include 'db.php';

$id = $_GET['id'];
$course = $conn->query("SELECT * FROM courses WHERE id=$id")->fetch_assoc();
$teachers = $conn->query("SELECT id, username FROM users");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $teacher_id = $_POST['teacher_id'];

    $imgName = $_FILES["image"]["name"];
    $imgTmp = $_FILES["image"]["tmp_name"];

    // If user uploaded a new image
    if (!empty($imgName)) {
        $uploadPath = "upload/" . basename($imgName);
        if (move_uploaded_file($imgTmp, $uploadPath)) {
            $stmt = $conn->prepare("UPDATE courses SET title = ?, description = ?, image = ?, teacher_id = ? WHERE id = ?");
            $stmt->bind_param("sssii", $title, $description, $uploadPath, $teacher_id, $id);
            $stmt->execute();
        }
    } else {
        // No new image — don't update image
        $stmt = $conn->prepare("UPDATE courses SET title = ?, description = ?, teacher_id = ? WHERE id = ?");
        $stmt->bind_param("ssii", $title, $description, $teacher_id, $id);
        $stmt->execute();
    }

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <body>
<div class="container mt-5">
  <h2>Edit Course</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Title</label>
      <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($course['title']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control"><?= htmlspecialchars($course['description']) ?></textarea>
    </div>
    <div class="mb-3">
      <label>CurrentImage</label>
      <?php echo "<img src=".$course["image"]." width='60'>"//"<img src='{$course['image']}' width='60'>" ?>
    </div>
    <div class="mb-3">
      <label>Change Image</label>
      <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-3">
      <label>Teacher</label>
      <select name="teacher_id" class="form-control" required>
        <option value="">-- Select Teacher --</option>
        <?php while($t = $teachers->fetch_assoc()): ?>
           <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['username']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>