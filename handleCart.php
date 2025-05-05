<?php

class HandleCartProducts{

    public $servername = "localhost";
    public $username = "root"; 
    public $password = "";     
    public $dbname = "gh_db";  
    public $conn;

    function __construct(){

      $this->conn=new mysqli($this->servername,$this->username,$this->password,$this->dbname);

      if($this->conn->connect_error){
        die("Connection failed: " . $this->conn->connect_error);
      }

    }

function checkInCart($product_id){
    $sql = "SELECT * FROM cart_products WHERE product_id = ?";
    $cart_stmt = $this->conn->prepare($sql);
    $cart_stmt->bind_param("i", $product_id);
    if ($cart_stmt->execute()) {
      $result = $cart_stmt->get_result();
      return $result->num_rows > 0;  
  }else{
       $cart_stmt->close();
        return false;
    }
    
}

   function addToCart($post){
    $insert_sql = "INSERT INTO cart_products (product_id, name, price, description, image, quantity) 
    VALUES (?, ?, ?, ?, ?, ?)";
    $insert_stmt = $this->conn->prepare($insert_sql);
    $insert_stmt->bind_param("issssi", $post['product_id'], $post['name'], $post['price'], $post['description'], $post['image'], $post['quantity']);
   
    if ($insert_stmt->execute()) {
    return true;
   }
    else {
    $insert_stmt->close();
   return false;
   }
   }



   function deleteFromCart($product_id){
    $delete_sql = "DELETE FROM cart_products WHERE product_id = ?";
    $delete_stmt = $this->conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $product_id); 
  
    if ($delete_stmt->execute()) {
        return true;
    } else {
      $delete_stmt->close();
        return false;
    }
  }


  function deleteAllProducts() {
    $delete_sql = "DELETE FROM cart_products";
    $delete_stmt = $this->conn->prepare($delete_sql);
    if ($delete_stmt->execute()) {
        return true;
    } else {
      $delete_stmt->close();
        return false;
    }
}


  function updateQuantity($product_id,$quantity){
    $update_sql = "UPDATE cart_products SET quantity = ? WHERE product_id = ?";
        $update_stmt = $this->conn->prepare($update_sql);
        $update_stmt->bind_param("ii", $quantity, $product_id); 
         if($update_stmt->execute()){
          return true;
         }else{
          $update_stmt->close();
          return false;
         }
  }


function getCartProducts(){
  $sql = "SELECT product_id, name, price, description, image, quantity FROM cart_products";
  $stmt=$this->conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  return $result;
}


function countTotalProducts()
{
  $sql_check = "SELECT COUNT(*) AS total_items FROM cart_products";
$result_check = $this->conn->query($sql_check);
$row_check = $result_check->fetch_assoc();
return $row_check['total_items'];
}


}

?>