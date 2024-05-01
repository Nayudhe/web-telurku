<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class OrdersExport implements FromView, WithStyles
{

    protected $year;
    protected $month;

    function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function view(): View
    {
        $orders = Order::where('status', 'done')
            ->whereRaw('YEAR(created_at) = ' . $this->year)
            ->whereRaw('MONTH(created_at) = ' . $this->month)
            ->get();

        $date = Carbon::createFromFormat('mY', sprintf("%02d", $this->month) . $this->year)->translatedFormat('F Y');
        return view('pages.admin.generateReport', [
            'orders' => $orders,
            'date' => $date
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1   => [
                'font'      => ['bold' => true, 'size' => 14],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
            ],
            'B' => ['alignment' => ['wrapText' => true]],
            'C' => ['alignment' => ['wrapText' => true]],
            'D' => ['alignment' => ['wrapText' => true]],
        ];
    }
}
