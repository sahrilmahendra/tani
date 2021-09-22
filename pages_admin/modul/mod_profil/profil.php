<?php
include "../config/koneksi.php";

if(!isset($_SESSION['admin'])){
	echo '<script language="javascript">alert("Anda harus Login!"); document.location="../login.php";</script>';
}
else
{
?>
<script type="text/javascript" src="../ajax_daerah.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Profil</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Profil Saya
            </div>
			<div class="panel-body">


<?php
$query=mysql_query("select *from user where level='admin' and nik='$_SESSION[admin]'");
$row=mysql_fetch_array($query);
?>
<form action="modul/mod_profil/aksi_profil.php" method="post" name="profil" id="profil" onsubmit="return validasi(this)">
                        <form role="form">
                            <fieldset>
                                <div class="form-group has-default">
                                    <label class="control-label">NIK</label>
                                    <input class="form-control" name="username" type="username" value="<?php echo $row['nik'];?>" readonly>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $row['nama'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">No Telpon</label>
                                    <input type="text" class="form-control" name="telp" value="<?php echo $row['telp'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Password Lama</label>
									<input class="form-control" name="passl" type="password" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Password Baru</label>
									<input class="form-control" name="passb" type="password" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tmp_lhr" value="<?php echo $row['tmp_lhr'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lhr" value="<?php echo $row['tgl_lhr'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Jenis Kelamin</label>
                                    <select class="form-control" name="jk">
                                        <option><?php echo $row['jk'];?></option>
                                        <option>Laki-Laki</option>
                                        <option>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">RT/RW</label>
                                    <input type="text" class="form-control" name="rtrw" value="<?php echo $row['rtrw'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Dusun</label>
                                    <input type="text" class="form-control" name="dusun" value="<?php echo $row['dusun'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kelurahan/Desa</label>
									<input class="form-control" name="desa" type="text" value="<?php echo $row['desa'];?>">
									</select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kecamatan</label>
									<input class="form-control" name="kecamatan" type="text" value="<?php echo $row['kecamatan'];?>">
									</select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kabupaten/Kota</label>
									<input class="form-control" name="kabupaten" type="text" value="<?php echo $row['kabupaten'];?>">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Provinsi</label>
									<input class="form-control" name="provinsi" type="text" value="<?php echo $row['provinsi'];?>">
                                </div>
								<br>
								<div class="alert alert-warning col-xs-7">
                                Jika Password tidak diubah, isi password baru sama dengan password lama!
								</div>
                                <div align="right"><input type="submit" class="button btn-lg btn-success" name="profil" value="Perbaharui Profil"></div>
                            </fieldset>
                        </form>
</form>
            </div>
			
    </div>
	
<?php
}
?>
</div>