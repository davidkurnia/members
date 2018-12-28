<?php
include ("header.php"); // memanggil file header.php
include ("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database

?>
	<div class="container">
		<div class="row">

			
			<?php
$id = $_GET['id']; // assigment nim dengan nilai nim yang akan diedit
$sql = mysqli_query($koneksi, "SELECT * FROM members WHERE id='$id'"); // query untuk memilih entri data dengan nilai nim terpilih
if (mysqli_num_rows($sql) == 0)
{
    header("Location: index.php");
}
else
{
    $row = mysqli_fetch_assoc($sql);
}

$msg = "";
$comp = mysqli_query($koneksi, "SELECT company.idcompany, company.name FROM members join company on members.idcompany=company.idcompany where id='$id'");
$comp1 = mysqli_query($koneksi, "SELECT * from company join members on members.idcompany!=company.idcompany where id='$id'");
$city = mysqli_query($koneksi, "Select city.idcity, city.cityname, city.country from members join city on members.idcity=city.idcity where id='$id'");
$city1 = mysqli_query($koneksi, "SELECT * from city join members on members.idcity!=city.idcity where id='$id'");
$foto = mysqli_query($koneksi, "Select foto from members where id='$id'");

if (isset($_POST['save']))
{ // jika tombol 'Simpan' dengan properti name="add" ditekan
    $target = "uploads/" . basename($_FILES["foto"]["name"]);
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $idcompany1 = $_POST['idcompany'];
    $idcity1 = $_POST['idcity'];
    $foto = $_FILES["foto"]["name"];

    $update = mysqli_query($koneksi, "UPDATE members SET fullname='$fullname', email='$email', address='$address', idcompany='$idcompany1', idcity='$idcity1', foto='$foto' WHERE id='$id'") or die(mysqli_error());
    if ($update)
    {
        header("Location: edit.php?nim=" . $id . "&pesan=sukses");
    }
    else
    { // jika query update gagal dieksekusi
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>';
    }
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target))
    {
        $msg = " success";

    }
    else
    {
        $foto = $_FILES["foto"]["name"];
        $msg = "There was a problem uploading image";
    }
}
if (isset($_GET['pesan']) == 'sukses')
{
    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="data.php"><- Kembali</a></div>';
}

?>
			<h1>Edit Member &raquo; <?php echo $row['fullname']; ?></h1>
						<hr />
		
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3 control-label">Fullname</label>
					<div class="col-sm-4">
						<input type="text" name="fullname" value="<?php echo $row['fullname']; ?>" class="form-control" placeholder="fullname" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-4">
						<input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="email" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Address</label>
					<div class="col-sm-4">
						<input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control" placeholder="address" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Company</label>
					<div class="col-sm-4">
						<select name="idcompany" value="<?php echo $row['idcompany']; ?>" class="form-control" required>
							<?php
while ($row = $comp->fetch_assoc())
{
    $idcompany1 = $row['idcompany'];
    $name1 = $row['name'];
    echo "<option value='$idcompany1'>$name1</option>";
}
while ($row = $comp1->fetch_assoc())
{
    $idcompany1 = $row['idcompany'];
    $name1 = $row['name'];
    echo "<option value='$idcompany1'>$name1</option>";
}
?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">City</label>
					<div class="col-sm-4">
						<select name="idcity" value="<?php echo $row['idcity']; ?>" class="form-control" required>
							<?php
while ($row = $city->fetch_assoc())
{
    $idcity1 = $row['idcity'];
    $cityname1 = $row['cityname'];
    $country = $row['country'];
    echo "<option value='$idcity1'>$cityname1,$country</option>";
}
while ($row = $city1->fetch_assoc())
{
    $idcity2 = $row['idcity'];
    $cityname2 = $row['cityname'];
    $country = $row['country'];
    echo "<option value='$idcity2'>$cityname2,$country</option>";
}
?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-3">
						<?php
while ($row = $foto->fetch_assoc())
{
    echo "<img src='img/" . $row["foto"] . "' width='85' height='85' >";
}

?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Foto</label>
					<div class="col-sm-4">
						<input type="file" name="foto" value="<?php echo $row['foto']; ?>" class="form-control" placeholder="foto" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-info" value="Simpan" data-toggle="tooltip" title="Simpan Data mahasiswa">
						<a href="index.php" class="btn btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
<?php
// include("footer.php"); // memanggil file footer.php

?>
