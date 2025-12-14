<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kelola Periode Kuisioner</h2>
        <a href="<?= base_url('kaprodi/periode/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Periode
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
                        <th width="50%">Keterangan</th>
                        <th width="15%">Status</th>
                        <th width="15%">Pertanyaan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($periodeList)): ?>
                        <?php foreach ($periodeList as $index => $periode): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($periode['keterangan']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $periode['status_periode'] == 'aktif' ? 'success' : 'secondary' ?>">
                                        <?= ucfirst($periode['status_periode']) ?>
                                    </span>
                                </td>
                                <td><?= $periode['jumlah_pertanyaan'] ?? 0 ?> pertanyaan</td>
                                <td>
                                    <a href="<?= base_url('kaprodi/periode/edit/' . $periode['id']) ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= base_url('kaprodi/summary?periode=' . $periode['id']) ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-bar-chart"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $periode['id'] ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data periode</td>
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
    if (confirm('Apakah Anda yakin ingin menghapus periode ini?')) {
        window.location.href = '<?= base_url('kaprodi/periode/delete/') ?>' + id;
    }
}
</script>
<?= $this->endSection() ?>
