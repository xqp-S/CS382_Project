<?php
class GetProducts {

    private $servername = "localhost";  
    private $username = "root";          
    private $password = "";              
    private $dbname = "gh_db";           
    public $conn;

    function __construct() {

        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    function getProducts($column=null,$value=null) {

        if($column!=null&&$value!=null){ 
            $sql = "SELECT * FROM products WHERE $column = '$value'";
        }else{
              $sql = "SELECT * FROM products";
        }
       $result = $this->conn->query($sql);
       if($result){
        return $result;
       }else{
        return false;
       }
       
    }

     function getProducts_Platform($platform) {

         if($platform!=null){
          $sql = "SELECT * FROM products WHERE Platform = '$platform'";
        
        $result = $this->conn->query($sql);
         }if($result){
             return $result;
         }
         else{
             return false;
         }
        return $result;
     }

    function getProduct($id)
    {
        $sql = "SELECT * FROM products WHERE ID = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id); 
    if($stmt->execute()){
        return $stmt->get_result()-> fetch_assoc();
    }else{
        return false;
    }
    }


    function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE ID = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        return true;
    } else {
        echo false;
    }
    }

    function addProduct($post)
    {
            $game_name = $post['game_name'];
            $platform = $post['platform'];
            $genre = $post['genre'];
            $price = $post['price'];
            $description = $post['description'];
            $main_image = $post['main_image'];
            $small_image1 = $post['small_image1'];
            $small_image2 = $post['small_image2'];
            $small_image3 = $post['small_image3'];
            $small_image4 = $post['small_image4'];
    
            $sql = "INSERT INTO products (Name, platform, genre, price, description, `Main-img`, `Small-img1`, `Small-img2`, `Small-img3`, `Small-img4`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
            $stmt =$this->conn->prepare($sql);
            $stmt->bind_param("ssssssssss", $game_name, $platform, $genre, $price, $description, $main_image, $small_image1, $small_image2, $small_image3, $small_image4);
            if($stmt->execute())
            {
                return true;
            }else{
                return false;
            }
        
    }

    function updateProduct($post)
    {
                $game_id = $post['game_id'];
                $game_name = $post['game_name'];
                $platform = $post['platform'];  
                $genre = $post['genre'];
                $price = $post['price'];
                $description = $post['description'];
                $main_image = $post['main_image'];
                $small_image1 = $post['small_image1'];
                $small_image2 = $post['small_image2'];
                $small_image3 = $post['small_image3'];
                $small_image4 = $post['small_image4'];
    
                $sql = "UPDATE products SET Name = ?, Platform = ?, Genre = ?, Price = ?, Description = ?, `Main-img` = ?, `Small-img1` = ?, `Small-img2` = ?, `Small-img3` = ?, `Small-img4` = ? WHERE ID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("ssssssssssi", $game_name, $platform, $genre, $price, $description, $main_image, $small_image1, $small_image2, $small_image3, $small_image4, $game_id);
    
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } 
    }
?>
