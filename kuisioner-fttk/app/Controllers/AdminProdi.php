<?php

namespace App\Controllers;

use App\Models\Prodi_model;
use App\Models\Jurusan_model;
use App\Models\User_model;

class AdminProdi extends AdminBase
{
    protected $model;
    protected $jurusan;
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Prodi_model();
        $this->jurusan = new Jurusan_model();
        $this->user = new User_model();
    }

    public function index()
    {
        return view('admin/prodi/index', [
            'data' => $this->model->findAll()
        ]);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $this->model->insert($this->request->getPost());
            $this->writeLog('CREATE', 'prodi', $this->model->getInsertID());
            return redirect()->to('/admin/prodi');
        }
        return view('admin/prodi/form', [
            'jurusan' => $this->jurusan->findAll(),
            'kaprodi' => $this->user->where('role', 'kaprodi')->findAll()
        ]);
    }

    public function edit($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $this->model->update($id, $this->request->getPost());
            $this->writeLog('UPDATE', 'prodi', $id);
            return redirect()->to('/admin/prodi');
        }
        return view('admin/prodi/form', [
            'row' => $this->model->find($id),
            'jurusan' => $this->jurusan->findAll(),
            'kaprodi' => $this->user->where('role', 'kaprodi')->findAll()
        ]);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        $this->writeLog('DELETE', 'prodi', $id);
        return redirect()->to('/admin/prodi');
    }
}
