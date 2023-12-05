<?php

namespace App\DataTables;

use App\Models\Day;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class DaysDataTable extends DataTable
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
            ->addColumn('action', function($row){

                if (Auth::guard('admin')->user()->hasPermission('days-update')) {
                    $btn = '<button type="button" class="btn btn-icon btn-icon rounded-circle btn-gradient-success edit" data-toggle="modal"
                    data-target="#modal-edit-days" data-dayid="' . $row->id . '" data-time="' . $row->name . '"><i data-feather="edit"></i></button> &nbsp;';
                } else {
                    $btn = '<button  type="button" class="btn btn-icon btn-icon rounded-circle btn-gradient-success disabled"><i data-feather="edit"></i></button>';
                }
              return $btn;
            })
                ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Day $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Day $model)
    {
        return $model->query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('day-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title("#")->addClass('text-center')->orderable(false)->searchable(false),
            Column::computed('name')->title(__('admin.name'))->searchable(true)->addClass('text-center'),
            Column::computed('action')->title(__('admin.action'))->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }


}
