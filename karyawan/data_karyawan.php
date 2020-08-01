<?php 
include '../template/header_admin.php'; 
include '../koneksidb.php';
?>

<div class="content-wrapper">
<section class="content-header">
  <h1>Data Karyawan
    <small>Semua Data Karyawan dan CRUD Data Karyawan</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="../admin/admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Data Karyawan</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">List Data Karyawan</h3> 
          <div class="box-tools pull-left">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahkaryawan"><i class="fa fa-male"></i> Tambah Karyawan</a>
          </div>
        </div>
        <div class="box-body">

          <div class="table-responsive22">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Karyawan</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Jenis Kelamin</th>
                  <th>No Hp</th>
                  <th>Role</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                    $no = 1;
                    $queryview = mysqli_query($koneksi, "SELECT * FROM karyawan a, role b where a.id_role=b.id_role order by id_karyawan asc");
                    // karyawan a, role b where a.id_role=b.id_role ADALAH relasi dari database
                    // order by id_karyawan asc untuk mengurutkan sesuai id_karyawan
                    while ($row = mysqli_fetch_assoc($queryview)) {
                  ?>
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['id_karyawan'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['password'];?></td>
                    <td><?php echo $row['nama'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['kelamin'];?></td>
                    <td><?php echo $row['hp'];?></td>
                    <td><?php echo $row['user_role']; ?></td>
                    <td>
                      <!--<a href="../karyawan/form_editkaryawan.php?id=<?php echo $row['id_karyawan']?>" class="btn btn-primary btn-flat btn-xs"><i class="fa fa-pencil"></i> Edit</a>-->
                      <a href="#" class="btn btn-primary btn-flat btn-xs" data-toggle="modal" data-target="#updatekaryawan<?php echo $no; ?>"><i class="fa fa-pencil"></i> Edit</a>
                      <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#deletekaryawan<?php echo $no; ?>"><i class="fa fa-trash"></i> Delete</a>                      
                      
                      <!-- modal delete -->
                      <div class="example-modal">
                        <div id="deletekaryawan<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Konfirmasi Delete Data Karyawan</h3>
                              </div>
                              <div class="modal-body">
                                <h4 align="center" >Apakah anda yakin ingin menghapus karyawan id <?php echo $row['id_karyawan'];?><strong><span class="grt"></span></strong> ?</h4>
                              </div>
                              <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancle</button>
                                <a href="../karyawan/function_karyawan.php?act=deletekaryawan&id=<?php echo $row['id_karyawan']; ?>" class="btn btn-primary">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div><!-- modal delete -->

                      <!-- modal update user -->
                      <div class="example-modal">
                        <div id="updatekaryawan<?php echo $no; ?>" class="modal fade" role="dialog" style="display:none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">Edit Data Karyawan</h3>
                              </div>
                              <div class="modal-body">
                                <form action="../karyawan/function_karyawan.php?act=updatekaryawan" method="post" role="form" enctype="multipart/form-data">
                                  <?php
                                  $id_karyawan = $row['id_karyawan'];
                                  $query = "SELECT * FROM karyawan a, role b WHERE a.id_role=b.id_role and id_karyawan='$id_karyawan'";
                                  $result = mysqli_query($koneksi, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                  <div class="form-group">
                                    <div class="row">
                                      <label class="col-sm-3 control-label text-right">Id Karyawan <span class="text-red">*</span></label>         
                                      <div class="col-sm-8"><input type="text" class="form-control" name="id_karyawan" placeholder="Id karyawan" value="<?php echo $row['id_karyawan']; ?>" readonly></div>
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
                                        <input type="radio" name="kelamin" id="pria" value="Pria" <?php if($row['kelamin']=='Pria') echo 'checked'?>>Pria
                                        <input type="radio" name="kelamin" id="wanita" value="Wanita" <?php if($row['kelamin']=='Wanita') echo 'checked'?>>Wanita
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
                                      <label class="col-sm-3 control-label text-right">Role <span class="text-red">*</span></label>
                                      <div class="col-sm-8">
                                        <select name="id_role" class="text-center" id="">
                                          <?php
                                            include ("../koneksidb.php");
                                            $sql="SELECT * FROM role";
                                            $data=mysqli_query($koneksi,$sql);
                                            echo"<option value='$row[id_role]'>$row[user_role]</option>";
                                            while ($hasil=mysqli_fetch_array ($data)){
                                              echo"<option value='$hasil[id_role]'>$hasil[user_role]</option>";
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
                                            <img src="../aset/img/<?php echo $row['id_karyawan']?>.jpg" alt="" width="100px" style="padding:10px">
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
          $kode=kode_auto("karyawan","id_karyawan","K","1","4");
        ?>
        <div class="example-modal">
          <div id="tambahkaryawan" class="modal fade" role="dialog" style="display:none;">
            <div class="modal-dialog"> 
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h3 class="modal-title">Registrasi Karyawan Baru</h3>
                </div>
                <div class="modal-body">
                  <form action="../karyawan/function_karyawan.php?act=tambahkaryawan" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="row">
                      <label class="col-sm-3 control-label text-right">Id Karyawan <span class="text-red">*</span></label>         
                      <div class="col-sm-8"><input type="text" class="form-control" name="id_karyawan" placeholder="Id Karyawan" value="<?php echo $kode?>" readonly></div>
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
                      <input type="radio" name="kelamin" id="pria" value="Pria">Pria
                      <input type="radio" name="kelamin" id="wanita" value="Wanita">Wanita
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
                        <label class="col-sm-3 control-label text-right">Role <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                          <select name="id_role" class="text-center" id="">
                          <?php
                          include ("../koneksidb.php");
                          $sql="SELECT * FROM role";
                          $data=mysqli_query($koneksi,$sql);
                          while ($hasil=mysqli_fetch_array ($data)){
                            echo"<option value='$hasil[id_role]'>$hasil[user_role]</option>";
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
                      <a href="../karyawan/data_karyawan.php" class="btn btn-danger"><i class="fa fa-close"></i> Batal</a>
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