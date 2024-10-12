<?php
include 'config/db.php';

// Tambah Transaksi
if (isset($_POST['create'])) {
  $jenis = $_POST['jenis'];
  $jumlah = $_POST['jumlah'];
  $keterangan = $_POST['keterangan'];
  $tanggal = $_POST['tanggal'];

  $mysqli->query("INSERT INTO transaksi (jenis, jumlah, keterangan, tanggal) VALUES ('$jenis', '$jumlah', '$keterangan', '$tanggal')");
  header("Location: index.php");
}

// Update Transaksi
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $jenis = $_POST['jenis'];
  $jumlah = $_POST['jumlah'];
  $keterangan = $_POST['keterangan'];
  $tanggal = $_POST['tanggal'];

  $mysqli->query("UPDATE transaksi SET jenis='$jenis', jumlah='$jumlah', keterangan='$keterangan', tanggal='$tanggal' WHERE id=$id");
  header("Location: index.php");
}

// Hapus Transaksi
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM transaksi WHERE id=$id");
  header("Location: index.php");
}
