<?php
session_start();
error_reporting(0);
include "timeout.php";

if((isset($_SESSION['admin'])) OR (isset($_SESSION['user']))){
  header('location:logout.php');
}else{
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daftar Baru</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<script type="text/javascript" src="ajax_daerah.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body OnLoad="document.login.username.focus();">
<form action="prosesdaftar.php" method="post" name="daftar" id="daftar" onsubmit="return validasi(this)">
    <div class="container">
        <div class="row">
		<br><br>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Silahkan Isi Data Pribadi Anda</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
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
                                    <label class="control-label">Provinsi</label>
                                    <!--<input type="text" class="form-control" name="provinsi" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">-->
									<select class="form-control" name="prop" id="prop" onchange="ajaxkota(this.value)">
									<option value="">Pilih Provinsi</option>
									<?php 
									include 'config/konek.php';
									$query=$db->prepare("SELECT id_prov,nama FROM provinsi ORDER BY nama");
									$query->execute();
									while ($data=$query->fetchObject()){
									echo '<option value="'.$data->id_prov.'">'.$data->nama.'</option>';
									}
									?>
									<select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kabupaten/Kota</label>
                                    <!--<input type="text" class="form-control" name="kabupaten" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">-->
									<select class="form-control" name="kota" id="kota" onchange="ajaxkec(this.value)">
									<option value="">Pilih Kabupaten/Kota</option>
									</select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kecamatan</label>
                                    <!--<input type="text" class="form-control" name="kecamatan" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">-->
									<select class="form-control" name="kec" id="kec" onchange="ajaxkel(this.value)">
									<option value="">Pilih Kecamatan</option>
									</select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Kelurahan/Desa</label>
                                    <!--<input type="text" class="form-control" name="desa" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">-->
									<select class="form-control" name="kel" id="kel" onchange="showCoordinate()">
									<option value="">Pilih Kelurahan/Desa</option>
									</select>
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">Dusun</label>
                                    <input type="text" class="form-control" name="dusun">
                                </div>
                                <div class="form-group has-default">
                                    <label class="control-label">RT/RW</label>
                                    <input type="text" class="form-control" name="rtrw" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
								<br>
								<div class="alert alert-warning">
                                Mohon untuk melengkapi informasi diri anda
								</div>
                                <!-- Change this to a button or input when using this as a form -->
                                <center><input type="submit" class="button btn-lg btn-success btn-block" name="daftar" value="Daftar"></center>
                            </fieldset>
                        </form>
					<br><center><a href="login.php">Sudah memiliki akun</a></center>
                    </div>
                </div>
            </div>
		<br><br>
        </div>
    </div>
</form>
    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
<?php
}
?>