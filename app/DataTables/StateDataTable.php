<?php

namespace App\DataTables;

use App\Models\state;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class StateDataTable extends DataTable
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
        ->addColumn('title', function ($query) {
            return $query->title;
        })
        ->addColumn('action', function ($row) {

            if (Auth::guard('admin')->user()->hasPermission('states-update')){
                $btn ='<button type="button" class="btn btn-icon btn-icon rounded-circle btn-gradient-success edit" data-toggle="modal"
                data-target="#modal-edit-state" data-stateid="'.$row->id.'" data-title_ar="'.$row->title_ar.'" data-title_en="'.$row->title_en.'"><i data-feather="edit"></i></button> &nbsp;';
               }else{
                $btn = '<button  type="button" class="btn btn-icon btn-icon rounded-circle btn-gradient-success disabled"><i data-feather="edit"></i></button>';
               }

            if (Auth::guard('admin')->user()->hasPermission('states-delete')){
                $btn = $btn.
                '<form class="delete"  action="' . route("states.destroy", $row->id) . '"  method="POST" id="delform"
                style="display: inline-block; right: 50px;" >
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger" title=" ' . 'Delete' . ' "><i data-feather="trash-2"></i></button>
                    </form>';
            }else{
                $btn = $btn. '<button class="btn btn-danger btn-xs disabled"><i data-feather="trash-2"></i></button>';
            }

            return $btn;
        })
        ->rawColumns(['action', 'active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\City $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(State $model)
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
            ->setTableId('city-table')
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
            Column::computed('title')->title(__('admin.title'))->searchable(true)->addClass('text-center'),
            Column::computed('action')->title(__('admin.action'))->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }

}
