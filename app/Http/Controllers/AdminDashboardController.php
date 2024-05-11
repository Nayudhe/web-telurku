<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
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

        $monthlyOrder = Order::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, SUM(total_price) earnings'))
            ->where('status', 'done')
            ->groupBy('year')->groupBy('month')
            ->orderBy('year', 'desc')->orderBy('month', 'desc')
            ->get();

        $data = [
            'monthEarnings' => $monthEarnings,
            'monthlyOrder' => $monthlyOrder,
            'totalEarnings' => $totalEarnings,
            'stock' => $stock,
            'orderCount' => $orderCount
        ];
        return view('pages.admin.dashboard')->with('data', $data);
    }

    public function user_list()
    {
        $users = User::where('role', 'user')->paginate(10);
        return view('pages.admin.user-list')->with('users', $users);
    }

    public function delete_user(User $user)
    {
        try {
            $user->delete();
            return redirect()->back()->with('status', 'Berhasil menghapus data user');;
        } catch (QueryException $exception) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $exception);
        }
    }

    public function message_list()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(5);
        return view('pages.admin.message-list')->with('messages', $messages);
    }
}
