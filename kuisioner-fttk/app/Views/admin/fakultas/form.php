<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h4>Form Fakultas</h4>

<form method="post">
    <input type="text" name="nama_fakultas" class="form-control mb-2"
           value="<?= $row['nama_fakultas'] ?? '' ?>" required>
    <button class="btn btn-success">Simpan</button>
    <a href="/admin/fakultas" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>
