<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch application locale.
     */
    public function switch(string $locale): RedirectResponse
    {
        if (in_array($locale, ['en', 'fr', 'ar'])) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
