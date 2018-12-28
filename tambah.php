<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="row">
			<h1>Data mahasiswa &raquo; Tambah Data</h1>
			<hr />

			
			<?php

				$msg = "";
				$comp = mysqli_query($koneksi, "Select * from company"); 
				$city = mysqli_query($koneksi, "Select * from city"); 
				$foto = mysqli_query($koneksi, "Select * from members");
				
				$foto = false;
			if(isset($_POST['add'])){ // jika tombol 'Simpan' dengan properti name="add" ditekan
				$target = "uploads/".basename($_FILES["foto"]["name"]);
				$fullname	   = $_POST['fullname'];
				$email   = $_POST['email'];
				$address	 = $_POST['address'];
				$idcompany1	 = $_POST['idcompany'];
				$idcity1     = $_POST['idcity'];
				$foto = $_FILES["foto"]["name"];



 
						$insert = mysqli_query($koneksi, "INSERT INTO members( fullname, email, address, idcompany, idcity, foto) VALUES('$fullname', '$email', '$address', '$idcompany1', '$idcity1', '$foto')") or die(mysqli_error()); // query untuk menambahkan data ke dalam database
						if($insert){ // jika query insert berhasil dieksekusi
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Member Berhasil disimpan <a href="index.php"><- Kembali</a></div>'; // maka tampilkan 'Data Mahasiswa Berhasil Di Simpan.'
						}else{ // jika query insert gagal dieksekusi
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Member Gagal Di simpan! <a href="index.php"><- Kembali</a></div>'; // maka tampilkan 'Ups, Data Mahasiswa Gagal Di simpan!'
						}
					
			if (move_uploaded_file($_FILES["foto"]["tmp_name"],$target)) {
							$msg = " success";
								
			}else{
				$msg = "There was a problem uploading image";
			}
			}
			?>
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3 control-label">Fullname</label>
					<div class="col-sm-4">
						<input type="text" name="fullname" class="form-control" placeholder="fullname" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-4">
						<input type="text" name="email" class="form-control" placeholder="email" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Company</label>
					<div class="col-sm-4">
						<select name="idcompany" class="form-control" required>
							<?php
								while ($row = $comp->fetch_assoc()) {
									$idcompany1 = $row['idcompany'];
									$name1 = $row['name'];
									echo "<option value='$idcompany1'>$name1</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Address</label>
					<div class="col-sm-4">
						<input type="text" name="address" class="form-control" placeholder="address" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">City</label>
					<div class="col-sm-4">
						<select name="idcity" class="form-control" required>
							<?php
								while ($row = $city->fetch_assoc()) {
									$idcity1 = $row['idcity'];
									$cityname1 = $row['cityname'];
									$country = $row['country'];
									echo "<option value='$idcity1'>$cityname1,$country</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Foto</label>
					<div class="col-sm-4">
						<input type="file" name="foto" class="form-control" placeholder="foto" required />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-info" value="Simpan" data-toggle="tooltip" title="Simpan Data mahasiswa">
						<a href="index.php" class="btn btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
// include("footer.php"); // memanggil file footer.php
?>