@php
$inactivityTimeout = config('filament-inactivity-guard.inactivity_timeout', 30) * 1000;
$noticeTimeout = config('filament-inactivity-guard.notice_timeout', 15) * 1000;
$interactionEvents = json_encode(config('filament-inactivity-guard.interaction_events'));
$enabled = config('filament-inactivity-guard.enabled');
@endphp

<div>
@if($enabled && auth(filament()->getAuthGuard())->check())
    <x-filament::modal
        id="inactivityModal"
        width="lg"
        :close-button="false"
        :close-by-clicking-away="false"
    >
        <x-slot name="heading">@lang('filament-inactivity-guard::inactivity-guard.modal.heading')</x-slot>

        <x-slot name="description">
            @lang('filament-inactivity-guard::inactivity-guard.modal.content')
        </x-slot>

        <x-slot name="footer">
            <x-filament::button type="button" x-on:click="$dispatch('resumeActivities')">
                @lang('filament-inactivity-guard::inactivity-guard.modal.resume_session')
            </x-filament::button>

            <x-filament::button color="danger" disabled>
                <div
                    style="opacity: 0.8; cursor: not-allowed;"
                    x-data="{timeout:null}"
                    x-on:start-logout-countdown.window="timeout={{ $noticeTimeout/1000 }}; interval = setInterval(() => timeout > 0 ? timeout=timeout-1 : clearInterval(interval), 1000)"
                >
                    @lang('filament-inactivity-guard::inactivity-guard.modal.logout')
                    <span x-text="`${timeout}s`"></span>
                </div>
            </x-filament::button>
        </x-slot>
    </x-filament::modal>

    <div
        style="height: 0"
        x-ignore
        ax-load
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-inactivity-guard', 'eightcedars/filament-inactivity-guard') }}"
        x-data="inactivityGuard($wire, {{ $interactionEvents }}, '{{ $inactivityTimeout }}', '{{ $noticeTimeout }}')">
    </div>
@endif
</div>

