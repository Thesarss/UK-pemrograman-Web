<?php

namespace App\Controllers;

class Kaprodi extends BaseController
{
    // ========== DASHBOARD ==========
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard KAPRODI',
            'activeMenu' => 'dashboard',
            'totalPeriode' => 0, // TODO: Get from model
            'totalPertanyaan' => 0, // TODO: Get from model
            'totalResponden' => 0, // TODO: Get from model
            'periodeAktif' => 0, // TODO: Get from model
            'recentPeriode' => [] // TODO: Get from model
        ];
        
        return view('kaprodi/dashboard', $data);
    }

    // ========== PERIODE CRUD ==========
    public function periodeIndex()
    {
        $data = [
            'title' => 'Kelola Periode',
            'activeMenu' => 'periode',
            'periodeList' => [] // TODO: Get from model
        ];
        
        return view('kaprodi/periode/index', $data);
    }

    public function periodeCreate()
    {
        $data = [
            'title' => 'Tambah Periode',
            'activeMenu' => 'periode'
        ];
        
        return view('kaprodi/periode/form', $data);
    }

    public function periodeStore()
    {
        // TODO: Validate and save to database
        // TODO: Set flash message
        return redirect()->to('kaprodi/periode');
    }

    public function periodeEdit($id)
    {
        $data = [
            'title' => 'Edit Periode',
            'activeMenu' => 'periode',
            'periode' => [] // TODO: Get from model by $id
        ];
        
        return view('kaprodi/periode/form', $data);
    }

    public function periodeUpdate($id)
    {
        // TODO: Validate and update database
        // TODO: Set flash message
        return redirect()->to('kaprodi/periode');
    }

    public function periodeDelete($id)
    {
        // TODO: Delete from database
        // TODO: Set flash message
        return redirect()->to('kaprodi/periode');
    }

    // ========== PERTANYAAN CRUD ==========
    public function pertanyaanIndex()
    {
        $data = [
            'title' => 'Kelola Pertanyaan',
            'activeMenu' => 'pertanyaan',
            'pertanyaanList' => [] // TODO: Get from model
        ];
        
        return view('kaprodi/pertanyaan/index', $data);
    }

    public function pertanyaanCreate()
    {
        $data = [
            'title' => 'Tambah Pertanyaan',
            'activeMenu' => 'pertanyaan'
        ];
        
        return view('kaprodi/pertanyaan/form', $data);
    }

    public function pertanyaanStore()
    {
        // TODO: Validate and save to database
        // TODO: Set flash message
        return redirect()->to('kaprodi/pertanyaan');
    }

    public function pertanyaanEdit($id)
    {
        $data = [
            'title' => 'Edit Pertanyaan',
            'activeMenu' => 'pertanyaan',
            'pertanyaan' => [] // TODO: Get from model by $id
        ];
        
        return view('kaprodi/pertanyaan/form', $data);
    }

    public function pertanyaanUpdate($id)
    {
        // TODO: Validate and update database
        // TODO: Set flash message
        return redirect()->to('kaprodi/pertanyaan');
    }

    public function pertanyaanDelete($id)
    {
        // TODO: Delete from database
        // TODO: Set flash message
        return redirect()->to('kaprodi/pertanyaan');
    }

    // ========== PILIHAN JAWABAN ==========
    public function pilihanIndex($pertanyaanId)
    {
        $data = [
            'title' => 'Kelola Pilihan',
            'activeMenu' => 'pertanyaan',
            'pertanyaan' => [], // TODO: Get from model by $pertanyaanId
            'pilihanList' => [] // TODO: Get from model by $pertanyaanId
        ];
        
        return view('kaprodi/pertanyaan/pilihan', $data);
    }

    public function pilihanStore($pertanyaanId)
    {
        // TODO: Validate and save multiple pilihan to database
        // TODO: Return JSON response for AJAX
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Pilihan berhasil disimpan'
        ]);
    }

    public function pilihanDelete($id)
    {
        // TODO: Delete pilihan from database
        // TODO: Set flash message
        return redirect()->back();
    }

    // ========== ASSIGN PERTANYAAN KE PERIODE ==========
    public function assignIndex()
    {
        $data = [
            'title' => 'Assign Pertanyaan',
            'activeMenu' => 'assign',
            'periodeList' => [], // TODO: Get from model
            'pertanyaanList' => [] // TODO: Get from model
        ];
        
        return view('kaprodi/assign/index', $data);
    }

    public function assignStore()
    {
        // TODO: Validate and save assignment to database
        // TODO: Set flash message
        return redirect()->to('kaprodi/assign');
    }

    public function assignGet($periodeId)
    {
        // TODO: Get assigned pertanyaan by periode
        // TODO: Return JSON response for AJAX
        return $this->response->setJSON([]);
    }

    public function assignDelete($assignId)
    {
        // TODO: Delete assignment from database
        // TODO: Set flash message
        return redirect()->to('kaprodi/assign');
    }

    // ========== SUMMARY ==========
    public function summaryIndex()
    {
        $periodeId = $this->request->getGet('periode');
        
        $data = [
            'title' => 'Summary Hasil',
            'activeMenu' => 'summary',
            'periodeList' => [], // TODO: Get from model
            'selectedPeriode' => $periodeId,
            'periodeInfo' => [], // TODO: Get from model if $periodeId
            'totalResponden' => 0, // TODO: Get from model if $periodeId
            'summary' => [] // TODO: Get summary data if $periodeId
        ];
        
        return view('kaprodi/summary/index', $data);
    }

    // ========== JAWABAN MAHASISWA ==========
    public function jawabanIndex()
    {
        $periodeId = $this->request->getGet('periode');
        
        $data = [
            'title' => 'Jawaban Mahasiswa',
            'activeMenu' => 'jawaban',
            'periodeList' => [], // TODO: Get from model
            'selectedPeriode' => $periodeId,
            'jawabanList' => [] // TODO: Get from model, filter by $periodeId if set
        ];
        
        return view('kaprodi/jawaban/index', $data);
    }

    public function jawabanDetail($mahasiswaId, $periodeId)
    {
        $data = [
            'title' => 'Detail Jawaban',
            'activeMenu' => 'jawaban',
            'mahasiswa' => [], // TODO: Get from model by $mahasiswaId
            'periode' => [], // TODO: Get from model by $periodeId
            'waktuPengisian' => '', // TODO: Get from model
            'detailJawaban' => [] // TODO: Get detail jawaban from model
        ];
        
        return view('kaprodi/jawaban/detail', $data);
    }
}
