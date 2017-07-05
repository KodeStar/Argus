<?php

namespace App\Http\Middleware;

use Closure;
use App\Setting as Setting;

class DatabaseReady
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Setting::databaseReady()) {
            return redirect('setup');
        }
        return $next($request);
    }
}
