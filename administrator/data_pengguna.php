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
            <h1 class="m-0">Data Pengguna</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="content">
      <div class="container-fluid">
	<div class="card mt-2">
		<div class="card-body">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-data">
  				Tambah Data
			</button>
		</div>
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
			<table class="table">
				<table class="table table-bordered table-striped table-sm mt-1">
        <thead class="thead-primary">
        <tr class="table-primary" class="fw-bold" align="center">
						<th>No</th>
						<th>Nama Petugas</th>
						<th>Username</th>
						<th>Akses Petugas</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					include '../koneksi.php';
					$no = 1;
					$data = mysqli_query($koneksi,"select * from petugas");
					while($d = mysqli_fetch_array($data)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $d['nama_petugas']; ?></td>
						<td><?php echo $d['username']; ?></td>
						<td>
							<?php
							if ($d['level'] == $_SESSION['level']) { ?>
								Administrator
							<?php } else { ?>
								Petugas
							<?php } ?>
						</td>
						<td>
							<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['id_petugas']; ?>">
  							Edit
							</button>
							<?php
							if ($d['level'] == 'admin') { ?>
							<?php } else { ?>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['id_petugas']; ?>">
  							Hapus
							</button>
						</td>
					<?php }?>
					</tr>
					<!-- Modal Edit Data -->
					<div class="modal fade" id="edit-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  						<div class="modal-dialog">
    						<div class="modal-content">
      							<div class="modal-header">
        							<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
        							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      							</div>
      							<form action="proses_update_petugas.php" method="post">
      							<div class="modal-body">
       								<div class="form-group">
        								<label>Nama Petugas</label>
        								<input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
        								<input type="text" name="nama_petugas" class="form-control" value="<?php echo $d['nama_petugas']; ?>" autocomplete="off">
        							</div>
        							<div class="form-group">
        								<label>Username</label>
        								<input type="text" name="username" class="form-control" value="<?php echo $d['username']; ?>" autocomplete="off">
        							</div>
        							<div class="form-group">
        								<label>Password</label>
        								<br><small class="text-danger">Kosongkan jika tidak merubah password</small>
        								<input type="text" name="password" class="form-control" autocomplete="off">
        							</div>
        							<div class="form-group">
        								<label>Level</label>
        								<input type="text" name="level" class="form-control" value="<?php echo $d['level']; ?>" autocomplete="of">
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

					<!-- Modal Hapus Data -->
					<div class="modal fade" id="hapus-data<?php echo $d['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  						<div class="modal-dialog">
    						<div class="modal-content">
      							<div class="modal-header">
        							<h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
        							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      							</div>
      							<div class="modal-body">
      							<form method="post" action="proses_hapus_petugas.php">
      							<div class="modal-body">
      								<input type="hidden" name="id_petugas" value="<?php echo $d['id_petugas']; ?>">
       								 Apakah anda yakin akan menghapus data <b><?php echo $d['nama_petugas']; ?></b>
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses_simpan_petugas.php" method="post">
      <div class="modal-body">
        	<div class="form-group">
        		<label>Nama Petugas</label>
        		<input type="text" name="nama_petugas" class="form-control"  autocomplete="off">
        	</div>
        	<div class="form-group">
        		<label>Username</label>
        		<input type="text" name="username" class="form-control" autocomplete="off">
        	</div>
        	<div class="form-group">
        		<label>Password</label>
        		<input type="text" name="password" class="form-control" autocomplete="off">
        	</div>
        	<div class="form-group">
        		<label>Level</label>
        		<select name="level" class="form-control">
        			<option>--- Level ---</option>
        			<option value="admin">Administrator</option>
        			<option value="petugas">Petugas</option>
        		</select>
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
	
	
	
	