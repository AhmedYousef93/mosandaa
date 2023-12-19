<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class OrderDataTable extends DataTable
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
            ->addColumn('service', function ($query) {
                return $query->service->title;
            })
            ->addColumn('subservice', function ($query) {
                return $query->subservice->title;
            })   
            ->addColumn('time', function ($query) {
                return $query->time->time;
            })
             ->addColumn('user', function ($query) {
                return $query->user->name;
            }) 
            ->addColumn('status', function ($query) {
                return match ($query->status?->value) {
                    1 => '<p>' . $query->status?->label() . '</p>',
                    2 => '<p>' . $query->status?->label() . '</p>',
                    3 => '<p>' . $query->status?->label() . '</p>',
                    4 => '<p>' . $query->status?->label() . '</p>',
                    5 => '<p>' . $query->status?->label() . '</p>',
                    default => '<p>' . $query->status?->label() . '</p>'
                };

            })
             ->addColumn('action', function ($query) {
                $btn = '<a href="' . route('ordersAdvice.show', $query->id) . '" class="btn btn-icon btn-icon rounded-circle btn-info show">
                <i data-feather="eye"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->query()->orderByDesc('id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
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
            Column::computed('service')->title(__('admin.service'))->searchable(true)->addClass('text-center'),
            Column::computed('subservice')->title(__('admin.subservice'))->searchable(true)->addClass('text-center'),
            Column::computed('user')->title(__('admin.user'))->searchable(true)->addClass('text-center'),
            Column::computed('date')->title(__('admin.date'))->searchable(true)->addClass('text-center'),
            Column::computed('time')->title(__('admin.time'))->searchable(true)->addClass('text-center'),
            Column::computed('status')->title(__('admin.status'))->searchable(true)->addClass('text-center'),
            Column::computed('action')->title(__('admin.action'))->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }


}
