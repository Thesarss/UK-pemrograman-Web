<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h4>Form Mahasiswa</h4>

<form method="post">
    <input type="text" name="nim" class="form-control mb-2"
           value="<?= $row['nim'] ?? '' ?>" placeholder="NIM" required>

    <input type="text" name="nama_mahasiswa" class="form-control mb-2"
           value="<?= $row['nama_mahasiswa'] ?? '' ?>" placeholder="Nama Mahasiswa" required>

    <select name="id_user_mahasiswa" class="form-control mb-2">
        <?php foreach ($users as $u): ?>
            <option value="<?= $u['id_user'] ?>"><?= $u['nama_user'] ?></option>
        <?php endforeach ?>
    </select>

    <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>
