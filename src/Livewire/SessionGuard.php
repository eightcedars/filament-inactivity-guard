<?php

namespace EightCedars\FilamentInactivityGuard\Livewire;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Livewire\Component;

class SessionGuard extends Component
{
    protected const MILLISECONDS_PER_SECOND = 1000;

    public function render(): string | View
    {
        if (Filament::auth()->guest()) {
            return '<div></div>';
        }

        return view('filament-inactivity-guard::livewire.session-guard', [
            'inactivity_timeout' => config('filament-inactivity-guard.inactivity_timeout', 15 * Carbon::SECONDS_PER_MINUTE) * static::MILLISECONDS_PER_SECOND,
            'notice_timeout' => config('filament-inactivity-guard.notice_timeout') * static::MILLISECONDS_PER_SECOND,
            'interaction_events' => json_encode(config('filament-inactivity-guard.interaction_events')),
        ]);
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
