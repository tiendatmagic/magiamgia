<?php

namespace Botble\Service\Tables;

use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Botble\Service\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Builder;

class ServiceCategoryTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(ServiceCategory::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('service-category.create'))
            ->addActions([
                EditAction::make()->route('service-category.edit'),
                DeleteAction::make()->route('service-category.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                NameColumn::make()->route('service-category.edit'),
                CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('service-category.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                    'id',
                    'name',
                    'slug',
                    'description',
                    'status',
                    'created_at',
                ]);
            });
    }
}
