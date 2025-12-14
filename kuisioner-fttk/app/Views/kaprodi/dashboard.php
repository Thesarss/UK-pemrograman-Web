<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h2 class="mb-4">Dashboard KAPRODI</h2>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Periode</h5>
                    <h2><?= $totalPeriode ?? 0 ?></h2>
                    <p class="card-text">Periode kuisioner aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Pertanyaan</h5>
                    <h2><?= $totalPertanyaan ?? 0 ?></h2>
                    <p class="card-text">Bank pertanyaan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Responden</h5>
                    <h2><?= $totalResponden ?? 0 ?></h2>
                    <p class="card-text">Mahasiswa mengisi</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Periode Aktif</h5>
                    <h2><?= $periodeAktif ?? 0 ?></h2>
                    <p class="card-text">Sedang berjalan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <a href="<?= base_url('kaprodi/periode/create') ?>" class="btn btn-primary w-100">
                                <i class="bi bi-plus-circle"></i> Buat Periode Baru
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="<?= base_url('kaprodi/pertanyaan/create') ?>" class="btn btn-success w-100">
                                <i class="bi bi-plus-circle"></i> Tambah Pertanyaan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="<?= base_url('kaprodi/assign') ?>" class="btn btn-info w-100">
                                <i class="bi bi-link-45deg"></i> Assign Pertanyaan
                            </a>
                        </div>
                        <div class="col-md-3 mb-2">
                            <a href="<?= base_url('kaprodi/summary') ?>" class="btn btn-warning w-100">
                                <i class="bi bi-bar-chart"></i> Lihat Summary
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Periode Terbaru</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Jumlah Pertanyaan</th>
                                <th>Responden</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recentPeriode)): ?>
                                <?php foreach ($recentPeriode as $periode): ?>
                                    <tr>
                                        <td><?= esc($periode['keterangan']) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $periode['status_periode'] == 'aktif' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($periode['status_periode']) ?>
                                            </span>
                                        </td>
                                        <td><?= $periode['jumlah_pertanyaan'] ?? 0 ?></td>
                                        <td><?= $periode['jumlah_responden'] ?? 0 ?></td>
                                        <td>
                                            <a href="<?= base_url('kaprodi/summary?periode=' . $periode['id']) ?>" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada periode</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
