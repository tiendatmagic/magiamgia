<?php

namespace Botble\Voucher\Http\Controllers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Voucher\Forms\ProviderForm;
use Botble\Voucher\Http\Requests\ProviderRequest;
use Botble\Voucher\Models\Provider;
use Botble\Voucher\Tables\ProviderTable;
use Illuminate\Http\Request;

class ProviderController extends BaseController
{
  public function __construct()
  {
    $this
      ->breadcrumb()
      ->add(trans('plugins/voucher::voucher.providers'), route('voucher-provider.index'));
  }

  public function index(ProviderTable $table)
  {
    $this->pageTitle(trans('plugins/voucher::voucher.providers'));

    return $table->renderTable();
  }

  public function create()
  {
    $this->pageTitle(trans('plugins/voucher::voucher.provider_create'));

    return ProviderForm::create()->renderForm();
  }

  public function store(ProviderRequest $request)
  {
    $form = ProviderForm::create()->setRequest($request);
    $form->save();

    // Sync slug from custom link field
    $provider = $form->getModel();
    $desired = (string) $request->input('slug');
    \Botble\Slug\Facades\SlugHelper::createSlug($provider, $desired ?: $provider->name);

    return $this
      ->httpResponse()
      ->setPreviousUrl(route('voucher-provider.index'))
      ->setNextUrl(route('voucher-provider.edit', $form->getModel()->getKey()))
      ->setMessage(trans('core/base::notices.create_success_message'));
  }

  public function edit(Provider $provider)
  {
    $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $provider->name]));

    return ProviderForm::createFromModel($provider)->renderForm();
  }

  public function update(Provider $provider, ProviderRequest $request)
  {
    ProviderForm::createFromModel($provider)
      ->setRequest($request)
      ->save();

    // Sync slug from custom link field
    $desired = (string) $request->input('slug');
    \Botble\Slug\Facades\SlugHelper::createSlug($provider, $desired ?: $provider->name);

    return $this
      ->httpResponse()
      ->setPreviousUrl(route('voucher-provider.index'))
      ->setMessage(trans('core/base::notices.update_success_message'));
  }

  public function destroy(Provider $provider)
  {
    return DeleteResourceAction::make($provider);
  }

  public function categories(Provider $provider, Request $request)
  {
    abort_unless($request->expectsJson(), 404);

    $tags = $provider->tags;
    if (! is_array($tags)) {
      $tags = [];
    }

    $tags = array_values(array_filter(array_map('strval', $tags)));

    return $this
      ->httpResponse()
      ->setData(['categories' => $tags]);
  }
}
