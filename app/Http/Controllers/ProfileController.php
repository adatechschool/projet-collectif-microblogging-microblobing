<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

       $request->validate([
            'biography'=> 'required|string|max:150',
       ]);

        $request->user()->biography = $request->input('biography');
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // Display user page by ID or name :
    public function show($identifier): View
    {
        // Vérifie si l'identifiant est un nombre (ID d'utilisateur) et le récupère
        if (is_numeric($identifier)) {
            $user = User::findOrFail($identifier);
        } else {
            // ou récupère le name
            $user = User::where('name', $identifier)->firstOrFail();
        }
        // Récupère tous les posts de cet utilisateur
         $posts = $user->posts()->latest()->get();
    
        // Passer les posts et l'utilisateur à la vue
        return view('userPage', ['user' => $user, 'posts' => $posts]);
    }

    // Search User by name
    public function search(Request $request)
    {
        $request->validate([
            'searchByName' => 'required|string',
        ]);

        // Récupère la valeur de l'input recherche
        $name = $request->input('searchByName');

        // Recherche l'utilisateur par son nom
        $user = User::where('name', $name)->first();
        $posts = $user->posts()->latest()->get();

        // Vérifie si l'utilisateur est trouvé et affiche la UserPage
        if ($user) {
            return view('userPage', ['user' => $user, 'posts' => $posts]);
        } else {
            return back()->with('error', 'Utilisateur non trouvé');
        }
    }
}
