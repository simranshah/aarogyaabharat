<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index() {
        return view('admin.status.index');
    }

    public function create() {
        return view('admin.status.create');
    }
}
