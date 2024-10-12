<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Catatan - Manajemen Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body {
      background-color: #f8f9fa;
    }

    .form-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 40px;
    }

    h2 {
      color: #007bff;
    }

    .btn-primary {
      border-radius: 50px;
      padding: 10px 20px;
      font-size: 1rem;
    }
  </style>
</head>

<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-container">
          <h2 class="text-center mb-4">Tambah Catatan</h2>

          <!-- Form tambah transaksi -->
          <form action="process_catatan.php" method="POST">
            <div class="mb-3">
              <label for="jenis" class="form-label">Jenis Transaksi</label>
              <select name="jenis" class="form-control form-control-lg" required>
                <option value="Pemasukan">Pemasukan</option>
                <option value="Pengeluaran">Pengeluaran</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="jumlah" class="form-label">Jumlah</label>
              <input type="number" name="jumlah" class="form-control form-control-lg" placeholder="Masukkan jumlah" required>
            </div>
            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <input type="text" name="keterangan" class="form-control form-control-lg" placeholder="Masukkan keterangan" required>
            </div>
            <div class="mb-3">
              <label for="tanggal" class="form-label">Tanggal</label>
              <input type="date" name="tanggal" class="form-control form-control-lg" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary btn-lg w-100">
              <i class="fas fa-save"></i> Simpan
            </button>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer text-center mt-5">
    <p>&copy; <?= date('Y'); ?> Aplikasi Manajemen Keuangan Pribadi. Semua Hak Dilindungi.</p>
  </footer>

  <script src="h