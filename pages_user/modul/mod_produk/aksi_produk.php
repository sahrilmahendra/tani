<?php
include "../../../config/koneksi.php";
$user = $_POST['id_user'];

$sqlsql = mysql_query("SELECT * FROM order_temp WHERE id_user='$user'") or die(mysql_error());
if(mysql_num_rows($sqlsql) == 0){
	echo '<script language="javascript">alert("Keranjang belanja masih kosong!"); document.location="../../media.php?produk";</script>';
}else{
$date=date('Y/m/d H:i:s');
$total = $_POST['total'];

$sqlquery = mysql_query("SELECT * FROM saldo WHERE id_user='$user' ORDER BY tanggal DESC") or die(mysql_error());
$rowquery=mysql_fetch_array($sqlquery);
if($rowquery['saldo'] < $total){
	echo '<script language="javascript">alert("Saldo anda tidak cukup!"); document.location="../../media.php?produk";</script>';
}else{
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
$nota = create_random(10);

$sql = mysql_query("SELECT * FROM pembelian WHERE no_nota='$nota'") or die(mysql_error());
if(mysql_num_rows($sql) == 0){

	$sql2 = mysql_query("INSERT INTO pembelian (no_nota,tanggal,total,status,id_user)
	VALUE ('$nota','$date','$total','baru','$user')") or die(mysql_error());
	
	$sql1 = mysql_query("SELECT * FROM order_temp WHERE id_user='$user'") or die(mysql_error());
	while($row1=mysql_fetch_array($sql1)) {
	$sql2 = mysql_query("INSERT INTO detail_pembelian (no_nota,id_produk,jumlah,harga)
	VALUE ('$nota','$row1[item_id]','$row1[item_quantity]','$row1[item_price]')") or die(mysql_error());
	}$sql3 = mysql_query("DELETE FROM order_temp WHERE id_user='$user'") or die(mysql_error());
	
	$query=mysql_query("SELECT *FROM saldo WHERE id_user='$user' ORDER BY tanggal DESC");
	$row=mysql_fetch_array($query);
	$saldo=$row['saldo'];
	$saldo_akhir=$saldo-$total;
	$query1 = mysql_query("INSERT INTO saldo (id_user,tanggal,keluar,saldo)
	VALUE ('$user','$date','$total','$saldo_akhir')") or die(mysql_error());
	
	echo '<script language="javascript">alert("Pembelian Berhasil!"); document.location="../../media.php?dashboard";</script>';
}/*else{
		echo '<script language="javascript">alert("Tidak Berhasil!"); document.location="../../media.php?produk";</script>';
	}*/
}
}
?>
