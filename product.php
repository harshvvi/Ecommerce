<?php
    session_start();
    $servername="localhost";
    $username="root";
    $pass="";
    $db="ecommerce";
    $conn=new mysqli($servername,$username,$pass,$db);
    if($conn->connect_error){
        die("Connection Failed : " . $conn->connect_error);
    }
    else{
        $s=$_SESSION['product_name'];
        $q1="select * from products where name='$s'";
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="product.css">
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
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
        <div id="container">
            <?php
                if($result1=$conn->query($q1)){
                    if($result1->num_rows >0){
                        while($rows=$result1->fetch_assoc()){
            ?>
            <div id="product_images">
                <div id="small_images">
                    <?php
                        echo '<img width="50" height="50" onmouseover="change_image(e)" id="image1" src="data:image;base64,'.base64_encode($rows['img1']).'">';
                        echo '<img width="50" height="50" onmouseover="change_image(e)" id="image2" src="data:image;base64,'.base64_encode($rows['img2']).'">';
                        echo '<img width="50" height="50" onmouseover="change_image(e)" id="image3" src="data:image;base64,'.base64_encode($rows['img3']).'">';
                    ?>
                </div>
                <div id="big_image">
                    <?php 
                        echo '<img width="330" height="350" src="data:image;base64,'.base64_encode($rows['img1']).'">';
                    ?>
                </div>
            </div>

            <div id="product_description">
                <?php
                    echo $rows['description'];
                ?>
            </div>

            <div id="product_content">
                
            </div>
            <?php
                }}}
                else{
                    echo "Error description " . $conn->error;
                }
            ?>
        </div>


        <script>
            function change_image(){
                var id=e.id;
                var big_image=document.getElementById="big_image";
                if(id=="image1"){
                    big_image.innerHtml="<?php echo '<img width="50" height="50" onmouseover="change_image(e)" id="image1" src="data:image;base64,'.base64_encode($rows['img1']).'">'; ?>"
                }
                else if(id=="image2"){
                    big_image.innerHtml="<?php echo '<img width="50" height="50" onmouseover="change_image(e)" id="image2" src="data:image;base64,'.base64_encode($rows['img2']).'">'; ?>"
                }
                else if(id=="image3"){
                    big_image.innerHtml="<?php echo '<img width="50" height="50" onmouseover="change_image(e)" id="image3" src="data:image;base64,'.base64_encode($rows['img3']).'">'; ?>"
                }
            }
        </script>

    </body>    
</html>