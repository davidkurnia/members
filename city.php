<?php
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
   <div class="container">
    <div class="row">
            <h1>Data City</h1>
            <hr />
            <a href="city.php" class="btn btn-info">1. CRUD City</a>
            <a href="company.php" class="btn btn-info">2. CRUD Company</a>
            <a href="tambahcity.php" class="btn btn-success">Add Data</a>
            <hr />            
            <?php
if (isset($_GET['aksi']) == 'delete') // mengkonfirmasi jika 'aksi' bernilai 'delete'
  {
    $idcity = $_GET['idcity']; // ambil nilai nim
    $cek    = mysqli_query($koneksi, "Select * from city WHERE idcity='$idcity'"); // query untuk memilih entri dengan nim yang dipilih
    if (mysqli_num_rows($cek) == 0) // mengecek jika tidak ada entri nim yang dipilih
      {
        echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; // maka tampilkan 'Data tidak ditemukan.'
      }
    else // mengecek jika terdapat entri nim yang dipilih
      {
        $delete = mysqli_query($koneksi, "DELETE FROM city WHERE idcity='$idcity'"); // query untuk menghapus
        if ($delete) // jika query delete berhasil dieksekusi
          {
            echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
          }
        else // jika query delete gagal dieksekusi
          {
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
                        <th>CityName</th>
                        <th>Country</th>
                        <th>Tools</th>
                    </tr>
                    <?php
$sql = mysqli_query($koneksi, "Select * from city");

if (mysqli_num_rows($sql) == 0)
  {
    echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
  }
else // jika terdapat entri maka tampilkan datanya
  {
    $no = 1; // mewakili data dari nomor 1
    while ($row = mysqli_fetch_assoc($sql)) // fetch query yang sesuai ke dalam array
      {
        echo '
                            <tr>
                                <td>' . $no . '</td>
                                <td>' . $row['cityname'] . '</td>
                                <td>' . $row['country'] . '</td>
                                <td>
                                    
                                    <a href="editcity.php?idcity=' . $row['idcity'] . '" class="btn btn-warning">Edit</a>
                                    <a href="city.php?aksi=delete&idcity=' . $row['idcity'] . '" onclick="return confirm(\'Anda yakin akan menghapus data ' . $row['cityname'] . '?\')" class="btn btn-danger">Delete</a>
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