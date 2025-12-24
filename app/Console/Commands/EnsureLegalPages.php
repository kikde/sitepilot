<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class EnsureLegalPages extends Command
{
    protected $signature = 'ngo:ensure-legal-pages {--force : Overwrite empty fields with defaults}';
    protected $description = 'Create/update Terms, Privacy, and Refund policy pages if missing for the current tenant.';

    public function handle(): int
    {
        if (!Schema::hasTable('pages')) {
            $this->error('pages table not found. Run migrations first.');
            return self::FAILURE;
        }

        $this->info('Ensuring legal pages exist (Terms/Privacy/Refund)…');

        $rows = [
            [
                'types' => 'TC',
                'name'  => 'Terms & Conditions',
                'slug'  => 'terms-and-conditions',
            ],
            [
                'types' => 'PP',
                'name'  => 'Privacy Policy',
                'slug'  => 'privacy-policy',
            ],
            [
                'types' => 'CRP',
                'name'  => 'Cancellations & Refunds Policy',
                'slug'  => 'cancellation-and-refund-policy',
            ],
        ];

        $Page = \Modules\Page\Entities\Page::class;
        $changed = 0;
        foreach ($rows as $data) {
            /** @var \Modules\Page\Entities\Page $page */
            $page = $Page::query()->where('types', $data['types'])->first();
            if (!$page) {
                $page = new $Page();
            }

            $page->types      = $data['types'];
            $page->name       = $page->name ?: $data['name'];
            $page->slug       = $page->slug ?: $data['slug'];
            $page->pagetitle  = $page->pagetitle ?: $data['name'];
            $page->pagestatus = $page->pagestatus ?: 'Published';

            if ($this->option('force')) {
                if (empty($page->description)) {
                    $page->description = '<p>'.$data['name'].' content goes here. Please update from Admin &gt; Pages.</p>';
                }
            }

            $page->save();
            $changed++;
            $this->line("✓ {$data['name']} ensured (id: {$page->id})");
        }

        $this->info("Done. {$changed} rows ensured in pages table.");
        return self::SUCCESS;
    }
}

