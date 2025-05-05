<?php
include 'getPlatformProducts.php';
$gp = new GetProducts();


if ($gp->conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result=$gp->getProducts();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_product') {

    if (isset($_POST['game_name'], $_POST['platform'], $_POST['genre'], $_POST['price'], $_POST['description'], $_POST['main_image'], $_POST['small_image1'], $_POST['small_image2'], $_POST['small_image3'], $_POST['small_image4'])) {
   
     if($gp->addProduct($_POST))
     {
        // echo 'product added successfully';
     }else{
        // echo 'failed to add product';
     }

    } else {
        echo "Please fill in all the fields!";
    }
}




if (isset($_POST['update_game_id'])) {
    $game_id = $_POST['update_game_id'];
    if (is_numeric($game_id)) {
        $product_to_update = $gp->getProduct($game_id);
        if($product_to_update ){
            // echo 'success';
        }else{
            // return 'failed';
        }
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['update_action']) && $_POST['update_action'] === 'update_product') {
        if (isset($_POST['game_id'], $_POST['game_name'], $_POST['platform'], $_POST['genre'], $_POST['price'], $_POST['description'], $_POST['main_image'], $_POST['small_image1'], $_POST['small_image2'], $_POST['small_image3'], $_POST['small_image4'])) {
            if ($gp->updateProduct($_POST)) {
                // echo "Product updated successfully!";
            } else {
                // echo "Error updating product: " . $stmt->error;
            }
        } else {
            echo "Please fill in all the fields!";
        }
    }



elseif (isset($_POST['action']) && $_POST['action'] === 'delete_product') {
        if (isset($_POST['game_id'])) {
            $game_id = $_POST['game_id'];
            if (is_numeric($game_id)) {
                if ($gp->deleteProduct($game_id)) {
                    // echo "Product deleted successfully!";
                } else {
                    // echo "Error deleting product: " . $stmt->error;
                }
            } else {
                echo "Invalid product ID.";
            }
        }
    }
}



$platform = isset($_POST['platform']) ? $_POST['platform'] : '';

