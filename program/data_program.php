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
 include '../koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data program
    <small>Semua Data program dan CRUD Data program</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data program</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data program</h3> 
          <div class="box-tools pull-left">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahprogram"><i class="fas fa-folder-plus"></i> Tambah program</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id program</th>
                  <th>Nama Program</th>
                  <th>Keterangan</th>
                  <th>Sesi</th>
                  <th>Biaya</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT * FROM program order by id_program asc");
                    // program a, role b where a.id_role=b.id_role ADALAH relasi dari database
                    // order by id_program asc untuk mengurutkan sesuai id_program
                    while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['id_program'];?></td>
                    <td><?php echo $row['nama_program'];?></td>
                    <td><?php echo $row['keterangan'];?></td>
                    <td><?php echo $row['sesi'];?></td>
                    <td><?php echo $row['biaya'];?></td>
                    <td>
                      <!--<a href="../program/form_editprogram.php?id=<?php echo $row['id_program']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updateprogram<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deleteprogram<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deleteprogram<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data program</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus program id <?php echo $row['id_program'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancle</button>
                                <a href="../program/function_program.php?act=deleteprogram&id=<?php echo $row['id_program']; ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updateprogram<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data program</h3>
                              </div>
                              <div class="modal-body">
                                <form action="../program/function_program.php?act=updateprogram" method="post" role="form" enctype="multipart/form-data">
                                  <?php
                                  $id_program = $row['id_program'];
                                  $query = "SELECT * FROM program WHERE id_program='$id_program'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Id program <span class="text-red">*</span></label>         
                                      <div class="col-sm-8"><input type="text" class="form-control" name="id_program" placeholder="Id program" value="<?php echo $row['id_program']; ?>" readonly></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Nama Program <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="nama_program" placeholder="Nama Program" value="<?php echo $row['nama_program']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">keterangan <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="keterangan" placeholder="keterangan" value="<?php echo $row['keterangan']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Sesi <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="sesi" placeholder="Sesi" value="<?php echo $row['sesi']; ?>"></div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">biaya <span class="text-red">*</span></label>
                                      <div class="col-sm-8"><input type="text" class="form-control" name="biaya" placeholder="Biaya" value="<?php echo $row['biaya']; ?>"></div>
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
          $kode=kode_auto("program","id_program","P","1","4");
        ?>
        <div class="example-modal">
          <div id="tambahprogram" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Registrasi program Baru</h3>
                </div>
                <div class="modal-body">
                  <form action="../program/function_program.php?act=tambahprogram" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Id program <span class="text-red">*</span></label>         
                      <div class="col-sm-8"><input type="text" class="form-control" name="id_program" placeholder="Id program" value="<?php echo $kode?>" readonly></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Nama Program <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="nama_program" placeholder="Nama Program" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">keterangan <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="keterangan" placeholder="keterangan" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Sesi <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="sesi" placeholder="Sesi" value=""></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Biaya <span class="text-red">*</span></label>
                      <div class="col-sm-8"><input type="text" class="form-control" name="biaya" placeholder="Biaya" value=""></div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                      <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                    </div>
                    <!--<div class="box-footer">
                      <a href="../program/data_program.php" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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