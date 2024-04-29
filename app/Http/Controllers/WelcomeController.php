<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $text = 'Bienvenue sur notre site !';
        return view('welcome', ['text' => $text]);
    }
    public function apiIndex()
    {
        $text = 'Bienvenue sur notre site !';
        return response()->json(['text' => $text]);
    }
}
