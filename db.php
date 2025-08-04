<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>courses</title>
</head>
<body>
    <?php
    $hostname='localhost';
    $user='root';
    $pass='';
    $db='elearning';
    $conn = new mysqli($hostname,$user,$pass,$db);

    if($conn->connect_error){
    die("Connection failed ".$conn->connect_error);
}

?>
    
</body>
</html>