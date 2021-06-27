<?php

namespace Modules\User\Tables;

use Modules\User\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserTable extends DataTable
{
    protected $table_id = 'users-table';
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->with('roles'))
            ->addColumn('action', function ($item) {
                $actions = [];
                $table_id = $this->table_id;
                if (user_check_permission('user.admin.edit')) {
                    $actions['edit'] = [
                        'status' => true,
                        'link' => route('user.admin.edit', $item->id)
                    ];
                }
                if (user_check_permission('user.admin.delete')) {
                    $actions['delete'] = [
                        'status' => true,
                        'link' => route('user.admin.delete', $item->id)
                    ];
                }
                return view('core::table.action', compact('actions', 'table_id'))->render();
            })
            ->addColumn('role', function (User $user) {
                if ($user->roles->count()) {
                    return $user->roles->map(function ($role) {
                        return '<strong>' . $role->title . '</strong>';
                    })->implode(',');
                }
                return '<em class="text-warning">Chưa phân quyền</em>';
            })
            ->editColumn('status', function ($item) {
                return $item->status ? '<span class="badge bg-success">Hoạt động</span>' : '<span class="badge bg-danger">Tạm khóa</span>';
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId($this->table_id)
            ->columns($this->getColumns())
            ->ajax()
            ->autoWidth(false)
            ->dom("fBrt<'datatables__info_wrap text-center'pli<'clearfix'>>")
            ->languageInfo('Đang xem <strong>_START_</strong> đến <strong>_END_</strong> trong tổng số <strong>_TOTAL_</strong> mục')
            ->orderBy(0)
            ->buttons($this->getButtons());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->title('#')
                ->width(60)
                ->addClass('text-center'),
            Column::make('display_name')->title('Tên hiển thị'),
            Column::make('email')->title('Email'),
            Column::make('role', 'roles.title')->title('Vai trò'),
            Column::make('status')->title('Trạng thái'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->title('Thao tác'),
        ];
    }

    /**
     * Get buttons.
     *
     * @return array
     */
    protected function getButtons()
    {
        $buttons = [];
        if (user_check_permission('user.admin.add')) {
            array_unshift(
                $buttons,
                Button::make('create')->text('<i class="fas fa-plus"></i> Thêm tài khoản mới')->addClass('btn-success')
            );
        }
        return $buttons;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}