<?php

namespace App\Models;

use CodeIgniter\Model;

class JawabanModel extends Model
{
    protected $table      = 'jawaban';
    protected $primaryKey = 'id_jawaban';
    protected $allowedFields = [
        'nim','id_pertanyaan','id_pilihan_jawaban_pertanyaan','id_periode'
    ];
    protected $useTimestamps = false;

    public function getPrefill(string $nim, int $idPeriode): array
    {
        $rows = $this->select('id_pertanyaan, id_pilihan_jawaban_pertanyaan')
            ->where('nim', $nim)
            ->where('id_periode', $idPeriode)
            ->findAll();

        // map: [id_pertanyaan => id_pilihan]
        $map = [];
        foreach ($rows as $r) $map[(int)$r['id_pertanyaan']] = (int)$r['id_pilihan_jawaban_pertanyaan'];
        return $map;
    }

    public function replaceAnswers(string $nim, int $idPeriode, array $payload): void
    {
        // payload: [id_pertanyaan => id_pilihan]
        $this->where('nim', $nim)->where('id_periode', $idPeriode)->delete();

        $batch = [];
        foreach ($payload as $idPertanyaan => $idPilihan) {
            if (!$idPilihan) continue;
            $batch[] = [
                'nim' => $nim,
                'id_periode' => $idPeriode,
                'id_pertanyaan' => (int)$idPertanyaan,
                'id_pilihan_jawaban_pertanyaan' => (int)$idPilihan,
            ];
        }
        if ($batch) $this->insertBatch($batch);
    }
}
