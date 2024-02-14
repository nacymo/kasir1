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
            <h1 class="m-0">Data Pelanggan</h1>
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
								<th>ID Pelanggan</th>
								<th>Nama Pelanggan</th>
								<th>Alamat</th>
								<th>No. Telepon</th>
								<th>Total Pembayaran</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							include '../koneksi.php';
							$no = 1;
							$data = mysqli_query($koneksi,"SELECT * from pelanggan inner join penjualan on pelanggan.PelangganID=penjualan.PelangganID");
							while($d = mysqli_fetch_array($data)){
							?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $d['PelangganID']; ?></td>
									<td><?php echo $d['NamaPelanggan']; ?></td>
									<td><?php echo $d['Alamat']; ?></td>
									<td><?php echo $d['NomorTelepon']; ?></td>
									<td>Rp. <?php echo $d['TotalHarga']; ?></td>
									<td>
										<a class="btn btn-info btn-sm" href="detail_pembelian.php?PelangganID=<?php echo $d['PelangganID'];?> ">Detail</a>
										<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['PelangganID']; ?>">
  									Edit
										</button>
										<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['PelangganID']; ?>">
  									Hapus
										</button>
									</td>
								</tr>
								<!-- Modal Edit Data -->
								<div class="modal fade" id="edit-data<?php echo $d['PelangganID'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <form action="proses_update_pembelian.php" method="post">
								      <div class="modal-body">
								        	<div class="form-group">
								        		<input type="text" name="PelangganID" value="<?php echo $d['PelangganID'];?>" class="form-control" hidden autocomplete="off">
								        	</div>
								        	<div class="form-group">
								        		<label>Nama Pelanggan</label>
								        		<input type="text" name="NamaPelanggan" value="<?php echo $d['NamaPelanggan'];?>" class="form-control" autocomplete="off">
								        	</div>
								        	<div class="form-group">
								        		<label>Alamat</label>
								        		<input type="text" name="Alamat" value="<?php echo $d['Alamat'];?>" class="form-control" autocomplete="off">
								        	</div>
								        	<div class="form-group">
								        		<label>No Telepon</label>
								        		<input type="text" name="NomorTelepon" value="<?php echo $d['NomorTelepon'];?>" class="form-control" autocomplete="off">
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
								<div class="modal fade" id="hapus-data<?php echo $d['PelangganID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  						<div class="modal-dialog">
			    						<div class="modal-content">
			      							<div class="modal-header">
			        							<h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
			        							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      							</div>
			      							<form method="post" action="proses_hapus_pembelian.php">
			      							<div class="modal-body">
			      								<input type="hidden" name="PelangganID" value="<?php echo $d['PelangganID']; ?>">
			       								 Apakah anda yakin akan menghapus data <b><?php echo $d['NamaPelanggan']; ?></b>
			      							</div>
			      							<div class="modal-footer">
			        							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
			        							<button type="submit" class="btn btn-primary">Hapus</button>
			      							</div>
			      							</form>
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
	</div>
<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses_pembelian.php" method="post">
      <div class="modal-body">
        	<div class="form-group">
        		<label>ID Pelanggan</label>
        		<input type="text" name="PelangganID" value="<?php echo date("dmHi") ?>" class="form-control" readonly autocomplete="off">
        	</div>
        	<div class="form-group">
        		<label>Nama Pelanggan</label>
        		<input type="text" name="NamaPelanggan" class="form-control" autocomplete="off">
        	</div>
        	<div class="form-group">
        		<label>Alamat</label>
        		<input type="text" name="Alamat" class="form-control" autocomplete="off">
        		<input type="hidden" name="TanggalPenjualan" value="<?php echo date("Y-m-d") ?>" class="form-control" autocomplete="off">
        	</div>
        	<div class="form-group">
        		<label>No Telepon</label>
        		<input type="text" name="NomorTelepon" class="form-control" autocomplete="off">
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
	
	