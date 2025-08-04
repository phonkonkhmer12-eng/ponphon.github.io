<?php
$servername = "localhost";
$username ="root";
$password ="";
$dbname = "elearning";
$conn = new mysqli($servername,$username,$password,$dbname);
if  ($conn->connect_error){
    die ("Conncention failed:".$conn->connect_error);
}
?>