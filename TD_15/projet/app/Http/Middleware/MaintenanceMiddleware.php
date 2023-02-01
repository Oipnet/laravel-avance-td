<?php

namespace App\Http\Middleware;

use App\Models\Maintenance;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|View
     */
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_MAINTENANCE', false)) {
            return response(content: view('maintenance', ['message', 'Le site est en maintenance']), status: 503);
        }

        $now = Carbon::now();
        $planifiedMaintenance = Maintenance::where('start_at', '<=', $now)
            ->where('end_at', '>', $now)
            ->orderBy('start_at')
            ->first();

        if ($planifiedMaintenance) {
            return response(
                content: view(
                    'maintenance',
                    ['message' => $planifiedMaintenance->message]
                ),
                status: 503
            );
        }

        return $next($request);
    }
}
