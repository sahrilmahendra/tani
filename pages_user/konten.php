<?php
include "../config/koneksi.php";

// Bagian Dashboard
if (isset($_GET['dashboard'])){
    include "dashboard.php";
}

// Bagian Profil
elseif (isset($_GET['profil'])){
    include "modul/mod_profil/profil.php";
}

// Bagian Saldo
elseif (isset($_GET['saldo'])){
    include "modul/mod_saldo/saldo.php";
}

// Bagian Produk
elseif (isset($_GET['produk'])){
    include "modul/mod_produk/produk.php";
}

// Bagian Laporan Setoran
elseif (isset($_GET['setoran'])){
    include "modul/mod_setoran/setoran.php";
}

// Bagian Laporan Pembelian
elseif (isset($_GET['pembelian'])){
    include "modul/mod_pembelian/pembelian.php";
}

// Apabila modul tidak ditemukan
else{
	include "kosong.php";
}
?>