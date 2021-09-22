<?php
include "../config/koneksi.php";
$date=date('Y/m/d');
$ldate=date('Y/m/d H:i:s');

if(!isset($_SESSION['user'])){
	echo '<script language="javascript">alert("Anda harus Login!"); document.location="../login.php";</script>';
}
else
{
$user = $_SESSION['user'];
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
				<i class="fa fa-list-alt"></i>&ensp;Laporan Setoran Gabah Anda
            </div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
				<?php 
if(isset($_GET['setoran'])){
	$awal=$_GET['awal'];
	$akhir=$_GET['akhir'];
	if($awal==''){
		$awal=$date;
	}
	if($akhir==''){
		$akhir=$ldate;
	}
	$query = mysql_query("SELECT * FROM setoran WHERE id_user='$user' AND tanggal BETWEEN '$awal' AND '$akhir' ORDER BY tanggal ASC") or die(mysql_error());

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
<th> No Faktur </th>
<th> Tanggal </th>
<th> Berat </th>
<th> Total </th>
</tr>
</thead>
<tbody>
";
while($s=mysql_fetch_array($query)) {
$total=number_format($s['total'],0,".",",");
echo "
<tr>
<td>$s[no_faktur]</td>
<td>$s[tanggal]</td>
<td>$s[berat]</td>
<td>Rp.&nbsp;$total</td>
</tr>
";
}
echo "
</tbody>";
}
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
			<form action="media.php" method="GET" name="setoran">
				<input type='hidden' value='<?php echo $user;?>' name='setoran'>
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