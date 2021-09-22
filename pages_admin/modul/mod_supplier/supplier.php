<?php
include "../config/koneksi.php";

if(!isset($_SESSION['admin'])){
	echo '<script language="javascript">alert("Anda harus Login Sebagai Admin!"); document.location="../login.php";</script>';
}
else
{
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Supplier</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
			<form action="media.php" method="get">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama..." name="supplier">
						<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<i class="fa fa-search"></i>
						</button>
						</span>
                    </div>
            </form>
            </div>
			<div class="panel-body">

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<?php	
if(isset($_GET['supplier'])){
	$cari = $_GET['supplier'];
	$query = mysql_query("select *from supplier where nama_supplier like '%".$cari."%'");
echo "
<thead>
<tr>
<th> ID Supplier </th>
<th> Nama Supplier </th>
<th> Alamat </th>
<th> Email </th>
<th> No Telpon </th>
<th>   </th>
</tr>
</thead>
<tbody>
";
while($s=mysql_fetch_array($query)) {
$ids=$s['id_supplier'];
echo "
<form method='post' action='media.php?supplier=&detail&id=$ids'>
<input type='hidden' name='id' value='$ids' />
<tr>
<td>$ids</td>
<td>$s[nama_supplier]</td>
<td>$s[alamat]</td>
<td>$s[email]</td>
<td>$s[telpon]</td>
<td><input type='submit' name='detail' class='button btn-xs btn-warning btn-block' value='Detail' /></td>
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
    </div>

	<div class="col-lg-12">
		<div class="panel panel-yellow">
			<div class="panel-heading">
                Detail Supplier
            </div>
            <div class="panel-body">
<?php 
if(isset($_GET['supplier']) AND isset($_POST['detail'])){
	$id=$_POST['id'];
	$q1 = mysql_query("select *from supplier where id_supplier=$id") or die(mysql_error());
$r1=mysql_fetch_array($q1);
?>
<form action="modul/mod_supplier/aksi_supplier.php" method="post" name="supplier" id="supplier" onsubmit="return validasi(this)">
                                <div class="form-group has-default">
                                    <label class="control-label">ID Supplier</label>
                                    <input class="form-control" name="username" type="username" value="<?php echo $r1['id_supplier'];?>" readonly>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Nama Supplier</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $r1['nama_supplier'];?>"required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" value="<?php echo $r1['alamat'];?>"required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $r1['email'];?>"required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">No Telpon</label>
                                    <input type="text" class="form-control" name="telp" value="<?php echo $r1['telpon'];?>"required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
								<br>
								<div class="alert alert-warning col-xs-12">
                                Mohon untuk lengkapi informasi diatas!
								</div>
                                <div class="col-xs-6"><input type="submit" name="ubah" class="button btn-xs btn-success btn-block" value="Ubah" /></div>
</form>
<form action="modul/mod_supplier/aksi_supplier.php" method="post" name="hapus">
<input type="hidden" name="id_hapus" value="<?php echo $id;?>" />
<div class="col-xs-6"><input type="submit" name="hapus" class="button btn-xs btn-danger btn-block" value="Hapus" /></div>
</form>
<br /><br /><div class="col-xs-4 col-xs-offset-4" align="center"><hr /></div>
<br /><br /><div class="col-xs-4 col-xs-offset-4" align="center"><a href="?supplier" class="button btn-xs btn-info btn-block">Batal</a></div>
<?php
}else{
?>
<form action="modul/mod_supplier/aksi_supplier.php" method="post" name="supplier" id="supplier" onsubmit="return validasi(this)">
                                <div class="form-group has-default">
                                    <label class="control-label">ID Supplier</label>
									<input class="form-control" name="username" type="username" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Nama Supplier</label>
                                    <input type="text" class="form-control" name="nama" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">No Telpon</label>
                                    <input type="text" class="form-control" name="telp" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
								<br>
								<div class="alert alert-warning">
                                Mohon untuk melengkapi informasi diatas!
								</div>
                                <!-- Change this to a button or input when using this as a form -->
                                <center><input type="submit" class="button btn-lg btn-success btn-block" name="tambah" value="Tambah"></center>
</form>
<?php
}
?>
            </div>
        </div>
    </div>			
</div>
	
<?php
}
?>