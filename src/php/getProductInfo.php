<?php
	header("Access-Control-Allow-Origin: *");//这个必写，否则报错
	$mysqli=new mysqli('localhost','root','root','product');//根据自己的数据库填写
 
  $id = (int)$_POST['id'];

	$sql="select * from product";
	$res=$mysqli->query($sql);

  while ($row=$res->fetch_assoc()) {
    if($row['id'] == $id) {
      echo $row["name"].",".$row["pic"].",".$row["price"];
      exit;
    }
  }

  echo 'error';
	$res->free();

	//关闭连接
	$mysqli->close();
	 
?>