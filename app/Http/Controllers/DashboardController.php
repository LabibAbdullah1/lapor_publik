<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $stats = [
                'total_reports' => Report::count(),
                'submitted_reports' => Report::where('status', 'submitted')->count(),
                'in_progress_reports' => Report::where('status', 'in_progress')->count(),
                'resolved_reports' => Report::where('status', 'resolved')->count(),
                'total_users' => User::count(),
            ];
            return view('Admin.dashboard', compact('stats'));
        }

        // Role user biasa
        $reports = Report::where('user_id', $user->id)->get();
        return view('User.dashboard', compact('reports'));
    }
}
