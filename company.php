<?php
include ("header.php"); // memanggil file header.php
include ("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

?>
	<div class="container">
		<div class="row">
			<h1>Data Company</h1>
			<hr />
			<a href="city.php" class="btn btn-info">1. CRUD City</a>
			<a href="company.php" class="btn btn-info">2. CRUD Company</a>
			<a href="tambahcompany.php" class="btn btn-success">Add Data</a>
			<hr />



			
			<?php
if (isset($_GET['aksi']) == 'delete')
{ // mengkonfirmasi jika 'aksi' bernilai 'delete'
    $idcompany = $_GET['idcompany']; // ambil nilai nim
    $cek = mysqli_query($koneksi, "Select * from company WHERE idcompany='$idcompany'"); // query untuk memilih entri dengan nim yang dipilih
    if (mysqli_num_rows($cek) == 0)
    { // mengecek jika tidak ada entri nim yang dipilih
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; // maka tampilkan 'Data tidak ditemukan.'
        
    }
    else
    { // mengecek jika terdapat entri nim yang dipilih
        $delete = mysqli_query($koneksi, "DELETE FROM company WHERE idcompany='$idcompany'"); // query untuk menghapus
        if ($delete)
        { // jika query delete berhasil dieksekusi
            echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
            
        }
        else
        { // jika query delete gagal dieksekusi
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
						<th>Company</th>
						<th>Tools</th>
					</tr>
					<?php
$sql = mysqli_query($koneksi, "Select * from company");

if (mysqli_num_rows($sql) == 0)
{
    echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
    
}
else
{ // jika terdapat entri maka tampilkan datanya
    $no = 1; // mewakili data dari nomor 1
    while ($row = mysqli_fetch_assoc($sql))
    { // fetch query yang sesuai ke dalam array
        echo '
							<tr>
								<td>' . $no . '</td>
								<td>' . $row['name'] . '</td>
								<td>
									<a href="editcompany.php?idcompany=' . $row['idcompany'] . '"class="btn btn-warning">Edit</a>
									<a href="company.php?aksi=delete&idcompany=' . $row['idcompany'] . '" onclick="return confirm(\'Anda yakin akan menghapus data ' . $row['name'] . '?\')" class="btn btn-danger">Delete</a>
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
