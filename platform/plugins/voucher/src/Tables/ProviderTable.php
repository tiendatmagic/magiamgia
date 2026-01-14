<?php

namespace Botble\Voucher\Tables;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\LinkableColumn;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Botble\Voucher\Models\Provider;
use Illuminate\Database\Eloquent\Builder;

class ProviderTable extends TableAbstract
{
  public function setup(): void
  {
    $this
      ->model(Provider::class)
      ->addHeaderAction(CreateHeaderAction::make()->route('voucher-provider.create'))
      ->addColumns([
        Column::make('id')->title('ID')->width(20),
        LinkableColumn::make('name')
          ->title(trans('plugins/voucher::voucher.fields.name'))
          ->width(200)
          ->route('voucher-provider.edit'),
        StatusColumn::make(),
        CreatedAtColumn::make(),
      ])
      ->addActions([
        EditAction::make()->route('voucher-provider.edit'),
        DeleteAction::make()->route('voucher-provider.destroy'),
      ])
      ->addBulkActions([
        DeleteBulkAction::make()->permission('voucher-provider.destroy'),
      ])
      ->queryUsing(function (Builder $query) {
        return $query->select(['id', 'name', 'status', 'created_at']);
      });
  }
}
