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
 include '../koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data pembayaran
    <small>Semua Data pembayaran dan CRUD Data pembayaran</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/frontoffice.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data pembayaran</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data pembayaran</h3> 
          <div class="box-tools pull-left">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahpembayaran"><i class="fa fa-male"></i> Tambah pembayaran</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nota</th>
                  <th>Siswa</th>
                  <th>Nominal</th>
                  <th>Tanggal</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT * FROM pembayaran order by nota asc");
                    // pembayaran a, role b where a.id_role=b.id_role ADALAH relasi dari database
                    // order by id_pembayaran asc untuk mengurutkan sesuai id_pembayaran
                    while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['nota'];?></td>
                    <td><?php echo $row['id_siswa'];?></td>
                    <td><?php echo $row['nominal'];?></td>
                    <td><?php echo $row['tanggal'];?></td>
                    <td>
                      <!--<a href="../pembayaran/form_editpembayaran.php?id=<?php echo $row['nota']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updatepembayaran<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletepembayaran<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deletepembayaran<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data pembayaran</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus pembayaran id <?php echo $row['nota'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancle</button>
                                <a href="../pembayaran/function_pembayaran.php?act=deletepembayaran&id=<?php echo $row['nota']; ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updatepembayaran<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data pembayaran</h3>
                              </div>
                              <div class="modal-body">
                                <form action="../pembayaran/function_pembayaran.php?act=updatepembayaran" method="post" role="form" enctype="multipart/form-data">
                                  <?php
                                  $nota = $row['nota'];
                                  $query = "SELECT * FROM pembayaran WHERE nota='$nota'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Nota <span class="text-red">*</span></label>         
                                      <div class="col-sm-8"><input type="text" class="form-control" name="nota" placeholder="" value="<?php echo $row['nota']; ?>" readonly></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Siswa <span class="text-red">*</span></label>         
                                      <div class="col-sm-8"><input type="text" class="form-control" name="id_siswa" placeholder="" value="<?php echo $row['id_siswa']; ?>" readonly></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">nominal <span class="text-red">*</span></label>
                                      <div class="col-sm-8">
                                        <input type="number" class="form-control" name="nominal" placeholder="nominal" value="<?php echo $row['nominal']; ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Tanggal <span class="text-red">*</span></label>
                                      <div class="col-sm-8">
                                        <?php echo $row['tanggal']; ?>
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
          $kode=kode_auto("pembayaran","nota","B","1","4");
        ?>
        <div class="example-modal">
          <div id="tambahpembayaran" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Registrasi pembayaran Baru</h3>
                </div>
                <div class="modal-body">
                  <form action="../pembayaran/function_pembayaran.php?act=tambahpembayaran" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nota <span class="text-red">*</span></label>         
                      <div class="col-sm-8"><input type="text" class="form-control" name="nota" placeholder="nota" value="<?php echo $kode?>" readonly></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-sm-3 control-label text-right">Siswa <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                          <select name="nis" class="text-center" id="">
                          <?php
                          include ("../koneksidb.php");
                          $sql="SELECT * FROM siswa";
                          $data=mysqli_query($koneksi,$sql);
                          while ($hasil=mysqli_fetch_array ($data)){
                            echo"<option value='$hasil[nis]'>$hasil[username]</option>";
                          }
                          ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nominal <span class="text-red">*</span></label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control" name="nominal" placeholder="nominal">
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Tanggal <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                        <?php
                          date_default_timezone_set('Asia/Jakarta');
                          echo date('Y-m-d/h:i:s');
                        ?>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                      <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div>
                    <!--<div class="box-footer">
                      <a href="../pembayaran/data_pembayaran.php" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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