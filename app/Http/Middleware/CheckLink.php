<?php

namespace App\Http\Middleware;

use App\Models\Link;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($key = $request->route('key')) {
            $link = Link::query()
                ->where('key', $key)
                ->where('created_at', '>', now()->subDays(7))
                ->first();
            if (!$link) {
                return back()->withErrors([
                    'key' => __('This Link is deactivate!'),
                ]);
            }
        }

        return $next($request);
    }
}
