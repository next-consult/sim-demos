<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanningController extends Controller
{
    public function index(): View
    {
        $interventions = Intervention::with(['client', 'entreprise','intervenants'])->get();
        return view('plannings.index', compact('interventions'));
    }
    public function gear2(): View
    {
        $interventions = Intervention::with(['client', 'entreprise','intervenant'])->get();
        return view('plannings.gear2', compact('interventions'));
    }
}
