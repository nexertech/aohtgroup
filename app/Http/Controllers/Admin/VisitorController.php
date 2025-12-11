<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = \App\Models\Visitor::latest()->paginate(20);
        return view('admin.visitors.index', compact('visitors'));
    }
}
