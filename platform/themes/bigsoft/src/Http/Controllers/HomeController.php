<?php

namespace Theme\BigSoft\Http\Controllers;

use App\Http\Controllers\Controller;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Theme\Facades\Theme;
use Botble\Voucher\Models\Provider;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
  public function index()
  {
    $providers = $this->getProviders();

    return Theme::scope('home-page', compact('providers'))->render();
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
}
