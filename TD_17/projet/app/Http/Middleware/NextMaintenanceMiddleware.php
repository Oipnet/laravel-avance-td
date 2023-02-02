<?php

namespace App\Http\Middleware;

use App\Models\Maintenance;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class NextMaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::now();
        $nowAdd7Days = Carbon::now()->addDays(7);

        $nextMaintenance = Maintenance::where('start_at', '>', $now)
            ->where('start_at', '<', $nowAdd7Days)
            ->orderBy('start_at')
            ->first();

        if ($nextMaintenance) {
            $request->session()->flash(
                'maintenance',
                sprintf(
                    'Une maintenance est prévue du %s au %s',
                    $nextMaintenance->start_at->format('d/m/Y H:i'),
                    $nextMaintenance->end_at->format('d/m/Y H:i')
                )
            );
        }

        return $next($request);
    }
}
