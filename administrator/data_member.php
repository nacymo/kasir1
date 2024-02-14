<?php

require "../koneksi.php";

$title = "Aplikasi Kasir";
require "header.php";
require "navbar.php";
require "sidebar.php";

?>

<div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Member</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
  <div class="card mt-2">
    <!--div class="card-body">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-data">
          Tambah Data
      </button>
    </div-->
    <div class="card-body">
    	<?php 
      if(isset($_GET['pesan'])){
        if($_GET['pesan']=="simpan"){
        echo '<script>
          alert("Data berhasil di simpan");
        </script>';
        }
      }
      ?>
      <?php 
      if(isset($_GET['pesan'])){
        if($_GET['pesan']=="update"){
        echo '<script>
          alert("Data berhasil di edit");
        </script>';
        }
      }
      ?>
      <?php 
      if(isset($_GET['pesan'])){
        if($_GET['pesan']=="hapus"){
        echo '<script>
          alert("Data berhasil di hapus");
        </script>';
        }
      }
      ?>
      <table class="table table-bordered table-striped table-sm mt-1">
        <thead class="thead-primary">
        <tr class="table-primary" class="fw-bold" align="center">
            <th>No</th>
            <th>NIK</th>
            <th>Nama Member</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        	<?php 
          include '../koneksi.php';
          $no = 1;
          $data = mysqli_query($koneksi,"select * from datamember");
          while($d = mysqli_fetch_array($data)){
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nik']; ?></td>
            <td><?php echo $d['nama']; ?></</td>
            <td><?php echo $d['jenkel']; ?></</td>
            <td><?php echo $d['alamat']; ?></</td>
            <td><?php echo $d['telp']; ?></</td>
            <td>
            	<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['nik']; ?>">
                Edit
              </button>
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['nik']; ?>">
                Hapus
              </button>
            </td>
          </tr>
          <!-- Modal Edit Data -->
			<div class="modal fade" id="edit-data<?php echo $d['nik']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <form action="proses_update_member.php" method="post">
			      <div class="modal-body">
			        <div class="form-group">
			            <label>Nik</label>
			            <input type="text" name="nik" class="form-control" value="<?php echo $d['nik']; ?>" autocomplete="off">
			          </div>
			            <div class="form-group">
			            <label>Nama Member</label>
			            <input type="text" name="nama" class="form-control" value="<?php echo $d['nama']; ?>" autocomplete="off">
			          </div>
			          <div class="form-group">
			            <label>Jenis Kelamin</label>
			            <input type="text" name="jenkel" class="form-control" value="<?php echo $d['jenkel']; ?>" autocomplete="off">
			          </div>
			          <div class="form-group">
			            <label>Alamat</label>
			            <input type="text" name="alamat" class="form-control" value="<?php echo $d['alamat']; ?>" autocomplete="off">
			          </div>
			          <div class="form-group">
			            <label>Nomor Telepon</label>
			            <input type="text" name="telp" class="form-control" value="<?php echo $d['telp']; ?>" autocomplete="off">
			          </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
			        <button type="submit" class="btn btn-primary">Simpan</button>
			      </div>
			    </div>
			</form>
			  </div>
			</div>

          <!-- Modal Hapus Data -->
          <div class="modal fade" id="hapus-data<?php echo $d['nik']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form method="post" action="proses_hapus_member.php">
                    <div class="modal-body">
                      <input type="hidden" name="nik" value="<?php echo $d['nik']; ?>">
                       Apakah anda yakin akan menghapus data <b><?php echo $d['nama']; ?></b>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                      <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
          </div>
        <?php } ?>
        </tbody>
      </table>
    </table>
  </div>
</div>
    </div>
  </div>
  </div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses_simpan_member.php" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control"  autocomplete="off">
          </div>
          <div class="form-group">
            <label>Nama Member</label>
            <input type="text" name="nama" class="form-control" autocomplete="off">
          </div>
          <div class="form-group">
        	<label>Jenis Kelamin</label>
        	<select name="jenkel" class="form-control">
        		<option>--- Jenis Kelamin ---</option>
        		<option value="laki-laki" <?php if ($d['jenkel'] == 'laki-laki') ?>>Laki-laki</option>
        		<option value="perempuan" <?php if ($d['jenkel'] == 'perempuan') ?>>Perempuan</option>
        	</select>
        	</div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" autocomplete="off">
          </div>
          <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="telp" class="form-control" autocomplete="off">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
include "footer.php";
?>
  