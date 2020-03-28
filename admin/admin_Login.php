<?php 
    $name=$nameErr=$pass=$passErr="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["name"])){
            $nameErr="Username can't be empty";
        }
        else{
            $name=test_input($_POST["name"]);
        }
        if(empty($_POST["pass"])){
            $passErr="Password can't be empty";
        }
        else{
            $pass=test_input($_POST["pass"]);
        }
    }
    function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    if($name!="" && $pass!=""){
         if($name=="harshv2v2" && $pass=="Indore@123"){
        header("Location:admin_home.php");
        }
        else{
            echo "<script>alert('Incorrect Username or password');</script>";
        }
    }
?>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_login.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="login_form">
        <div id="head">Admin Login</div>
        Enter Username <input  class="a" type="text" name="name" id="name" placeholder="Enter Username">
        Enter Password <input class="a" type="password" name="pass" id="pass" placeholder="Enter Password">
        <input type="submit" value="Login">
    </form>   
</body>
</html>