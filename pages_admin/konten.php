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

// Bagian User
elseif (isset($_GET['user'])){
    include "modul/mod_user/user.php";
}

// Bagian Supplier
elseif (isset($_GET['supplier'])){
    include "modul/mod_supplier/supplier.php";
}

// Bagian Setoran
elseif (isset($_GET['setor'])){
    include "modul/mod_setor/setor.php";
}

// Bagian Produk
elseif (isset($_GET['produk'])){
    include "modul/mod_produk/produk.php";
}

// Bagian Laporan Setoran
elseif (isset($_GET['setoran'])){
    include "modul/mod_setoran/setoran.php";
}

// Bagian Laporan Penjualan
elseif (isset($_GET['penjualan'])){
    include "modul/mod_penjualan/penjualan.php";
}

// Apabila modul tidak ditemukan
else{
	include "kosong.php";
}
?>