<?php

	$berkas = "data/data.json";
	$dataJson = file_get_contents($berkas);
	$DataPesananAlbum = json_decode($dataJson, true);

	//Array Data Album Sane's
	$unitAlbum = array ("Album NCT (NCT 127 )", "Album NCT (NCT Dream)", "Album NCT(WayV)", "Album NCT (U)", "Album NCT (NCT 2018)", "Album NCT (NCT 2020)");									//Array Unit Album yang Tersedia 
	$hargaunitAlbum = array ("Album NCT (NCT 127 )"=>350000, "Album NCT (NCT Dream)"=>350000, "Album NCT(WayV)"=>350000, "Album NCT (U)"=>350000, "Album NCT (NCT 2018)"=>450000, "Album NCT (NCT 2020)"=>450000);	//Array Pricelist harga album
	$tujuanDelivery = array ("Jawa Barat", "Jawa Tengah", "Jawa Timur" ); 											//Array tujuan antar pesanan 
	$hargatujuanDelivery = array ("Jawa Barat"=>10000, "Jawa Tengah"=>15000, "Jawa Timur"=>20000);			//Array Data Ongkir


	//Fungsi Menghitung Total Delivery Album Sane's
	/**
		Fungsi ini berguna untuk Menghitung Total Album Sane's
		-- Argumen pertama berisi harga pesan unit album
		-- Argumen kedua berisi harga tujuan delivery 
		-- Balikan dari Fungsi ini adalah Total Delivery Album yang harus dibayarkan
	**/
	function totalHarga($hargaAlbum, $hargaDelivery) {
		global $hargaunitAlbum, $hargatujuanDelivery;
	
		foreach ($hargaunitAlbum as $harga1 => $harga1_value) {					//Mengambil harga pesanan unit album yang dipilih
			if ($hargaAlbum == $harga1) {
				$nilaiharga1 = $harga1_value;
			}
		}
	
		foreach ($hargatujuanDelivery as $harga2 => $harga2_value) {			//Mengambil harga tujuan delivery sesuai dengan tujuan yang dipilih
			if ($hargaDelivery == $harga2) {
				$nilaiharga2 = $harga2_value;
			}
		}
	
		return $nilaiharga1 + $nilaiharga2;
	}
	
	
	
?>
	
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="library/css/bootstrap.min.css" rel="stylesheet" >

	<body>
			<img src="img/logo_albumsane1.png" class="mx-auto d-block" style="width: 250px; height: 250px">
    
			
			
			<div class="mb-4"></div>
            <div class="col-md-6 mx-auto">
            <!-- Awal Bootsrap card untuk form-->
                <div class="text-center">    
                    <div class="card-header bg-success text-light">Form Pesan Album NCT Sane's</div>
                </div>
                <div class="card-body">
                <h1 class= "text-center">Form Pesanan Album NCT Sane's</h1>

    <!-- Form Pesan Album NCT Sane's -->
	<form action="index.php" method="post">
		<table width="700px">
			<tr>
            <div class="mb-3">
				<td><label>Unit Album</label></td>
				<td>:</td>
				<td>
                    <select name="unitalbum"> 																						<!-- Input dengan pilih Unit Album -->
                    <!-- Perulangan untuk menampilkan Pilihan Unit NCT -->
                    <?php
							foreach ($unitAlbum as $vd) {
								echo "<option value='".$vd."'>".$vd."</option>";
							}
                            ?>
					</select>
				</td>
            </div>
		</tr>
		<tr>
                <td><div class="mb-3"><label>Tujuan Antar</label></td> 																				<!-- Input dengan pilih Tujuan Delivery -->
				<td>:</td>
				<td>
                    <select name="tujuanantar">
                        <!-- Perulangan untuk menampilkan Pilihan Tujuan Delivery -->
						<?php
							foreach ($tujuanDelivery as $td) {
                                echo "<option value='".$td."'>".$td."</option>";
							}
                            ?>
					</select>
                </div>
			</td>
            </tr>
			<tr>
				<td width="20%"><div class="mb-3"><label>Nama</label></td>
				<td>:</td>
				<td width="80%"><input type="text" name="nama" class="inputtext" placeholder="Nama Pemesan" required=""></td> <!-- Input nama pemesan -->
			</div>
		</tr>
		<tr>
				<td><div class="mb-3"><label>Alamat Antar</label></td>
				<td>:</td>
				<td width="80%"><input type="text" name="alamat" class="inputtext" placeholder="Alamat Pemesan" required=""></td> 				<!-- Input alamat lengkap  -->
                </div>
            </tr>
			<tr>
				<td colspan="3" style="text-align: center;"><input type="submit" value="Submit" name="submit" class="btn btn-secondary text-light"></td>					<!-- Submit Form -->
			</tr>
		</table>		
	</form> <br>
    <!-- Akhir form -->
