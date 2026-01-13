<?php

namespace Botble\Voucher\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Voucher\Models\Provider;
use Illuminate\Http\Request;

class PublicController extends BaseController
{
  /**
   * Show provider detail page
   */
  public function showProvider(Provider $provider, Request $request)
  {
    $vouchers = $request->get('vouchers', collect());
    $hotVouchers = $request->get('hotVouchers', collect());
    $categories = $request->get('categories', []);

    // Process accordion data
    $providerAccordionsHeader = is_array($provider->accordions_header) ? $provider->accordions_header : [];
    $providerAccordionsFooter = is_array($provider->accordions_footer) ? $provider->accordions_footer : [];

    // Calculate initial count
    $initialCount = $vouchers instanceof \Illuminate\Support\Collection
      ? $vouchers->count()
      : (is_array($vouchers) ? count($vouchers) : 0);

    // Get interest posts (blog posts)
    $interestPosts = $this->getInterestPosts();

    // Get grid configuration from theme options
    $gridConfig = $this->getGridConfiguration();

    return view('plugins/voucher::public.provider', array_merge(
      compact(
        'provider',
        'vouchers',
        'hotVouchers',
        'categories',
        'providerAccordionsHeader',
        'providerAccordionsFooter',
        'initialCount',
        'interestPosts'
      ),
      $gridConfig
    ));
  }

  /**
   * Get interest posts (blog posts related to provider)
   */
  protected function getInterestPosts(int $limit = 8)
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

  /**
   * Get grid configuration from theme options
   */
  protected function getGridConfiguration(): array
  {
    $cols = max(1, min(6, (int) theme_option('blog_grid_cols', 2)));
    $colsSm = max(1, min(6, (int) theme_option('blog_grid_cols_sm', 2)));
    $colsMd = max(1, min(6, (int) theme_option('blog_grid_cols_md', 3)));
    $colsLg = max(1, min(6, (int) theme_option('blog_grid_cols_lg', 4)));
    $colsXl = max(1, min(6, (int) theme_option('blog_grid_cols_xl', 4)));

    $gridClass = sprintf(
      'tw-grid tw-grid-cols-%d sm:tw-grid-cols-%d md:tw-grid-cols-%d lg:tw-grid-cols-3 xl:tw-grid-cols-4 tw-gap-6 grid-interest-posts',
      $cols,
      $colsSm,
      $colsMd,
      $colsLg,
      $colsXl
    );

    return [
      'gridClass' => $gridClass,
      'gridCols' => $cols,
      'gridColsSm' => $colsSm,
      'gridColsMd' => $colsMd,
      'gridColsLg' => $colsLg,
      'gridColsXl' => $colsXl,
    ];
  }
}
