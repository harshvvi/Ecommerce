<?php
    session_start();
    $servername="localhost";
    $username="root";
    $pass="";
    $db="ecommerce";
    $email=$pass="";
    $emailErr=$passErr="";
    $confirm=true;
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $conn=new mysqli($servername,$username,$pass,$db);
    if($conn->connect_error){
        die("Connection failed : " . $conn->connect_error);
    }
    else{
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["email"])){
                $emailErr="Email can't be empty";
                $confrim=false;
            }
            else{
                $email=test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                    $confirm=false;
                }
            }
            if(empty($_POST["pass"])){
                $passErr="Password can't be empty";
                $confirm=false;
            }
            else{
                $pass=test_input($_POST["pass"]);
            }
            if($confirm==true){
                $q1="select * from registered_users where email='$email' and password='$pass'";
                $result1=$conn->query($q1);
                if($result1->num_rows>0){
                    $row=$result1->fetch_assoc();
                    $_SESSION['logged_user']=$row['name'];
                    header("Location:index.php");
                }
                else{
                    echo "<script>alert('Email not registered');</script>";
                }
            }
        }
    }
    
?>
<html>
<head>
    <link rel="stylesheet" href="login.css">
</head>
<body >
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="login_form">
        <fieldset id="form_field" style="border:none;">
            <legend class="legend">Login form</legend>
            <div id="email_div">
                <label for="email" id="email_label">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter Email" value="<?php echo $email;?>">
                <span class="error">* <br><?php echo $emailErr;?></span>
            </div>
            <div id="pass_div">
                <label for="pass" id="pass_label">Password</label>
                <input type="password" name="pass" id="pass" placeholder="Enter password" value="<?php echo $pass;?>">
                <span class="error">* <br><?php echo $passErr;?></span>
            </div>
            <input type="submit" value="Login" id="login">
        </fieldset>
    </form>        
</body>
</html>