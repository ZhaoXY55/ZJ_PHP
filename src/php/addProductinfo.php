<?php
	header("Access-Control-Allow-Origin: *");//这个必写，否则报错
	$mysqli=new mysqli('localhost','root','root','product');//根据自己的数据库填写
 
  $name = $_POST['name'];
  $pic = $_POST['pic'];
  $price = $_POST['price'];
  $status = $_POST['status'];

	$sql="select * from product";
	$res=$mysqli->query($sql);

  $sql = "INSERT INTO product(name,pic,price,status) VALUES ('$name','$pic','$price','$status')";
  if ($mysqli->query($sql)) {
    echo "success";
    exit;
  }
  else {
    echo "error";
    exit;
  };

	$res->free();

	//关闭连接
	$mysqli->close();
	 
?>