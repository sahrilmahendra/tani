<?php
include "../../../config/koneksi.php";
$d=date('Y/m/d');
$date=date('Y/m/d H:i:s');

function create_random($length)
{
    $data = 'ABCDEFGHIJKLMNOPQRSTU1234567890';
    $string = '';
    for($i = 0; $i < $length; $i++) {
        $pos = rand(0, strlen($data)-1);
        $string .= $data{$pos};
    }
    return $string;
}
$faktur = create_random(12);

if(isset($_POST['setor']))
{
	$user=$_POST['id_user'];
	$qry = mysql_query("SELECT nik FROM user WHERE nik='$user'") or die(mysql_error());
	if(mysql_num_rows($qry) == 0){
		echo '<script language="javascript">alert("User tidak terdaftar!"); document.location="../../media.php?setor";</script>';
	}else{
	
	$query = mysql_query("SELECT * FROM setoran WHERE no_faktur='$faktur'") or die(mysql_error());
	if(mysql_num_rows($query) == 0){
		
	$berat=$_POST['berat'];
	
	$q=mysql_query("SELECT *FROM gabah ORDER BY tanggal DESC");
	$r=mysql_fetch_array($q);
	$harga=$r['hrg_per_kg'];
	$total=$berat*$harga;
	
	$sql = mysql_query("INSERT INTO setoran (no_faktur,tanggal,berat,total,id_user)
	VALUE ('$faktur','$date','$berat','$total','$user')") or die(mysql_error());
	
	$query2=mysql_query("SELECT *FROM saldo WHERE id_user='$user' ORDER BY tanggal DESC");
	$row2=mysql_fetch_array($query2);
	$saldo=$row2['saldo'];
	$saldo_akhir=$saldo+$total;
	$sql2 = mysql_query("INSERT INTO saldo (id_user,tanggal,masuk,saldo)
	VALUE ('$user','$date','$total','$saldo_akhir')") or die(mysql_error());
	
		echo '<script language="javascript">alert("Setoran Telah Ditambahkan!"); document.location="../../media.php?setor";</script>';
	}/*else{
		echo '<script language="javascript">alert("Tidak Berhasil!"); document.location="../../media.php?setor";</script>';
	}*/
	}
}

if(isset($_POST['ganti']))
{
	$hrg=$_POST['hrg'];
	$sql = mysql_query("INSERT INTO gabah (tanggal,hrg_per_kg)
	VALUE ('$d','$hrg')") or die(mysql_error());
	
		echo '<script language="javascript">alert("Harga Telah Diperbaharui!"); document.location="../../media.php?setor";</script>';
}

?>
