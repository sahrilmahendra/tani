<?php
include "../config/koneksi.php";

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
				<i class="fa fa-cube"></i>&ensp;List Produk
            </div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
				<?php 
if(isset($_GET['produk'])){
	$query = mysql_query("SELECT * FROM produk WHERE aktif='Y'") or die(mysql_error());

echo "
<thead>
<tr>
<th width='15%'> ID </th>
<th width='40%'> Nama </th>
<th width='20%'> Tanggal </th>
<th width='15%'> Harga </th>
<th width='10%'>  </th>
</tr>
</thead>
<tbody>
";
while($s=mysql_fetch_array($query)) {
$harga=number_format($s['harga'],0,".",",");
$id=$s['id_produk'];
echo "
<form method='post' action='media.php?produk=detail&id=$id'>
<input type='hidden' name='id' value='$id' />
<tr>
<td>$id</td>
<td>$s[nama_produk]</td>
<td>$s[tgl_masuk]</td>
<td>Rp.&nbsp;$harga</td>
<td><input type='submit' name='detail' class='button btn-xs btn-warning btn-block' value='Detail' /></td>
</form>
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

		<div class="panel panel-success">
			<div class="panel-heading">
                
            </div>
            <div class="panel-body">
				
			</div>
        </div>
    </div>

	<div class="col-lg-4">
		<div class="panel panel-success">
			<div class="panel-heading">
                Produk
            </div>
            <div class="panel-body"><?php 
if(isset($_GET['produk']) AND isset($_POST['detail'])){
	$id_produk=$_POST['id'];
	$q1 = mysql_query("SELECT * FROM produk WHERE aktif='Y' AND id_produk='$id_produk'") or die(mysql_error());
$r1=mysql_fetch_array($q1);
echo "
<form action='modul/mod_produk/aksi_produk.php' method='post' name='ubah' enctype='multipart/form-data'>
<div class='form-group has-default'>
	<label class='control-label'>ID Produk</label>
	<input class='form-control' name='id_produk' type='text' value='$r1[id_produk]' readonly>
</div>
<div class='form-group has-default'>
	<label class='control-label'>Nama Produk</label>
	<input class='form-control' name='nama_produk' type='text' value='$r1[nama_produk]'>
</div>
<div class='form-group has-default'>
	<label class='control-label'>Harga</label>
	<input class='form-control' name='harga' type='text' value='$r1[harga]'>
</div>
<div class='form-group has-default'>
	<label class='control-label'>Deskripsi</label>
	<textarea class='form-control' name='deskripsi' style='height: 100px;' value='$r1[deskripsi]'>$r1[deskripsi]</textarea>
</div>
<div class='form-group has-default'>
	<label class='control-label'>Gambar</label><br />
	<img src='../fotoproduk/$r1[gambar]' class='img=responsive'>
	<input name='gambar' type='file'><br />
	<div class='alert alert-warning'>Tipe gambar harus JPG/JPEG<br />Apabila gambar tidak diubah kosongi saja</div>
</div>
<div class='col-xs-6'><input type='submit' name='ubah' class='button btn-xs btn-success btn-block' value='Ubah' /></div
</form>
<form action='modul/mod_produk/aksi_produk.php' method='post' name='hapus'>
<input type='hidden' name='id_hapus' value='$r1[id_produk]' />
<div class='col-xs-6'><input type='submit' name='hapus' class='button btn-xs btn-danger btn-block' value='Hapus' /></div>
</form>
<br /><br /><div class='col-xs-4 col-xs-offset-4' align='center'><a href='?produk' class='button btn-xs btn-warning btn-block'>Batal</a></div>
";
}else{
echo "
<form action='modul/mod_produk/aksi_produk.php' method='post' name='tambah' enctype='multipart/form-data'>
<div class='form-group has-default'>
	<label class='control-label'>Supplier</label>
	<select class='form-control' name='supplier'>
	<option value=''>Pilih Supplier</option>
";
$sq = mysql_query("SELECT * FROM supplier ORDER BY id_supplier ASC");
while($rsq=mysql_fetch_array($sq)){
	echo "<option value='$rsq[id_supplier]'>$rsq[nama_supplier]</option>";
}
echo "
	</select>
</div>
<div class='form-group has-default'>
	<label class='control-label'>Nama Produk</label>
	<input class='form-control' name='nama_produk' type='text'>
</div>
<div class='form-group has-default'>
	<label class='control-label'>Harga</label>
	<input class='form-control' name='harga' type='text'>
</div>
<div class='form-group has-default'>
	<label class='control-label'>Deskripsi</label>
	<textarea class='form-control' name='deskripsi' style='height: 100px;'></textarea>
</div>
<div class='form-group has-default'>
	<label class='control-label'>Gambar</label>
	<input name='gambar' type='file'><br />
	<div class='alert alert-warning'>Tipe gambar harus JPG/JPEG	</div>
</div>
<input type='submit' name='tambah' class='button btn-lg btn-success btn-block' value='Tambah' />
</form>
";
}
?>
			</div>
        </div>
    </div>			
</div>
	
<?php
}
?>