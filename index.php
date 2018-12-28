<?php 
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
	<div class="container">
		<div class="row">
			<h1>Data Member</h1>
			<hr />
			<div class="row">
				<div class="col-md-6">
					<a href="city.php" class="btn btn-info">1. CRUD City</a>
					<a href="company.php" class="btn btn-info">2. CRUD Company</a>
					<a href="tambah.php" class="btn btn-success">Add Data</a>
				</div>
			<div class="col-md-6">
				<form action="" method="post" enctype="multipart/form-data" class="form-inline">
				<label>File Csv</label>	
				<div class="form-group">
					<input type="file" class="form-control" name="csv">
				</div>
				<button id="import" class="btn btn-primary">Import Csv</button>
				</form>
			</div>
		</div>
			</div>
	
			<br />


			<?php


			 if(isset($_POST["import"])){
					

				$filename=$_FILES["file"]["tmp_name"];	
				$target = "uploads/".basename($_FILES["file"]["name"]);	


					 if($_FILES["file"]["size"] > 0)
					 {
					  	$file = fopen($filename, "r");
				        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
				         {


				           $imp = "INSERT into members (fullname,email,address,foto,idcompany, idcity) 
			                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."')";
			                   $result = mysqli_query($koneksi, $imp);
							if(!isset($result))
							{
								echo "<script type=\"text/javascript\">
										alert(\"Invalid File:Please Upload CSV File.\");
										window.location = \"index.php\"
									  </script>";		
							}
							else {
								  echo "<script type=\"text/javascript\">
									alert(\"CSV File has been successfully Imported.\");
									window.location = \"index.php\"
								</script>";
							}
				         }

				         if (move_uploaded_file($_FILES["file"]["tmp_name"],$target)) {
							$msg = " success";
								
						}else{
							$msg = "There was a problem uploading image";
						}
									
				         fclose($file);	
					 }
				}	 	 


			 ?>
			
			<?php
			if(isset($_GET['aksi']) == 'delete'){ // mengkonfirmasi jika 'aksi' bernilai 'delete'
				$id = $_GET['id']; // ambil nilai nim
				$cek = mysqli_query($koneksi, "Select members.id,members.fullname,members.email,company.name,city.cityname from members join company on members.idcompany=company.idcompany join city on members.idcity=city.idcity WHERE id='$id'"); // query untuk memilih entri dengan nim yang dipilih
				if(mysqli_num_rows($cek) == 0){ // mengecek jika tidak ada entri nim yang dipilih
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; // maka tampilkan 'Data tidak ditemukan.'
				}else{ // mengecek jika terdapat entri nim yang dipilih
					$delete = mysqli_query($koneksi, "DELETE FROM members WHERE id='$id'"); // query untuk menghapus
					if($delete){ // jika query delete berhasil dieksekusi
						echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
					}else{ // jika query delete gagal dieksekusi
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
					}
				}
			}
			?>

		
			<!-- memulai tabel responsive -->
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>Fullname</th>
						<th>Email</th>
						<th>Company</th>
						<th>City</th>
						<th>Tools</th>
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "Select members.id,members.fullname,members.email,company.name,city.cityname, city.country from members join company on members.idcompany=company.idcompany join city on members.idcity=city.idcity"); 
					
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['fullname'].'</a></td>
								<td>'.$row['email'].'</td>
								<td>'.$row['name'].'</td>
								<td>'.$row['cityname'].",".$row['country'].'</td>
								<td>
									
									<a href="edit.php?id='.$row['id'].'" class="btn btn-warning">Edit</a>
									<a href="detail.php?id='.$row['id'].'" class="btn btn-info">Detail</a>
									<a href="index.php?aksi=delete&id='.$row['id'].' onclick="return confirm(\'Anda yakin akan menghapus data '.$row['fullname'].'?\')" class="btn btn-danger">Delete</a>
									
								</td>
							</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
						}
					}
					?>
				</table>
			</div> <!-- /.table-responsive -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php 
// include("footer.php"); // memanggil file footer.php
?>