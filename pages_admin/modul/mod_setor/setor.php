<?php
include "../config/koneksi.php";

if(!isset($_SESSION['admin'])){
	echo '<script language="javascript">alert("Anda harus Login Sebagai Admin!"); document.location="../login.php";</script>';
}
else
{
$date=date('Y/m/d');
	
$sql=mysql_query("SELECT * FROM gabah ORDER BY tanggal DESC");
$r=mysql_fetch_array($sql);
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
				<div class="fa-2x"><i class="fa fa-upload"></i>&ensp;Setor Gabah</div>
            </div>
			<div class="panel-body">
				<form action="modul/mod_setor/aksi_setor.php" method="POST" name="setor"  id="setor" onsubmit="return validasi(this)">
					<form role="form">
                        <fieldset>
                            <div class="form-group has-default">
                                <label class="control-label">NIK</label>
                                <input type="text" class="form-control" name="id_user" required oninvalid="this.setCustomValidity('NIK tidak boleh kosong, Mohon diisi angka 16 digit!')" oninput="setCustomValidity('')" pattern="[0-9]{16,16}">
                            </div>
                            <div class="form-group has-default">
                                <label class="control-label">Berat per Kg</label>
                                <input type="text" class="form-control" name="berat" placeholder="format 57.31" required oninvalid="this.setCustomValidity('Mohon hanya diisi angka!')" oninput="setCustomValidity('')" pattern="[0-9 .]{1,20}">
                            </div>
                            <center><input type="submit" class="button btn-lg btn-success btn-block" name="setor" value="Setor"></center>
                        </fieldset>
                    </form>
            </div>
		</div>
    </div>

	<div class="col-lg-4">
		<div class="panel panel-info">
			<div class="panel-heading">
                Nilai Tukar Petani dan Harga Produsen Gabah
            </div>
            <div class="panel-body">
                <div class="list-group">
					<h4 class="list-group-item">
                        <i class="fa fa-calendar fa-fw"></i> Tanggal
                        <span class="pull-right text-success"><?php echo $r['tanggal'];?>
                        </span>
					</h4>
					<h4 class="list-group-item">
                        <i class="fa fa-money fa-fw"></i> Harga
                        <span class="pull-right text-success">Rp.&nbsp;<?php echo number_format($r['hrg_per_kg'],0,".",",");?>
                        </span>
					</h4>
				</div>
            </div>
            <div class="panel-footer">
				<form action="modul/mod_setor/aksi_setor.php" method="POST">
                    <div class="form-group col-xs-8">
                        <input placeholder="Masukan Harga Terbaru" name="hrg" type="text">
                    </div>
					<div align="right"><input type="submit" class="button btn-xs btn-info" name="ganti" value="Perbaharui"></div>
                </form>
            </div>
        </div>
    </div>			
</div>
	
<?php
}
?>