<?php

namespace Larapress\Notifications\Commands;

use Illuminate\Console\Command;
use Larapress\Notifications\Models\SMSGatewayData;

class ExportSMSGateways extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lp:notify:export-sms {path?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export SMS gateways to json file.';

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
            if (!file_exists(storage_path('json'))) {
                mkdir(storage_path('json'));
            }
            $filepath = storage_path('/json/sms_gateways.json');
        }

        file_put_contents($filepath, json_encode(SMSGatewayData::all(), JSON_PRETTY_PRINT));
        $this->info('Gateways exported to path: '.$filepath.'.');

        return 0;
    }
}
