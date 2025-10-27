<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Activitylog\Models\Activity;
use App\Models\User;

class LogActivityController extends Controller
{
    public function activityReport(Request $request)
    {
        $data['title'] = 'Activity Log';
        $users = User::where('role','admin')->where('is_hide',0)->pluck('name', 'id');

        $query = Activity::query()->with('causer');

        // Filter by User
        if ($request->filled('user_id')) {
            $query->where('causer_id', $request->user_id);
        }

        $query->where('event','deleted');

        // Filter by Date Range
        // if ($request->filled('start_date') && $request->filled('end_date')) {
        //     $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        // }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereDate('created_at', '>=', $request->start_date)
                ->whereDate('created_at', '<=', $request->end_date);
        }

        $activities = $query->latest()->paginate(100);

        return view('admin.activity.report', compact('activities', 'users'))->with($data);
    }
}
