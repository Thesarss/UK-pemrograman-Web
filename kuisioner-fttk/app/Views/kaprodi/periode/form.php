<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?= isset($periode) ? 'Edit' : 'Tambah' ?> Periode Kuisioner</h2>
        <a href="<?= base_url('kaprodi/periode') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('kaprodi/periode/' . (isset($periode) ? 'update/' . $periode['id'] : 'store')) ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan Periode <span class="text-danger">*</span></label>
                    <textarea 
                        class="form-control <?= isset($validation) && $validation->hasError('keterangan') ? 'is-invalid' : '' ?>" 
                        id="keterangan" 
                        name="keterangan" 
                        rows="3" 
                        required
                        placeholder="Contoh: Kuisioner Kepuasan Mahasiswa Semester Ganjil 2024/2025"
                    ><?= old('keterangan', $periode['keterangan'] ?? '') ?></textarea>
                    <?php if (isset($validation) && $validation->hasError('keterangan')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('keterangan') ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="status_periode" class="form-label">Status Periode <span class="text-danger">*</span></label>
                    <select 
                        class="form-select <?= isset($validation) && $validation->hasError('status_periode') ? 'is-invalid' : '' ?>" 
                        id="status_periode" 
                        name="status_periode" 
                        required
                    >
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif" <?= old('status_periode', $periode['status_periode'] ?? '') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="nonaktif" <?= old('status_periode', $periode['status_periode'] ?? '') == 'nonaktif' ? 'selected' : '' ?>>Non-Aktif</option>
                    </select>
                    <?php if (isset($validation) && $validation->hasError('status_periode')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('status_periode') ?>
                        </div>
                    <?php endif; ?>
                    <small class="text-muted">Status "Aktif" memungkinkan mahasiswa mengisi kuisioner</small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('kaprodi/periode') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
