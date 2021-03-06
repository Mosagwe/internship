<?php

namespace App\DataTables;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Builder;
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
            })->addColumn('employeetype',function ($q){
                return $q->employee->employeeType->name;
            })->addColumn('salary',function ($q){
                return $q->employee->category->salary;
            })->addColumn('category',function ($q){
                return $q->employee->category->name;
            })
            ->addColumn('action', function ($contract){
                return view('contracts.action',compact('contract'));
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
        return $model->newQuery()->with('employee')->with('station')->with('unit')
            ->whereHas('employee',function (Builder $query){
                $query->where('deleted_at','=',null);
            });
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
            Column::make('employee.firstname')->title('First Name')->visible(false),
            Column::make('employee.lastname')->title('Last Name')->visible(false),
            Column::make('employee.gender')->title('Gender'),
            Column::make('employee.idno')->title('ID Number'),
            Column::computed('employeetype'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('station.name')->name('station.name')->title('Station'),
            Column::computed('category'),
            Column::computed('salary')->title('Renumeration')->visible(true),
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
        return 'Contract_' . date('YmdHis');
    }
}
