<?php
    $servername="localhost";
    $username="root";
    $pass="";
    $db="ecommerce";
    $conn=new mysqli($servername,$username,$pass,$db);
    $scname=$scdesc=$cname="";
    $sno=0;
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
        if($_SERVER["REQUEST_METHOD"]=='POST'){
            $date = date('m/d/Y ', time());
            if(empty($_POST['name'])){
                echo "<script>alert('Sub-Category cannot be empty');</script>";
            }
            else{
                $scname=test_input($_POST['name']);
            }
            if(empty($_POST['desc'])){
                echo "<script>alert('Sub-Category description cannot be empty');</script>";
            }
            else{
                $scdesc=test_input($_POST['desc']);
            }
            if(empty($_POST['category'])){
                echo "<script>alert('No category selected');</script>";
            }
            else{
                $cname=$_POST['category'];
            }
            $q2="select * from product_subcategory where category_name='$cname'";
            $result2=$conn->query($q2);
            if($result2->num_rows>0){
                echo "<script>alert('Sub-Category already exists');</script>";
            }
            else{
                $q3="insert into product_subcategory values('$scname','$scdesc','$cname','$date')";
                if($conn->query($q3)===true){
                    echo "<script>alert('Sub-Category created successfully');</script>";
                }
            }
        }
        $q4="select * from product_subcategory";
    }
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="create_subcategory.css">
</head>
<body>
    <div id="create_subcategory">
        <h3 id="top">Create Sub-Category</h3>
        <div id="create_subcategory_form">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                <div id="category">Catgory 
                    <select name="category" id="category_list">
                        <option value="" disabled selected>Select Category</option>
                    <?php 
                        if($result1=$conn->query($q1)){
                            while($rows=$result1->fetch_assoc()){
                    ?>
                        <option value="<?php echo $rows['category_name'];?>"><?php echo $rows['category_name'];?></option>
                    <?php            
                        } }
                    ?>
                
                    </select>
                </div>
                <div id="name_div">Sub-Category name <input type="text" name="name" id="name" placeholder="Enter category name"></div>
                <div id="desc_div">Sub-Category description <input type="text" name="desc" id="desc" placeholder="Enter sub-category description"></div>
                <input type="submit" value="Create" id="sub_btn">
            </form>
        </div>
    </div><hr>


    <div id="subcategory_list">
        <h3 id="second_top">Manage Sub-Category</h3>
        <div id="subcategory_table_div">
            <table id="subcategory_table">
                <tr id="row_head">
                    <th id="sno">#</th>
                    <th id="category">Category</th>
                    <th id="subcategory">Sub-Category</th>
                    <th id="description">Description</th>
                    <th id="doc">Date of creation</th>
                    <th id="action">Action</th>
                </tr>
                <?php
                    if($result4=$conn->query($q4)){
                        while($rows=$result4->fetch_assoc()){
                            $sno++;
                ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <td><?php echo $rows['category'];?></td>
                        <td><?php echo $rows['subcategory_name'];?></td>
                        <td><?php echo $rows['subcategory_desc'];?></td>
                        <td><?php echo $rows['creation_date'];?></td>
                        <td><button id="category_edit" onclick="categroy_edit('<?php echo $rows['category_name'];?>')"><i class='fa fa-edit'></i></button>
                            <button id="category_delete" onclick="category_delete('<?php echo $rows['category_name'];?>')"><i class='fa fa-window-close'></i></button>
                        </td>
                    </tr>
                <?php
                    }}
                ?>
            </table>
        </div>
    </div>
</body>
</html>