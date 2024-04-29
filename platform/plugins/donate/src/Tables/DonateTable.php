<?php

namespace Botble\Donate\Tables;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Donate\Models\Donate;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\ActiveInactiveStatusColumn;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\DonationNameColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\PhoneColumn;
use Botble\Table\Columns\StatusColumn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;

class DonateTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Donate::class)
            ->addActions([
                EditAction::make()
                    ->route('donate.edit'),
                DeleteAction::make()
                    ->route('donate.destroy'),
            ]);
    }

    public function ajax(): JsonResponse
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function (Donate $item) {
                if (! $this->hasPermission('donate.edit')) {
                    return BaseHelper::clean($item->name);
                }
                return Html::link(route('donate.edit', $item->getKey()), BaseHelper::clean($item->name));
            });

        return $this->toJson($data);
    }

    public function query(): Relation|Builder|QueryBuilder
    {
        $query = $this
            ->getModel()
            ->query()
            ->select([
               'id',
               'name',
            //    'donation',
               'phone',
               'created_at',
               'status',
           ]);

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            NameColumn::make(),
            // DonationNameColumn::make(),
            PhoneColumn::make(),
            CreatedAtColumn::make(),
            // StatusColumn::make(),
            ActiveInactiveStatusColumn::make(),

        ];
    }

    public function buttons(): array
    {
        return $this->addCreateButton(route('donate.create'), 'donate.create');
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('donate.destroy'),
        ];
    }

    public function getBulkChanges(): array
    {
        return [
            'name' => [
                'title' => trans('core/base::tables.name'),
                'type' => 'text',
                'validate' => 'required|max:120',
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'type' => 'select',
                'choices' => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type' => 'date',
            ],
        ];
    }

    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }
}
