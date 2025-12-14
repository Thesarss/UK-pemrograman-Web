<?php

namespace App\Controllers;

use App\Models\Fakultas_model;

class AdminFakultas extends AdminBase
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Fakultas_model();
    }

    public function index()
    {
        return view('admin/fakultas/index', [
            'data' => $this->model->findAll()
        ]);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $this->model->insert($this->request->getPost());
            $this->writeLog('CREATE', 'fakultas', $this->model->getInsertID());
            return redirect()->to('/admin/fakultas');
        }
        return view('admin/fakultas/form');
    }

    public function edit($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $this->model->update($id, $this->request->getPost());
            $this->writeLog('UPDATE', 'fakultas', $id);
            return redirect()->to('/admin/fakultas');
        }
        return view('admin/fakultas/form', [
            'row' => $this->model->find($id)
        ]);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        $this->writeLog('DELETE', 'fakultas', $id);
        return redirect()->to('/admin/fakultas');
    }
}
