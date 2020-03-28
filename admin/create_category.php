<?php 
    $servername="localhost";
    $username="root";
    $pass="";
    $db="ecommerce";
    $conn=new mysqli($servername,$username,$pass,$db);
    $cname=$cdesc="";
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
        if($_SERVER["REQUEST_METHOD"]=='POST'){
            $date = date('m/d/Y ', time());
            if(empty($_POST['name'])){
                echo "<script>alert('category cannot be empty');</script>";
            }
            else{
                $cname=test_input($_POST['name']);
            }
            if(empty($_POST['desc'])){
                echo "<script>alert('category description cannot be empty');</script>";
            }
            else{
                $cdesc=test_input($_POST['desc']);
            }
            $q1="select * from product_category where category_name='$cname'";
            $result1=$conn->query($q1);
            if($result1->num_rows>0){
                echo "<script>alert('Category already exists');</script>";
            }
            else{
                $q2="insert into product_category values('$cname','$cdesc','$date')";
                if($conn->query($q2)===true){
                    echo "<script>alert('Category successfully created');</script>";
                }
            }
        }
        $q3="select * from product_category";
    }
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="create_category.css">
</head>
<body>
    <div id="create_category">
        <h2 id="top">Create Category</h2>
        <div id="create_category_form">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                <div id="name_div">Category name <input type="text" name="name" id="name" placeholder="Enter category name"></div>
                <div id="desc_div">Category description <input type="text" name="desc" id="desc" placeholder="Enter category description"></div>
                <input type="submit" value="Create">
            </form>
        </div>
    </div><hr>
    <div id="category_list">
        <h3 id="second_top">Manage Category</h3>
        <div id="category_table_div">
            <table id="category_table">
                <tr id="row_head">
                    <th id="sno">#</th>
                    <th id="category">Category</th>
                    <th id="description">Description</th>
                    <th id="doc">Date of creation</th>
                    <th id="action">Action</th>
                </tr>
                <?php
                if( $result2=$conn->query($q3)){
                    while($rows=$result2->fetch_assoc()){
                        $sno++;
                ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <td><?php echo $rows['category_name'];?></td>
                        <td><?php echo $rows['category_desc'];?></td>
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


    <script type="text/javascript">
        function category_edit(name){

        }
        function category_delete(name){
            <?php 
            ?>
        }
    </script>
</body>
</html>