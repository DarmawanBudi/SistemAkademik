<?php 
error_reporting(0);
session_start();
if ($_SESSION['id_role'] == 'R0001')
{
  include '../template/header_admin.php';
} 
else if ($_SESSION['id_role']=="R0004")
{
  include '../template/header_frontoffice.php';
}
else if ($_SESSION['id_role']=="R0003")
{
  include '../template/header_akademik.php';
}
 include '../koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data siswa
    <small>Semua Data siswa dan CRUD Data siswa</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/frontoffice.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data siswa</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data siswa</h3> 
          <div class="box-tools pull-left">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahsiswa"><i class="fas fa-user-plus"></i> Tambah siswa</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nis</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Jenis Kelamin</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Agama</th>
                  <th>No Hp</th>
                  <th>Status</th>
                  <th>Program</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT * FROM siswa a, program b where a.prog=b.id_program order by nis asc");
                    // siswa a, role b where a.id_role=b.id_role ADALAH relasi dari database
                    // order by nis asc untuk mengurutkan sesuai nis
                    while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['nis'];?></td>
                    <td><?php echo $row['nama'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['jenis'];?></td>
                    <td><?php echo $row['tempat'];?></td>
                    <td><?php echo $row['lahir'];?></td>
                    <td><?php echo $row['agama'];?></td>
                    <td><?php echo $row['hp'];?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['nama_program']; ?></td>
                    <td>
                      <!--<a href="../siswa/form_editsiswa.php?id=<?php echo $row['nis']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#updatesiswa<?php echo $no; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <a href="#" class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#detailsiswa<?php echo $no; ?>"><i class="fas fa-calendar-week"></i> Detail</a>
                      <a href="#" class="btn btn-success btn-flat btn-xs" data-toggle="modal" data-target="#bayarsiswa<?php echo $no; ?>"><i class="fas fa-dollar-sign"></i> Bayar</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletesiswa<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>

                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deletesiswa<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data siswa</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus siswa id <?php echo $row['nis'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancle</button>
                                <a href="../siswa/function_siswa.php?act=deletesiswa&id=<?php echo $row['nis']; ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                       <!-- modal detail -->
                      <div class="example-modal">
                        <div id="detailsiswa<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Detail Pembayaran Siswa</h3>
                              </div>
                              <div class="modal-body">
                              <?php
                                $nis=$row['nis'];
                                $nourut= 1;
                                $query="select * from pembayaran where nis='$nis'";
                                $result=mysqli_query($koneksi,$query);
                                if(mysqli_num_rows($result)>0)
                                {
                                  echo "<table class='table table-condensed'>
                                  <thead>
                                    <tr>
                                      <td>No</td>
                                      <td>Tanggal</td>
                                      <td>Keterangan</td>
                                      <td>Nominal</td>
                                    </tr>
                                  </thead>
                                  <tbody>";
                                  while($rowdetail=mysqli_fetch_array($result))
                                  {
                                    echo "<tr>
                                    <td>$nourut</td>
                                    <td>$rowdetail[tanggal]</td>
                                    <td>$rowdetail[keterangan]</td>
                                    <td> Rp. ";
                                    echo number_format($rowdetail['nominal'],2,",",".");
                                    echo "</td>
                                    </tr>";
                                    $nourut++;
                                  }
                                 echo "</tbody>
                                  </table>";
                                }
                                else
                                {
                                  echo "Belum ada transaksi pembayaran";
                                }
                              ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal detail -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updatesiswa<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data siswa</h3>
                              </div>
                              <div class="modal-body">
                                <form action="../siswa/function_siswa.php?act=updatesiswa" method="post" role="form" enctype="multipart/form-data">
                                  <?php
                                  $nis = $row['nis'];
                                  $query = "SELECT * FROM siswa WHERE nis='$nis'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Nis <span class="text-red">*</span></label>         
                                      <div class="col-sm-8"><input type="text" class="form-control" name="nis" placeholder="Nis" value="<?php echo $row['nis']; ?>" readonly></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Username <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $row['username']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Password <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="password" class="form-control" name="password" placeholder="Password" id="myPassword" value="<?php echo $row['password']; ?>">
                                        <input type="checkbox" onclick="myFunction()"> Lihat Password
                                          <script>
                                          function myFunction() {
                                            var x = document.getElementById("myPassword");
                                            if (x.type === "password") {
                                              x.type = "text";
                                            } else {
                                              x.type = "password";
                                            }
                                          }
                                          </script>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Nama <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo $row['nama']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Email <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $row['email']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Jenis Kelamin <span class="text-red">*</span></label>
                                      <div class="col-sm-8">
                                        <input type="radio" name="jenis" id="pria" value="Pria" <?php if($row['jenis']=='Pria') echo 'checked'?>>Pria
                                        <input type="radio" name="jenis" id="wanita" value="Wanita" <?php if($row['jenis']=='Wanita') echo 'checked'?>>Wanita
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Tempat Lahir <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="tempat" placeholder="Tmpat Lahir" value="<?php echo $row['tempat']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Tanggal Lahir <span class="text-red">*</span></label>
                                      <div class="col-sm-8">
                                        <input type="date" name="lahir" class="form-control">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Agama <span class="text-red">*</span></label>
                                      <div class="col-sm-8">
                                        <select name="agama" class="text-center" id="">
                                          <option value="Islam">Islam</option>
                                          <option value="Krisren">Kristen</option>
                                          <option value="Katolik">Katolik</option>
                                          <option value="Hindu">Hindu</option>
                                          <option value="Budha">Budha</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">No hp <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="hp" placeholder="No Hp" value="<?php echo $row['hp']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Status Sekolah <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="status_sekolah" placeholder="Status Sekolah" value="<?php echo $row['status_sekolah']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Asal Sekolah <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="asal_sekolah" placeholder="Asal Sekolah" value="<?php echo $row['asal_sekolah']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Kerja <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="kerja" placeholder="Kerja" value="<?php echo $row['kerja']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Status <span class="text-red">*</span></label>
                                      <div class="col-sm-8">
                                        <p>DFTAR</p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Program <span class="text-red">*</span></label>
                                      <div class="col-sm-8">
                                        <select name="id_program" class="text-center" id="">
                                          <?php
                                            include ("../koneksidb.php");
                                            $sql="SELECT * FROM program";
                                            $data=mysqli_query($koneksi,$sql);
                                            echo"<option value='$row[id_program]'>$row[prog]</option>";
                                            while ($hasil=mysqli_fetch_array ($data)){
                                              echo"<option value='$hasil[id_program]'>$hasil[nama_program]</option>";
                                            }
                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                        <div class="row">
                                          <label class="col-sm-3 control-label text-right">foto <span class="text-red">*</span></label>
                                          <div class="col-sm-8">
                                            <img src="../aset/img/<?php echo $row['nis'];?>.jpg" alt="" width="100px"  style="padding:10px">
                                            <input type="file" name="foto">
                                          </div>
                                        </div>
                                      </div>
                                  <div class="modal-footer">
                                    <button id="noedit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                  </div>
                                  <?php
                                  }
                                  ?>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal update user -->

                              <!-- modal bayar -->
                      <div class="example-modal">
                        <div id="bayarsiswa<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog"> 
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Pembayaran</h3>
                              </div>
                              <?php
                              require_once("../genid.php");
                              $id=kode_auto("pembayaran","nota","N","1","4");
                              $queryket="select * from pembayaran where nis='$nis'";
                              $resultket=mysqli_query($koneksi,$queryket);
                              if(mysqli_num_rows($resultket)>0)
                              {
                                while($rowket=mysqli_fetch_array($resultket))
                                {
                                  if($retowk['keterangan']=="Pendaftaran")
                                  {
                                    $keterangan="Angsuran 1";
                                  }
                                  else if($rowket['keterangan']=="Angsuran 1")
                                  {
                                    $keterangan="Angsuran 2";
                                  }
                                  else if($rowket['keterangan']=="Angsuran 2")
                                  {
                                    $keterangan="Angsuran 3";
                                  }
                                  else
                                  {
                                    $keterangan="Angsuran 4";
                                  }
                                }
                              }
                              else
                              {
                                
                                $nominal=100000;
                              }
                              //untuk menganbil biaya
                              $querybiaya="SELECT c.*,b.*,sum(a.nominal) AS totalbiaya FROM pembayaran a, siswa b, program c WHERE a.nis=b.nis AND b.prog=c.id_program AND b.nis='$nis'";
                              $resultbiaya=mysqli_query($koneksi,$querybiaya);
                              if (mysqli_num_rows($resultbiaya)>0)
                              {
                                $rowbiaya=mysqli_fetch_array($resultbiaya);
                                $total=$rowbiaya['totalbiaya']-100000;
                                $biaya=$rowbiaya['biaya'];
                                
                                $kekurangan=$biaya-$total;
                              }
                              ?>
                              <div class="modal-body">
                                <form action="../siswa/function_siswa.php?act=bayarsiswa" method="post" role="form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Nota <span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="nota" value="<?php echo $id;?>"readonly></div>
                                    </div>
                                  </div>
                                <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Siswa <span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="nis" value="<?php echo $nis;?>"readonly></div>
                                    </div>
                                  </div>
                                <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Tanggal <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><?php echo date('Y-m-d');?></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Keterangan <span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="keterangan" value="<?php echo $keterangan;?>"readonly></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                    <label class="col-sm-3 control-label text-right">Nominal <span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="text" class="form-control" name="nominal" value="<?php echo $kekurangan; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal bayar close -->
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
              </tbody>
            </table>
          </div> 
        </div>

        <!-- modal insert -->
        <?php
          require_once("../genid.php");
          $kode=kode_auto("siswa","nis","S","1","4");
        ?>
        <div class="example-modal">
          <div id="tambahsiswa" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-labelledby="judulmodalscroll" aria-hidden="true" style="display:none;">
            <div class="modal-dialog modal-dialog-scrollable" role="document"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Registrasi siswa Baru</h3>
                </div>
                <div class="modal-body">
                  <form action="../siswa/function_siswa.php?act=tambahsiswa" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nis <span class="text-red">*</span></label>         
                      <div class="col-sm-8"><input type="text" class="form-control" name="nis" placeholder="Nis" value="<?php echo $kode?>" readonly></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Username <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="username" placeholder="Username" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Password <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="password" class="form-control" name="password" placeholder="Password" id="myPassword" value="">
                      <input type="checkbox" onclick="myFunction()"> Lihat Password
                      <script>
                      function myFunction() {
                        var x = document.getElementById("myPassword");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                      }
                      </script>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nama <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="nama" placeholder="Nama" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Email <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="email" placeholder="Email" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Jenis Kelamin <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                          <input type="radio" name="jenis" id="pria" value="Pria">Pria
                          <input type="radio" name="jenis" id="wanita" value="Wanita">Wanita
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Tempat Lahir <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="tempat" placeholder="Tempat Lahir" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Tanggal Lahir <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                          <input type="date" name="lahir" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Agama <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                      <select name="agama" class="text-center" id="">
                        <option value="Islam">Islam</option>
                        <option value="Krisren">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                    </select>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">No Hp <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="hp" placeholder="No Hp" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Status Sekolah <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="status_sekolah" placeholder="Status Sekolah" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Asal Sekolah <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="asal_sekolah" placeholder="Asal Sekolah" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Kerja <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="kerja" placeholder="Kerja" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Status <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                          <p>DAFTAR</p>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Program <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                          <select name="id_program" class="text-center" id="">
                          <?php
                          include ("../koneksidb.php");
                          $sql="SELECT * FROM program";
                          $data=mysqli_query($koneksi,$sql);
                          while ($hasil=mysqli_fetch_array ($data)){
                            echo"<option value='$hasil[id_program]'>$hasil[nama_program]</option>";
                          }
                          ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">foto <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                          <input type="file" name="foto" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                      <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div>
                    <!--<div class="box-footer">
                      <a href="../siswa/data_siswa.php" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
                      <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div> /.box-footer -->
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div><!-- modal insert close -->


      </div>
    </div>
  </div>
</section><!-- /.content -->
</div>

<?php include '../template/footer.php'; ?>