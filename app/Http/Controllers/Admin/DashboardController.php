<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $userCount = User::where('role', 'user')->count();

        return view('admin.dashboard', compact('totalUsers', 'adminCount', 'userCount'));
    }
}
