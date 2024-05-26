<?php
date_default_timezone_set('Asia/Jakarta');
$tgl_masuk = date('Y-m-d h:i:s');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="container-fluid">
    <h1 class="h3 mb-3 text-gray-800"><?= $judul; ?></h1>
    <div class="card shadow mb-4">
      <div class="card-body">
        <form method="post" action="<?= base_url('transaksi/updatesatuan') ?>">
          <div class="form-group">
            <label>Kode Transaksi</label>
            <input type="text" name="kode_transaksi" value="<?= $transaksi['kode_transaksi']; ?>" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Nama Konsumen</label>
            <select name="kode_konsumen" class="form-control">
              <?php foreach ($konsumen as $row) { ?>
                <?php if ($transaksi['kode_konsumen'] == $row->kode_konsumen) { ?>
                  <option value="<?= $row->kode_konsumen ?>" selected><?= $row->nama_konsumen ?></option>
                <?php } else { ?>
                  <option value="<?= $row->kode_konsumen ?>"><?= $row->nama_konsumen ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Paket</label>
            <select name="kode_paket" id="paket" class="form-control">
              <?php foreach ($paket as $row) { ?>
                <?php if ($transaksi['kode_paket'] == $row->kode_paket) { ?>
                  <option value="<?= $row->kode_paket ?>" selected><?= $row->nama_paket ?></option>
                <?php } else { ?>
                  <option value="<?= $row->kode_paket ?>"><?= $row->nama_paket ?></option>
                <?php } ?>
              <?php } ?>
            </select>
            </div>
            <div class="form-group">
            <label>Harga Paket</label>
            <input type="text" id="harga" value="<?= $transaksi['harga_paket']; ?>" class="form-control"  readonly>
          </div>
          <div class="form-group">
            <label>Jenis Barang</label>
            <select name="kode_jenis" id="jenis" class="form-control" required>
              <option value="">-Pilih Jenis Barang-</option>
              <?php foreach ($jenis as $row) { ?>
                <?php if ($transaksi['kode_jenis'] == $row->kode_jenis) { ?>
                  <option value="<?= $row->kode_jenis ?>" selected><?= $row->jenis_barang ?></option>
                <?php } else { ?>
                  <option value="<?= $row->kode_jenis ?>"><?= $row->jenis_barang ?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Harga Jenis Barang</label>
            <input type="text" value="<?= $transaksi['harga_jenis']; ?>" id="hargajenis" class="form-control" placeholder="Harga Jenis Barang" readonly>
          </div>
          <div class="form-group">
            <label>Jumlah Barang</label>
            <input type="text" name="qty" value="<?= $transaksi['qty']; ?>" id="qty" class="form-control"  required>
          </div>
          <div class="form-group">
            <label>Grand Total</label>
            <input type="number" value="<?= $transaksi['grand_total']; ?>"  name="grand_total" id="grand_total" class="form-control" placeholder="Input Grand Total" readonly>
          </div>
          <div class="form-group" hidden>
            <label>Tanggal Masuk</label>
            <input type="text" name="tgl_masuk" value="<?= $tgl_masuk; ?>" class="form-control" placeholder="Input Grand Total">
          </div>
          <div class="form-group">
            <label>Bayar</label>
            <select name="bayar" class="form-control">
              <?php
              if ($transaksi['bayar'] == "Lunas") { ?>
                <option value="Lunas" selected>Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
              <?php } else { ?>
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas" selected>Belum Lunas</option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group" hidden>
            <label>Status</label>
            <input type="text" name="status" value="Baru" class="form-control" placeholder="Input Status">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('transaksi/riwayatsatuan') ?>" class="btn btn-danger">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>

</html>

<script>
    // Ketika pilihan paket berubah
    $('#paket').change(function() {
      var kode_paket = $(this).val();
      $.ajax({
        url: '<?= base_url() ?>transaksi/getHargaPaket',
        data: {
          kode_paket: kode_paket
        },
        method: 'post',
        dataType: 'JSON',
        success: function(hasil) {
          $('#harga').val(hasil.harga_paket);
          // Panggil fungsi perhitungan total
          hitungTotal();
        }
      });
    });

    // Ketika pilihan jenis barang berubah
    $('#jenis').change(function() {
      var kode_jenis = $(this).val();
      $.ajax({
        url: '<?= base_url() ?>transaksi/getHargaJenis',
        data: {
          kode_jenis: kode_jenis
        },
        method: 'post',
        dataType: 'JSON',
        success: function(hasil) {
          $('#hargajenis').val(hasil.harga_jenis);
          // Panggil fungsi perhitungan total
          hitungTotal();
        }
      });
    });

    // Ketika input jumlah barang berubah
    $('#qty').keyup(function() {
      // Panggil fungsi perhitungan total
      hitungTotal();
    });

    // Fungsi perhitungan total
    function hitungTotal() {
      var qty = parseFloat($('#qty').val());
      var harga = parseFloat($('#harga').val());
      var hargajenis = parseFloat($('#hargajenis').val());
      var grand_total = harga + hargajenis * qty;
      $('#grand_total').val(grand_total.toFixed(0));
    }
  </script>