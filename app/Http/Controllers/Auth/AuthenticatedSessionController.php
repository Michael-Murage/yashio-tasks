<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Foundation\Application;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display Search view
     */
    public function showSearch(): Response
    {
        return Inertia::render('Search');
    }

    /**
     * Display SinglePost view
     */
    public function showSinglePost($key): Response
    {
        $post = Post::with('tags')->where('posts.id', intval($key))->get()->all();
        return Inertia::render('SinglePost', [
            'data' => $post
        ]);
    }

    /**
     * Display NewPost view
     */
    public function showNewPost(): Response
    {
        return Inertia::render('NewPost');
    }

    /**
     * Display Posts view
     */
    public function showPosts(): Response
    {
        return Inertia::render('Posts');
    }

    /**
     * Display welcome view
     */
    public function returnHome()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    /**
     * Display the dashboard view
     */
    public function showDashboard()
    {
        return Inertia::render('Dashboard');
    }

    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
