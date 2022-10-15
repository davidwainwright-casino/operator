<?php

namespace Wainwright\CasinoDogScanner\Commands;

use Illuminate\Console\Command;

class CasinoDogScannerCommand extends Command
{
    public $signature = 'casino-dog-scanner';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
