<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elearning";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data to display in confirmation (corrected table name to 'users')
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT id, username, role, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("User not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    $sql = "DELETE FROM users WHERE id = ?"; // Corrected table name
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $conn->close();
    header("Location: index.php");
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .form-container {
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        p {
            margin-bottom: 15px;
        }
        .button-group {
            display: flex;
            gap: 10px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .confirm-btn {
            background-color: #f44336;
            color: white;
        }
        .confirm-btn:hover {
            background-color: #d32f2f;
        }
        .cancel-btn {
            background-color: #ccc;
            color: #333;
        }
        .cancel-btn:hover {
            background-color: #bbb;
        }
        @media (max-width: 600px) {
            .form-container {
                max-width: 100%;
                margin: 0;
                padding: 15px;
            }
            .button-group {
                flex-direction: column;
                gap: 10px;
            }
            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete the following user?</p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
        <p><strong>Role:</strong> <?php echo htmlspecialchars($row['role']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
        <form method="POST">
            <div class="button-group">
                <button type="submit" name="confirm_delete" class="confirm-btn">Yes, Delete</button>
                <a href="index.php" class="cancel-btn" style="text-decoration: none; display: inline-block; text-align: center;">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>