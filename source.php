<?php
    $servername="localhost";
    $username="root";
    $pass="";
    $db="ecommerce";
    $conn=new mysqli($servername,$username,$pass,$db);
    if($conn->connect_error){
        die("Connection Failed : " . $conn->connect_error);
    }
    else{
        $q1="select * from products";
        $result1=$conn->query($q1);
        while($rows=$result1->fetch_assoc()){
            header("Content-type: image/JPG");
            print $rows['img1'];
        }
    }
?>