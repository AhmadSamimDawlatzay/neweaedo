<?php

namespace Botble\Project\Tables;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Project\Models\Project;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\ImageColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\JsonResponse;

class ProjectTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Project::class)
            ->addActions([
                EditAction::make()
                    ->route('project.edit'),
                DeleteAction::make()
                    ->route('project.destroy'),
            ]);
    }

    public function ajax(): JsonResponse
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function (Project $item) {
                if (! $this->hasPermission('project.edit')) {
                    return BaseHelper::clean($item->name);
                }
                return Html::link(route('project.edit', $item->getKey()), BaseHelper::clean($item->name));
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
               'image',
               'name',
               'created_at',
               'status',
           ]);

        return $this->applyScopes($query);
    }

    public function columns(): array
    {
        return [
            IdColumn::make(),
            ImageColumn::make(),
            NameColumn::make(),
            // Column::make(),
            // DateTimeColumn::make(),
            CreatedAtColumn::make(),
            StatusColumn::make(),
        ];
    }

    public function buttons(): array
    {
        return $this->addCreateButton(route('project.create'), 'project.create');
    }

    public function bulkActions(): array
    {
        return [
            DeleteBulkAction::make()->permission('project.destroy'),
        ];
    }

    public function getBulkChanges(): array
    {
        return [
            'image' => [
                'title' => trans('core/base::tables.image'),
                'type' => 'image',
                'validate' => 'required|max:120',
            ],
            'name' => [
                'title' => trans('core/base::tables.name'),
                'type' => 'text',
                'validate' => 'required|max:120',
            ],
            // 'description' => [
            //     'title' => trans('core/base::tables.description'),
            //     'type' => 'text',
            //     'validate' => 'required|max:120',
            // ],
            // 'date' => [
            //     'title' => trans('core/base::tables.date'),
            //     'type' => 'date',
            // ],

            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type' => 'date',
            ],

            'status' => [
                'title' => trans('core/base::tables.status'),
                'type' => 'select',
                'choices' => BaseStatusEnum::labels(),
                'validate' => 'required|in:' . implode(',', BaseStatusEnum::values()),
            ],

        ];
    }

    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }
}
