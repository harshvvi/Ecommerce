<?php
    session_start();
    if(isset($_POST["logout_btn"])){
        unset($_SESSION["logged_user"]);
    }
    $servername="localhost";
    $username="root";
    $pass="";
    $db="ecommerce";
    $conn=new mysqli($servername,$username,$pass,$db);
    if($conn->connect_error){
        die("Connection failed : " . $conn->connect_error);
        if(isset($_POST["wish_list_btn"])){
            $q2="";
        }
    }
    else{
        $q1="select * from products";
    }
?>
<html>
<head>
    <title>Ecommerce Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="index_image.css">
</head>
<body onload="showSlides()">
    <header id="header">
        <nav id="top_nav">
            <a href="index.php" id="site_name"><h2 id="site">Shopping Portal</h2></a>
            <div id="search">
                <input type="text" name="search" id="search_bar" placeholder="Search products here" style="text-align:center;"><button type="submit" id="search_btn"><i class="fa fa-search"></i></button>
            </div>
            <a href="#" id="track_order">Track Order</a>
            <a href="#" id="cart"><i class="fa fa-shopping-cart fa-2x"></i>Cart</a>
            <div id="login_drop">
                <?php
                if(isset($_SESSION["logged_user"])){
                ?>
                    <span id="login"><?php echo $_SESSION["logged_user"];?></span>
                    <div id="login_content">
                        <a href="#" id="account">Your account</a><hr>
                        <a href="#" id="orders">Your orders</a><hr>
                        <a href="#" id="wishlist">Wishlist</a><hr>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="logout">
                            <div id="logout_div">
                                <i class="fa fa-sign-out" aria-hidden="true"></i><input type="submit" value="logout" name="logout_btn" id="logout_btn">
                            </div>
                        </form>
                    </div>
                <?php
                }
                else{
                ?>
                    <a href="login.php" id="login">Login</a>
                    <div id="login_content">
                        <a href="#" id="account">Your account</a><hr>
                        <a href="#" id="orders">Your orders</a><hr>
                        <a href="#" id="wishlist">Wishlist</a>
                        <hr>
                        <p id="new_user" style="margin-bottom:5px; margin-top:3px;">New User</p>
                            <a href="user_signup.php" id="sign_up">Sign Up</a>
                    </div>
                <?php
                }
                ?>
            </div>
        </nav>
    </header>


    <div id="side_nav_div">
        <h3 id="top_categories">Top categories</h3>
        <nav id="side_nav">
            <a href="#" id="mens"><i class="fa fa-male"></i>Mens</a>
            <hr>
            <a href="#" id="womens"><i class="fa fa-female"></i>Women</a>
            <hr>
            <a href="#" id="fashion"><i class="fa fa-tshirt"></i>Fashion</a>
            <hr>
            <a href="#" id="electronics"><i class="fa fa-laptop"></i>Electronics</a>
            <hr>
            <a href="#" id="books"><i class="fa fa-book"></i>Books</a>
            <hr>
            <a href="#" id="furniture"><i class="fa fa-chair"></i>Furniture</a>
        </nav>
    </div>


    <div id="slide_show">
        <div class="slides fade">
            <img src="images\img1.jfif" alt="Image Not available" id="img1">
            <div class="caption c1">
                <p id="line1">Best offers on top Brands</p><br>
                <p id="line2">Upto <span id="off">70%</span> off</p>
            </div>
        </div>
        <div class="slides fade">
            <img src="images\gaming_laptops.jfif" alt="Image Not available" id="laptop" >
            <div class="caption c2">
                <p id="line1">Season End Sale</p>
                <p id="line2">Upto <span id="off">60%</span> off</p>
                <p id="line3">on Best Brands</p>
            </div> 
        </div>
        <div class="slides fade">
            <img src="images\furniture.jfif" alt="Image not available" id="furniture">
            <div class="caption c3">
                <p id="line1">Top furniture</p>
                <p id="line2"><span id="sale">Sale</span>starts today</p>
            </div> 
        </div>
        <div class="slides fade">
            <img src="images\womens_fashion.jfif" alt="Image not available" id="womens_fashion" >
            <div class="caption c4">
                <p id="line1"><span id="off">50%-70%</span>off</p>
                <p id="line2">on women's clothing</p>
            </div> 
        </div>
        <div class="slides fade">
            <img src="images\watch.jfif" alt="Image not available" id="watch">
            <div class="caption c5">
                <p id="line1">Latest watches</p>
                <p id="line2">upto <span id="off">50%</span>off</p>
                <p id="line3">on top Brands</p>
            </div> 
        </div>
        <div  style="text-align:center; margin-top:20px;">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>


    <div id="products_div">
        <?php
            if($result1=$conn->query($q1)){
                $product=0;
                if($result1->num_rows >0){
                    if($product<13){
                    while($rows=$result1->fetch_assoc()){
                        $product++;
        ?>
        <a href="product.php" style="color:black;"><div id="product_container">
                <?php
                    $_SESSION["product_name"]=$rows["name"];
                ?>
                <div id="product_images">
                <?php
                    echo '<img width="260" height="250" src="data:image;base64,'.base64_encode($rows['img1']).'">';
                ?>
                </div>

                <div id="product_cart">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="product_cart_form" method="post">
                        <button type="submit" name="product_cart_btn" id="product_cart_btn" onclick="cart()"><i class="fa fa-shopping-cart fa"></i></button>
                    </form>
                </div>

                <div id="wish_list">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="wish_list_form" method="POST">
                        <button type="submit" name="wish_list_btn" id="wish_list_btn" onclick="wish()"><i class="fa fa-heart"></i></button>
                    </form>
                </div>

                <div id="product_content">
                    <div id="product_name" style="margin-bottom:15px;"><?php echo $rows["name"];?></div>
                    <div id="product_oprice" style="font-weight:50;margin:0 15px 20px 20px;"><strike>Rs<?php echo $rows["oprice"];?></strike></div>
                    <div id="product_sprice" style="font-weight:bold;">Rs<?php echo $rows["sprice"];?></div>
                    <div id="category_name" style="text-align:center;margin-top:10px;"><?php echo $rows["category"];?></div>
                </div>
            </div>
            </a>
        <?php
        }}}}
        ?>
    </div>










    <script>
        var slideIndex = 0;
        
        function showSlides() {
          var i;
          var slides = document.getElementsByClassName("slides");
          var dots = document.getElementsByClassName("dot");
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          slideIndex++;
          if (slideIndex > slides.length) {slideIndex = 1}    
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
          setTimeout("showSlides()", 2000);
        }
    </script>
</body>
</html>