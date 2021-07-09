<?php

namespace App\Http\Traits;

trait ContractStatusTrait{

    protected static $statuses=[
        'Active'=>1,
        'Inactive'=>0
    ];
    public function index()
    {

    }
}
