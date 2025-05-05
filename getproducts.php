<?php

$column=$_GET['column'];
$platform=$_GET['platform'];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gh_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}           

 if ($platform=="*"){
    if($column=='*'){
        $sql = "SELECT * FROM products";
    }else{
        $sql = "SELECT * FROM products WHERE $column='1'";
    }
 }else if($column=='*'){
     if($platform=='*'){
        $sql = "SELECT * FROM products";
     }else{
        $sql = "SELECT * FROM products WHERE Platform = '$platform'";
     }


    
}

$result = $conn->query($sql);
$products = array();


if ($result->num_rows > 0) {
    

    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "no product was found";
}



$conn->close(); 


header('Content-Type: application/json');
echo json_encode($products);

?>