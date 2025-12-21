<?php

// Provide short alias to match docs: php artisan db:seed --class=TenancySeeder
class_alias(\Dapunjabi\TenancyAdapter\Database\Seeders\TenancySeeder::class, 'TenancySeeder');

// Also support Laravel's default namespace for seeders
// so php artisan db:seed --class=Database\\Seeders\\TenancySeeder works
if (! class_exists('Database\\Seeders\\TenancySeeder', false)) {
    class_alias(\Dapunjabi\TenancyAdapter\Database\Seeders\TenancySeeder::class, 'Database\\Seeders\\TenancySeeder');
}
