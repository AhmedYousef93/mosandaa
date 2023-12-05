<?php

namespace App\DataTables;

use App\Models\Time;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;

class TimeTable extends DataTable
{

    protected $dayId;

    public function setDayId($dayId)
    {
        $this->dayId = $dayId;
        return $this;
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Time $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Time $model)
    {
        $query = $model->newQuery();
        if ($this->dayId) {
            $query->where('day_id', $this->dayId);
        }
        return $query;
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
            Column::computed('time')->title(__('admin.time'))->searchable(true)->addClass('text-center'),
        ];
    }


}
