<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return User::orderBy('name', 'desc')->get();
        
    }

    public function show(string $id)
    {
        return User::where('id', $id)->orderBy('name', 'desc')->first();;

    }
}
