<?php

namespace Dapunjabi\CoreAuth\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class InstallCommand extends Command
{
    protected $signature = 'coreauth:install';

    protected $description = 'Install CoreAuth: publish assets, run migrations, seed superadmin user';

    public function handle(): int
    {
        $this->info('Publishing CoreAuth config, views, assets, and migrations...');

        Artisan::call('vendor:publish', ['--tag' => 'coreauth-config', '--force' => true]);
        Artisan::call('vendor:publish', ['--tag' => 'coreauth-views', '--force' => true]);
        Artisan::call('vendor:publish', ['--tag' => 'coreauth-assets', '--force' => true]);
        Artisan::call('vendor:publish', ['--tag' => 'coreauth-migrations', '--force' => true]);

        $this->output->write(Artisan::output());

        $this->info('Running migrations...');
        Artisan::call('migrate', ['--force' => true]);
        $this->output->write(Artisan::output());

        $this->info('Seeding superadmin user...');
        $this->seedSuperAdmin();

        $this->info('CoreAuth installation complete.');
        return self::SUCCESS;
    }

    protected function seedSuperAdmin(): void
    {
        $userModel = config('auth.providers.users.model') ?? '\\App\\Models\\User';

        if (!class_exists($userModel)) {
            $this->warn("User model {$userModel} not found. Skipping superadmin seeding.");
            return;
        }

        $email = config('coreauth.superadmin.email');
        $name = config('coreauth.superadmin.name');
        $password = config('coreauth.superadmin.password');

        try {
            $existing = $userModel::query()->where('email', $email)->first();
            if ($existing) {
                $this->line("Superadmin already exists: {$email}");
                return;
            }

            $userModel::query()->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                // Additional fields can be added here as needed
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

            $this->line("Superadmin created: {$email}");
        } catch (\Throwable $e) {
            $this->warn('Could not create superadmin user: '.$e->getMessage());
        }
    }
}
