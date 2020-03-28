<?php
    $servername="localhost";
    $username="root";
    $pass="";
    $db="ecommerce";
    $conn=new mysqli($servername,$username,$pass,$db);
    $sno=0;
    if($conn->connect_error){
        die("Connection falied : ". $conn->connect_error);
    }
    else{
        $q1="select * from products";
    }
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="manage_product.css">
</head>
<body>
    <div id="product_list">
        <h3 id="top">Manage Product</h3>
        <div id="product_table_div">
            <table id="product_table">
                <tr id="row_head">
                    <th id="sno">#</th>
                    <th id="name">Product name</th>
                    <th id="category">Category</th>
                    <th id="subcategory">Sub-category</th>
                    <th id="company">Company</th>
                    <th id="description">Description</th>
                    <th id="action">Action</th>
                </tr>
                <?php
                if( $result1=$conn->query($q1)){
                    while($rows=$result1->fetch_assoc()){
                        $sno++;
                ?>
                    <tr>
                        <td><?php echo $sno; ?></td>
                        <td><?php echo $rows['name'];?></td>
                        <td><?php echo $rows['category'];?></td>
                        <td><?php echo $rows['subcategory'];?></td>
                        <td><?php echo $rows['company'];?></td>
                        <td><?php echo $rows['description'];?></td>
                        <td><button id="product_edit" onclick="categroy_edit('<?php echo $rows['name'];?>')"><i class='fa fa-edit'></i></button>
                            <button id="product_delete" onclick="category_delete('<?php echo $rows['name'];?>')"><i class='fa fa-window-close'></i></button>
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