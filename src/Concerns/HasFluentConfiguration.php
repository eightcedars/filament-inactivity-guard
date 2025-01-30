<?php

namespace EightCedars\FilamentInactivityGuard\Concerns;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;

trait HasFluentConfiguration
{
    use EvaluatesClosures;

    public function enabled(bool | Closure $condition = true): static
    {
        config()->set('filament-inactivity-guard.enabled', $this->evaluate($condition));

        return $this;
    }

    public function inactiveAfter(int | Closure $seconds): static
    {
        config()->set('filament-inactivity-guard.inactivity_timeout', $this->evaluate($seconds));

        return $this;
    }

    public function showNoticeFor(int | null | Closure $seconds): static
    {
        config()->set('filament-inactivity-guard.notice_timeout', $this->evaluate($seconds));

        return $this;
    }

    public function keepActiveOn(array $browserEvents, bool $mergeWithDefaults = true): static
    {
        $events = ! $mergeWithDefaults ? [] : config('filament-inactivity-guard.interaction_events');

        $events = array_merge($events, $browserEvents);

        config()->set('filament-inactivity-guard.interaction_events', array_unique($events));

        return $this;
    }
}
