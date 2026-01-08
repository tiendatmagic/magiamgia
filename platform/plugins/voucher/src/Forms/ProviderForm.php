<?php

namespace Botble\Voucher\Forms;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FormAbstract;
use Botble\Voucher\Http\Requests\ProviderRequest;
use Botble\Voucher\Models\Provider;

class ProviderForm extends FormAbstract
{
  public function setup(): void
  {
    Assets::addScriptsDirectly([
      'vendor/core/plugins/voucher/js/provider-admin.js',
    ]);

    $this
      ->model(Provider::class)
      ->setValidatorClass(ProviderRequest::class)
      ->add('name', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.name'),
        'required' => true,
      ])
      ->add('slug', TextField::class, [
        'label' => 'Đường dẫn tĩnh',
        'required' => true,
        'value' => $this->getModel()?->slug ?: '',
        'help_block' => [
          'text' => (function () {
            $value = $this->getModel()?->slug ?: '';
            if (! $value) {
              return '';
            }
            $preview = url('/' . ltrim($value, '/'));
            return 'Xem trước: <a href="' . e($preview) . '" target="_blank">' . e($preview) . '</a>';
          })(),
        ],
      ])
      ->add('logo', MediaImageField::class, [
        'label' => trans('plugins/voucher::voucher.fields.logo'),
      ])
      ->add('description', TextareaField::class, [
        'label' => trans('plugins/voucher::voucher.fields.description'),
        'attr' => [
          'rows' => 3,
        ],
      ])
      ->add('provider_buttons_hr', HtmlField::class, [
        'html' => '<hr class="my-4">',
        'wrapper' => false,
      ])
      ->add('button_1_text', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.button_1_text'),
      ])
      ->add('button_1_url', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.button_1_url'),
      ])
      ->add('button_2_text', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.button_2_text'),
      ])
      ->add('button_2_url', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.button_2_url'),
      ])
      ->add('tags', TextField::class, [
        'label' => trans('plugins/voucher::voucher.fields.tags'),
        'help_block' => [
          'text' => trans('plugins/voucher::voucher.helpers.tags'),
        ],
        'value' => $this->normalizeTagsToString($this->getModel()?->tags),
      ])
      ->add('accordions', HtmlField::class, [
        'label' => trans('plugins/voucher::voucher.fields.accordions'),
        'html' => view('plugins/voucher::admin.partials.accordion-field', [
          'value' => $this->getModel()?->accordions,
        ])->render(),
      ])
      ->add('status', SelectField::class, StatusFieldOption::make()->toArray())
      ->setBreakFieldPoint('status');
  }

  protected function normalizeTagsToString(mixed $tags): string
  {
    if (is_string($tags)) {
      return $tags;
    }

    if (! is_array($tags)) {
      return '';
    }

    $tags = array_values(array_filter(array_map('strval', $tags)));

    return implode(', ', $tags);
  }
}
