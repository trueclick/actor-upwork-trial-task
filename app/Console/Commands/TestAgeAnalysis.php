<?php

namespace App\Console\Commands;

use App\Models\Actor;
use Illuminate\Console\Command;

class TestAgeAnalysis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:age-analysis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test age analysis functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Testing Age Analysis ===');

        $actors = Actor::all();
        $this->info("Total actors: " . $actors->count());

        foreach ($actors as $actor) {
            $this->line("Actor ID: {$actor->id}");
            $this->line("Name: {$actor->first_name} {$actor->last_name}");
            $this->line("Age: " . ($actor->age ?? 'NULL'));
            $this->line("Gender: " . ($actor->gender ?? 'NULL'));
            $this->line("Age Analysis: " . ($actor->age_analysis ? 'EXISTS (' . strlen($actor->age_analysis) . ' chars)' : 'NULL'));
            $this->line("Gender Analysis: " . ($actor->gender_analysis ? 'EXISTS (' . strlen($actor->gender_analysis) . ' chars)' : 'NULL'));
            $this->line("---");
        }
    }
}
