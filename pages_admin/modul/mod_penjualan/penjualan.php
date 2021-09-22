<?php
include "../config/koneksi.php";
$date=date('Y/m/d');
$ldate=date('Y/m/d H:i:s');

if(!isset($_SESSION['admin'])){
	echo '<script language="javascript">alert("Anda harus Login Sebagai Admin!"); document.location="../login.php";</script>';
}
else
{
?>
<link href="../dist/css/style.css" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-green">
            <div class="panel-heading">
				<i class="fa fa-list-alt"></i>&ensp;Laporan Penjualan Produk
            </div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
				<?php 
if(isset($_GET['penjualan']) AND isset($_GET['awal']) AND isset($_GET['akhir'])){
	$awal=$_GET['awal'];
	$akhir=$_GET['akhir'];
	if($awal==''){
		$awal=$date;
	}
	if($akhir==''){
		$akhir=$ldate;
	}
	$query = mysql_query("SELECT * FROM pembelian WHERE tanggal BETWEEN '$awal' AND '$akhir' ORDER BY tanggal ASC") or die(mysql_error());

if(mysql_num_rows($query) == 0){
	echo "
	<center><p>Tidak ada laporan pada tanggal ";
	echo $awal;
	echo " sampai ";
	echo $akhir;
	echo "</p></center>";
}else{
echo "
<thead>
<tr>
<th> No Nota </th>
<th> Tanggal </th>
<th> Total </th>
<th> Status </th>
<th>  </th>
</tr>
</thead>
<tbody>
";
while($s=mysql_fetch_array($query)) {
$total=number_format($s['total'],0,".",",");
$nota=$s['no_nota'];
echo "
<form method='post' action='media.php?penjualan=detail&nota=$nota'>
<input type='hidden' name='no_nota' value='$nota' />
<tr>
<td>$s[no_nota]</td>
<td>$s[tanggal]</td>
<td>Rp.&nbsp;$total</td>
<td>$s[status]</td>
<td><input type='submit' name='detail' class='button btn-xs btn-warning btn-block' value='Detail' /></td>
</tr>
</form>
";
}
echo "
</tbody>";
}
}

if(isset($_GET['penjualan']) AND isset($_POST['detail'])){
	$no_nota=$_POST['no_nota'];
	$query1 = mysql_query("SELECT * FROM pembelian WHERE no_nota='$no_nota'") or die(mysql_error());

echo "
<thead>
<tr>
<th> No Nota </th>
<th> Tanggal </th>
<th> Total </th>
<th> Status </th>
</tr>
</thead>
<tbody>
";
while($s1=mysql_fetch_array($query1)) {
$total=number_format($s1['total'],0,".",",");
$nota=$s1['no_nota'];
echo "
<tr>
<td>$s1[no_nota]</td>
<td>$s1[tanggal]</td>
<td>Rp.&nbsp;$total</td>
<td>$s1[status]</td>
</tr>
</form>
";
}
echo "
</tbody>";
}
				?>
					</table>
				</div>
            </div>
		</div>

		<div class="panel panel-success">
			<div class="panel-heading">
                Detail Penjualan
            </div>
            <div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
			<?php
if(isset($_POST["detail"])){
$no_nota=$_POST['no_nota'];
	$sql = mysql_query("SELECT * FROM detail_pembelian WHERE no_nota='$no_nota'") or die(mysql_error());
		echo "
<thead>
<tr>
<th colspan='1'> No Nota </th>
<th colspan='3'> $no_nota </th>
</tr>
</thead>
<tbody>
<tr>
<td> Nama Produk </td>
<td> Jumlah </td>
<td> Harga </td>
<td> Total </td>
</tr>
";
while($row=mysql_fetch_array($sql)) {
$harga=number_format($row['harga'],0,".",",");
$hrg=$row['jumlah']*$row['harga'];
$thrg=number_format($hrg,0,".",",");
$produk=$row['id_produk'];
$sql0=mysql_query("SELECT * FROM produk WHERE id_produk='$produk'") or die(mysql_error());
$row0=mysql_fetch_array($sql0);
echo "
<tr>
<td>$row0[nama_produk]</td>
<td>$row[jumlah]</td>
<td>Rp. $harga</td>
<td>Rp. $thrg</td>
</tr>
";
}
echo "
</tbody>";
}
			?>
					</table>
				</div>
			</div>
        </div>
    </div>

	<div class="col-lg-4">
		<div class="panel panel-yellow">
			<div class="panel-heading">
                Cari berdasarkan tanggal
            </div>
            <div class="panel-body">
			<form action="media.php" method="GET" name="penjualan">
				<input type='hidden' value='' name='penjualan'>
                <div class="list-group">
					<h5 class="list-group-item">
                        <i class="fa fa-calendar fa-fw"></i>
						<label class="control-label">Mulai</label>
						<input type="date" class="form-control" name="awal">
					</h5>
					<h5 class="list-group-item">
                        <i class="fa fa-calendar fa-fw"></i>
						<label class="control-label">Sampai</label>
						<input type="date" class="form-control" name="akhir">
					</h5>
				</div>
				<center><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></center>
            </form>
			</div>
        </div>
    </div>			
</div>
	
<?php
}
?>