<?php

use EightCedars\FilamentInactivityGuard\FilamentInactivityGuardPlugin;
use Filament\Facades\Filament;

it('can register plugin', function () {
    $panel = Filament::getPanel('test');
    $plugin = $panel->getPlugin('eightcedars/filament-inactivity-guard');

    expect($plugin)->toBeInstanceOf(FilamentInactivityGuardPlugin::class);
});

it('can configure plugin to be enabled', function () {
    $plugin = FilamentInactivityGuardPlugin::get();

    expect($plugin->enabled(false))->toBeInstanceOf(FilamentInactivityGuardPlugin::class);
    expect(config('filament-inactivity-guard.enabled'))->toBeFalse();

    $plugin->enabled(true);
    expect(config('filament-inactivity-guard.enabled'))->toBeTrue();
});

it('can configure plugin te to be enabled with closure', function () {
    $plugin = FilamentInactivityGuardPlugin::get();

    $plugin->enabled(fn () => false);
    expect(config('filament-inactivity-guard.enabled'))->toBeFalse();

    $plugin->enabled(fn () => true);
    expect(config('filament-inactivity-guard.enabled'))->toBeTrue();
});

it('can configure inactivity timeout', function () {
    $plugin = FilamentInactivityGuardPlugin::get();

    expect($plugin->inactiveAfter(300))->toBeInstanceOf(FilamentInactivityGuardPlugin::class);
    expect(config('filament-inactivity-guard.inactivity_timeout'))->toBe(300);

    $plugin->inactiveAfter(600);
    expect(config('filament-inactivity-guard.inactivity_timeout'))->toBe(600);
});

it('can configure inactivity timeout with closure', function () {
    $plugin = FilamentInactivityGuardPlugin::get();

    $plugin->inactiveAfter(fn () => 900);
    expect(config('filament-inactivity-guard.inactivity_timeout'))->toBe(900);
});

it('can configure notice modal timeout', function () {
    $plugin = FilamentInactivityGuardPlugin::get();

    expect($plugin->showNoticeFor(60))->toBeInstanceOf(FilamentInactivityGuardPlugin::class);
    expect(config('filament-inactivity-guard.notice_timeout'))->toBe(60);

    $plugin->showNoticeFor(null);
    expect(config('filament-inactivity-guard.notice_timeout'))->toBeNull();
});

it('can configure notice modal timeout with closure', function () {
    $plugin = FilamentInactivityGuardPlugin::get();

    $plugin->showNoticeFor(fn () => 120);
    expect(config('filament-inactivity-guard.notice_timeout'))->toBe(120);

    $plugin->showNoticeFor(fn () => null);
    expect(config('filament-inactivity-guard.notice_timeout'))->toBeNull();
});

it('can configure interaction events with merge', function () {
    $plugin = FilamentInactivityGuardPlugin::get();

    // Set initial events
    config()->set('filament-inactivity-guard.interaction_events', ['click', 'keydown']);

    expect($plugin->keepActiveOn(['scroll', 'mousemove']))->toBeInstanceOf(FilamentInactivityGuardPlugin::class);
    expect(config('filament-inactivity-guard.interaction_events'))->toEqual(['click', 'keydown', 'scroll', 'mousemove']);
});

it('can configure interaction events without merge', function () {
    $plugin = FilamentInactivityGuardPlugin::get();

    // Set initial events
    config()->set('filament-inactivity-guard.interaction_events', ['click', 'keydown']);

    $plugin->keepActiveOn(['scroll', 'mousemove'], false);
    expect(config('filament-inactivity-guard.interaction_events'))->toEqual(['scroll', 'mousemove']);
});

it('can chain configuration methods', function () {
    $plugin = FilamentInactivityGuardPlugin::get();

    $result = $plugin
        ->enabled(true)
        ->inactiveAfter(300)
        ->showNoticeFor(60)
        ->keepActiveOn(['click', 'scroll']);

    expect($result)->toBeInstanceOf(FilamentInactivityGuardPlugin::class);
    expect(config('filament-inactivity-guard.enabled'))->toBeTrue();
    expect(config('filament-inactivity-guard.inactivity_timeout'))->toBe(300);
    expect(config('filament-inactivity-guard.notice_timeout'))->toBe(60);
    expect(config('filament-inactivity-guard.interaction_events'))->toContain('click');
    expect(config('filament-inactivity-guard.interaction_events'))->toContain('scroll');
});
