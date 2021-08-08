<?php 

$host = "localhost";
$username = "root";
$password = "";
$database = "hackacode";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn){
//     echo "success";
// }
// else{
    echo "Error". mysqli_connect_error();
}
?>