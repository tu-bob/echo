<?php


namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Counters\Models\Visitor;

class Traffic
{
    public function handle(Request $request, Closure $next)
    {
        Visitor::create([
            'ip'=> $request->ip(),
            'agent' => Str::limit($request->userAgent(), 255),
            'method' => $request->method(),
            'request' =>  Str::limit(collect($request->all())->flatten()->implode(' | '), 255),
            'url' => Str::limit($request->url(), 255),
            'user_id' => auth()?->id()
        ]);

        return $next($request);
    }
}
