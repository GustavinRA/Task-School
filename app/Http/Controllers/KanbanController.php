<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KanbanController extends Controller
{
    public function index() 
    {
        return view('kanban.index');    
    }
}
