<?php

namespace Botble\Voucher\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Facades\MetaBox;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Slug\Models\Slug;
use Botble\Voucher\Http\Controllers\PublicController;
use Botble\Voucher\Models\Provider;
use Botble\Voucher\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use RvMedia;

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

    $today = Carbon::now()->startOfDay();

    $baseQuery = Voucher::query()
      ->where('status', BaseStatusEnum::PUBLISHED)
      ->where('provider_id', $provider->getKey())
      ->where(function ($query) use ($today) {
        $query
          ->whereNull('expired_at')
          ->orWhereDate('expired_at', '>=', $today);
      });

    $orderByExpiry = function ($query) {
      return $query
        ->orderByRaw('CASE WHEN expired_at IS NULL THEN 1 ELSE 0 END')
        ->orderBy('expired_at')
        ->orderByDesc('created_at');
    };

    $vouchers = $orderByExpiry(clone $baseQuery)
      ->take(18)
      ->get();

    $hotVouchers = $orderByExpiry(clone $baseQuery)
      ->where('is_hot', true)
      ->take(9)
      ->get();

    $categories = $provider->tags ?? [];
    if (! $categories) {
      $categories = (clone $baseQuery)
        ->whereNotNull('category')
        ->distinct()
        ->orderBy('category')
        ->pluck('category')
        ->all();
    }

    // Load metadata for SEO
    $provider->loadMissing('metadata');
    $seoMeta = $provider->getMetaData('seo_meta', true) ?? [];

    // Set SEO title and description with fallback logic
    $seoTitle = Arr::get($seoMeta, 'seo_title') ?: $provider->name;
    $seoDescription = Arr::get($seoMeta, 'seo_description') ?: $provider->description;

    SeoHelper::setTitle($seoTitle);
    if ($seoDescription) {
      SeoHelper::setDescription(strip_tags($seoDescription));
    }

    // Set noindex if specified
    if (Arr::get($seoMeta, 'index') === 'noindex') {
      SeoHelper::meta()->addMeta('robots', 'noindex, nofollow');
    }

    // Set OG image if cover image exists
    if ($provider->cover_image) {
      SeoHelper::openGraph()->setImage(RvMedia::getImageUrl($provider->cover_image));
    }

    // Pass data to controller for processing
    request()->merge(compact('vouchers', 'hotVouchers', 'categories'));

    $controller = app(PublicController::class);
    $response = $controller->showProvider($provider, request());

    return [
      'view' => 'voucher-provider',
      'default_view' => 'plugins/voucher::public.provider',
      'data' => $response->getData(),
      'slug' => $provider->slug,
    ];
  }
}
