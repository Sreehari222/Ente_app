<?php

namespace App\Http\Controllers\AreaOperator;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaOperatorAttendanceController extends Controller
{
     public function mark()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        // Get today's attendance
        $attendance = Attendance::firstOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            ['status' => 'present']
        );

        return view('attendance.mark', compact('attendance'));
    }

    public function checkIn()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        $attendance = Attendance::firstOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            ['status' => 'present']
        );

        $attendance->check_in = now();
        $attendance->save();

        return back()->with('success', 'Checked in successfully!');
    }

    public function checkOut()
    {
        $user = Auth::user();
        $today = now()->format('Y-m-d');

        $attendance = Attendance::where('user_id', $user->id)
                                ->whereDate('date', $today)
                                ->first();

        if ($attendance && !$attendance->check_out) {
            $attendance->check_out = now();
            $attendance->save();

            return back()->with('success', 'Checked out successfully!');
        }

        return back()->with('error', 'You already checked out or not checked in yet.');
    }

    public function index(Request $request)
{
    $areaOperator = auth()->user();

    $salesmen = User::where('role','salesman')
                    ->where('area_operator_id', $areaOperator->id)
                    ->get();

    $salesmanId = $request->salesman_id;
    $startDate  = $request->start_date;
    $endDate    = $request->end_date;

    $query = Attendance::whereIn('user_id', $salesmen->pluck('id'));

    if($salesmanId){
        $query->where('user_id', $salesmanId);
    }
    if($startDate){
        $query->whereDate('date', '>=', $startDate);
    }
    if($endDate){
        $query->whereDate('date', '<=', $endDate);
    }

    $attendances = $query->orderBy('date','desc')->get();

    return view('area_operator.attendance.index', compact(
        'attendances','salesmen','salesmanId','startDate','endDate'
    ));
}
}
