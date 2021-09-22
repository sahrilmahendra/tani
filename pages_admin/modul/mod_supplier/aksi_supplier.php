<?php
include "../../../config/koneksi.php";

if(isset($_POST['tambah'])){
	$user = mysql_real_escape_string(htmlentities($_POST['username']));
	$nama = mysql_real_escape_string(htmlentities($_POST['nama']));
	$alamat = mysql_real_escape_string(htmlentities($_POST['alamat']));
	$email = mysql_real_escape_string(htmlentities($_POST['email']));
	$telp = mysql_real_escape_string(htmlentities($_POST['telp']));
 
	$sql = mysql_query("SELECT * FROM supplier WHERE id_supplier='$user'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0){
		$sql = mysql_query("INSERT INTO supplier (id_supplier,nama_supplier,alamat,email,telpon)
		VALUE ('$user','$nama','$alamat','$email','$telp')") or die(mysql_error());
		
		echo '<script language="javascript">alert("Data Supplier berhasil ditambahkan!"); document.location="../../media.php?supplier";</script>';
		
	}else{
		
		echo '<script language="javascript">alert("Data Supplier telah terdaftar!"); document.location="../../media.php?supplier";</script>';
		
	}
}

if(isset($_POST['ubah'])){
	$user = mysql_real_escape_string(htmlentities($_POST['username']));
	$nama = mysql_real_escape_string(htmlentities($_POST['nama']));
	$alamat = mysql_real_escape_string(htmlentities($_POST['alamat']));
	$email = mysql_real_escape_string(htmlentities($_POST['email']));
	$telp = mysql_real_escape_string(htmlentities($_POST['telp']));
 
	$sql = mysql_query("SELECT * FROM supplier WHERE id_supplier='$user'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0){
		
	}else{
				$sql = mysql_query("UPDATE supplier SET
				nama_supplier	='$nama',
				alamat			='$alamat',
				email			='$email',
				telpon			='$telp'
				WHERE id_supplier='$user'") or die(mysql_error());
				
				echo '<script language="javascript">alert("Data Supplier Berhasil diubah!"); document.location="../../media.php?supplier";</script>';
		}
}

if(isset($_POST['hapus'])){
	$user = $_POST['id_hapus'];
 
	$sql = mysql_query("DELETE FROM supplier WHERE id_supplier='$user'") or die(mysql_error());

	echo '<script language="javascript">alert("Data Supplier Berhasil diubah!"); document.location="../../media.php?supplier";</script>';
}
?>
