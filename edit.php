<?php
$servername = "localhost";
$username ="root";
$password ="";
$dbname = "elearning";

// Create conncention
$conn = new mysqli($servername,$username,$password,$dbname);

// Check conncention
if  ($conn->connect_error){
    die ("Conncention failed:".$conn->connect_error);
}
// Fetch user data for editing (corrected table name from 'user' to 'users')
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET username=?, role=?, email=? WHERE id=?"; // Corrected table name
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $role, $email, $id);
    $stmt->execute();
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
    <title>Edit User</title>
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
        form {
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1976D2;
        }
        @media (max-width: 600px) {
            form {
                max-width: 100%;
                margin: 0;
                padding: 15px;
            }
            input {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>

        <label for="role">Role:</label>
        <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($row['role']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>

        <button type="submit">Save Changes</button>
    </form>
</body>
</html>