<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\PageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
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
     * Handle an incoming register request.
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = User::query()
            ->firstOrCreate($data, $data);
        $link = $user->links()
            ->create([
                'key' => uniqid(),
            ]);

        return redirect()->route('page', $link->key);
    }
}
