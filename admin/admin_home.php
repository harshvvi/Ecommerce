<?php
    $servername="localhost";
    $username="root";
    $password="";
    $db="Ecommerce";
    $conn=new mysqli($servername,$username,$password,$db);
    function test_input($data){
        $data=stripslashes($data);
        $data=trim($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    $pass=$new_pass=$conf_pass="";
    $passErr=$new_passErr=$conf_passErr="";
    if($conn->connect_error){
        die("connection failed: ".$conn->connect_error);
    }
    else{
        $confirm=true;
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["curr_pass"])){
                $passErr="current password not entered";
                $confirm=false;
            }
            else{
                $pass=test_input($_POST["curr_pass"]);
            }
            if(empty($_POST["new_pass"])){
                $new_passErr="new password not entered";
                $confirm=false;
            }
            else{
                $new_pass=test_input($_POST["new_pass"]);
            }
            if(empty($_POST["conf_pass"])){
                $conf_passErr="password not confirmed";
                $confirm=false;
            }
            else{
                $conf_pass=test_input($_POST["conf_pass"]);
            }
            if($confirm==true){
                if($new_pass!=$conf_pass){
                    $conf_passErr="password confirmation does not match";
                }
                else{
                    $q1="select * from admin where pass='$pass'";
                    $result=$conn->query($q1);
                    if($result->num_rows>0){
                        $row=$result->fetch_assoc();
                        $q2="update admin set pass='$new_pass' where username='".$row['username']."' ";
                        $conn->query($q2);
                        echo "<script>alert('password updated succesfully')<script>";
                    }
                    else{
                        $passErr="password does not exist";
                    }
                }
            }
        }
        $conn->close();
    }
?>
<html>
<head>
    <title>Admin Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin_home.css">
</head>
<body>
    <header id="top">
        <nav id="top_nav">
            <h1 id="heading">Admin Portal</h1>
            <a href="admin_Login.php" id="logout"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
        </nav>
    </header>

    <div id="side_div">
        <nav id="side_nav">
            <button id="order_manage" onclick="ordersfun()"><i class="fa fa-cog" aria-hidden="true"></i>Order Management<i class="fa fa-arrow-down" aria-hidden="true"></i></button>
                <div id="orders">
                    <button id="today_order"><i class="fa fa-bars" aria-hidden="true"></i>Today's orders</button>
                    <hr>
                    <button id="pending_order"><i class="fa fa-bars" aria-hidden="true"></i>Pending orders</button>
                    <hr>
                    <button id="delivered_order"><i class="fa fa-envelope-open" aria-hidden="true"></i>Delivered orders</button>
                </div>        
            <hr>
            <button id="manage_users" ><i class="fa fa-users" aria-hidden="true"></i>Manage Users</button>
            <hr>
            <button id="create_category" onclick="create_category()"><i class="fa fa-bars" aria-hidden="true"></i>Create category</button>
            <hr>
            <button id="sub_category" onclick="create_subcategory()"><i class="fa fa-bars" aria-hidden="true"></i>Sub category</button>
            <hr>
            <button id="insert_producr" onclick="insert_product()"><i class="fa fa-file-text-o" aria-hidden="true"></i>Inset products</button>
            <hr>
            <button id="manage_product" onclick="manage_product()"><i class="fa fa-calendar" aria-hidden="true"></i>Manage products</button>
            <hr>
            <button id="user_login_log"><i class="fa fa-bars" aria-hidden="true"></i>User login log</button>
            <hr>
        </nav>

        <div id="body">
            <div id="change_pass">
                <h3 id="change_heading">Admin change password</h3>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="change_form">
                    <div id="curr_div"><span>Current password</span><input type="text" name="curr_pass" id="curr_pass" placeholder="Enter your current password">
                    
                    </div><span class="error"> <?php echo $passErr;?></span>
                    <div id="new_div">
                    <span>New password</span><input type="text" name="new_pass" id="new_pass" placeholder="Enter your new password">
                    
                    </div><span class="error"> <?php echo $new_passErr;?></span>
                    <div id="conf_div">
                    <span>Confirm password</span><input type="text" name="conf_pass" id="conf_pass" placeholder="Confirm your new password">
                    
                    </div><span class="error"><?php echo $conf_passErr;?></span>
                    <input type="submit" value="Submit" style="width:100px;background-color:rgb(155, 155, 194);margin-left:300px;margin-top:20px;">
                </form>
            </div>
        </div>
    </div>
    


    <script>
        var orders=document.getElementById("orders");
        function ordersfun(){
            if(orders.style.display=="none"){
                orders.style.display="block";
            }
            else{
                orders.style.display="none";
            }  
        }
        function create_category(){
            var body=document.getElementById("body");
            body.innerHTML = "<object style=\overflow:hidden; width: 99.25%; height: 101%\" width=\"100%\" height=\"101%\" data=\"http://localhost/php_project/Ecommerce/admin/create_category.php\"></object>"
        }
        function create_subcategory(){
            var body=document.getElementById("body");
            body.innerHTML="<object style=\overflow:hidden; width: 99.25%; height: 101%\" width=\"100%\" height=\"101%\" data=\"http://localhost/php_project/Ecommerce/admin/create_subcategory.php\"></object>"
        }
        function insert_product(){
            var body=document.getElementById("body");
            body.innerHTML="<object style=\overflow:hidden; width: 99.25%; height: 121%\" width=\"100%\" height=\"121%\" data=\"http://localhost/php_project/Ecommerce/admin/insert_product.php\"></object>"
        }
        function manage_product(){
            var body=document.getElementById("body");
            body.innerHTML="<object style=\overflow:hidden; width: 99.25%; height: 121%\" width=\"100%\" height=\"121%\" data=\"http://localhost/php_project/Ecommerce/admin/manage_product.php\"></object>" 
        }
    </script>
</body>
</html>