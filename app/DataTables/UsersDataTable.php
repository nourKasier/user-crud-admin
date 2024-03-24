<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\HtmlString;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->setRowId('id')
            ->addColumn('custom_column', function ($user) {
                $editButton = '<button class="btn btn-primary btn-sm edit-button" data-id="' . $user->id . '">Edit</button>';
                $deleteButton = '<button class="btn btn-danger btn-sm delete-button" data-id="' . $user->id . '" data-token="' . csrf_token() . '">Delete</button>';
                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['custom_column'])
            ->editColumn('subscription_end_date', function ($user) {
                return $user->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('created_at', function ($user) {
                return $user->updated_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at->format('Y-m-d H:i:s');
            });
    }

    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'asc')
            ->selectStyleSingle()
            ->buttons([
                Button::make('add'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {

        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('subscription_end_date'),
            Column::make('email'),
            Column::make('phone_number'),
            Column::make('is_admin'),
            // Column::make('avatar'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('custom_column'),
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
