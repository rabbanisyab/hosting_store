<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\TravelPackage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalOrders = Booking::count();
        $totalHostingPackages = TravelPackage::count();

        return view('admin.dashboard', compact('totalUsers', 'totalOrders', 'totalHostingPackages'));
    }
}
