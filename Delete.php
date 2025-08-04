<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM courses WHERE id=$id");
header("Location: index.php");
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>