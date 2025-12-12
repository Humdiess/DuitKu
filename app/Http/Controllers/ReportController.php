<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Display the reports page.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();
        
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);

        $reportData = $this->reportService->getReportData($userId, $year, $month);
        $availableMonths = $this->reportService->getAvailableMonths($userId);

        return view('dashboard.laporan', [
            'stats' => $reportData['stats'],
            'categoryBreakdown' => $reportData['category_breakdown'],
            'dailyTrend' => $reportData['daily_trend'],
            'incomeVsExpense' => $reportData['income_vs_expense'],
            'availableMonths' => $availableMonths,
            'currentYear' => $year,
            'currentMonth' => $month,
            'currentMonthLabel' => Carbon::create($year, $month, 1)->translatedFormat('F Y'),
        ]);
    }
}
