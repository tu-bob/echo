<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Modules\Counters\Models\Visitor;

class Traffic
{
    public function handle(Request $request, Closure $next)
    {
        Visitor::create([
            'ip'=> $request->ip(),
            'agent' => $request->userAgent(),
            'method' => $request->method(),
            'request' => implode(' | ',$request->toArray()),
            'url' => $request->url(),
            'user_id' => auth()->id()
        ]);

        return $next($request);
    }
}
