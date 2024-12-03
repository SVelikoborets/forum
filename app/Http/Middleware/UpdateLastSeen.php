<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;


class UpdateLastSeen
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) { // Проверяем, авторизован ли пользователь
            $user = Auth::user();

            $lastSeen = Carbon::parse($user->last_seen);
            // Обновляем поле last_seen только если прошло больше 1 минуты с последнего обновления
            if (is_null($user->last_seen) || $lastSeen->diffInMinutes(now()) > 1) {
                $user->update(['last_seen' => now()]);
            }
        }

        return $next($request);
    }
}