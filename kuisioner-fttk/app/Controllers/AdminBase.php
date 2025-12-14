<?php

namespace App\Controllers;

use App\Models\Activity_log_model;

class AdminBase extends BaseController
{
    protected $log;

    public function __construct()
    {
        $this->log = new Activity_log_model();
    }

    protected function writeLog($aksi, $tabel, $record_id)
    {
        $this->log->insert([
            'id_user'   => session()->get('id_user'),
            'aksi'      => $aksi,
            'tabel'     => $tabel,
            'record_id' => $record_id,
            'created_at'=> date('Y-m-d H:i:s')
        ]);
    }
}
