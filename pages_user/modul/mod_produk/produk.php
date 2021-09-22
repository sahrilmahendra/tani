<?php
include "../config/koneksi.php";

if(!isset($_SESSION['user'])){
	echo '<script language="javascript">alert("Anda harus Login!"); document.location="../login.php";</script>';
}
else
{
$user = $_SESSION['user'];

if(isset($_GET["produk"]) AND isset($_POST["tambah"]))
{
	$sql = mysql_query("SELECT * FROM order_temp WHERE item_id='$_POST[hidden_id]' AND id_user='$user'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0){
		$sql2 = mysql_query("INSERT INTO order_temp (id_user,item_id,item_name,item_quantity,item_price)
		VALUE ('$user','$_POST[hidden_id]','$_POST[hidden_name]','1','$_POST[hidden_price]')") or die(mysql_error());
		
	}else{
		$sql1 = mysql_query("SELECT * FROM order_temp WHERE item_id='$_POST[hidden_id]' AND id_user='$user'") or die(mysql_error());
		$r1=mysql_fetch_array($sql1);
		$qty=$r1['item_quantity'];
		$qty=$qty+1;
		$sql2 = mysql_query("UPDATE order_temp SET item_quantity='$qty' WHERE item_id=$_POST[hidden_id] AND id_user='$user'") or die(mysql_error());
	}
}

if(isset($_GET["produk"]) AND isset($_POST["hapus"]))
{
	
	$sql2 = mysql_query("DELETE FROM order_temp WHERE item_id='$_POST[item_id]' AND id_user='$user'") or die(mysql_error());
}

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"></h1>
    </div>
</div>
<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-yellow">
            <div class="panel-heading">
			<div class="fa-2x"><i class="fa fa-shopping-cart"></i>
			Keranjang Belanja</div>
            </div>
			<div class="panel-body">
			<!--<div class="page-404">
				<p class="text-404">@_@</p>
				<h2>Halaman masih kosong</h2>
			</div>-->
			<div class="table-responsive" id="order_table">
				<table class="table table-bordered table-striped">
					<tr>  
						<th width="40%">Nama Produk</th>  
						<th width="10%">Jumlah</th>  
						<th width="20%">Harga</th>  
						<th width="15%">Total</th>  
						<th width="5%"></th>  
					</tr>
					<?php
					$query1 = mysql_query("SELECT * FROM order_temp WHERE id_user='$user' ORDER BY item_id ASC");
					while($row1=mysql_fetch_array($query1)) 
					{
					?>
					<tr>						
						<form method="post" action="media.php?produk=hapus&id=<?php echo $row["item_id"]; ?>">
						<td><input type="hidden" name="item_id" value="<?php echo $row1["item_id"]?>"><?php echo $row1["item_name"]; ?></td>
						<td><input type="hidden" name="item_quantity" value="<?php echo $row1["item_quantity"]?>"><?php echo $row1["item_quantity"]; ?></td>
						<td><input type="hidden" name="item_price" value="<?php echo $row1["item_price"]?>">Rp.&nbsp; <?php echo number_format($row1["item_price"],0,".",","); ?></td>
						<td>Rp.&nbsp; <?php echo number_format($row1["item_quantity"] * $row1["item_price"],0,".",",");?></td>
						<td><input type="submit" name="hapus" class="button btn-xs btn-danger btn-block" value="Hapus" /></td>
						</form>
					</tr>
					<?php
							$total = $total + ($row1["item_quantity"] * $row1["item_price"]);
						}
					?>
				<form action="modul/mod_produk/aksi_produk.php" method="post" name="cekout" id="cekout">
					<tr>
						<td colspan="3" align="right">Total</td>
						<td colspan="1"><input type='hidden' value='<?php echo $total;?>' name='total'>
						Rp.&nbsp; <?php echo number_format($total,0,".",","); ?></td>
						<td colspan="1"><input type='hidden' value='<?php echo $user;?>' name='id_user'>
						<input type="submit" class="button btn-xs btn-success" name="cekout" value="CekOut"></td>
					</tr>
				</table>
				</form>
			</div>
            </div>
		</div>
    </div>

	<div class="col-lg-12">
                <div class="row">
                    <div class="col-xs-8">
                        
                    </div>
                    <div class="col-xs-4 text-right">
						<form action="" method="">
						<div class="input-group custom-search-form">
							<input type="text" class="form-control" placeholder="Cari Berdasarkan Nama..." name="">
							<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="fa fa-search"></i>
							</button>
							</span>
						</div>
						</form>
                    </div>
                </div> 
	</div>
<?php
				$query = mysql_query("SELECT * FROM produk WHERE aktif='Y' ORDER BY id_produk ASC");
				while($row=mysql_fetch_array($query)) {
				?>
				<form method="post" action="media.php?produk=tambah&id=<?php echo $row["id_produk"]; ?>">
				<div class="col-md-3" style="margin-top:12px;">
						<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
						<div style="height:155px;"><img src="../fotoproduk/<?php echo $row["gambar"]; ?>" class="img-responsive" /></div><br />

						<h4 class="text-info"><?php echo $row["nama_produk"]; ?></h4>

						<h4 class="text-danger">Rp.&nbsp; <?php echo number_format($row["harga"],0,".",","); ?></h4>

						<input type="hidden" name="hidden_id" value="<?php echo $row["id_produk"]; ?>" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["nama_produk"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["harga"]; ?>" /><br />

						<input type="submit" name="tambah" style="margin-top:5px;" class="button btn-lg btn-success btn-block" value="Tambah ke Keranjang" />

					</div>
					<br />
				</div>
				</form>
			<?php
				}
			?>	
	
</div>	
<?php
}
?>