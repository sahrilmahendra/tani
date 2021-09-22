<?php
include('config/koneksi.php');

session_start();
include "timeout.php";
if(isset($_POST['login'])){
	$user = mysql_real_escape_string(htmlentities($_POST['username']));
	$pass = mysql_real_escape_string(htmlentities(md5($_POST['password'])));
 
	$sql = mysql_query("SELECT * FROM user WHERE nik='$user' AND password='$pass'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0){
		echo '<script language="javascript">alert("Username atau Password Salah!"); document.location="login.php";</script>';
	}else{
		$row = mysql_fetch_assoc($sql);
		$_SESSION['nama'] = $row['nama'];
		if($row['level'] == "admin"){
			$_SESSION['admin']=$user;
			echo '<script language="javascript">alert("Anda berhasil Login sebagai Admin!"); document.location="pages_admin/index.php";</script>';
		}
		else{
		if($row['level'] == "user"){
			$_SESSION['user']=$user;
			echo '<script language="javascript">alert("Anda berhasil Login sebagai User!"); document.location="pages_user/index.php";</script>';
			}
		}
	}
}
?>