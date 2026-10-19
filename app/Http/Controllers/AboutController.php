<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view("about", [
            "title" => "About Page",
            "description" => "This is the about page of the project.",
        ]);
    }
}
