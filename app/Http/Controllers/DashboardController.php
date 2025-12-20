<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Need;
use App\Models\Donation;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     */
    public function index()
    {
        // Ambil statistik untuk ditampilkan di dashboard
        $programsCount = Program::count();
        $needsCount = Need::count();
        $donationsCount = Donation::count();

        // Ambil beberapa data terbaru untuk preview
        $latestPrograms = Program::latest()->take(5)->get();
        $latestNeeds = Need::latest()->take(5)->get();
        $latestDonations = Donation::with(['user', 'need'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'programsCount',
            'needsCount',
            'donationsCount',
            'latestPrograms',
            'latestNeeds',
            'latestDonations'
        ));
    }
}

