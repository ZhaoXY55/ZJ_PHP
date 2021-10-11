<?php
	header("Access-Control-Allow-Origin: *");//这个必写，否则报错
	$mysqli=new mysqli('localhost','root','root','product');//根据自己的数据库填写
 
  $type = $_POST['type'];
  $id = $_POST['id'];
  $name = $_POST['name'];
  $pic = $_POST['pic'];
  $price = $_POST['price'];
  $status = $_POST['status'];

	$sql="select * from product";
	$res=$mysqli->query($sql);

  if($type == 'updateAll') {
    while ($row=$res->fetch_assoc()) {
      if($row['id'] == $id) {
        // sql修改语句
        $sql = "UPDATE product SET name = '$name',pic = '$pic',price = '$price' WHERE id = '$id'";
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
  }

  if($type == 'updateStatus') {
    while ($row=$res->fetch_assoc()) {
      if($row['id'] == $id) {
        $sql = "UPDATE product SET status = '$status' WHERE id = '$id'";
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
  }

	$res->free();

	//关闭连接
	$mysqli->close();
	 
?>