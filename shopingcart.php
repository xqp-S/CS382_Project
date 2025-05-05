<?php
include 'handleCart.php';
$ch=new HandleCartProducts();


$total_price = 0;


$result=$ch->getCartProducts();

$cart_is_empty = ($result->num_rows == 0);



if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); 

$isDeleted=$ch->deleteFromCart($delete_id);
if($isDeleted){
    header("Location: shopingcart.php"); 
    exit();
    // echo 'deleted successfully';
}else{
    // echo 'failed to delete';
}
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = intval($_POST['product_id']); 
    $quantity = intval($_POST['quantity']); 
    
    if ($quantity > 0) {
        
        $isUpdated=$ch->updateQuantity($product_id,$quantity);
        if ($isUpdated) {
            header("Location: " . $_SERVER['REQUEST_URI']);
             exit();
            // $message = "Quantity updated successfully.";
            echo 'quantity updated successfully';
        } else {
            echo 'failed to update quantity';
            // $message = "Error updating quantity: " . $conn->error;
        }  
    } else {
        // $message = "Invalid quantity.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Game Haeven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <link rel="website icon" href="image/GamesHeavenn.png">
    <link rel="stylesheet" href="nv-ft.css">
    <link rel="stylesheet" href="Best_of.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="Cart.css">
    <script src="sign_out.js"></script>
</head>
<body>
<nav>
        <div class="logo">
            <a href="index.html"> <img src="image/GamesHeavenn.png" width="80px" height="80px"style="border-radius: 120px; margin: 15px 10px;"></a>
        </div>
        <div class="hamburger">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    
        <ul class="nav-links">
            <li><a href="Search.php" id="search_icon"><i class="fa-solid fa-magnifying-glass"
                        style="color: antiquewhite; font-size: 33px;"></i></a></li>
            <li> <a href="Playstation.php"><i class="fa-brands fa-playstation fa-2xl" style="font-size: 40px;"></i></a>
            </li>
            <li> <a href="Xbox.php"><i class="fa-brands fa-xbox fa-2xl"
                        style="color: #14b383; font-size: 40px;"></i></a>
            </li>
            <li> <a href="Nintendo.php"><img src="image/4518902_nintendo_switch_icon.svg" width="67px"
                        height="67px"></a> </li>
            <li id="pcc"> <a href="PC.php" style="padding: 0px;"><img src="image/image (3).png" width="67px"
                        height="67px"></a> </li>
            <li> <a href="#move_C">
                    <h5 style="color: antiquewhite; font-size: 15px; font-weight: 40px; ">ContactUs</h5>
                </a> </li>
                <li> <a class="nav-cta-button" href="shopingcart.php"><i class="fa-solid fa-cart-shopping " style="color: antiquewhite; margin: 0px 15px"></i></a></li>
                <li id="auth-links" class="nav-item">
                    <a href="login.html" class="btn btn-primary" id="sign-in_button">Sign In</a>
                </li>
        </ul>
    </nav>

    <section class="main">
        <div class="cart-content">
            <div class="cart-header">
                <h2>Shopping Cart</h2>
                <span id="items-count"><?php echo $result->num_rows; ?> Items</span>
            </div>
            <div class="cart-items" id="cart-items">
            <?php if ($result->num_rows > 0): ?>
            <?php
                
                while ($row = $result->fetch_assoc()) {
                    
                    $product_id = $row['product_id'];  
                    $product_name = $row['name'];
                    $product_price = $row['price'];
                    $product_description = $row['description'];
                    $product_image = $row['image'];
                    $quantity = $row['quantity'];  
                    $total_price += $product_price * $quantity;  
            ?>
               <div class="cart-item" data-id="<?php echo $product_id; ?>">
                    <div class="item-details">
                        <div class="item-image">
                            <a href="products.php" class="game-link" data-id="<?php echo $product_id; ?>">
                                <img src="<?php echo $product_image; ?>" alt="Product Image">
                            </a>
                        </div>
                        <div class="item-info">
                            <a href="products.php" class="game-link" data-id="<?php echo $product_id; ?>">
                                <h3><?php echo htmlspecialchars($product_name); ?></h3>
                            </a>
                            <p><?php echo htmlspecialchars($product_description); ?></p>
                        </div>
                    </div>
                    <div class="price">
                        <form method="POST" style="display: flex; align-items: center; gap: 10px;">
                            <span class="product-price"><?php echo $product_price; ?></span> 
                            <span>x</span> 
                            <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" required class="quantity-input">
                            <span>=</span> 
                            <span class="total-price"><?php echo $product_price * $quantity; ?> SAR</span>
                            <button type="button" class="remove-btn" onclick="window.location.href='shopingcart.php?delete_id=<?php echo $product_id; ?>'">
                                Remove
                            </button>
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <button type="submit" class="increase-qty-btn">Update Quantity</button>
                        </form>
                    </div>
                        
                </div>
            <?php } ?>  
            <?php else: ?>
                <p>Your cart is empty. Please add some items to your cart.</p>
            <?php endif; ?>
            </div>
            
        </div>
        <div class="checkout">
            <h3>Checkout</h3>
            <div class="payment-method">
                
                <div >
                <h4>Payment Methods</h4><br>
                <div class="payment-options">
                    
                    <label>
                        <input id="visa" type="radio" name="PM" value="visa">
                        <img src="image/Visa.jpeg" alt="Visa"> <p>Visa</p>
                    </label>
                    <label>
                        <input id="mastercard" type="radio" name="PM" value="MasterCard">
                        <img src="image/mastercard.png" alt="mastercard"> <p>MasterCard</p>
                    </label>
                    <label>
                        <input id="madapay" type="radio" name="PM" value="MadaPay">
                        <img src="image/MadaLogo.jpeg" alt="MadaPay"> <p>MadaPay</p>
                    </label>
                    <label>
                        <input id="paypal" type="radio" name="PM" value="PayPal">
                        <img src="image/pp.png" alt="PayPal"> <p>PayPal</p>
                    </label>
                    <label>
                        <input id="applepay" type="radio" name="PM" value="ApplePay">
                        <img src="image/ApplePay.jpeg" alt="ApplePay"> <p>ApplePay</p>
                    </label>
                    <label>
                        <input id="cash" type="radio" name="PM" value="Cash">
                        <img src="image/Cash.png" alt="Cash"> <p>Cash On Delivery</p>
 
                    </label>
                </div>
                </div>
            </div>
            <div class="cart-total">
            <h3>Total: <span id="total-amount"><?php echo $total_price; ?> SAR</span></h3>
            <button id="btn" class="btn btn-primary" onclick="proceedToPayment()" <?php echo $cart_is_empty ? 'disabled' : ''; ?>>
                Checkout
            </button>
            </div>
        </div>
       
    </section>
    <footer>
        <table >
            <tbody>

                <tr>
                    <td class="logo"><a href="#"> <img src="image/GamesHeavenn.png"></a></td>
                </tr>
                <tr>
                    <td>
                        <div class="table_head">
                            <h1>Overview</h1>
                            <h1>Contact us</h1>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="table_head">
                            <h3 class="Overview-element" id="move_O"><a href="aboutus.html">About us</a></h3>
                            <h3 class="Contact-element" id="move_C">Email:<a href="mailto">Badgahish@gmail.com</a></h3>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="table_head">
                            <h3 class="Overview-element" id="move_O"><a href="Return.html">Return policies</a></h3>
                            <h3 class="Contact-element" id="move_C">Phone number: <a href="number">+966567176142</a>
                            </h3>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </footer>  
</body>
</section>
<script src="shoppingPay.js"></script>
<script src="menu.js"></script>
<script src="Product_id.js"></script>
</html>
