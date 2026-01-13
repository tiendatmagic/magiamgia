<?php

namespace Botble\Voucher\Forms;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\DatePickerFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\CheckboxField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\DatePickerField;
use Botble\Base\Forms\Fields\MediaImageField;
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
      ->add('provider_category_row_open', HtmlField::class, [
        'html' => '<div class="row">',
        'wrapper' => false,
      ])
      ->add('provider_id', SelectField::class, SelectFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.provider'))
        ->choices(['' => trans('plugins/voucher::voucher.helpers.select_provider')] + $providers)
        ->required()
        ->wrapperAttributes([
          'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
        ])
        ->toArray())
      ->add('category', SelectField::class, SelectFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.category'))
        ->choices(['' => trans('plugins/voucher::voucher.helpers.select_category')])
        ->selected($this->getModel()?->category)
        ->addAttribute('data-saved-value', $this->getModel()?->category ?: '')
        ->required()
        ->wrapperAttributes([
          'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
        ])
        ->toArray())
      ->add('provider_category_row_close', HtmlField::class, [
        'html' => '</div>',
        'wrapper' => false,
      ])
      ->add('code_discount_row_open', HtmlField::class, [
        'html' => '<div class="row">',
        'wrapper' => false,
      ])
      ->add('code', TextField::class, TextFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.code'))
        ->required()
        ->wrapperAttributes([
          'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6 col-xl-4',
        ])
        ->toArray())
      ->add('discount_type', SelectField::class, SelectFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.discount_type'))
        ->choices([
          'percent' => trans('plugins/voucher::voucher.discount.percent'),
          'amount' => trans('plugins/voucher::voucher.discount.amount'),
        ])
        ->required()
        ->wrapperAttributes([
          'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6 col-xl-4',
        ])
        ->toArray())
      ->add('discount_value', TextField::class, TextFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.discount_value'))
        ->required()
        ->addAttribute('type', 'number')
        ->addAttribute('step', '0.01')
        ->addAttribute('min', '0')
        ->maxLength(0)
        ->wrapperAttributes([
          'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6 col-xl-4',
        ])
        ->toArray())
      ->add('code_discount_row_close', HtmlField::class, [
        'html' => '</div>',
        'wrapper' => false,
      ])
      ->add('discount_row_open', HtmlField::class, [
        'html' => '<div class="row">',
        'wrapper' => false,
      ])
      ->add('max_discount', TextField::class, TextFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.max_discount'))
        ->addAttribute('type', 'number')
        ->addAttribute('step', '0.01')
        ->addAttribute('min', '0')
        ->maxLength(0)
        ->wrapperAttributes([
          'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
        ])
        ->toArray())
      ->add('min_order', TextField::class, TextFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.min_order'))
        ->addAttribute('type', 'number')
        ->addAttribute('step', '0.01')
        ->addAttribute('min', '0')
        ->maxLength(0)
        ->wrapperAttributes([
          'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ' col-md-6',
        ])
        ->toArray())
      ->add('discount_row_close', HtmlField::class, [
        'html' => '</div>',
        'wrapper' => false,
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
      ->add('is_hot', CheckboxField::class, [
        'label' => trans('plugins/voucher::voucher.fields.is_hot'),
        'help_block' => [
          'text' => trans('plugins/voucher::voucher.fields.is_hot_help'),
        ],
        'attr' => [
          'value' => 1,
          'data-off-value' => 0,
        ],
      ])
      ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
      ->add('expired_at', DatePickerField::class, DatePickerFieldOption::make()
        ->label(trans('plugins/voucher::voucher.fields.expired_at'))
        ->defaultValue('')
        ->required()
        ->toArray())
      ->add('coupon_image', MediaImageField::class, [
        'label' => trans('plugins/voucher::voucher.fields.coupon_image'),
      ])
      ->setBreakFieldPoint('status');
  }
}
