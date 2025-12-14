<?php

namespace App\Controllers;

use App\Models\JawabanModel;
use App\Models\NotifikasiModel;
use CodeIgniter\Controller;

class Mahasiswa extends Controller
{
    protected JawabanModel $jawaban;
    protected NotifikasiModel $notif;
    protected $db;

    public function __construct()
    {
        $this->jawaban = new JawabanModel();
        $this->notif   = new NotifikasiModel();
        $this->db      = \Config\Database::connect();
        helper(['url','form']);
    }

    private function getNimLogin(): string
    {
        // Asumsi session dibuat oleh Auth:
        // session('id_user') dan mahasiswa punya kolom id_user_mahasiswa (recommended)
        $idUser = session('id_user');
        if (!$idUser) return '';

        $row = $this->db->table('mahasiswa')
            ->select('nim')
            ->where('id_user_mahasiswa', $idUser)
            ->get()->getRowArray();

        return $row['nim'] ?? '';
    }

    public function index()
    {
        $nim = $this->getNimLogin();
        if ($nim === '') return redirect()->to('/login');

        // periode aktif (kalau sudah ditambah tanggal_mulai/tanggal_selesai, bisa filter juga)
        $periode = $this->db->table('periode_kuisioner')
            ->where('status_periode','aktif')
            ->orderBy('id_periode','DESC')
            ->get()->getResultArray();

        return view('mahasiswa/dashboard', [
            'nim' => $nim,
            'periode' => $periode,
            'unread' => $this->notif->unreadCount($nim),
        ]);
    }

    public function periode(int $idPeriode)
    {
        $nim = $this->getNimLogin();
        if ($nim === '') return redirect()->to('/login');

        // ambil pertanyaan untuk periode ini (join pertanyaan_periode -> pertanyaan)
        $pertanyaan = $this->db->table('pertanyaan_periode_kuisioner ppk')
            ->select('q.id_pertanyaan, q.pertanyaan')
            ->join('pertanyaan q', 'q.id_pertanyaan = ppk.id_pertanyaan')
            ->where('ppk.id_pertanyaan_periode_kuisioner IS NOT NULL') // biar join kepake
            ->where('ppk.id_periode_kuisioner', $idPeriode)
            ->orderBy('q.id_pertanyaan','ASC')
            ->get()->getResultArray();

        if (!$pertanyaan) {
            return redirect()->back()->with('error', 'Kuisioner belum ada pertanyaan.');
        }

        // ambil pilihan jawaban per pertanyaan
        $ids = array_column($pertanyaan, 'id_pertanyaan');
        $opsiRows = $this->db->table('pilihan_jawaban_pertanyaan')
            ->whereIn('id_pertanyaan', $ids)
            ->orderBy('id_pilihan_jawaban','ASC')
            ->get()->getResultArray();

        $opsiMap = [];
        foreach ($opsiRows as $o) {
            $opsiMap[(int)$o['id_pertanyaan']][] = $o;
        }

        // prefill jawaban lama (requirement tampilkan jawaban sebelumnya)
        $prefill = $this->jawaban->getPrefill($nim, $idPeriode);

        return view('mahasiswa/form', [
            'nim' => $nim,
            'idPeriode' => $idPeriode,
            'pertanyaan' => $pertanyaan,
            'opsiMap' => $opsiMap,
            'prefill' => $prefill,
        ]);
    }

    public function submit(int $idPeriode)
    {
        $nim = $this->getNimLogin();
        if ($nim === '') return redirect()->to('/login');

        $rules = [
            'jawaban' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error','Jawaban belum diisi.');
        }

        // jawaban[ID_PERTANYAAN] = ID_PILIHAN
        $jawaban = $this->request->getPost('jawaban');
        if (!is_array($jawaban)) $jawaban = [];

        // simpan strategi replace per periode (simple, aman, ga ribet)
        $this->jawaban->replaceAnswers($nim, $idPeriode, $jawaban);

        return redirect()->to('/mahasiswa')->with('success','Jawaban tersimpan.');
    }

    public function notifications()
    {
        $nim = $this->getNimLogin();
        if ($nim === '') return redirect()->to('/login');

        $rows = $this->notif->where('nim',$nim)->orderBy('created_at','DESC')->findAll();

        return view('mahasiswa/notifications', [
            'nim' => $nim,
            'rows' => $rows
        ]);
    }

    public function readNotif(int $idNotif)
    {
        $nim = $this->getNimLogin();
        if ($nim === '') return redirect()->to('/login');

        $this->notif->where('id_notif',$idNotif)->where('nim',$nim)->set(['is_read'=>1])->update();

        return redirect()->to('/mahasiswa/notifications');
    }
}
