<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table      = 'notifikasi';
    protected $primaryKey = 'id_notif';
    protected $allowedFields = ['nim','judul','pesan','is_read','created_at'];
    protected $useTimestamps = false;

    public function unreadCount(string $nim): int
    {
        return (int)$this->where('nim',$nim)->where('is_read',0)->countAllResults();
    }
}
