<?php
include ("header.php"); // memanggil file header.php
include ("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

?>
	<div class="container">
		<div class="row">
			
			<?php
$id = $_GET['id']; // mengambil data nim dari nim yang terpilih
$sql = mysqli_query($koneksi, "Select members.id,members.fullname,members.email,members.foto, company.name,city.cityname, city.country from members join company on members.idcompany=company.idcompany join city on members.idcity=city.idcity WHERE id='$id'"); // query memilih entri nim pada database
if (mysqli_num_rows($sql) == 0)
{
    header("Location: index.php");
}
else
{
    $row = mysqli_fetch_assoc($sql);
}

if (isset($_GET['aksi']) == 'delete')
{ // jika tombol 'Hapus Data' pada baris 87 ditekan
    $delete = mysqli_query($koneksi, "DELETE FROM members WHERE id='$id'"); // query delete entri dengan nim terpilih
    if ($delete)
    { // jika query delete berhasil dieksekusi
        echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
        
    }
    else
    { // jika query delete gagal dieksekusi
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
        
    }
}
?>
						<h1>Data Member &raquo; <?php echo $row['fullname']; ?></h1>
			<hr />
			<!-- bagian ini digunakan untuk menampilkan data mahasiswa -->
			<table class="table table-striped table-condensed">
				<tr>
					<td id="cell_1" width="150" height="150">
						<?php
echo "<img src='uploads/" . $row['foto'] . "' width='150' height='150' >"

?>
					</td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php echo $row['email']; ?></td>
				</tr>
				<tr>
					<th>Company</th>
					<td><?php echo $row['name']; ?></td>
				</tr>
				<tr>
					<th>City</th>
					<td><?php echo $row['cityname']; ?></td>
				</tr>
				<tr>
					<th>Country</th>
					<td><?php echo $row['country']; ?></td>
				</tr>
			</table>
			
			<a href="index.php" class="btn btn-info">Back</a>
			<a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit Data</a>
			<a href="detail.php?aksi=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin akan mengahapus data <?php echo $row['fullname']; ?>')">Hapus Data</a>
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php
// include("footer.php"); // memanggil file footer.php

?>
