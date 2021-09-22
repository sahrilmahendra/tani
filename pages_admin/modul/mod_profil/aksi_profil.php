<?php
include "../../../config/koneksi.php";

if(isset($_POST['profil'])){
	$user = mysql_real_escape_string(htmlentities($_POST['username']));
	$passl = mysql_real_escape_string(htmlentities(md5($_POST['passl'])));
	$passb = mysql_real_escape_string(htmlentities(md5($_POST['passb'])));
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
 
	$sql = mysql_query("SELECT * FROM user WHERE nik='$user'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0){
		
	}else{
		$row = mysql_fetch_assoc($sql);
		if ($passl==$row['password']){
				$sql = mysql_query("UPDATE user SET
				nama		='$nama',
				email		='$email',
				telp		='$telp',
				password	='$passb',
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
				WHERE nik=$user") or die(mysql_error());
				
				echo '<script language="javascript">alert("Profil Berhasil diubah!"); document.location="../../index.php";</script>';
		}else{
			echo '<script language="javascript">alert("Password lama yang Anda masukkan salah!"); document.location="../../media.php?profil";</script>';
		}
	}
}

?>
