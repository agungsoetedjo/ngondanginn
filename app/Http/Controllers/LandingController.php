<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(){
        $faqs = FAQ::all();
        return view('welcome',[
            'faqs' => $faqs,
        ]);
    }
}
