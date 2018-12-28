<?php
include ("header.php"); // memanggil file header.php
include ("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

?>
	<div class="container">
		<div class="row">

			
			<?php
$idcity = $_GET['idcity']; // assigment nim dengan nilai nim yang akan diedit
$sql = mysqli_query($koneksi, "SELECT * FROM city WHERE idcity='$idcity'"); // query untuk memilih entri data dengan nilai nim terpilih
if (mysqli_num_rows($sql) == 0)
{
    header("Location: city.php");
}
else
{
    $row = mysqli_fetch_assoc($sql);
}

$msg = "";
if (isset($_POST['save']))
{ // jika tombol 'Simpan' dengan properti name="add" ditekan
    $cityname = $_POST['cityname'];
    $country = $_POST['country'];

    $update = mysqli_query($koneksi, "UPDATE city SET cityname='$cityname', country='$country' WHERE idcity='$idcity'") or die(mysqli_error());
    if ($update)
    {
        header("Location: editcity.php?idcity=" . $idcity . "&pesan=sukses");
    }
    else
    { // jika query update gagal dieksekusi
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
}

if (isset($_GET['pesan']) == 'sukses')
{
    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="city.php"><- Kembali</a></div>';
}

?>
			<h1>Edit City &raquo; <?php echo $row['cityname']; ?></h1>
						<hr />
		
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3 control-label">CityName</label>
					<div class="col-sm-4">
						<input type="text" name="cityname" value="<?php echo $row['cityname']; ?>" class="form-control" placeholder="fullname">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Country</label>
					<div class="col-sm-4">
						<input type="text" name="country" value="<?php echo $row['country']; ?>" class="form-control" placeholder="email">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-info" value="Simpan" data-toggle="tooltip" title="Simpan Data City">
						<a href="city.php" class="btn btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>				
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
