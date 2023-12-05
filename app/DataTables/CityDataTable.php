<?php

namespace App\DataTables;

use App\Models\City;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Auth;

class CityDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('title', function ($query) {
                return $query->title;
            })
            ->addColumn('action', function ($row) {

                if (Auth::guard('admin')->user()->hasPermission('cities-update')) {
                    $btn = '<button type="button" class="btn btn-icon btn-icon rounded-circle btn-gradient-success edit" data-toggle="modal"
                    data-target="#modal-edit-city" data-cityid="' . $row->id . '" data-title_ar="' . $row->title_ar . '" data-title_en="' . $row->title_en . '"><i data-feather="edit"></i></button> &nbsp;';
                } else {
                    $btn = '<button  type="button" class="btn btn-icon btn-icon rounded-circle btn-gradient-success disabled"><i data-feather="edit"></i></button>';
                }

                if (Auth::guard('admin')->user()->hasPermission('cities-delete')) {
                    $btn = $btn .
                        '<form class="delete"  action="' . route("cities.destroy", $row->id) . '"  method="POST" id="delform"
                    style="display: inline-block; right: 50px;" >
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="btn btn-icon btn-icon rounded-circle btn-danger" title=" ' . 'Delete' . ' "><i data-feather="trash-2"></i></button>
                        </form>';
                } else {
                    $btn = $btn . '<button class="btn btn-danger btn-xs disabled"><i data-feather="trash-2"></i></button>';
                }

                return $btn;
            })

            ->rawColumns(['action', 'title']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(City $model): QueryBuilder
    {
        return $model->query()->withoutGlobalScope(ActiveScope::class)->orderByDesc('id');
    }

    /**
     * Optional method if you want to use the html builder.
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
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title("#")->addClass('text-center')->orderable(false)->searchable(false),
            Column::computed('title')->title(__('admin.title'))->searchable(true)->addClass('text-center'),
            Column::computed('action')->title(__('admin.action'))->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'City_' . date('YmdHis');
    }
}
