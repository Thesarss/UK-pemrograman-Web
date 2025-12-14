<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h4>Form Jurusan</h4>

<form method="post">
    <input type="text" name="nama_jurusan" class="form-control mb-2"
           value="<?= $row['nama_jurusan'] ?? '' ?>" required>

    <select name="id_fakultas" class="form-control mb-2">
        <?php foreach ($fakultas as $f): ?>
            <option value="<?= $f['id_fakultas'] ?>"
                <?= isset($row)&&$row['id_fakultas']==$f['id_fakultas']?'selected':'' ?>>
                <?= $f['nama_fakultas'] ?>
            </option>
        <?php endforeach ?>
    </select>

    <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>
