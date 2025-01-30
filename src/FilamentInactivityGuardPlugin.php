<?php

namespace EightCedars\FilamentInactivityGuard;

use EightCedars\FilamentInactivityGuard\Concerns\HasFluentConfiguration;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

class FilamentInactivityGuardPlugin implements Plugin
{
    use HasFluentConfiguration;

    public function getId(): string
    {
        return 'eightcedars/filament-inactivity-guard';
    }

    public function register(Panel $panel): void
    {
        if (config('filament-inactivity-guard.enabled')) {
            $panel->renderHook(
                PanelsRenderHook::BODY_END,
                fn () => Blade::render("@livewire('filament-inactivity-guard::session-guard')")
            );
        }
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
