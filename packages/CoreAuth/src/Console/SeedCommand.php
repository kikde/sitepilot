<?php

namespace Dapunjabi\CoreAuth\Console;

use Illuminate\Console\Command;

class SeedCommand extends Command
{
    protected $signature = 'coreauth:seed';
    protected $description = 'Seed CoreAuth test users (superadmin, test1 verified, test2 unverified)';

    public function handle(): int
    {
        $class = \Dapunjabi\CoreAuth\Database\Seeders\CoreAuthSeeder::class;
        $this->call('db:seed', ['--class' => $class]);
        $this->info('CoreAuth seed complete.');
        return self::SUCCESS;
    }
}

