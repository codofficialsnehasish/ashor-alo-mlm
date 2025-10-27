<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckLoginRestriction
{
    public function handle($request, Closure $next)
    {
        $now = Carbon::now(); // server time
        $restrictedStart = Carbon::today()->setTime(23, 30); // 11:30 PM
        $restrictedEnd = Carbon::tomorrow()->setTime(0, 0);  // 12:00 AM

        // If current time is between 11:30 PM and midnight
        if ($now->between($restrictedStart, $restrictedEnd)) {
            if (Auth::check()) {
                Auth::logout();
                return redirect()->route('login')->with(["msg"=>"Your session ended. Please try again after 12:00 AM."]);
            }
        }

        return $next($request);
    }
}
