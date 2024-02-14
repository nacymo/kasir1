<?php

require "../koneksi.php";

$title = "Aplikasi Kasir";
require "header.php";
require "navbar.php";
require "sidebar.php";

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="card bg-primary mt-2">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            Data Barang
            <?php
            include '../koneksi.php';
            $data_produk = mysqli_query($koneksi,"SELECT * FROM produk");
            $jumlah_produk = mysqli_num_rows($data_produk);
            ?>
            <h2><?php echo $jumlah_produk; ?></h2>
            <a href="data_barang.php" class="btn btn-outline-primary btn-sm">Detail</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            Data Pembelian
            <?php
            include '../koneksi.php';
            $data_penjualan = mysqli_query($koneksi,"SELECT * FROM penjualan");
            $jumlah_penjualan = mysqli_num_rows($data_penjualan);
            ?>
            <h2><?php echo $jumlah_penjualan; ?></h2>
            <a href="pembelian.php" class="btn btn-outline-primary btn-sm">Detail</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<?php
include "footer.php";
?>