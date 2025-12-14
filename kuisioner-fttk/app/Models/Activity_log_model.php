<?php

namespace App\Models;

use CodeIgniter\Model;

class Activity_log_model extends Model
{
    protected $table = 'activity_log';
    protected $primaryKey = 'id_log';
    protected $allowedFields = [
        'id_user','aksi','tabel','record_id','created_at'
    ];
}
