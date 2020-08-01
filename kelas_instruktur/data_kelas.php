<?php 
error_reporting(0);
session_start();
if ($_SESSION['id_role'] == 'R0001')
{
  include '../template/header_admin.php';
} 
else if ($_SESSION['id_role']=="R0003")
{
  include '../template/header_akademik.php';
}
else if ($_SESSION['id_role']=="R0010")
{
  include '../template/header_instruktur.php';
}
 include '../koneksidb.php';
 include("combo_tambah.php");
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data kelas
    <small>Semua Data kelas dan CRUD Data kelas</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data kelas</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data kelas</h3> 
          <div class="box-tools pull-left">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahkelas"><i class="fas fa-plus"></i> Tambah kelas</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID kelas</th>
                  <th>Program</th>
                  <th>Waktu</th>
                  <th>Ruang</th>
                  <th>Instruktur</th>
                  <th>Keterangan</th>
                  <th>Tanggal</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  $queryview = mysqli_query($koneksi, "SELECT a.id_kelas as id_kelas, a.id_program as id_prog, b.*, c.*, d.*, e.* FROM kelas a, program b, waktu c, ruang d, instruktur e where a.id_program=b.id_program and a.id_waktu=c.id_waktu and a.id_ruang=d.id_ruang and a.id_instruktur=e.id_instruktur order by id_kelas asc");
                  // kelas a, role b where a.id_role=b.id_role ADALAH relasi dari database
                  // order by id_kelas asc untuk mengurutkan sesuai id_kelas
                  while ($row = mysqli_fetch_assoc($queryview)) {
                ?>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $row['id_kelas'];?></td>
                  <td><?php echo $row['nama_program'];?></td>
                  <td><?php echo $row['mulai'];?></td>
                  <td><?php echo $row['ruang'];?></td>
                  <td><?php echo $row['username'];?></td>
                  <td><?php echo $row['keterangan_kelas'];?></td>
                  <td><?php echo $row['tanggal'];?></td>
                  <td>
                    <!--<a href="../kelas/form_editkelas.php?id=<?php echo $row['id_kelas']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                    <a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="#updatekelas<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="#" class="btn btn-success btn-flat btn-xs" data-toggle="modal" data-target="#gabungkelas<?php echo $no; ?>"><i class="fas fa-link"></i> Gabung</a>
                    <a href="#" class="btn btn-info btn-flat btn-xs" data-toggle="modal" data-target="#lihatkelas<?php echo $no; ?>"><i class="fas fa-eye"></i></i> Lihat</a>
                    <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletekelas<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                    
                    <!-- modal delete -->
                    <div class="example-modal">
                      <div id="deletekelas<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h3 class="modal-title">Konfirmasi Delete Data kelas</h3>
                            </div>
                            <div class="modal-body">
                              <h4 align="center" >Apakah anda yakin ingin menghapus kelas id <?php echo $row['id_kelas'];?><strong><span class="grt"></span></strong> ?</h4>
                            </div>
                            <div class="modal-footer">
                              <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancle</button>
                              <a href="../kelas/function_kelas.php?act=deletekelas&id=<?php echo $row['id_kelas']; ?>" class="btn btn-primary">Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- modal delete -->

                    <!-- modal gabung -->
                    <div class="example-modal">
                      <div id="gabungkelas<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h3 class="modal-title">Konfirmasi Gabung kelas</h3>
                            </div>
                            <div class="modal-body">
                              <form action="../kelas/function_kelas.php?act=gabungkelas" method="post" role="form" enctype="multipart/form-data">
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Nama Siswa<span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                    <input type="hidden" name="id_kelas" value="<?php echo $row['id_kelas']; ?>">
                                      <?php
                                      
                                      $id_program = $row['id_prog'];
                                        $querygabung="SELECT * FROM siswa WHERE prog='$id_program' and status='Daftar'";
                                        $resultgabung=mysqli_query($koneksi,$querygabung);
                                        if (mysqli_num_rows($resultgabung)>0)
                                          while ($rowgabung=mysqli_fetch_array ($resultgabung)){
                                          echo"<input class='form-check-input' type='checkbox' value='$rowgabung[nis]' name='nis[]'> $rowgabung[nama]</br>";
                                        }
                                      ?> 
                                    </div>
                                  </div>
                                </div>
                              
                            </div>
                            <div class="modal-footer">
                              <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                              <input type="submit" name="submit" class="btn btn-primary" value="Gabung">
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div><!-- modal gabung -->

                    <!-- modal lihat -->
                    <div class="example-modal">
                      <div id="lihatkelas<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h3 class="modal-title">Lihat Siswa</h3>
                            </div>
                            <div class="modal-body">
                            <?php
                              $id_lihat=$row['id_kelas'];
                              $nourut= 1;
                              $querylihat="select * from detail_kelas a, siswa b where id_kelas='$id_lihat' and a.nis=b.nis";
                              $resultlihat=mysqli_query($koneksi,$querylihat);
                              if(mysqli_num_rows($resultlihat)>0)
                              {
                                echo "<table class='table table-condensed'>
                                <thead>
                                  <tr>
                                    <td>No</td>
                                    <td>Nis</td>
                                    <td>Nama</td>
                                    
                                  </tr>
                                </thead>
                                <tbody>";
                                while($rowlihat=mysqli_fetch_array($resultlihat))
                                {
                                  echo "<tr>
                                  <td>$nourut</td>
                                  <td>$rowlihat[nis]</td>
                                  <td>$rowlihat[nama]</td>
                                  
                                  </tr>";
                                  $nourut++;
                                }
                                echo "</tbody>
                                </table>";
                              }
                              else
                              {
                                echo "Tidak Ada Siswa";
                              }
                            ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- modal detail -->

                    <!-- modal update user -->
                    <div class="example-modal">
                      <div id="updatekelas<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h3 class="modal-title">Edit Data kelas</h3>
                            </div>
                            <div class="modal-body">
                              <form action="../kelas/function_kelas.php?act=updatekelas" method="post" role="form" enctype="multipart/form-data">
                                <?php
                                $id_kelas = $row['id_kelas'];
                                $queryupdate = "SELECT a.*, b.*, c.*, d.*, e.id_instruktur, e.username FROM kelas a, program b, waktu c, ruang d, instruktur e where a.id_program=b.id_program and a.id_waktu=c.id_waktu and a.id_ruang=d.id_ruang and a.id_instruktur=e.id_instruktur and id_kelas='$id_kelas'";
                                $resultupdate = mysqli_query($koneksi, $queryupdate);
                                while ($row = mysqli_fetch_assoc($resultupdate)) {
                                ?>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">ID Kelas <span class="text-red">*</span></label>         
                                    <div class="col-sm-8"><input type="text" class="form-control" name="id_kelas" value="<?php echo $row['id_kelas']; ?>" readonly></div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Program <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" name="id_program" value="<?php echo $row['nama_program']; ?>" readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Waktu <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                      <select name="id_waktu" class="form-control" id="">
                                          <?php
                                            $querywaktu="SELECT * FROM waktu";
                                            $resultwaktu=mysqli_query($koneksi,$querywaktu);
                                            if (mysqli_num_rows($resultwaktu)>0)
                                              echo"<option value='$row[id_waktu]'>$row[mulai]</option>";
                                              while ($rowwaktu=mysqli_fetch_array ($resultwaktu)){
                                              echo"<option value='$rowwaktu[id_waktu]'>$rowwaktu[mulai]</option>";
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Ruang <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                      <select name="id_ruang" class="form-control" id="">
                                        <?php
                                          $queryruang="SELECT * FROM ruang";
                                          $resultruang=mysqli_query($koneksi,$queryruang);
                                          if (mysqli_num_rows($resultruang)>0)
                                            echo"<option value='$row[id_ruang]'>$row[ruang]</option>";
                                            while ($rowruang=mysqli_fetch_array ($resultruang)){
                                            echo"<option value='$rowruang[id_ruang]'>$rowruang[ruang]</option>";
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Instruktur <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                      <select name="id_instruktur" class="form-control" id="">
                                        <?php
                                          $id_pgrm = $row['id_program'];
                                          $queryinstruktur="SELECT * FROM instruktur WHERE id_program LIKE '%".$id_pgrm."%'";
                                          $resultinstruktur=mysqli_query($koneksi,$queryinstruktur);
                                          if (mysqli_num_rows($resultinstruktur)>0)
                                            echo"<option value='$row[id_instruktur]'>$row[username]</option>";
                                            while ($rowinstruktur=mysqli_fetch_array ($resultinstruktur)){
                                            echo"<option value='$rowinstruktur[id_instruktur]'>$rowinstruktur[username]</option>";
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">Keterangan <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                    <select name="keterangan_kelas" class="form-control" id="">
                                      <?php echo"<option value='$row[keterangan_kelas]'>$row[keterangan_kelas]</option>"; ?>
                                      <option value="reguler" <?php if($row=="reguler"){echo "selected";} ?> >Reguler</option>
                                      <option value="privat" <?php if($row=="privat"){echo "selected";} ?> >Privat</option>
                                      <option value="profesi" <?php if($row=="profesi"){echo "selected";} ?> >Profesi</option>
                                    </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="row">
                                    <label class="col-sm-3 control-label text-right">tanggal <span class="text-red">*</span></label>
                                    <div class="col-sm-8"><input type="date" class="form-control" name="tanggal" value="<?php echo $row['tanggal']; ?>"></div>
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
          $kode=kode_auto("kelas","id_kelas","K","1","4");
        ?>
        <div class="example-modal">
          <div id="tambahkelas" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Registrasi kelas Baru</h3>
                </div>
                <div class="modal-body">
                  <form action="../kelas/function_kelas.php?act=tambahkelas" name="form_tambah" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">ID Kelas <span class="text-red">*</span></label>         
                      <div class="col-sm-8"><input type="text" class="form-control" name="id_kelas" value="<?php echo $kode?>" readonly></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Program <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                        <select name="id_program" class="form-control" id="" onchange="showIn()">
                          <?php
                            $queryprogram="SELECT * FROM program";
                            $resultprogram=mysqli_query($koneksi,$queryprogram);
                            if (mysqli_num_rows($resultprogram)>0)
                              echo "<option value='Silahkan pilih'>Silahkan pilih program</option>";
                              while ($rowprogram=mysqli_fetch_array ($resultprogram)){
                              echo"<option value='$rowprogram[id_program]'>$rowprogram[nama_program]</option>";
                            }
                          ?>
                        </select>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Waktu <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                        <select name="id_waktu" class="form-control" id="">
                          <?php
                            $querywaktu="SELECT * FROM waktu";
                            $resultwaktu=mysqli_query($koneksi,$querywaktu);
                            if (mysqli_num_rows($resultwaktu)>0)
                              echo "<option value='Silahkan pilih'>Silahkan pilih waktu</option>";
                              while ($rowwaktu=mysqli_fetch_array ($resultwaktu)){
                              echo"<option value='$rowwaktu[id_waktu]'>$rowwaktu[mulai] - $rowwaktu[selesai]</option>";
                            }
                          ?>
                        </select>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Ruang <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                        <select name="id_ruang" class="form-control" id="">
                          <?php
                            $queryruang="SELECT * FROM ruang";
                            $resultruang=mysqli_query($koneksi,$queryruang);
                            if (mysqli_num_rows($resultruang)>0)
                              echo "<option value='Silahkan pilih'>Silahkan pilih ruang</option>";
                              while ($rowruang=mysqli_fetch_array ($resultruang)){
                              echo"<option value='$rowruang[id_ruang]'>$rowruang[ruang]</option>";
                            }
                          ?>
                        </select>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Instruktur <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                        <select name="id_instruktur" class="form-control" id="ins">
                          <option value='Silahkan pilih'>Silahkan pilih Program Dahulu</option>";
                        </select>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Keterangan <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                      <select name="keterangan_kelas" class="form-control" id="">
                        <option value="Silahkan pilih">Silahkan pilih keterangan</option>
                        <option value="reguler">Reguler</option>
                        <option value="privat">Privat</option>
                        <option value="profesi">Profesi</option>
                      </select>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Tanggal Mulai <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                      <input type="date" name="tanggal">
                      </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                      <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div>
                    <!--<div class="box-footer">
                      <a href="../kelas/data_kelas.php" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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