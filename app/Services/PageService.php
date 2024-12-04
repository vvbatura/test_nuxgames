<?php

namespace App\Services;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PageService
{

    /**
     * Handle an incoming deactivateKey request.
     *
     * @param Link|Builder $link
     * @return string
     */
    public function getShowPage(Link|Builder $link): string
    {
        return $link->created_at > now()->subDays(7) ? 'page' : 'expired_key';
    }

    /**
     * Handle an incoming deactivateKey request.
     *
     * @param string $key
     * @return string|null
     */
    public function activateNewKey(string $key): string|null
    {
        $user = User::query()
            ->whereHas('links', fn($query) => $query->where('key', $key))
            ->first();

        try {
            $link = $user->links()
                ->create([
                    'key' => uniqid(),
                ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return $link?->key;
    }

    /**
     * Handle an incoming deactivateKey request.
     *
     * @param string $key
     * @return bool
     */
    public function deactivateKey(string $key): bool
    {
        try {
            $result = Link::query()
                ->where('key', $key)
                ->update([
                    'created_at' => now()->subDays(7),
                ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $result = false;
        }

        return (bool)$result;
    }

    /**
     * Handle an incoming deactivateKey request.
     *
     * @param string $key
     * @return array|null
     */
    public function createGame(string $key): array|null
    {
        try {
            $number = rand(1,1000);
            $win = $number % 2 ? false : true;
            $percent = !$win ? 0 : ( $number > 900 ? 70 : ( $number > 600 ? 50 : ( $number > 300 ? 30 : 10 )));
            $user = User::query()
                ->whereHas('links', fn($query) => $query->where('key', $key))
                ->first();
            $game = $user->games()->create([
                    'number' => $number,
                    'win' => $win,
                    'sum' => round($number * $percent / 100, 2),
                ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $game = null;
        }

        return $game?->toArray();
    }

    /**
     * Handle an incoming deactivateKey request.
     *
     * @param string $key
     * @return array
     */
    public function getGames(string $key): array
    {
        $user = User::query()
            ->with([
                'games' => fn($query) => $query->latest()->take(3)
            ])
            ->whereHas('links', fn($query) => $query->where('key', $key))
            ->first();

        return $user->games->toArray();
    }

}
