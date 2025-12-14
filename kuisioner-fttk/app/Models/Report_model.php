<?php

namespace App\Models;
use CodeIgniter\Model;

class Report_model extends Model
{
    public function summaryByPeriode($id_periode, $id_prodi = null)
    {
        $builder = $this->db->table('jawaban j');
        $builder->select('
            p.id_pertanyaan,
            p.pertanyaan,
            pj.deskripsi_pilihan,
            COUNT(j.id_jawaban) AS total
        ');
        $builder->join('pertanyaan p', 'j.id_pertanyaan = p.id_pertanyaan');
        $builder->join(
            'pilihan_jawaban_pertanyaan pj',
            'j.id_pilihan_jawaban_pertanyaan = pj.id_pilihan_jawaban'
        );
        $builder->where('j.id_periode', $id_periode);

        if ($id_prodi != null) {
            $builder->where('p.id_prodi', $id_prodi);
        }

        $builder->groupBy('p.id_pertanyaan, pj.id_pilihan_jawaban');
        return $builder->get()->getResultArray();
    }
}