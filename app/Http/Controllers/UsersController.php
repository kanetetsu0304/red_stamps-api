<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return User::orderBy('created_at', 'desc')->get();
        
    }

    public function indexAsc()
    {
        return User::orderBy('created_at', 'asc')->get();
        
    }

    public function show(string $id)
    {
        return User::where('id', $id)->orderBy('name', 'desc')->first();;

    }
}
