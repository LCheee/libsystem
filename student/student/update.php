<?php
	session_start();
	include('../../conn.php');
	$conn=new conn("SET NAMES UTF8");
	$conn->execute_sql();

	$rno=$_POST['ids'];
	$rname=$_POST['bname'];
	$password=sha1($_POST['password']);
	$passwordnew=sha1($_POST['passwordNew']);


	$conn->sql="SELECT password FROM ls_login WHERE rno='".$rno."'";
	$res=$conn->fetch_res();
	echo $res[0]['password'];
	if($res[0]['password']) != $password) {
		echo "2";
	} else  {
		$conn->sql="UPDATE reader SET rname='".$rname."',password='".$passwordnew."'";
		$status=$conn->execute_sql();
		if($status==1) {
			echo "1";
		} else {
			echo "0";
		}
	}

?>