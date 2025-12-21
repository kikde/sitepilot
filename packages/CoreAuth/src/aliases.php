<?php

// Provide a convenient seeder alias to allow:
// php artisan db:seed --class=CoreAuthSeeder

if (! class_exists('CoreAuthSeeder')) {
    class_alias(\Dapunjabi\CoreAuth\Database\Seeders\CoreAuthSeeder::class, 'CoreAuthSeeder');
}
if (! class_exists('Database\\Seeders\\CoreAuthSeeder')) {
    class_alias(\Dapunjabi\CoreAuth\Database\Seeders\CoreAuthSeeder::class, 'Database\\Seeders\\CoreAuthSeeder');
}
