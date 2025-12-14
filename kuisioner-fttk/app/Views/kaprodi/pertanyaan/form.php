<?= $this->extend('layout/kaprodi') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?= isset($pertanyaan) ? 'Edit' : 'Tambah' ?> Pertanyaan</h2>
        <a href="<?= base_url('kaprodi/pertanyaan') ?>" class="btn btn-secondary">
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
            <form action="<?= base_url('kaprodi/pertanyaan/' . (isset($pertanyaan) ? 'update/' . $pertanyaan['id'] : 'store')) ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="teks_pertanyaan" class="form-label">Teks Pertanyaan <span class="text-danger">*</span></label>
                    <textarea 
                        class="form-control <?= isset($validation) && $validation->hasError('teks_pertanyaan') ? 'is-invalid' : '' ?>" 
                        id="teks_pertanyaan" 
                        name="teks_pertanyaan" 
                        rows="3" 
                        required
                        placeholder="Masukkan pertanyaan pilihan ganda"
                    ><?= old('teks_pertanyaan', $pertanyaan['teks_pertanyaan'] ?? '') ?></textarea>
                    <?php if (isset($validation) && $validation->hasError('teks_pertanyaan')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('teks_pertanyaan') ?>
                        </div>
                    <?php endif; ?>
                    <small class="text-muted">Pertanyaan harus berupa pilihan ganda</small>
                </div>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Setelah menyimpan pertanyaan, Anda dapat menambahkan pilihan jawaban pada halaman berikutnya.
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('kaprodi/pertanyaan') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
