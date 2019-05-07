<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bouquet;

class BouquetsController extends Controller
{
    public function index()
    {
        $data['bouquets'] = Bouquet::with('price')->with('payment')->with('services')->get();
        return view('bouquets.index',$data);
    }
}
