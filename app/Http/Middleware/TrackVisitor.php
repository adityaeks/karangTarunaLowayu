<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ignore bots and admin routes
        if (!$this->isBot($request) && !str_starts_with($request->path(), 'admin')) {
            Visitor::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'page' => $request->path() == '/' ? 'home' : $request->path(),
                'visited_at' => Carbon::now(),
            ]);
        }

        return $next($request);
    }

    /**
     * Check if the request is from a bot
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function isBot(Request $request)
    {
        $botPatterns = [
            'bot', 'spider', 'crawler', 'slurp', 'googlebot',
            'bingbot', 'yandex', 'baidu', 'crawler', 'yahoo'
        ];

        $userAgent = strtolower($request->userAgent() ?? '');

        foreach ($botPatterns as $pattern) {
            if (str_contains($userAgent, $pattern)) {
                return true;
            }
        }

        return false;
    }
}
