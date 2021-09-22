<?php
include "../config/koneksi.php";

if(!isset($_SESSION['admin'])){
	echo '<script language="javascript">alert("Anda harus Login Sebagai Admin!"); document.location="../login.php";</script>';
}
else
{
?>
<script type="text/javascript" src="../ajax_daerah.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Data Pengguna</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
			<form action="media.php" method="get">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Cari Berdasarkan Nama..." name="user">
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
if(isset($_GET['user'])){
	$cari = $_GET['user'];
	$query = mysql_query("select *from user where level='user' and nama like '%".$cari."%'");
echo "
<thead>
<tr>
<th> NIK </th>
<th> Nama </th>
<th> Jenis Kelamin </th>
<th> Email </th>
<th> No Telpon </th>
<th> Alamat </th>
<th>   </th>
</tr>
</thead>
<tbody>
";
while($s=mysql_fetch_array($query)) {
$nik=$s['nik'];
echo "
<form method='post' action='media.php?user=&detail&nik=$nik'>
<input type='hidden' name='id' value='$nik' />
<tr>
<td>$nik</td>
<td>$s[nama]</td>
<td>$s[jk]</td>
<td>$s[email]</td>
<td>$s[telp]</td>
<td>$s[alamat]</td>
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
                Detail Pengguna
            </div>
            <div class="panel-body">
<?php 
if(isset($_GET['user']) AND isset($_POST['detail'])){
	$id=$_POST['id'];
	$q1 = mysql_query("select *from user where level='user' and nik=$id") or die(mysql_error());
$r1=mysql_fetch_array($q1);
?>
<form action="modul/mod_user/aksi_user.php" method="post" name="user" id="user" onsubmit="return validasi(this)">
                                <div class="form-group has-default">
                                    <label class="control-label">NIK</label>
                                    <input class="form-control" name="username" type="username" value="<?php echo $r1['nik'];?>" readonly>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $r1['nama'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $r1['email'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">No Telpon</label>
                                    <input type="text" class="form-control" name="telp" value="<?php echo $r1['telp'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Password Baru</label>
									<input class="form-control" name="password" type="password" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tmp_lhr" value="<?php echo $r1['tmp_lhr'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lhr" value="<?php echo $r1['tgl_lhr'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Jenis Kelamin</label>
                                    <select class="form-control" name="jk">
                                        <option><?php echo $r1['jk'];?></option>
                                        <option>Laki-Laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" value="<?php echo $r1['alamat'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">RT/RW</label>
                                    <input type="text" class="form-control" name="rtrw" value="<?php echo $r1['rtrw'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Dusun</label>
                                    <input type="text" class="form-control" name="dusun" value="<?php echo $r1['dusun'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kelurahan/Desa</label>
									<input class="form-control" name="desa" type="text" value="<?php echo $r1['desa'];?>">
									</select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kecamatan</label>
									<input class="form-control" name="kecamatan" type="text" value="<?php echo $r1['kecamatan'];?>">
									</select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kabupaten/Kota</label>
									<input class="form-control" name="kabupaten" type="text" value="<?php echo $r1['kabupaten'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Provinsi</label>
									<input class="form-control" name="provinsi" type="text" value="<?php echo $r1['provinsi'];?>">
                                </div>
								<br>
								<div class="alert alert-warning col-xs-12">
                                Mohon isi password baru pengguna!
								</div>
                                <div class="col-xs-6"><input type="submit" name="ubah" class="button btn-xs btn-success btn-block" value="Ubah" /></div>
</form>
<form action="modul/mod_user/aksi_user.php" method="post" name="hapus">
<input type="hidden" name="id_hapus" value="<?php echo $id;?>" />
<div class="col-xs-6"><input type="submit" name="hapus" class="button btn-xs btn-danger btn-block" value="Hapus" /></div>
</form>
<br /><br /><div class="col-xs-4 col-xs-offset-4" align="center"><hr /></div>
<br /><br /><div class="col-xs-4 col-xs-offset-4" align="center"><a href="?user" class="button btn-xs btn-info btn-block">Batal</a></div>
<?php
}else{
?>
<form action="modul/mod_user/aksi_user.php" method="post" name="user" id="user" onsubmit="return validasi(this)">
                                <div class="form-group has-default">
                                    <label class="control-label">NIK</label>
                                    <input class="form-control" name="username" type="username" required oninvalid="this.setCustomValidity('Data tidak boleh kosong, Mohon diisi angka 16 digit!')" oninput="setCustomValidity('')" pattern="[0-9]{16,16}">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">No Telpon</label>
                                    <input type="text" class="form-control" name="telp" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Password</label>
									<input class="form-control" name="password" type="password" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tmp_lhr" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lhr" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Jenis Kelamin</label>
                                    <select class="form-control" name="jk" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                        <option></option>
                                        <option>Laki-Laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">RT/RW</label>
                                    <input type="text" class="form-control" name="rtrw" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Dusun</label>
                                    <input type="text" class="form-control" name="dusun">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kelurahan/Desa</label>
									<input class="form-control" name="desa" type="text" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
									</select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kecamatan</label>
									<input class="form-control" name="kecamatan" type="text" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
									</select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kabupaten/Kota</label>
									<input class="form-control" name="kabupaten" type="text" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Provinsi</label>
									<input class="form-control" name="provinsi" type="text" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
								<br>
								<div class="alert alert-warning">
                                Mohon untuk melengkapi informasi diri
								</div>
                                <!-- Change this to a button or input when using this as a form -->
                                <center><input type="submit" class="button btn-lg btn-success btn-block" name="tambah" value="Daftarkan"></center>
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