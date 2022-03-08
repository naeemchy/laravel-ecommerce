<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function TodayOrder()
    {
        $today = date('d-m-y');
        $orders = Order::where('status', 0)->where('date', $today)->get();
        return view('Backend.dashboard.report.today', compact('orders'));
    }

    public function todayDelevered()
    {
        $today = date('d-m-y');
        $orders = Order::where('status', 3)->where('date', $today)->get();
        return view('Backend.dashboard.report.today', compact('orders'));
    }

    public function thisMonthDelevered()
    {
        $month = date('F');
        $orders = Order::where('status', 3)->where('month', $month)->get();
        return view('Backend.dashboard.report.today', compact('orders'));
    }

    public function search()
    {
        return view('Backend.dashboard.report.search');
    }

    public function searchByDate(Request $request)
    {
        $date = $request->date;
        $newdate = date("d-m-y", strtotime($date));
        $total = Order::where('status', 3)->where('date', $newdate)->sum('total');
        $orders = Order::where('status', 3)->where('date', $newdate)->get();
        return view('Backend.dashboard.report.search_report', compact('orders', 'total'));
    }

    public function searchByMonth(Request $request)
    {
        $month = $request->month;
        $total = Order::where('status', 3)->where('month', $month)->sum('total');
        $orders = Order::where('status', 3)->where('month', $month)->get();
        return view('Backend.dashboard.report.search_report', compact('orders', 'total'));
    }

    public function searchByYear(Request $request)
    {
        $year = $request->year;
        $total = Order::where('status', 3)->where('year', $year)->sum('total');
        $orders = Order::where('status', 3)->where('year', $year)->get();
        return view('Backend.dashboard.report.search_report', compact('orders', 'total'));
    }
}