</div>
<div class="card-footer bg-success">
	</div>
</div>
</div>
<!-- Akhir Boostrap card untuk form -->

		<!--Menampilkan Tabel harga Unit Album -->
		<div class="mb-4">
		</div>
		<div class="col-md-7 mx-auto">
			<table class="table table-secondary">
		<thead>
		<tr>
		<th scope="col">Unit Album</th>
		<th scope="col">Harga</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Album NCT 127</td>
			<td>Rp.350.000</td>
		</tr>
		<tr>
		<td>Album NCT Dream</td>
		<td>Rp.350.000</td>
	</tr>
	<tr>
		<td>Album NCT WayV</td>
		<td>Rp.350.000</td>
	</tr>
	<tr>
		<td>Album NCT U</td>
		<td>Rp.350.000</td>
	</tr>
	<tr>
		<td>Album NCT 2018</td>
		<td>Rp.450.000</td>
	</tr>
	<tr>
		<td>Album NCT 2020</td>
		<td>Rp.450.000</td>
	</tr>
	
</tbody>
</table>
</div>

<!-- Menampung seluruh hasil inputan User -->
	<?php
		if(isset($_POST['submit'])){
			$pesananunitAlbum = $_POST['unitalbum'];
			$tujuanantar = $_POST['tujuanantar'];
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$totalHargaPesanan = totalHarga($pesananunitAlbum, $tujuanantar);

			
			$PesananDelivery = [$pesananunitAlbum, $tujuanantar, $nama, $alamat, $totalHargaPesanan];		//Menampung inputan User kedalam Array sementara
			array_push($DataPesananAlbum, $PesananDelivery);																												//Memasukan Array baru kedalam Array Data Pesanan Album
			array_multisort($DataPesananAlbum, SORT_ASC);																													//Mengurutkan Data Pesanan Wownats berdasarkan unit album sesuai Abjad dari yang terkecil
			$dataJson = json_encode($DataPesananAlbum, JSON_PRETTY_PRINT);
			file_put_contents($berkas, $dataJson);
		}

	?>

        <!-- Awal Bootsrap card untuk tabel data-->
        <div class="mb-4"></div>
        <div class="col-md-6 mx-auto">
        <div class="text-center"></div> 
        <div class="card-header bg-success text-secondary"></div>
	<!-- Menampilkan Data Pesanan Delivery Album NCT beserta harga yang harus dibayarkan-->
    <h1 class="text-center">Daftar Pesanan Album </h1>
	<table class="table table-striped">
		<thead class="table-success">
			<tr>
				<th>Unit Album</th>
				<th>Tujuan Delivery</th>
				<th>Nama Pemesan</th>
				<th>Alamat </th>
				<th>Total Pembayaran</th>
			</tr>
		</thead>
		<tbody>
			<!-- Perulangan untuk menampilkan Data Pesanan Delivery Album Sane's beserta harga yang harus dibayarkan -->
			<?php
				for($i=0; $i<count($DataPesananAlbum); $i++){
					echo "<tr>";
					echo "<td>".$DataPesananAlbum[$i][0]."</td>";
					echo "<td style='text-align: center;'>".$DataPesananAlbum[$i][1]."</td>";
					echo "<td style='text-align: center;'>".$DataPesananAlbum[$i][2]."</td>";
					echo "<td style='text-align: center;'>".$DataPesananAlbum[$i][3]."</td>";
					echo "<td style='text-align: center;'>".$DataPesananAlbum[$i][4]."</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
    <!-- Akhir menampilkan data dalam tabel -->
    <div class="card-footer bg-success"></div>
	</div>
	</div>
    <!-- Akhir Boostrap card untuk tabel -->



    <script src="library/js/bootstrap.bundle.min.js" ></script>
	
		</div>
		</div>
  </body>
</html>