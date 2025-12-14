<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Jawaban Mahasiswa</h2>
        <a href="<?= base_url('kaprodi/jawaban') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informasi Mahasiswa</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>NIM:</strong> <?= esc($mahasiswa['nim'] ?? '') ?></p>
                    <p><strong>Nama:</strong> <?= esc($mahasiswa['nama'] ?? '') ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Periode:</strong> <?= esc($periode['keterangan'] ?? '') ?></p>
                    <p><strong>Waktu Pengisian:</strong> <?= date('d/m/Y H:i', strtotime($waktuPengisian ?? 'now')) ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($detailJawaban)): ?>
        <?php foreach ($detailJawaban as $index => $item): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Pertanyaan <?= $index + 1 ?></h6>
                </div>
                <div class="card-body">
                    <p class="mb-3"><strong><?= esc($item['pertanyaan']) ?></strong></p>
                    
                    <div class="list-group">
                        <?php if (!empty($item['pilihan'])): ?>
                            <?php foreach ($item['pilihan'] as $idx => $pilihan): ?>
                                <div class="list-group-item <?= $pilihan['dipilih'] ? 'list-group-item-success' : '' ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-secondary me-2"><?= chr(65 + $idx) ?></span>
                                        <span><?= esc($pilihan['teks']) ?></span>
                                        <?php if ($pilihan['dipilih']): ?>
                                            <i class="bi bi-check-circle-fill text-success ms-auto"></i>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle"></i> Tidak ada data jawaban
        </div>
    <?php endif; ?>

    <div class="text-end">
        <button class="btn btn-success" onclick="window.print()">
            <i class="bi bi-printer"></i> Cetak Detail
        </button>
    </div>
</div>

<?= $this->endSection() ?>
