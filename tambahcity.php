<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="row">
			<h1>Data City &raquo; Tambah Data</h1>
			<hr />

			
			<?php

				$msg = "";
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add" ditekan
				
				$cityname	   = $_POST['cityname'];
				$country   = $_POST['country'];



 
						$insert = mysqli_query($koneksi, "INSERT INTO city( cityname, country) VALUES('$cityname', '$country')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Member Berhasil disimpan <a href="city.php"><- Kembali</a></div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Member Gagal Di simpan! <a href="city.php"><- Kembali</a></div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}
					
			}
			?>
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3 control-label">CityName</label>
					<div class="col-sm-4">
						<input type="text" name="cityname" class="form-control" placeholder="CityName" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Country</label>
					<div class="col-sm-4">
						<input type="text" name="country" class="form-control" placeholder="Country" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data City">
						<a href="city.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
// include("footer.php"); // memanggil file footer.php
?>