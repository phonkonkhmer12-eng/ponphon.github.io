<?php include 'db.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Lists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="color: red;">
    <div class="container mt-5 "> <h2>Course Lists</h2>
     <a href="Create.php" class="btn btn-primary">Add New Courses</a>
    <button type="button" class="btn btn-link">Link</button>
       
          <table class="table table-bordered table-hover mt-3">
                 <thead class="table-dark">
                                <tr style="background-color: brown;">
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>image</th>
                                    <th>Teacher</th>
                                    <th>CreatedAt</th>
                                    <th>Actions</th>
                                </tr>
                 </thead>
     
<!----------------------Show date from database table in row ------------------------>      
                <tbody>
                    <?php
                    $sql="select * from courses";
                    $result=$conn->query($sql);
                    while($row=$result->fetch_assoc())
                        {
                        echo "<tr>";
                        
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['title']."</td>";
                            echo "<td>".$row['description']."</td>";
                            echo "<td>"."<img src=".$row['image']." width='60'>"."</td>";//<img src='{$row['image']}' width='60'></td>
                            echo "<td>".$row['teacher_id']."</td>";
                            echo "<td>".$row['created_at']."</td>";
                                                                       
                            
                            echo "<td>";
                        echo "<a href='edit.php?id=".$row["id"]."' class='btn btn-primary btn-sm'>Edit</a>";
                        echo "<a href='Update.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm'>Update</a>";
                        echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>";
                            echo"</td>";
                        echo "</tr>"; 
                    
                    }
                    ?>
                </tbody>
            </table>
    </div>
</body>
</html>