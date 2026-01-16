<?php

namespace Botble\Voucher\Http\Controllers;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Voucher\Forms\VoucherForm;
use Botble\Voucher\Http\Requests\VoucherRequest;
use Botble\Voucher\Models\Provider;
use Botble\Voucher\Models\Voucher;
use Botble\Voucher\Tables\VoucherTable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoucherController extends BaseController
{
  public function __construct()
  {
    $this
      ->breadcrumb()
      ->add(trans('plugins/voucher::voucher.coupons'), route('voucher-coupon.index'));
  }

  public function index(VoucherTable $table)
  {
    $this->pageTitle(trans('plugins/voucher::voucher.coupons'));

    return $table->renderTable();
  }

  public function create()
  {
    $this->pageTitle(trans('plugins/voucher::voucher.coupon_create'));

    return VoucherForm::create()->renderForm();
  }

  public function store(VoucherRequest $request)
  {
    $form = VoucherForm::create()->setRequest($request);
    $form->save();

    return $this
      ->httpResponse()
      ->setPreviousUrl(route('voucher-coupon.index'))
      ->setNextUrl(route('voucher-coupon.edit', $form->getModel()->getKey()))
      ->setMessage(trans('core/base::notices.create_success_message'));
  }

  public function edit(Voucher $voucher)
  {
    $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $voucher->code ?: $voucher->getKey()]));

    return VoucherForm::createFromModel($voucher)->renderForm();
  }

  public function update(Voucher $voucher, VoucherRequest $request)
  {
    VoucherForm::createFromModel($voucher)
      ->setRequest($request)
      ->save();

    return $this
      ->httpResponse()
      ->setPreviousUrl(route('voucher-coupon.index'))
      ->setMessage(trans('core/base::notices.update_success_message'));
  }

  public function destroy(Voucher $voucher)
  {
    return DeleteResourceAction::make($voucher);
  }

  public function loadMore(Request $request)
  {
    $providerSlug = (string) $request->query('provider');
    $offset = max(0, (int) $request->query('offset', 0));
    $limit = max(1, (int) $request->query('limit', 9));
    $category = trim((string) $request->query('category', ''));

    $provider = Provider::query()
      ->whereHas('slugable', function ($query) use ($providerSlug) {
        $query->where('key', $providerSlug);
      })
      ->where('status', BaseStatusEnum::PUBLISHED)
      ->first();

    if (! $provider) {
      return $this->httpResponse()->setError()->setMessage(__('Provider not found'));
    }

    $today = Carbon::now()->startOfDay();

    $query = Voucher::query()
      ->where('status', BaseStatusEnum::PUBLISHED)
      ->where('provider_id', $provider->getKey())
      ->where(function ($builder) use ($today) {
        $builder
          ->whereNull('expired_at')
          ->orWhereDate('expired_at', '>=', $today);
      });

    if ($category !== '') {
      $query->where('category', $category);
    }

    $items = $query
      ->orderByRaw('CASE WHEN expired_at IS NULL THEN 1 ELSE 0 END')
      ->orderBy('expired_at')
      ->orderByDesc('created_at')
      ->skip($offset)
      ->take($limit)
      ->get();

    $html = view('plugins/voucher::public.partials.voucher-items', [
      'vouchers' => $items,
      'provider' => $provider,
    ])->render();

    return $this->httpResponse()->setData([
      'html' => $html,
      'count' => $items->count(),
      'nextOffset' => $offset + $items->count(),
    ]);
  }

  public function loadMoreHot(Request $request)
  {
    $providerSlug = (string) $request->query('provider');
    $offset = max(0, (int) $request->query('offset', 0));
    $limit = max(1, (int) $request->query('limit', 9));

    // If provider slug is provided, load HOT vouchers for that provider
    if ($providerSlug) {
      $provider = Provider::query()
        ->whereHas('slugable', function ($query) use ($providerSlug) {
          $query->where('key', $providerSlug);
        })
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->first();

      if (! $provider) {
        return $this->httpResponse()->setError()->setMessage(__('Provider not found'));
      }

      $today = Carbon::now()->startOfDay();

      $items = Voucher::query()
        ->where('status', BaseStatusEnum::PUBLISHED)
        ->where('provider_id', $provider->getKey())
        ->where('is_hot', true)
        ->where(function ($query) use ($today) {
          $query
            ->whereNull('expired_at')
            ->orWhereDate('expired_at', '>=', $today);
        })
        ->orderByRaw('CASE WHEN expired_at IS NULL THEN 1 ELSE 0 END')
        ->orderBy('expired_at')
        ->orderByDesc('created_at')
        ->skip($offset)
        ->take($limit)
        ->get();

      $html = view('plugins/voucher::public.partials.voucher-items', [
        'vouchers' => $items,
        'provider' => $provider,
      ])->render();

      return $this->httpResponse()->setData([
        'html' => $html,
        'count' => $items->count(),
        'nextOffset' => $offset + $items->count(),
      ]);
    }

    // Otherwise, load HOT vouchers for homepage (show_homepage_hot)
    $today = Carbon::now()->startOfDay();

    $items = Voucher::query()
      ->where('status', BaseStatusEnum::PUBLISHED)
      ->where('show_homepage_hot', true)
      ->where(function ($query) use ($today) {
        $query
          ->whereNull('expired_at')
          ->orWhereDate('expired_at', '>=', $today);
      })
      ->with('provider')
      ->orderByRaw('CASE WHEN expired_at IS NULL THEN 1 ELSE 0 END')
      ->orderBy('expired_at')
      ->orderByDesc('created_at')
      ->skip($offset)
      ->take($limit)
      ->get();

    $html = '';
    foreach ($items as $voucher) {
      $html .= view('plugins/voucher::public.partials.voucher-items', [
        'vouchers' => collect([$voucher]),
        'provider' => $voucher->provider,
      ])->render();
    }

    return $this->httpResponse()->setData([
      'html' => $html,
      'count' => $items->count(),
      'nextOffset' => $offset + $items->count(),
    ]);
  }
}
