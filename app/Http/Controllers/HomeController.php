<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $top_complaints = Complaint::withCount('supports') 
        ->orderBy('supports_count', 'desc') 
        ->limit(6) 
        ->get();
        return view('home/index', ['top_complaints' => $top_complaints]);
    }
}
