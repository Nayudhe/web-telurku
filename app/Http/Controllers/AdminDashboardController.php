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

        $totalEarnings = Payment::sum('amount');
        $monthEarnings = Payment::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('amount');
        $stock = Product::sum('stock');
        $orderCount = Order::where('status', 'Waiting')->count();

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
        $users = User::all();
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
