<?php

namespace App\Http\Controllers;

use App\Sanctuary;
use Illuminate\Http\Request;

class SanctuaryController extends Controller
{
    public function index()
    {
        return Sanctuary::orderBy('name', 'desc')->get();
    }
}
