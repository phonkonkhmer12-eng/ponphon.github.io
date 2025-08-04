<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <!--Create CSS Style Sheet-->
    <style>
        
            .sqear{
            
            padding: none;
            background-color:hsla(50, 22.40%, 90.40%, 0.00);
            width: 100% ;
            height: 200px;
           .btn1{
            border-radius: 20px;
            padding: 10px 30px;
            font-size: large;
            background-color: salmon;
            color: rgb(246, 247, 248);
            margin-top: 150px;
            display: inline-block;

           }
           .btn2{
            border-radius: 20px;
            padding: 10px 30px;
            font-size: large;
            background-color: salmon;
            color: rgb(246, 247, 248);
            margin-top: 150px;
            display: inline-block;
            }
           .btn1:hover{
            background-color: #4CAF50;
            color:rgb(67, 54, 244);
            }
        .btn2:hover{
            background-color: #4CAF50;
            color:rgb(54, 158, 244);
        }
        a{
            text-decoration: none;
        }
    
        }
        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px 40px;
            font-family: Arial, sans-serif;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .action-btn {
            padding: 5px 10px;
            margin-right: 5px;
            text-decoration: none;
            color: white;
            border-radius: 3px;
        }
        .edit-btn {
            background-color: #2196F3;
        }
        .delete-btn {
            background-color: #f44336;
        }
        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            td {
                position: relative;
                padding-left: 50%;
                text-align: left;
                white-space: normal;
            }
            td:before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
                text-transform: uppercase;
            }
            .action-btn {
                display: block;
                margin: 5px 0;
            }
        }
    </style>

</head>
<body style="background-color:hsl(86, 21.60%, 85.50%);">
     <h1 class="sqear">       
        <a  href="index.php">Course</a>
            <button class="btn1"><a href="Register.php">Create User</a></button>
            <button class="btn2"><a href="Login.php">Login</a></button>
             <button class="btn1"><a href="index.php"><></index></a></button>
     </h1>      
        <?php
            $servername="localhost";
            $username="root";
            $password="";
            $db="elearning";
            //Create Connection
            $conn=new mysqli($servername,$username,$password,$db);
            //Chech Connection
            if($conn->connect_error)
            {
                die("Connect failed?!!".$conn->connect_error);
            }
        //Output Data to table 
        echo "<h2>User List</h2>";
        //Retrieve Data
        $sql="select id,username,role,email from users";
        $result=$conn->query($sql);
        //Check Data
        if($result->num_rows>0)
        {
            echo "<table>";
                echo "<thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";
                while($row=$result->fetch_assoc())
                {
                  echo "<tr>";
                  echo "<td data-label='ID'>" . htmlspecialchars($row["id"]) . "</td>";
                  echo "<td data-label='username'>" . htmlspecialchars($row["username"]) . "</td>";
                  echo "<td data-label='Role'>" . htmlspecialchars($row["role"]) . "</td>";
                  echo "<td data-label='Email'>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td data-label='Actions'>";
                echo "<a href='edit.php?id=" . htmlspecialchars($row["id"]) . "' class='action-btn edit-btn'>Edit</a>";
                echo "<a href='delete.php?id=" . htmlspecialchars($row["id"]) . "' class='action-btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>";
                echo "</tr>";
                
            }  
            echo "</tbody>";
            echo "</table>";
            }
        ?>
        
    </body>
</html>