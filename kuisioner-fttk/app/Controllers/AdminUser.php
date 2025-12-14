<?php

namespace App\Controllers;

use App\Models\User_model;

class AdminUser extends AdminBase
{
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = new User_model();
    }

    public function index()
    {
        return view('admin/user/index', [
            'users' => $this->user->findAll()
        ]);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $this->user->insert($this->request->getPost());
            $this->writeLog('CREATE', 'user', $this->user->getInsertID());
            return redirect()->to('/admin/users');
        }
        return view('admin/user/form');
    }

    public function edit($id)
    {
        if ($this->request->getMethod() === 'post') {
            $this->user->update($id, $this->request->getPost());
            $this->writeLog('UPDATE', 'user', $id);
            return redirect()->to('/admin/users');
        }
        return view('admin/user/form', [
            'user' => $this->user->find($id)
        ]);
    }

    public function delete($id)
    {
        $this->user->delete($id);
        $this->writeLog('DELETE', 'user', $id);
        return redirect()->to('/admin/users');
    }
}
