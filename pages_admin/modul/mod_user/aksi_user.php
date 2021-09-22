<?php
include "../../../config/koneksi.php";

if(isset($_POST['tambah'])){
	$user = mysql_real_escape_string(htmlentities($_POST['username']));
	$pass = mysql_real_escape_string(htmlentities(md5($_POST['password'])));
	$nama = mysql_real_escape_string(htmlentities($_POST['nama']));
	$email = mysql_real_escape_string(htmlentities($_POST['email']));
	$telp = mysql_real_escape_string(htmlentities($_POST['telp']));
	$tmp_lhr = mysql_real_escape_string(htmlentities($_POST['tmp_lhr']));
	$tgl_lhr = mysql_real_escape_string(htmlentities($_POST['tgl_lhr']));
	$jk = mysql_real_escape_string(htmlentities($_POST['jk']));
	$alamat = mysql_real_escape_string(htmlentities($_POST['alamat']));
	$rtrw = mysql_real_escape_string(htmlentities($_POST['rtrw']));
	$dusun = mysql_real_escape_string(htmlentities($_POST['dusun']));
	$desa = mysql_real_escape_string(htmlentities($_POST['desa']));
	$kecamatan = mysql_real_escape_string(htmlentities($_POST['kecamatan']));
	$kabupaten = mysql_real_escape_string(htmlentities($_POST['kabupaten']));
	$provinsi = mysql_real_escape_string(htmlentities($_POST['provinsi']));
 
	$sql = mysql_query("SELECT * FROM user WHERE level='user' AND nik='$user'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0){
		$sql = mysql_query("INSERT INTO user (nik,nama,email,telp,password,tmp_lhr,tgl_lhr,jk,alamat,rtrw,dusun,desa,kecamatan,kabupaten,provinsi)
		VALUE ('$user','$nama','$email','$telp','$pass','$tmp_lhr','$tgl_lhr','$jk','$alamat','$rtrw','$dusun','$desa','$kecamatan','$kabupaten','$provinsi')") or die(mysql_error());
		
		echo '<script language="javascript">alert("Profil Pengguna berhasil didaftarkan!"); document.location="../../media.php?user";</script>';
		
	}else{
		
		echo '<script language="javascript">alert("NIK Pengguna telah terdaftar!"); document.location="../../media.php?user";</script>';
		
	}
}

if(isset($_POST['ubah'])){
	$user = mysql_real_escape_string(htmlentities($_POST['username']));
	$password = mysql_real_escape_string(htmlentities(md5($_POST['password'])));
	$nama = mysql_real_escape_string(htmlentities($_POST['nama']));
	$email = mysql_real_escape_string(htmlentities($_POST['email']));
	$telp = mysql_real_escape_string(htmlentities($_POST['telp']));
	$tmp_lhr = mysql_real_escape_string(htmlentities($_POST['tmp_lhr']));
	$tgl_lhr = mysql_real_escape_string(htmlentities($_POST['tgl_lhr']));
	$jk = mysql_real_escape_string(htmlentities($_POST['jk']));
	$alamat = mysql_real_escape_string(htmlentities($_POST['alamat']));
	$rtrw = mysql_real_escape_string(htmlentities($_POST['rtrw']));
	$dusun = mysql_real_escape_string(htmlentities($_POST['dusun']));
	$desa = mysql_real_escape_string(htmlentities($_POST['desa']));
	$kecamatan = mysql_real_escape_string(htmlentities($_POST['kecamatan']));
	$kabupaten = mysql_real_escape_string(htmlentities($_POST['kabupaten']));
	$provinsi = mysql_real_escape_string(htmlentities($_POST['provinsi']));
 
	$sql = mysql_query("SELECT * FROM user WHERE level='user' AND nik='$user'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0){
		
	}else{
		$row = mysql_fetch_assoc($sql);
				$sql = mysql_query("UPDATE user SET
				nama		='$nama',
				email		='$email',
				telp		='$telp',
				password	='$password',
				tmp_lhr		='$tmp_lhr',
				tgl_lhr		='$tgl_lhr',
				jk			='$jk',
				alamat		='$alamat',
				rtrw		='$rtrw',
				dusun		='$dusun',
				desa		='$desa',
				kecamatan	='$kecamatan',
				kabupaten	='$kabupaten',
				provinsi	='$provinsi'
				WHERE nik='$user'") or die(mysql_error());
				
				echo '<script language="javascript">alert("Profil Pengguna Berhasil diubah!"); document.location="../../media.php?user";</script>';
		}
}

if(isset($_POST['hapus'])){
	$user = $_POST['id_hapus'];
 
	$sql = mysql_query("DELETE FROM user WHERE level='user' AND nik='$user'") or die(mysql_error());

	echo '<script language="javascript">alert("Profil Pengguna Berhasil diubah!"); document.location="../../media.php?user";</script>';
}
?>
