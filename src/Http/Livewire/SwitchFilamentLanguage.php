<?php

namespace BezhanSalleh\FilamentLanguageSwitch\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class SwitchFilamentLanguage extends Component
{
    public function changeLocale($locale)
    {
        session()->put('locale', $locale);

        if(config('filament-language-switch.store_locale_in_database')) {
            dd(auth()->user());
            dd("lang switch");
            if (auth()->check()) {
                auth()->user()->update([
                    'locale' => $locale,
                ]);
            }
        }

        cookie()->queue(cookie()->forever('filament_language_switch_locale', $locale));

        $this->redirect(request()->header('Referer'));
    }

    public function render(): View
    {
        return view('filament-language-switch::language-switch');
    }
}
