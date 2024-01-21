<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $currentYear = $date->year;
        $currentMonth = $date->month;

        $totalEarnings = Order::where('status', 'done')->sum('total_price');
        $monthEarnings = Order::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('status', 'done')
            ->sum('total_price');
        $stock = Product::sum('stock');
        $orderCount = Order::where('status', 'waiting')->count();

        $data = [
            'monthEarnings' => $monthEarnings,
            'totalEarnings' => $totalEarnings,
            'stock' => $stock,
            'orderCount' => $orderCount
        ];
        return view('pages.admin.dashboard')->with('data', $data);
    }

    public function userList()
    {
        $users = User::where('role', 'user')->paginate(10);
        return view('pages.admin.userList')->with('users', $users);
    }

    public function deleteUser(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('Admin.Users');
        } catch (QueryException $exception) {
            return redirect()->route('Admin.Users')->with('error', 'Gagal menghapus data: ' . $exception);
        }
    }
}
