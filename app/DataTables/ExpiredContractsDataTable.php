<?php

namespace App\DataTables;

use App\Models\Contract;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpiredContractsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('station_id',function ($q){
                if ($q->station){
                    return $q->station->name;
                }
            })->editColumn('status',function ($contract){
                return view('contracts.status',compact('contract'));
            })->editColumn('end_date',function ($contract){
                return Carbon::parse($contract->end_date)->diffForHumans();
            })
            ->addColumn('action', function ($contract){
                return view('contracts.expiredaction',compact('contract'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contract $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contract $model)
    {
        $c=Contract::where('status',1)->pluck('employee_id')->toArray();

        return $model->newQuery()->with('employee')
            ->whereNotIn('employee_id',$c)
            ->where('status',0);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('expiredcontracts-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('print'),
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('employee.firstname')->name('employee.firstname')->visible(false),
            Column::make('employee.full_name')->name('employee.full_name'),
            Column::make('end_date'),
            Column::make('station_id'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(90)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ExpiredContracts_' . date('YmdHis');
    }
}
