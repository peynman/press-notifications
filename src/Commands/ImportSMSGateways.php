<?php

namespace Larapress\Notifications\Commands;

use Illuminate\Console\Command;
use Larapress\Notifications\Models\SMSGatewayData;

class ImportSMSGateways extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lp:notify:import-sms {path?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import SMS gateways from json.';

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
        $filepath = $this->argument('path');
        if (is_null($filepath)) {
            $filepath = storage_path('/json/sms_gateways.json');
        }

        $types = json_decode(file_get_contents($filepath), true);

        foreach ($types as $type) {
            SMSGatewayData::withTrashed()
                ->updateOrCreate([
                    'id' => $type['id'],
                    'name' => $type['name'],
                ], [
                    'data' => $type['data'],
                    'author_id' => $type['author_id'],
                    'flags' => $type['flags'],
                    'gateway' => $type['gateway'],
                    'created_at' => $type['created_at'],
                    'updated_at' => $type['updated_at'],
                    'deleted_at' => $type['deleted_at'],
                ]);
            $this->info('Gateway added with name: ' . $type['name'] . '.');
        }

        $this->info('SMS Gateways imported.');

        return 0;
    }
}
