<?php

namespace App\DataTables;

use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeesDataTable extends DataTable
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
            ->addIndexColumn()
            ->editColumn('created_at',function ($query){
                return $query->created_at->format('d M Y');
            })
            ->editColumn('is_active',function ($employee){
                return view('employees.status',compact('employee'));
           })->addColumn('renumeration',function ($query){
               return $query->category->salary;
            })->editColumn('category_id',function ($query){
                if (isset($query->category->parent)){
                   return $query->category->parent->name;
                }else{
                    return $query->category->name;
                }
            })->addColumn('subcategory',function ($query){
                if (isset($query->category->parent)){
                    return $query->category->name;
                }
            })
            ->addColumn('action', function ($employee){
                return view('employees.action',compact('employee'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
        return $model->newQuery()->with('employeeType')->with('category')


          ;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('employees-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
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
            Column::computed('DT_RowIndex')->title('SN'),
            Column::make('id')->visible(false),
            Column::make('full_name'),
            Column::make('firstname')->visible(false),
            Column::make('lastname')->visible(false),
            Column::make('gender'),
            Column::make('idno'),
            Column::make('phonenumber'),
            Column::make('employee_type.name')->title('Emp Type'),
            Column::make('category_id')->title('Category'),
            Column::computed('subcategory'),
            Column::computed('renumeration'),
            Column::make('created_at'),
            Column::make('is_active')->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
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
        return 'Employees_' . date('YmdHis');
    }
}
