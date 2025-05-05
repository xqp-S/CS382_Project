
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
            <link rel="stylesheet" href="Search.css">
            <link rel="stylesheet" href="Style.css">
            <link rel="stylesheet" href="nv-ft.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="website icon" href="image/GamesHeavenn.png">
        <title>All Products</title>
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
        <div class="Home_Catogery">
            <h1>Most Popular Games &nbsp;</h1>
            <hr style="color: black; border: 0.3px solid;">
        </div>
        <br>
        <div class="filter-content">
        <div class="main-filter">
                <h2>Shopping options</h2>
                <hr>
                <br>

                <div class="filter-section">
                    <label for="Genre">Genre: </label>
                    <select id="Genre" name="Genre">
                        <option value="All">All</option>
                        <option value="Action">Action</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Sport">Sport</option>
                        <option value="Horror">Horror</option>
                        <option value="Shooter">Shooter</option>
                    </select>
                    <hr>
                </div>


                <div class="filter-section">
                    <label for="Price">Price Range: </label>
                    <input type="range" id="Price" name="Price" min="0" max="400" value="50"
                        oninput="updatePriceLabel(this.value)">
                    <span id="PriceValue">50</span> SA
                </div>

                <button type="submit">Apply Filters</button>

            </div>
            
            
            <div class="home_img"> 
            <?php
                 include 'getPlatformProducts.php';

                 $gp = new GetProducts();
                $result = $gp->getProducts('Popular','1');
                if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    ?>
                    
                    <table data-platform="<?php echo htmlspecialchars($product['Platform']); ?>" data-Genre="<?php echo htmlspecialchars($product['Genre']); ?>">
                    <tr>
                        <td><a  onclick="displayDetails(<?php echo $product['ID']; ?>)"> <img src="<?php echo htmlspecialchars($product['Main-img']); ?>" class="game-link" data-id="<?php echo htmlspecialchars($product['ID']); ?>"> </a></td>
                    </tr>
                    <tr>
                        <td> <a  onclick="displayDetails(<?php echo $product['ID']; ?>)" class="game-link" data-id="<?php echo htmlspecialchars($product['ID']); ?>">
                                <h4><?php echo htmlspecialchars($product['Name']); ?></h4>
                            </a> </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="card-text"><?php echo htmlspecialchars($product['Price']);  ?>SR</h5>
                        </td>
                    </tr>
                </table>
                    <?php
                }
            }else{
                echo "<center><h1>no Product was Found</h1></center>";
            }
                ?>
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
    <script src="menu.js"></script>
    <script src="platforms-filter.js"></script>
    <script src="Product_id.js"></script>
    </html>
    <?php

?>
