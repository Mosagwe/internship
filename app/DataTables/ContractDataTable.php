<?php

namespace App\DataTables;

use App\Models\Contract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ContractDataTable extends DataTable
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
            ->addColumn('employee.full_name',function ($emp){
                return $emp->full_name;
            })
            ->editColumn('status',function ($contract){
                return view('contracts.status',compact('contract'));
            })
            ->addColumn('action', 'contract.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contract $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contract $model)
    {
        return $model->newQuery()->with('employee')->with('station')->with('unit');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('contract-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print')
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

            Column::make('id')->visible(false),
            Column::make('employee.full_name')->title('Name'),
            Column::make('employee.gender')->title('Gender'),
            Column::make('employee.idno')->title('ID Number'),
            Column::make('employee_type'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('station.name')->title('Station'),
            Column::make('unit.name')->title('Unit'),
            Column::make('salary')->title('Renumeration'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'Contract_' . date('YmdHis');
    }
}
