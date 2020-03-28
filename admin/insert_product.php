<?php
    $servername="localhost";
    $username="root";
    $pass="";
    $db="ecommerce";
    $conn=new mysqli($servername,$username,$pass,$db);
    $confirm=true;
    $category=$scategory=$name=$company=$oprice=$sprice=$desc=$shipping=$availiability="";
    $img1content=$img2content=$img3content="";
    $target_dir = "images/";
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
        $q1="select * from product_category";
        $q2="select * from product_subcategory";
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(empty($_POST['category'])){
                echo "<script>alert('No category selected');</script>";
                $confirm=false;
            }
            else{
                $category=test_input($_POST['category']);
            }
            if(empty($_POST['subcategory'])){
                echo "<script>alert('No Sub-Category selected');</script>";
                $confirm=false;
            }
            else{
                $scategory=test_input($_POST['subcategory']);
            }
            if(empty($_POST['name'])){
                echo "<script>alert('Product name cannot be empty');</script>";
                $confirm=false;
            }
            else{
                $name=test_input($_POST['name']);
            }
            if(empty($_POST['company'])){
                echo "<script>alert('product company cannot be empty');</script>";
                $confirm=false;
            }
            else{
                $company=test_input($_POST['company']);
            }
            if(empty($_POST['price'])){
                echo "<script>alert('product original price cannot be empty');</script>";
                $confirm=false;
            }
            else{
                $oprice=test_input($_POST['price']);
            }
            if(empty($_POST['after_price'])){
                echo "<script>alert('product selling price cannot be empty');</script>";
                $confirm=false;
            }
            else{
                $sprice=test_input($_POST['after_price']);
            }
            if(empty($_POST['desc'])){
                echo "<script>alert('product description cannot be empty');</script>";
                $confirm=false;
            }
            else{
                $desc=test_input($_POST['desc']);
            }
            if(empty($_POST['s_charges'])){
                echo "<script>alert('product shipping charges not specified');</script>";
                $confirm=false;
            }
            else{
                $shipping=test_input($_POST['s_charges']);
            }
            if(empty($_POST['p_availiability'])){
                echo "<script>alert('product availiability not specified');</script>";
                $confirm=false;
            }
            else{
                $availiability=test_input($_POST['p_availiability']);
            }
            $check1=getimagesize($_FILES["image1"]["tmp_name"]);
            $check2=getimagesize($_FILES["image2"]["tmp_name"]);
            $check3=getimagesize($_FILES["image3"]["tmp_name"]);
            if($check1==false || $check2==false || $check3==false){
                $confirm=false;
            }
            else{
                $image1 = $_FILES['image1']['tmp_name'];
                $image2 = $_FILES['image2']['tmp_name'];
                $image3 = $_FILES['image3']['tmp_name'];
                $img1content = addslashes(file_get_contents($image1));
                $img2content = addslashes(file_get_contents($image2));
                $img3content = addslashes(file_get_contents($image3));
            }
            if($confirm==true){
                $q3="insert into products values('$category','$scategory','$name','$company','$oprice','$sprice','$desc','$shipping','$availiability','$img1content','$img2content','$img3content')";
                if(!$conn->query($q3)){
                    echo "<script>alert('Product not inserted');</script>";
                }
                else{
                    echo "<script>alert('Product inserted successfully');</script>";
                }
            }



        }
    }
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="insert_product.css">
</head>
<body>
    <div id="insert_product" style="margin-top:10;">
        <h3 id="top">Insert product</h3>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
        <div id="category">category
            <select name="category" id="category_list" style="margin-left:67px;font-size:16px;width:250px;">
                <option value="" disabled selected>Select category</option>
                <?php
                    if($result1=$conn->query($q1)){
                        while($rows=$result1->fetch_assoc()){
                ?>
                    <option value="<?php echo $rows['category_name'];?>"><?php echo $rows['category_name'];?></option>
                <?php
                   }}
                ?>
            </select>
        </div><hr>

        <div id="subcategory">Sub-category
            <select name="subcategory" id="subcategory_list" style="margin-left:30px;font-size:16px;width:250px;">
                <option value="" disabled selected>Select sub-category</option>
                <?php
                    if($result2=$conn->query($q2)){
                        while($rows=$result2->fetch_assoc()){
                ?>
                    <option value="<?php echo $rows['subcategory_name'];?>"><?php echo $rows['subcategory_name'];?></option>
                <?php
                   }}
                ?>
            </select>
        </div><hr>

        <div id="product_name">Product Name <input type="text" name="name" id="name" placeholder="Enter product Name" style="margin-left:140px;"></div><hr>
        <div id="product_company">Product Company <input type="text" name="company" id="company" placeholder="Enter product company" style="margin-left:110px;"></div><hr>
        <div id="product_price">Product Price before discount <input type="text" name="price" id="price" placeholder="Enter product original price" style="margin-left:17px;"></div><hr>
        <div id="after_price">Product price after discount <input type="text" name="after_price" id="after_price" placeholder="Enter product selling price" style="margin-left:33px;"></div><hr>
        <div id="product_desc">Product description <input type="text" name="desc" id="desc" placeholder="Enter product description" style="margin-left:100px;"></div><hr>
        <div id="shipping_charges">Product shipping charges <input type="text" name="s_charges" id="s_charges" placeholder="Enter product shipping charges" style="margin-left:54px;"></div><hr>
        <div id="product_availiability">Product availiability
            <select name="p_availiability" id="p_availiability" style="font-size:16px;margin-left:20px;width:250px;">
                <option value="" disabled selected>product availiability</option>
                <option value="In stock">In stock</option>
                <option value="Out of stock">Out of stock</option>
            </select>
        </div><hr>
        <div id="product_image1">Product image 1<input type="file" name="image1" id="image1" value="Choose file" style="font-size:15px;margin-left:20px;margin-right:10px;widht:150px"></div>
        <div id="product_image2">Product image 2<input type="file" name="image2" id="image2" value="Choose file" style="font-size:15px;margin-left:20px;margin-right:10px;widht:150px"></div>
        <div id="product_image3">Product image 3<input type="file" name="image3" id="image3" value="Choose file" style="font-size:15px;margin-left:20px;margin-right:10px;widht:150px"></div>
        
        <input type="submit" value="Insert" id="insert_btn">
        </form>
    </div>
</body>
</html>