<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks=[
            ['id'=>1,'bank_name'=>'Equity Bank','bank_code'=>'EQ'],
            ['id'=>2,'bank_name'=>'Cooperative Bank','bank_code'=>'COOP'],
            ['id'=>3,'bank_name'=>'Kenya Commercial Bank','bank_code'=>'KCB'],
            ['id'=>4,'bank_name'=>'Diamond Trust Bank','bank_code'=>'DTB'],
            ['id'=>5,'bank_name'=>'National Bank of Kenya','bank_code'=>'NBK'],
            ['id'=>6,'bank_name'=>'NCBA Bank','bank_code'=>'NCBA'],
        ];

        foreach ($banks as $bank){
            Bank::updateOrCreate(['id'=>$bank['id']],$bank);
        }
    }
}
