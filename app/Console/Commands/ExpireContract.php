<?php

namespace App\Console\Commands;

use App\Models\Contract;
use App\Notifications\ContractExpired;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class ExpireContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contract:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expires Employee contract past end date';

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
        $contracts=Contract::active()
            ->whereDate('end_date','<=',today()->format('Y-m-d'))
            ->get();
        if (!count($contracts)){
            return $this->info('No Contracts were expired');
        }
        $contracts->each->expire();
        foreach ($contracts as $contract){
            if($contract->employee){
                Notification::send($contract->employee,new ContractExpired($contract));
            }
        }

        return $this->info(count($contracts).' contracts were expired.');
    }
}
