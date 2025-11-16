<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function create() {
        return view('admin.create_kamar');
    }
}
