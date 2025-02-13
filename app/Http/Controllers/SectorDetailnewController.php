<?php

namespace App\Http\Controllers;

use App\Models\SectorDetailnew;
use Illuminate\Http\Request;

class SectorDetailnewController extends Controller
{
    public function getSectors()
    {
        $sectors = SectorDetailnew::all(); // Fetch all sectors
        return view('dashboard.banker', compact('sectors'));
    }
}
