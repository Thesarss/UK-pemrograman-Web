<?php

namespace App\Controllers;

use App\Models\Jurusan_model;
use App\Models\Fakultas_model;

class AdminJurusan extends AdminBase
{
    protected $model;
    protected $fakultas;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Jurusan_model();
        $this->fakultas = new Fakultas_model();
    }

    public function index()
    {
        return view('admin/jurusan/index', [
            'data' => $this->model->findAll()
        ]);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $this->model->insert($this->request->getPost());
            $this->writeLog('CREATE', 'jurusan', $this->model->getInsertID());
            return redirect()->to('/admin/jurusan');
        }
        return view('admin/jurusan/form', [
            'fakultas' => $this->fakultas->findAll()
        ]);
    }

    public function edit($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $this->model->update($id, $this->request->getPost());
            $this->writeLog('UPDATE', 'jurusan', $id);
            return redirect()->to('/admin/jurusan');
        }
        return view('admin/jurusan/form', [
            'row' => $this->model->find($id),
            'fakultas' => $this->fakultas->findAll()
        ]);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        $this->writeLog('DELETE', 'jurusan', $id);
        return redirect()->to('/admin/jurusan');
    }
}
