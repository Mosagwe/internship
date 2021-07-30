<?php

namespace App\Http\Controllers;

use App\DataTables\ContractDataTable;
use App\Mail\ContractExpiring;
use App\Models\Bank;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Station;
use App\Models\Unit;
use App\Notifications\ContractExpiringNotification;
use App\Notifications\ContractExpiryNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContractDataTable $dataTable)
    {

        //return view('contracts.index2');
       return $dataTable->render('contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        $stations = Station::all();
        $units = Unit::all();
        $banks = Bank::all();
        return view('contracts.create', compact('employees', 'stations', 'units', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return redirect()->route('contract.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract=Contract::find($id);
        return view('contracts.edit',compact('contract'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        $this->validate($request,[
            'start_date'=>'required',
            'station_id'=>'required',
        ]);

        $contract->start_date=Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $contract->end_date=Carbon::createFromFormat('d/m/Y', $request->start_date)->addMonths(3)->format('Y-m-d');
        $contract->station_id=$request->station_id;
        $contract->save();

        return redirect()->route('contract.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }

    public function terminate($id)
    {
        $contract = Contract::find($id);
        $contract->status = 0;
        if ($contract->save()) {
            return redirect()->route('contract.index');
        } else {
            return back();
        }

    }
}
