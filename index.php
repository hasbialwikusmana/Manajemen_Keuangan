<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <div class="container mt-4">
    <h2 class="my-4">Riwayat Transaksi</h2>

    <div class="text-end mb-3">
      <a href="tambah_catatan.php" class="btn btn-success btn-custom">
        <i class="fas fa-plus"></i> Tambah Catatan
      </a>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Statistik</h5>

        <!-- Menampilkan statistik pemasukan dan pengeluaran -->
        <p><strong>Pemasukan Hari Ini:</strong> Rp. <?= number_format($mysqli->query("SELECT SUM(jumlah) AS total FROM transaksi WHERE jenis='Pemasukan' AND DATE(tanggal) = CURDATE()")->fetch_assoc()['total'], 2); ?></p>
        <p><strong>Pengeluaran Bulan Ini:</strong> Rp. <?= number_format($mysqli->query("SELECT SUM(jumlah) AS total FROM transaksi WHERE jenis='Pengeluaran' AND MONTH(tanggal) = MONTH(CURRENT_DATE()) AND YEAR(tanggal) = YEAR(CURRENT_DATE())")->fetch_assoc()['total'], 2); ?></p>

        <!-- Menghitung sisa tabungan (pemasukan - pengeluaran) -->
        <?php
        $total_pemasukan = $mysqli->query("SELECT SUM(jumlah) AS total FROM transaksi WHERE jenis='Pemasukan'")->fetch_assoc()['total'] ?? 0;
        $total_pengeluaran = $mysqli->query("SELECT SUM(jumlah) AS total FROM transaksi WHERE jenis='Pengeluaran'")->fetch_assoc()['total'] ?? 0;
        $sisa_tabungan = $total_pemasukan - $total_pengeluaran;
        ?>
        <p><strong>Sisa Tabungan:</strong> Rp. <?= number_format($sisa_tabungan, 2); ?></p>

        <!-- Ukuran grafik disesuaikan -->
        <canvas id="myChart" style="width: 800px; height: 400px; margin: 0px auto;"></canvas>
      </div>
    </div>


    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $result = $mysqli->query("SELECT * FROM transaksi");

              if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()):
              ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['jenis']; ?></td>
                    <td>Rp. <?= number_format($row['jumlah'], 2); ?></td>
                    <td><?= $row['keterangan']; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td>
                      <a href="ubah_catatan.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <a href="process_catatan.php?delete=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">
                        <i class="fas fa-trash"></i> Hapus
                      </a>
                    </td>
                  </tr>
                <?php
                endwhile;
              } else {
                ?>
                <tr>
                  <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer text-center mt-4">
    <p>&copy; <?= date('Y'); ?> Aplikasi Manajemen Keuangan Pribadi. Semua Hak Dilindungi.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Ambil data untuk grafik dari server
    const ctx = document.getElementById('myChart').getContext('2d');
    const pemasukanData = <?= json_encode($total_pemasukan); ?> || 0;
    const pengeluaranData = <?= json_encode($total_pengeluaran); ?> || 0;
    const sisaTabunganData = <?= json_encode($sisa_tabungan); ?> || 0;

    const myChart = new Chart(ctx, {
      type: 'bar', // Tipe grafik
      data: {
        labels: ['Pemasukan', 'Pengeluaran', 'Sisa Tabungan'],
        datasets: [{
          label: 'Statistik Keuangan',
          data: [pemasukanData, pengeluaranData, sisaTabunganData],
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)' // Warna untuk Sisa Tabungan
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)' // Border untuk Sisa Tabungan
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

</body>

</html>