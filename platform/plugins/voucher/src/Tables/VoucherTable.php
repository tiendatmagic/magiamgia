<?php

namespace Botble\Voucher\Tables;

use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\LinkableColumn;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Botble\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Builder;

class VoucherTable extends TableAbstract
{
  public function setup(): void
  {
    $this
      ->model(Voucher::class)
      ->addHeaderAction(CreateHeaderAction::make()->route('voucher-coupon.create'))
      ->addColumns([
        Column::make('id')->title('ID')->width(20),
        LinkableColumn::make('code')
          ->title(trans('plugins/voucher::voucher.fields.code'))
          ->route('voucher-coupon.edit'),
        Column::make('discount_type')
          ->title(trans('plugins/voucher::voucher.fields.discount_type'))
          ->width(120)
          ->formatStateUsing(function ($state) {
            return trans('plugins/voucher::voucher.discount.' . $state);
          }),
        Column::make('discount_value')->title(trans('plugins/voucher::voucher.fields.discount_value'))->width(120),
        StatusColumn::make(),
        CreatedAtColumn::make(),
      ])
      ->addActions([
        EditAction::make()->route('voucher-coupon.edit'),
        DeleteAction::make()->route('voucher-coupon.destroy'),
      ])
      ->queryUsing(function (Builder $query) {
        return $query->select(['id', 'code', 'discount_type', 'discount_value', 'status', 'created_at']);
      });
  }
}
