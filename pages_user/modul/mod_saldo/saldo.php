<?php
include "../config/koneksi.php";

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
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
				<i class="fa fa-money"></i> Riwayat Saldo
            </div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
<?php
$query = mysql_query("SELECT * FROM saldo WHERE id_user='$user' ORDER BY tanggal ASC") or die(mysql_error());
echo "
<thead>
<tr>
<th> Tanggal </th>
<th> Masuk </th>
<th> Keluar </th>
<th> Saldo </th>
</tr>
</thead>
<tbody>
";
while($row=mysql_fetch_array($query)) {
echo "
<tr>
<td>$row[tanggal]</td>
<td>$row[masuk]</td>
<td>$row[keluar]</td>
<td>$row[saldo]</td>
</tr>
";
}
echo "
</tbody>";
?>
					</table>
				</div>
            </div>
		</div>
    </div>
</div>
	
<?php
}
?>