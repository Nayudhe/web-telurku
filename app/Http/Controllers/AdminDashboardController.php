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

    public function userList()
    {
        $users = User::where('role', 'user')->paginate(10);
        return view('pages.admin.userList')->with('users', $users);
    }

    public function deleteUser(User $user)
    {
        try {
            $user->delete();
            return redirect()->back()->with('status', 'Berhasil menghapus data user');;
        } catch (QueryException $exception) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $exception);
        }
    }

    public function messageList()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(5);
        return view('pages.admin.messageList')->with('messages', $messages);
    }
}
