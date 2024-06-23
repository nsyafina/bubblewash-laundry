<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<style>
	*{
		font-family: serif;
	}
</style>
<body>
  <div class="container-fluid">
    <div class="card shadow mb-4">
      <div class="card-body" style="border: 1px solid rgba(18, 56, 137, 0.4); box-shadow: inset -3px -3px rgba(18, 56, 137, 0.4); border-radius: 10px">
        <form method="post" action="<?= base_url('jenis/simpan') ?>">
          <div class="form-group">
            <label style="color: #12389F; font-size: 17px;">Kode Jenis Barang</label>
            <input type="text" style="border: 1px solid rgba(18, 56, 137, 0.6); box-shadow: inset -2px -2px rgba(18, 56, 137, 0.6); border-radius: 10px;" name="kode_jenis" value="<?= $kode_jenis; ?>" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label style="color: #12389F; font-size: 17px;">Jenis Barang</label>
            <input type="text" style="border: 1px solid rgba(18, 56, 137, 0.6); box-shadow: inset -2px -2px rgba(18, 56, 137, 0.6); border-radius: 10px;" name="jenis_barang" class="form-control" placeholder="Input Jenis Barang" required>
          </div>
          <div class="form-group">
            <label style="color: #12389F; font-size: 17px;">Harga</label>
            <input type="text" style="border: 1px solid rgba(18, 56, 137, 0.6); box-shadow: inset -2px -2px rgba(18, 56, 137, 0.6); border-radius: 10px;" name="harga_jenis" class="form-control" placeholder="Input Harga" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn" style="color: white; background-color: #12389F; box-shadow: inset -3px -3px rgba(0, 0, 0, 0.4)">Simpan</button>
            <a href="<?= base_url('jenis') ?>" class="btn" style="color: white; background-color: #c90000; box-shadow: inset -3px -3px rgba(0, 0, 0, 0.4)">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>