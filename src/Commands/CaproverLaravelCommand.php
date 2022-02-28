<?php

namespace Ariaieboy\CaproverLaravel\Commands;

use Illuminate\Console\Command;

class CaproverLaravelCommand extends Command
{
    public $signature = 'caprover-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
