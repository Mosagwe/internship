<?php

namespace App\Console\Commands;

use App\Models\Contract;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class ContractExpiring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send advance notification before the end date';

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
        $contracts = Contract::active()
            ->whereDate('end_date', '<=', today()->addDays(7)->format('Y-m-d'))
            ->get();
        foreach ($contracts as $contract) {
            if ($contract->employee) {
                Notification::send($contract->employee,new \App\Notifications\ContractExpiring($contract));
            }
        }
    }
}
