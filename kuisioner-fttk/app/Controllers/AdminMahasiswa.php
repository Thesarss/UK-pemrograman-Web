<?php

namespace App\Controllers;

use App\Models\Mahasiswa_model;
use App\Models\User_model;

class AdminMahasiswa extends AdminBase
{
    protected $model;
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Mahasiswa_model();
        $this->user = new User_model();
    }

    public function index()
    {
        return view('admin/mahasiswa/index', [
            'data' => $this->model->findAll()
        ]);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $this->model->insert($this->request->getPost());
            $this->writeLog('CREATE', 'mahasiswa', $this->request->getPost('nim'));
            return redirect()->to('/admin/mahasiswa');
        }
        return view('admin/mahasiswa/form', [
            'users' => $this->user->where('role', 'mahasiswa')->findAll()
        ]);
    }

    public function edit($id = null)
    {
        if ($this->request->getMethod() === 'post') {
            $this->model->update($id, $this->request->getPost());
            $this->writeLog('UPDATE', 'mahasiswa', $id);
            return redirect()->to('/admin/mahasiswa');
        }
        return view('admin/mahasiswa/form', [
            'row' => $this->model->find($id),
            'users' => $this->user->where('role', 'mahasiswa')->findAll()
        ]);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);
        $this->writeLog('DELETE', 'mahasiswa', $id);
        return redirect()->to('/admin/mahasiswa');
    }
}
