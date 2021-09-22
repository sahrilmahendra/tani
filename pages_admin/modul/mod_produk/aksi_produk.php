<?php
include "../../../config/koneksi.php";
$d=date('Y/m/d H:i:s');

/*function UploadImage($fupload_name){
$ekstensi_diperbolehkan	= array('png','jpg');
$nama = $_FILES['gambar']['name'];
$x = explode('.', $nama);
$ekstensi = strtolower(end($x));
$ukuran	= $_FILES['gambar']['size'];
$file_tmp = $_FILES['gambar']['tmp_name'];	

if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
	if($ukuran < 1044070){			
		move_uploaded_file($file_tmp, '../../../fotoproduk/'.$nama);
		$query = mysql_query("INSERT INTO produk 
		(nama_produk,harga,gambar,deskripsi,tgl_masuk,id_supplier)
		VALUE ('$_POST[nama_produk]','$_POST[harga]','$nama','$_POST[deskripsi]','$d','$_POST[supplier]')");
		if($query){
			echo 'FILE BERHASIL DI UPLOAD';
		}else{
			echo 'GAGAL MENGUPLOAD GAMBAR';
		}
	}else{
		echo 'UKURAN FILE TERLALU BESAR';
	}
}else{
	echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
}
}*/

if(isset($_POST['tambah'])){
$ekstensi_diperbolehkan	= array('png','jpg');
$nama = $_FILES['gambar']['name'];
$x = explode('.', $nama);
$ekstensi = strtolower(end($x));
$ukuran	= $_FILES['gambar']['size'];
$file_tmp = $_FILES['gambar']['tmp_name'];	

if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
	if($ukuran < 1044070){			
		move_uploaded_file($file_tmp, '../../../fotoproduk/'.$nama);
		$query = mysql_query("INSERT INTO produk 
		(nama_produk,harga,gambar,deskripsi,tgl_masuk,id_supplier)
		VALUE ('$_POST[nama_produk]','$_POST[harga]','$nama','$_POST[deskripsi]','$d','$_POST[supplier]')") or die(mysql_error());
		if($query){
			echo '<script language="javascript">alert("Produk Berhasil Ditambahkan!"); document.location="../../media.php?produk";</script>';
		}else{
			echo '<script language="javascript">alert("Produk Gagal Ditambahkan!"); document.location="../../media.php?produk";</script>';
		}
	}else{
	echo '<script language="javascript">alert("Ukuran Gambar Terlalu Besar!"); document.location="../../media.php?produk";</script>';
	}
}else{
	echo '<script language="javascript">alert("Ekstensi File yang di Upload tidak di perbolehkan!"); document.location="../../media.php?produk";</script>';
}
}

if(isset($_POST['ubah'])){
$ekstensi_diperbolehkan	= array('png','jpg');
$nama = $_FILES['gambar']['name'];
$x = explode('.', $nama);
$ekstensi = strtolower(end($x));
$ukuran	= $_FILES['gambar']['size'];
$file_tmp = $_FILES['gambar']['tmp_name'];	

if(empty($file_tmp)){
	$query = mysql_query("UPDATE produk SET
		nama_produk	='$_POST[nama_produk]',
		harga		='$_POST[harga]',
		deskripsi	='$_POST[deskripsi]'
		WHERE id_produk='$_POST[id_produk]'
		") or die(mysql_error());
		if($query){
			echo '<script language="javascript">alert("Produk Berhasil Diubah!"); document.location="../../media.php?produk";</script>';
		}else{
			echo '<script language="javascript">alert("Produk Gagal Diubah!"); document.location="../../media.php?produk";</script>';
		}
}else{

if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
	if($ukuran < 1044070){			
		move_uploaded_file($file_tmp, '../../../fotoproduk/'.$nama);
		$query = mysql_query("UPDATE produk SET
		nama_produk	='$_POST[nama_produk]',
		harga		='$_POST[harga]',
		gambar		='$nama',
		deskripsi	='$_POST[deskripsi]'
		WHERE id_produk='$_POST[id_produk]'
		") or die(mysql_error());
		if($query){
			echo '<script language="javascript">alert("Produk Berhasil Ditambahkan!"); document.location="../../media.php?produk";</script>';
		}else{
			echo '<script language="javascript">alert("Produk Gagal Ditambahkan!"); document.location="../../media.php?produk";</script>';
		}
	}else{
	echo '<script language="javascript">alert("Ukuran Gambar Terlalu Besar!"); document.location="../../media.php?produk";</script>';
	}
}else{
	echo '<script language="javascript">alert("Ekstensi File yang di Upload tidak di perbolehkan!"); document.location="../../media.php?produk";</script>';
}
}
}

if(isset($_POST['hapus'])){
	$query=mysql_query("UPDATE produk SET aktif='T' WHERE id_produk='$_POST[id_hapus]'") or die(mysql_error());
	echo '<script language="javascript">alert("Produk Berhasil Dihapus!"); document.location="../../media.php?produk";</script>';
}
?>
