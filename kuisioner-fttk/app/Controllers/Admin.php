<?php

namespace App\Controllers;

class Admin extends AdminBase
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }
}
