<?php
	header("Access-Control-Allow-Origin: *");//这个必写，否则报错
	$mysqli=new mysqli('localhost','root','root','product');//根据自己的数据库填写
 
  $id = $_POST['id'];

	$sql="select * from product";
	$res=$mysqli->query($sql);


  while ($row=$res->fetch_assoc()) {
    if($row['id'] == $id) {
      // sql删除语句
      $sql = "DELETE FROM product WHERE id = '$id'";
      if ($mysqli->query($sql)) {
        echo "success";
        exit;
      }
      else {
        echo "error";
        exit;
      };
    }
  }

	$res->free();

	//关闭连接
	$mysqli->close();
	 
?>