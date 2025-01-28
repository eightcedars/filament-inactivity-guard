<?php

namespace EightCedars\FilamentInactivityGuard\Commands;

use Illuminate\Console\Command;

class FilamentInactivityGuardCommand extends Command
{
    public $signature = 'filament-inactivity-guard';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
