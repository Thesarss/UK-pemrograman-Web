<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h4><?= isset($user) ? 'Edit' : 'Tambah' ?> User</h4>

<form method="post">
    <div class="mb-2">
        <label>Nama User</label>
        <input type="text" name="nama_user" class="form-control"
               value="<?= $user['nama_user'] ?? '' ?>" required>
    </div>

    <div class="mb-2">
        <label>Role</label>
        <select name="role" class="form-control">
            <?php foreach (['admin','kaprodi','mahasiswa','pimpinan'] as $r): ?>
                <option value="<?= $r ?>"
s
                    <?= isset($user) && $user['role']==$r?'selected':'' ?>>
                    <?= ucfirst($r) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="/admin/users" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>
