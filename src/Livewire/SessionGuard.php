<?php

namespace EightCedars\FilamentInactivityGuard\Livewire;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SessionGuard extends Component
{
    public function render(): View
    {
        return view('filament-inactivity-guard::livewire.session-guard');
    }

    public function logout(): void
    {
        Filament::auth()->logout();

        Notification::make()
            ->warning()
            ->title(__('filament-inactivity-guard::inactivity-guard.session_expired'))
            ->persistent()
            ->send();

        $this->redirect(Filament::getLoginUrl());
    }
}
