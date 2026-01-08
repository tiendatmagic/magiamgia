<?php

namespace Botble\Voucher\Forms;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\DatePickerFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\DatePickerField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Voucher\Http\Requests\VoucherRequest;
use Botble\Voucher\Models\Provider;
use Botble\Voucher\Models\Voucher;

class VoucherForm extends FormAbstract
{
  public function setup(): void
  {
    Assets::addScriptsDirectly([
      'vendor/core/plugins/voucher/js/voucher-admin.js',
    ]);

    $providers = Provider::query()
      ->select(['id', 'name'])
      ->orderBy('name')
      ->pluck('name', 'id')
      ->all();

    $this
      ->model(Voucher::class)
      ->setValidatorClass(VoucherRequest::class)
      ->add('provider_id', SelectField::class, SelectFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.provider'))
        ->choices(['' => trans('plugins/voucher::voucher.helpers.select_provider')] + $providers)
        ->required()
        ->toArray())
      ->add('category', SelectField::class, SelectFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.category'))
        ->choices(['' => trans('plugins/voucher::voucher.helpers.select_category')])
        ->selected($this->getModel()?->category)
        ->addAttribute('data-saved-value', $this->getModel()?->category ?: '')
        ->required()
        ->toArray())
      ->add('code', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.code'),
      ])
      ->add('discount_type', SelectField::class, SelectFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.discount_type'))
        ->choices([
          'percent' => trans('plugins/voucher::voucher.discount.percent'),
          'amount' => trans('plugins/voucher::voucher.discount.amount'),
        ])
        ->required()
        ->toArray())
      ->add('discount_value', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.discount_value'),
        'required' => true,
        'attributes' => [
          'type' => 'number',
          'step' => '0.01',
          'min' => '0',
        ],
      ])
      ->add('max_discount', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.max_discount'),
        'attributes' => [
          'type' => 'number',
          'step' => '0.01',
          'min' => '0',
        ],
      ])
      ->add('min_order', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.min_order'),
        'attributes' => [
          'type' => 'number',
          'step' => '0.01',
          'min' => '0',
        ],
      ])
      ->add('note', TextareaField::class, [
        'label' => trans('plugins/voucher::voucher.fields.note'),
        'attr' => [
          'rows' => 3,
        ],
      ])
      ->add('apply_url', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.apply_url'),
      ])
      ->add('banner_url', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.banner_url'),
      ])
      ->add('expired_at', DatePickerField::class, DatePickerFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.expired_at'))
        ->defaultValue('')
        ->required()
        ->toArray())
      ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
      ->setBreakFieldPoint('status');
  }
}