if ($platform) {
   $products=$gp->getProducts_Platform($platform);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="website icon" href="image/GamesHeavenn.png">
</head>

<body>
    <div class="admin-wrapper">
        
        <aside class="sidebar">
            <div class="logo">
                <a href="index.html"><img src="image/GamesHeavenn.png" alt="Logo"></a>
            </div>
            <nav>
                <ul>
                    <li><a href="#viewSales" class="nav-link">View Sales</a></li>
                    <li><a href="#addRemoveProducts" class="nav-link">Add/Remove Products</a></li>
                </ul>
            </nav>
        </aside>


        <div class="admin-content">
            <section id="viewSales" class="content-section">
                <h2>Sales and Best Sellers</h2>
                From: <input type="date" id="date">
                &nbsp;&nbsp;&nbsp;&nbsp;
                To: <input type="date" id="date">
                <br><br>
                <div class="sales-overview">
                    <div class="overview-box">
                        <h3>Total Sales</h3>
                        <p>50000.0SR</p>
                    </div>
                    <div class="overview-box">
                        <h3>Best Seller</h3>
                        <p><a href="products.php" class="game-link" data-id="8">Elden Ring</a></p>
                    </div>
                </div>
                <div class="sales-chart">
                    <img src="image/لقطة شاشة 2024-11-21 205502.png">
                </div>
            </section>
            <br><br>
            <section id="addRemoveProducts" class="content-section">
                <h2>Products Management</h2>
                <div class="product-actions">
                    <div class="action-box">
                        <h3>Add New Product</h3>
                        <br>
                        <button class="btn" onclick="showForm('addForm')">Add Product</button>
                    </div>
                    <div class="action-box">
                        <h3>Remove Product</h3>
                        <br>
                        <button class="btn" onclick="showForm('removeForm')">Remove Product</button>
                    </div>
                    <div class="action-box">
                        <h3>Update Product</h3>
                        <br>
                        <button class="btn" onclick="showForm('updateForm')">Update Product</button>
                    </div>
                    <div class="action-box">
                    <h3>Display Products</h3>
                   <br>
                   <form method='POST' action='admin.php' onsubmit="showForm('viewAllProducts')">
                    <input type="hidden" name='action' value='show_all_products'>
                   <button class="btn" type='submit'>Display All Products</button>
                   </form>
                 </div>
                </div>




    <div id="addForm" class="form-container">
    <h3>Add Product</h3>
    <form method="POST" action="admin.php">
        <input type="hidden" name="action" value="add_product">
        <input type="text" name="game_name" placeholder="Game Name" required><br>
        <select name="platform" required>
            <option value="" disabled selected>Select Platform</option>
            <option value="PlayStation">PlayStation</option>
            <option value="Xbox">Xbox</option>
            <option value="Nintendo">Nintendo</option>
            <option value="PC">PC</option>
        </select><br>
        <input type="text" name="genre" placeholder="Genre" required><br>
        <input type="number" step="0.01" name="price" placeholder="Price" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="text" name="main_image" placeholder="Main Image URL" required><br>
        <input type="text" name="small_image1" placeholder="Small Image 1 URL" required><br>
        <input type="text" name="small_image2" placeholder="Small Image 2 URL" required><br>
        <input type="text" name="small_image3" placeholder="Small Image 3 URL" required><br>
        <input type="text" name="small_image4" placeholder="Small Image 4 URL" required><br>
        <button type="submit"  onclick="showForm('addForm')">Add Product</button>
    </form>
</div>



<div id="removeForm" class="form-container ">
    <h3>Remove Product</h3>
    <form method="POST" action="">
        <select name="platform" required onchange="this.form.submit()">
            <option value="" disabled selected>Select Platform</option>
            <option value="PlayStation" <?php if ($platform == 'PlayStation') echo 'selected'; ?>>PlayStation</option>
            <option value="Xbox" <?php if ($platform == 'Xbox') echo 'selected'; ?>>Xbox</option>
            <option value="Nintendo" <?php if ($platform == 'Nintendo') echo 'selected'; ?>>Nintendo</option>
            <option value="PC" <?php if ($platform == 'PC') echo 'selected'; ?>>PC</option>
        </select>
        <hr>
    </form>

    
    <?php if (!empty($products)): ?>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <img src="<?php echo $product['Main-img']; ?>" alt="<?php echo $product['Name']; ?>">
                    <span><?php echo $product['Name']; ?></span>
                    <form method="POST" action="admin.php" style="display:inline;">
                    <input type="hidden" name="action" value="delete_product">
                    <input type="hidden" name="game_id" value="<?php echo $product['ID']; ?>">
                        <button type="submit" name="action" value="delete_product" onclick="showForm('updateForm')">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif ($platform): ?>
        <p>No products found for this platform.</p>
    <?php endif; ?>
</div>


<div id="updateForm" class="form-container">
    <h3>Update Product</h3>
    <form method="POST" action="" id="update-form">
        <select name="platform" required onchange="this.form.submit()">
            <option value="" disabled selected>Select Platform</option>
            <option value="PlayStation" <?php if ($platform == 'PlayStation') echo 'selected'; ?>>PlayStation</option>
            <option value="Xbox" <?php if ($platform == 'Xbox') echo 'selected'; ?>>Xbox</option>
            <option value="Nintendo" <?php if ($platform == 'Nintendo') echo 'selected'; ?>>Nintendo</option>
            <option value="PC" <?php if ($platform == 'PC') echo 'selected'; ?>>PC</option>
        </select>
        <hr>
    </form>



    <?php if (!empty($products)): ?>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <img src="<?php echo $product['Main-img']; ?>" alt="<?php echo $product['Name']; ?>">
                    <span><?php echo $product['Name']; ?></span>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="update_game_id" value="<?php echo $product['ID']; ?>">
                        <button type="submit" name="action" value="edit_product">Edit</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif ($platform): ?>
        <p>No products found for this platform.</p>
    <?php endif; ?>



    <?php if (isset($product_to_update)): ?>
        <form method="POST" action="admin.php">
        <input type="hidden" name="update_action" value="update_product">
        <input type="hidden" name="game_id" value="<?php echo $product_to_update['ID']; ?>">
            <input type="text" name="game_name" value="<?php echo $product_to_update['Name']; ?>" placeholder="Game Name" required><br>
            <select name="platform" required>
                <option value="PlayStation" <?php if ($product_to_update['Platform'] == 'PlayStation') echo 'selected'; ?>>PlayStation</option>
                <option value="Xbox" <?php if ($product_to_update['Platform'] == 'Xbox') echo 'selected'; ?>>Xbox</option>
                <option value="Nintendo" <?php if ($product_to_update['Platform'] == 'Nintendo') echo 'selected'; ?>>Nintendo</option>
                <option value="PC" <?php if ($product_to_update['Platform'] == 'PC') echo 'selected'; ?>>PC</option>
            </select><br>
            <input type="text" name="genre" value="<?php echo $product_to_update['Genre']; ?>" placeholder="Genre" required><br>
            <input type="number" step="0.01" name="price" value="<?php echo $product_to_update['Price']; ?>" placeholder="Price" required><br>
            <textarea name="description" placeholder="Description" required><?php echo $product_to_update['Description']; ?></textarea><br>
            <input type="text" name="main_image" value="<?php echo $product_to_update['Main-img']; ?>" placeholder="Main Image URL" required><br>
            <input type="text" name="small_image1" value="<?php echo $product_to_update['Small-img1']; ?>" placeholder="Small Image 1 URL" required><br>
            <input type="text" name="small_image2" value="<?php echo $product_to_update['Small-img2']; ?>" placeholder="Small Image 2 URL" required><br>
            <input type="text" name="small_image3" value="<?php echo $product_to_update['Small-img3']; ?>" placeholder="Small Image 3 URL" required><br>
            <input type="text" name="small_image4" value="<?php echo $product_to_update['Small-img4']; ?>" placeholder="Small Image 4 URL" required><br>
            <button type="submit">Update Product</button>
        </form>
    <?php endif; ?>
</div>
            </section>
            
           
<section id="viewAllProducts" class="content-section">
    <?php  
    global $result;
    if ($result && $result->num_rows > 0):?>
        <div id="productList" class="product-list" style="display:none;">
        <h2>All Products</h2>
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="product-item">
                    <img src="<?php echo $product['Main-img']; ?>" alt="<?php echo $product['Name']; ?>">
                    <span><?php echo $product['Name']; ?></span>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <center><h1>No products found.</h1></center>
    <?php endif; ?>
    <?php $gp->conn->close(); ?>
</section>
        </div>
    </div>
    <script src="Product_id.js"></script>
    <script src='admin.js'></script>
</body>

</html>