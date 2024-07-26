<?php

namespace Modules\Builder\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'test:test {param}';

    public function handle()
    {
        print_r(json_encode(['TestCommand Modules\Builder ']));echo "\n\n";exit;
    }
}
