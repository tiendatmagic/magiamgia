<?php

namespace Botble\Tour\Tables;

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
use Botble\Tour\Models\TourCategory;
use Illuminate\Database\Eloquent\Builder;

class TourCategoryTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(TourCategory::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('tour-category.create'))
            ->addActions([
                EditAction::make()->route('tour-category.edit'),
                DeleteAction::make()->route('tour-category.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                NameColumn::make()->route('tour-category.edit'),
                CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('tour-category.destroy'),
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
