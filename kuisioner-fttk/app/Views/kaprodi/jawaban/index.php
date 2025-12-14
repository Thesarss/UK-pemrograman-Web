<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h2 class="mb-4">Jawaban Mahasiswa</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="<?= base_url('kaprodi/jawaban') ?>">
                <div class="row">
                    <div class="col-md-10">
                        <label for="periode_id" class="form-label">Filter Periode</label>
                        <select class="form-select" id="periode_id" name="periode">
                            <option value="">-- Semua Periode --</option>
                            <?php if (!empty($periodeList)): ?>
                                <?php foreach ($periodeList as $periode): ?>
                                    <option value="<?= $periode['id'] ?>" <?= ($selectedPeriode ?? '') == $periode['id'] ? 'selected' : '' ?>>
                                        <?= esc($periode['keterangan']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Daftar Responden</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">NIM</th>
                        <th width="25%">Nama Mahasiswa</th>
                        <th width="30%">Periode</th>
                        <th width="15%">Waktu Pengisian</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($jawabanList)): ?>
                        <?php foreach ($jawabanList as $index => $jawaban): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($jawaban['nim']) ?></td>
                                <td><?= esc($jawaban['nama_mahasiswa']) ?></td>
                                <td><?= esc($jawaban['periode_keterangan']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($jawaban['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url('kaprodi/jawaban/detail/' . $jawaban['mahasiswa_id'] . '/' . $jawaban['periode_id']) ?>" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data jawaban</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
