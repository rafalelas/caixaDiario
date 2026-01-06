<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'theme' => 'required|in:light,dark',
            'timezone' => 'required|string',
            'date_format' => 'required|string',
            'items_per_page' => 'required|integer|min:1',
        ]);
        
        $user = auth()->user();
        
        $user->preferences = array_merge(
            $user->preferences ?? [],
            $data
        );
        $user = auth()->user();
    
        $prefs = $user->preferences ?? [];
    
        $prefs['theme'] = $request->theme ?? 'light';
        $prefs['timezone'] = $request->timezone ?? 'UTC';
        $prefs['date_format'] = $request->date_format ?? 'd/m/Y';
        $prefs['items_per_page'] = (int) ($request->items_per_page ?? 10);
    
        $user->update([
            'preferences' => $prefs,
        ]);
    
        return back()->with('success', 'Configurações salvas');

        $user->save();

        return back()->with('success', 'Configurações salvas');
    }

}

