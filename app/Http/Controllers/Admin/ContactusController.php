<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function index()
    {
        return view('admin.contactus.index');
    }
}
