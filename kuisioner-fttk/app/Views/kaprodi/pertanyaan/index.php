<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kelola Pertanyaan</h2>
        <a href="<?= base_url('kaprodi/pertanyaan/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Pertanyaan
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th width="60%">Pertanyaan</th>
                        <th width="15%">Jumlah Opsi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pertanyaanList)): ?>
                        <?php foreach ($pertanyaanList as $index => $pertanyaan): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($pertanyaan['teks_pertanyaan']) ?></td>
                                <td><?= $pertanyaan['jumlah_opsi'] ?? 0 ?> opsi</td>
                                <td>
                                    <a href="<?= base_url('kaprodi/pertanyaan/pilihan/' . $pertanyaan['id']) ?>" class="btn btn-sm btn-info" title="Kelola Pilihan">
                                        <i class="bi bi-list-check"></i>
                                    </a>
                                    <a href="<?= base_url('kaprodi/pertanyaan/edit/' . $pertanyaan['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $pertanyaan['id'] ?>)" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data pertanyaan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')) {
        window.location.href = '<?= base_url('kaprodi/pertanyaan/delete/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?>
