<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('editarPerfil');
    }

    public function update(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|max:2048', // até 2MB
        ]);

        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            // apaga imagem antiga
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // salva nova
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        $returnTo = $request->input('return_to');

        if ($returnTo) {
            $parsed = parse_url($returnTo);
            if (!isset($parsed['host']) || $parsed['host'] === $request->getHost()) {
                return redirect()->to($returnTo)->with('success', 'Perfil atualizado');
            }
        }

        return redirect()->route('dashboard')->with('success', 'Perfil atualizado');
    }
    public function settings()
    {
        return view('configuracoes');
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'theme' => 'nullable|string',
            'timezone' => 'nullable|string',
            'date_format' => 'nullable|string',
            'items_per_page' => 'nullable|integer',
            'email_notifications' => 'nullable|boolean',
        ]);

        $user = auth()->user();
        $prefs = $user->preferences ?? [];
        $prefs = array_merge($prefs, [
            'theme' => $data['theme'] ?? ($prefs['theme'] ?? 'light'),
            'timezone' => $data['timezone'] ?? ($prefs['timezone'] ?? 'UTC'),
            'date_format' => $data['date_format'] ?? ($prefs['date_format'] ?? 'd/m/Y'),
            'items_per_page' => $data['items_per_page'] ?? ($prefs['items_per_page'] ?? 10),
        ]);

        $user->preferences = $prefs;
        $user->save();

        return back()->with('success', 'Configurações salvas.');
    }

    
}

