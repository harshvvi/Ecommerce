<?php
    $servername="localhost";
    $username="root";
    $password="";
    $db="ecommerce";
    $conn=new mysqli($servername,$username,$password,$db);
    $nameErr=$emailErr=$passErr=$conf_passErr=$contactErr=$addressErr=$date="";
    $name=$email=$pass=$conf_pass=$contact=$address=$gender="";
    $confirm=true;
    function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }
    else{
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["name"])){
                $nameErr="Name is required";
                $confirm=false;
            }
            else{
                $name=test_input($_POST["name"]);
            }
            if(empty($_POST["email"])){
                $emailErr="Email is required";
                $confirm=false;
            }
            else{
                $email=test_input($_POST["email"]);
            }
            if(empty($_POST["pass"])){
                $passErr="Password is required";
                $confirm=false;
            }
            else{
                $pass=test_input($_POST["pass"]);
            }
            if(empty($_POST["conf_pass"])){
                $conf_passErr="Password confirmation is required";
                $confirm=false;
            }
            else{
                $conf_pass=test_input($_POST["conf_pass"]);
            }
            if(empty($_POST["contact"])){
                $contactErr="Contact is required";
                $confirm=false;
            }
            else{
                $contact=test_input($_POST["contact"]);
            }
            if(empty($_POST["address"])){
                $addressErr="Address is required";
                $confirm=false;
            }
            else{
                $address=test_input($_POST["address"]);
            }
            if(empty($_POST["gender"])){}
            else{
                $gender=test_input($_POST["gender"]);
            }
            date_default_timezone_set('Indian/Maldives');
            $date=date('d/m/Y');
            if($confirm==true){
                if($pass!=$conf_pass){
                    $conf_passErr="password confirmation does not match";
                }
                else{
                    $q1="select * from registered_users where name='$name'";
                    $result=$conn->query($q1);
                    if($result->num_rows>0){
                        echo "<script>alert('User already registered');</script>";
                    }
                    else{
                        $q2="insert into registered_users values('$name','$email','$pass','$contact','$address','$gender','$date')";
                        if($conn->query($q2)==true){
                            echo "<script>alert('User registered Successfully');</script>";
                        }
                    }
                }
            }

        }
        $conn->close();
    }
?>
<html>
<head>
    <title>User Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="user_signup.css">
</head>
<body>
    
    <header id="header">
        <nav id="top_nav">
            <a href="index.php" id="site_name"><h2 id="site">Shopping Portal</h2></a>
            <div id="search">
                <input type="text" name="search" id="search_bar" placeholder="Search products here"><button type="submit" id="search_btn"><i class="fa fa-search"></i></button>
            </div>
            <a href="#" id="cart"><i class="fa fa-shopping-cart fa-2x"></i>Cart</a>
            <div id="login_drop">
                <a href="login.php" id="login">Login</a>
                <div id="login_content">
                    <a href="#" id="account">Your account</a>
                    <a href="#" id="orders">Your orders</a>
                    <a href="#" id="wishlist">Wishlist</a>
                    <hr>
                </div>
            </div>
        </nav>
    </header>

    <div id="signup_div">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2 id="signup_head">CREATE NEW ACCOUNT</h2>
            <hr>
            <h3 id="signup_subhead">create your own shopping account</h3>
            Full Name * <span class="error"><?php echo $nameErr;?></span><input type="text" name="name" id="name" placeholder="Enter name">
            Email * <span class="error"><?php echo $emailErr;?></span><input type="email" name="email" id="email" placeholder="Enter email">
            Password * <span class="error"><?php echo $passErr;?></span><input type="password" name="pass" id="pass" placeholder="Enter password">
            Confirm Password * <span class="error"><?php echo $conf_passErr;?></span><input type="password" name="conf_pass" id="conf_pass" placeholder="Confirm password">
            Contact No. * <span class="error"><?php echo $contactErr;?></span><input type="number" name="contact" id="contact" placeholder="Enter contact">
            Gender <div id="gender">
                   <input type="radio" name="gender">Male
                   <input type="radio" name="gender">Female
                   <input type="radio" name="gender">Others <br>
            </div>
            Address *<span class="error"><?php echo $addressErr;?></span><input type="text" name="address" id="address" placeholder="Enter full address">
            <input type="submit" value="Sign up" id="signup_btn">
        </form>
    </div>
</body>
</html>