<?php

namespace Theme\BigSoft\Http\Controllers;

use App\Http\Controllers\Controller;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Theme\Facades\Theme;
use Botble\Voucher\Models\Provider;
use Botble\Voucher\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
  public function index()
  {
    $providers = $this->getProviders();
    $hotVouchers = $this->getHotVouchers();
    $promoPosts = $this->getPromoPosts();

    return Theme::scope('home-page', compact('providers', 'hotVouchers', 'promoPosts'))->render();
  }

  protected function getProviders(): Collection
  {
    if (! class_exists(Provider::class)) {
      return collect();
    }

    return Provider::query()
      ->where('status', BaseStatusEnum::PUBLISHED)
      ->orderByDesc('created_at')
      ->get();
  }

  protected function getHotVouchers(): Collection
  {
    if (! class_exists(Voucher::class)) {
      return collect();
    }

    $today = Carbon::now()->startOfDay();

    return Voucher::query()
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
      ->take(18)
      ->get();
  }

  protected function getPromoPosts(int $limit = 8): Collection
  {
    if (! class_exists(\Botble\Blog\Models\Post::class)) {
      return collect();
    }

    return \Botble\Blog\Models\Post::query()
      ->wherePublished()
      ->with(['slugable', 'categories', 'author'])
      ->orderByDesc('created_at')
      ->limit($limit)
      ->get();
  }
}
