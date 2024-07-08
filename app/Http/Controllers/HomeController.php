<?php
namespace App\Http\Controllers;

use App\Models\Videos;
use App\Models\News;
use App\Models\Tips;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $Vvideos = Videos::all();
        $Vnews = News::all();
        $Vtips = Tips::all();

        return view('welcome', compact('Vvideos', 'Vnews', 'Vtips'));
    }
}