<?php

namespace Botble\Voucher\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Slug\Models\Slug;
use Botble\Theme\Facades\Theme;
use Botble\Voucher\Models\Provider;
use Botble\Voucher\Models\Voucher;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class VoucherService
{
  public function handleFrontRoutes(Slug|array $slug): Slug|array
  {
    if (! $slug instanceof Slug) {
      return $slug;
    }

    if ($slug->reference_type !== Provider::class) {
      return $slug;
    }

    // Reject URLs with .html suffix for providers
    $requestPath = request()->path();
    if (str_ends_with($requestPath, '.html')) {
      return $slug; // Return as-is to trigger 404
    }

    $condition = [
      'id' => $slug->reference_id,
      'status' => BaseStatusEnum::PUBLISHED,
    ];

    if (Auth::guard()->check() && request()->input('preview')) {
      Arr::forget($condition, 'status');
    }

    $provider = Provider::query()
      ->where($condition)
      ->with(['slugable'])
      ->firstOrFail();

    $vouchers = Voucher::query()
      ->where('status', BaseStatusEnum::PUBLISHED)
      ->where('provider_id', $provider->getKey())
      ->orderByDesc('created_at')
      ->take(18)
      ->get();

    SeoHelper::setTitle($provider->name);

    return [
      'view' => 'voucher-provider',
      'default_view' => 'plugins/voucher::public.provider',
      'data' => compact('provider', 'vouchers'),
      'slug' => $provider->slug,
    ];
  }
}
