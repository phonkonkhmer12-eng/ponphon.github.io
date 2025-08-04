<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['users'] = $row;

            // Redirect based on role
            switch ($row['role']) {
                case 'admin': header("Location: admin/dashboard.php"); break;
                case 'teacher': header("Location: teacher.php"); break;
                case 'student': header("Location: student/dashboard.php"); break;
            }
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Users not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>User Login</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <input class="form-control mb-2" type="text" name="username" placeholder="Username" required>
        <input class="form-control mb-2" type="password" name="password" placeholder="Password" required>
        <button class="btn btn-success" type="submit">Login</button>
    </form>
    <a href="register.php" class="btn btn-link mt-2">Don't have an account? Register</a>
</div>
</body>
</html>