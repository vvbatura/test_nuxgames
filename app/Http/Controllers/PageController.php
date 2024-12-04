<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Services\PageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PageController extends Controller
{

    /**
     * AuthController constructor.
     *
     * @param PageService $service
     */
    public function __construct(
        protected PageService $service
    ){ }

    /**
     * Show page.
     *
     * @param string $key
     * @return View
     */
    public function index(string $key): View
    {
        $link = Link::query()
            ->where('key', $key)
            ->firstOrFail();

        return view($this->service->getShowPage($link), compact('link'));
    }

    /**
     * Handle an incoming activateNewKey request.
     *
     * @param string $key
     * @return RedirectResponse
     */
    public function activateNewKey(string $key): RedirectResponse
    {
        if ($key = $this->service->activateNewKey($key)) {
            return back()->withInput([
                'link' => $key,
            ]);
        } else {
            return back()->withErrors([
                'activateNewKey' => __('Error activateNewKey'),
            ]);
        }
    }

    /**
     * Handle an incoming deactivateKey request.
     *
     * @param string $key
     * @return RedirectResponse
     */
    public function deactivateKey(string $key): RedirectResponse
    {
        if ($this->service->deactivateKey($key)) {
            return redirect()->route('main');
        } else {
            return back()->withErrors([
                'deactivateKey' => __('Error deactivateKey') . ' - ' . $key,
            ]);
        }
    }

    /**
     * Handle an incoming createGame request.
     *
     * @param string $key
     * @return RedirectResponse
     */
    public function createGame(string $key): RedirectResponse
    {
        if ($game = $this->service->createGame($key)) {
            return back()->withInput([
                'game' => $game,
            ]);
        } else {
            return back()->withErrors([
                'game' => __('Error Imfeelinglucky'),
            ]);
        }
    }

    /**
     * Handle an incoming getGames request.
     *
     * @param string $key
     * @return RedirectResponse
     */
    public function getGames(string $key): RedirectResponse
    {
        return back()->withInput([
            'games' => $this->service->getGames($key),
        ]);
    }
}
