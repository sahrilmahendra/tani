<?php
include('config/koneksi.php');

if(isset($_POST['daftar'])){
	
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
	$kel = mysql_real_escape_string(htmlentities($_POST['kel']));
	$kec = mysql_real_escape_string(htmlentities($_POST['kec']));
	$kab = mysql_real_escape_string(htmlentities($_POST['kota']));
	$prov = mysql_real_escape_string(htmlentities($_POST['prop']));
	
	$sqlprov=mysql_query("SELECT * FROM provinsi WHERE id_prov=$prov");
	$rowprov=mysql_fetch_array($sqlprov);
	$provinsi = mysql_real_escape_string(htmlentities($rowprov['nama']));
	$sqlkab=mysql_query("SELECT * FROM kabupaten WHERE id_kab=$kab");
	$rowkab=mysql_fetch_array($sqlkab);
	$kabupaten = mysql_real_escape_string(htmlentities($rowkab['nama']));
	$sqlkec=mysql_query("SELECT * FROM kecamatan WHERE id_kec=$kec");
	$rowkec=mysql_fetch_array($sqlkec);
	$kecamatan = mysql_real_escape_string(htmlentities($rowkec['nama']));
	$sqlkel=mysql_query("SELECT * FROM kelurahan WHERE id_kel=$kel");
	$rowkel=mysql_fetch_array($sqlkel);
	$desa = mysql_real_escape_string(htmlentities($rowkel['nama']));
 
	$sql = mysql_query("SELECT * FROM user WHERE nik='$user'") or die(mysql_error());
	
	if(mysql_num_rows($sql) == 0){
		
		$sql = mysql_query("INSERT INTO user (nik,nama,email,telp,password,tmp_lhr,tgl_lhr,jk,alamat,rtrw,dusun,desa,kecamatan,kabupaten,provinsi)
		VALUE ('$user','$nama','$email','$telp','$pass','$tmp_lhr','$tgl_lhr','$jk','$alamat','$rtrw','$dusun','$desa','$kecamatan','$kabupaten','$provinsi')") or die(mysql_error());
		
		echo '<script language="javascript">alert("Pendaftaran Berhasil!"); document.location="login.php";</script>';
	
	}else{
		echo '<script language="javascript">alert("NIK telah terdaftar!"); document.location="daftar.php";</script>';		
	}
}
?>