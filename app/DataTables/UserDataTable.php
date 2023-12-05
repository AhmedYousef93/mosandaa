<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class UserDataTable extends DataTable
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
            ->addColumn('action', function ($query) {
                $btn = '<a href="' . route('users.show', $query->id) . '" class="btn btn-icon btn-icon rounded-circle btn-info show">
                <i data-feather="eye"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->query()->where('verified', 1)->orderByDesc('id');
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
            Column::computed('name')->title(__('admin.name'))->searchable(true)->addClass('text-center'),
            Column::computed('email')->title(__('admin.email'))->searchable(true)->addClass('text-center'),
            Column::computed('phone')->title(__('admin.phone'))->searchable(true)->addClass('text-center'),
            Column::computed('code')->title(__('admin.code'))->searchable(true)->addClass('text-center'),
            Column::computed('action')->title(__('admin.action'))->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }


}
