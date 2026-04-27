<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyExpense;
use App\Models\LaborCost;
use App\Models\Purchase;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPurchasing = Purchase::sum('total_price');
        $totalSales = Sale::sum('total_price');
        $totalLaborCost = LaborCost::sum('total_amount');
        $totalDailyExpenses = DailyExpense::sum('amount');

        $totalProfit = $totalSales - ($totalPurchasing + $totalDailyExpenses + $totalLaborCost);

        // Monthly sales for the current year
        $year = now()->year;
        $monthlySales = Sale::selectRaw('MONTH(date) as month, SUM(total_price) as total')
            ->whereYear('date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $months = [];
        $salesData = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = date('M', mktime(0, 0, 0, $m, 1));
            $salesData[] = isset($monthlySales[$m]) ? (float) $monthlySales[$m] : 0;
        }

        return view('admin.dashboard', [
            'totalPurchasing' => $totalPurchasing,
            'totalSales' => $totalSales,
            'totalLaborCost' => $totalLaborCost,
            'totalDailyExpenses' => $totalDailyExpenses,
            'totalProfit' => $totalProfit,
            'months' => $months,
            'salesData' => $salesData,
        ]);
    }
}

