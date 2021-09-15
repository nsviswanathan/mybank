<?php
$server="localhost";
$username="root";
$password="";
$db="bankdb";
$conn=mysqli_connect($server,$username,$password,$db);
if($conn){
}
else
    die("connection to the database failed due to " .mysqli_connect_error());
?>