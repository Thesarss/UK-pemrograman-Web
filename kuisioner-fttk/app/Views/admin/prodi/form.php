<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h4>Form Prodi</h4>

<form method="post">
    <input type="text" name="nama_prodi" class="form-control mb-2"
           value="<?= $row['nama_prodi'] ?? '' ?>" required>

    <select name="id_jurusan" class="form-control mb-2">
        <?php foreach ($jurusan as $j): ?>
            <option value="<?= $j['id_jurusan'] ?>"><?= $j['nama_jurusan'] ?></option>
        <?php endforeach ?>
    </select>

    <select name="id_user_kaprodi" class="form-control mb-2">
        <?php foreach ($kaprodi as $k): ?>
            <option value="<?= $k['id_user'] ?>"><?= $k['nama_user'] ?></option>
        <?php endforeach ?>
    </select>

    <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>
