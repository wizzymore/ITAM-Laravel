<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Scout\EngineManager;
use MeiliSearch\Client;

class SyncScout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync project\'s configuration with meilisearch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** @var Client $client */
        $client = app(EngineManager::class)->driver('meilisearch');

        $settings = collect(config('meilisearch.settings'));
        $settings->each(function ($config, $class) use ($client) {
            $model = new $class;
            $index = $client->getIndex($model->searchableAs());

            collect($config)->each(function ($value, $key) use ($index) {
                $status = $index->updateSettings([$key => $value]);
                $this->line("{$key} has been updated, updateId: {$status['updateId']}");
            });
        });
    }
}
