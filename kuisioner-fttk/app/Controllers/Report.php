<?php

namespace App\Controllers;
use App\Models\Report_model;

class Report extends BaseController
{
    protected $report;

    public function __construct()
    {
        $this->report = new Report_model();
    }

    // Untuk Kaprodi
    public function kaprodi($id_periode)
    {
        $id_prodi = session('id_prodi'); // dari login kaprodi
        $data['summary'] = $this->report->summaryByPeriode($id_periode, $id_prodi);
        return view('report/kaprodi_summary', $data);
    }

    // Untuk Pimpinan
    public function pimpinan($id_periode)
    {
        $data['summary'] = $this->report->summaryByPeriode($id_periode);
        return view('report/pimpinan_summary', $data);
    }
}