<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h2 class="mb-4">Summary Hasil Kuisioner</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="<?= base_url('kaprodi/summary') ?>">
                <div class="row">
                    <div class="col-md-8">
                        <label for="periode_id" class="form-label">Pilih Periode</label>
                        <select class="form-select" id="periode_id" name="periode" onchange="this.form.submit()">
                            <option value="">-- Pilih Periode --</option>
                            <?php if (!empty($periodeList)): ?>
                                <?php foreach ($periodeList as $periode): ?>
                                    <option value="<?= $periode['id'] ?>" <?= ($selectedPeriode ?? '') == $periode['id'] ? 'selected' : '' ?>>
                                        <?= esc($periode['keterangan']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Tampilkan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($summary)): ?>
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Informasi Periode</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Keterangan:</strong> <?= esc($periodeInfo['keterangan'] ?? '') ?></p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Total Responden:</strong> <?= $totalResponden ?? 0 ?></p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Total Pertanyaan:</strong> <?= count($summary) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($summary as $index => $item): ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Pertanyaan <?= $index + 1 ?>: <?= esc($item['pertanyaan']) ?></h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">Opsi</th>
                                <th width="50%">Pilihan</th>
                                <th width="20%">Jumlah</th>
                                <th width="20%">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($item['pilihan'])): ?>
                                <?php foreach ($item['pilihan'] as $idx => $pilihan): ?>
                                    <tr>
                                        <td><?= chr(65 + $idx) ?></td>
                                        <td><?= esc($pilihan['teks']) ?></td>
                                        <td><?= $pilihan['count'] ?></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: <?= $pilihan['percentage'] ?>%">
                                                    <?= number_format($pilihan['percentage'], 1) ?>%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada jawaban</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="text-end">
            <button class="btn btn-success" onclick="window.print()">
                <i class="bi bi-printer"></i> Cetak Summary
            </button>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> Pilih periode untuk melihat summary hasil kuisioner
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
