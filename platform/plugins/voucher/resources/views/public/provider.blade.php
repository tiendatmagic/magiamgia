@php
	/** @var \Botble\Voucher\Models\Provider $provider */
	$hotVouchers = $hotVouchers ?? collect();
	$categories = $categories ?? [];
	$categories = array_values(array_filter(array_unique(array_map('strval', $categories))));
	$initialCount = $initialCount ?? 0;
	$providerAccordionsHeader = $providerAccordionsHeader ?? [];
	$providerAccordionsFooter = $providerAccordionsFooter ?? [];

	Theme::layout('no-sidebar');
@endphp

<div class="container">
	<div class="tw-bg-white tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-lg tw-p-5">
		<div class="tw-flex tw-flex-col sm:tw-flex-row tw-items-center">
			<div class="sm:tw-w-1/4 lg:tw-w-1/5 tw-w-full tw-flex tw-justify-center tw-mb-4 sm:tw-mb-0">
				@if($provider->logo)
					<img src="{{ RvMedia::getImageUrl($provider->logo) }}" alt="{{ $provider->name }}" class="tw-w-32 tw-h-32 tw-object-contain tw-rounded-lg tw-border tw-border-gray-100" />
				@endif
			</div>

			<div class="sm:tw-w-3/4 lg:tw-w-4/5 tw-w-full">
				<h1 class="tw-text-center sm:tw-text-left tw-text-[var(--primary-color)] tw-font-bold tw-text-2xl" style="--primary-color: rgb(249, 126, 43); --breadcrumb-base: rgb(249, 126, 43);">
					{{ $provider->name }}
				</h1>
				@if($provider->description)
					<div class="tw-text-base tw-mt-3">
						{!! clean($provider->description) !!}
					</div>
				@endif

			</div>
		</div>
	</div>

	<div class="tw-flex tw-justify-evenly tw-flex-wrap tw-gap-3 tw-my-10">
			@if($provider->button_1_text && $provider->button_1_url)
			<a href="{{ $provider->button_1_url }}" target="_blank"
				class="tw-bg-[#cc2c62] tw-text-white tw-px-6 tw-py-3 tw-rounded-md tw-text-base tw-font-medium tw-shadow-md">
				{{ $provider->button_1_text }}
				<i class="fa fa-mouse-pointer"></i>
			</a>
			@endif

			@if($provider->button_2_text && $provider->button_2_url)
			<a href="{{ $provider->button_2_url }}" target="_blank"
				class="tw-bg-[#2c92cc] tw-text-white tw-px-6 tw-py-3 tw-rounded-md tw-text-base tw-font-medium tw-shadow-md">
						{{ $provider->button_2_text }}
				<i class="fa fa-mouse-pointer"></i>
			</a>
			@endif
	</div>

	@if(! empty($providerAccordionsHeader))
		<div class="tw-mt-6">
			<div class="accordion" id="accordionHeader">
				@foreach($providerAccordionsHeader as $i => $item)
					@php
						$title = $item['title'] ?? '';
						$content = $item['content'] ?? '';
						$collapseId = 'collapseHeader' . ($i + 1);
					@endphp
					@if($title || $content)
						<div class="accordion-item">
							<h2 class="accordion-header">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="false" aria-controls="{{ $collapseId }}">
									{{ $title }}
								</button>
							</h2>
							<div id="{{ $collapseId }}" class="accordion-collapse collapse" data-bs-parent="#accordionHeader">
								<div class="accordion-body">{!! clean($content) !!}</div>
							</div>
						</div>
					@endif
				@endforeach
			</div>
		</div>
	@endif

	<div class="tw-my-10">
		<div class="tw-border-t tw-border-gray-500 tw-w-1/2 tw-mx-auto"></div>
	</div>
</div>

<div class="tw-bg-gray-50 tw-mt-10 tw-p-5">
	<div class="container">

	@if($hotVouchers->isNotEmpty())
		<div class="">
			<div>
				<h4 class="tw-text-xl tw-pb-[8px] tw-font-semibold tw-text-[#464646]">{{ __('plugins/voucher::voucher.public.hot_voucher') }}</h4>
			</div>

			<div class="tw-mx-auto tw-w-full">
				<div id="hot-voucher-list" class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-3" data-offset="{{ $hotVouchers->count() }}">
					@include('plugins/voucher::public.partials.voucher-items', ['vouchers' => $hotVouchers, 'provider' => $provider])
				</div>

				<div class="">
					<div id="loadMoreHot" class="see-more tw-rounded-2xl tw-flex tw-flex-col tw-items-center tw-justify-center tw-cursor-pointer tw-text-center tw-mt-4" style="{{ $hotVouchers->count() < 9 ? 'display:none;' : '' }}">
						<svg class="arrows" width="60" height="72" viewBox="0 0 60 72" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0 L30 32 L60 0" class="a1" stroke="currentColor" stroke-width="2" fill="none"></path>
							<path d="M0 20 L30 52 L60 20" class="a2" stroke="currentColor" stroke-width="2" fill="none"></path>
							<path d="M0 40 L30 72 L60 40" class="a3" stroke="currentColor" stroke-width="2" fill="none"></path>
						</svg>
						<p class="tw-text-[14px] tw-leading-[21px] js-loadmore-label">{{ __('plugins/voucher::voucher.public.load_more_voucher') }}</p>
						<div class="tw-flex tw-items-center tw-gap-2 js-loadmore-loading" style="display:none;">
							<div>
								<svg class="tw-animate-spin tw-h-5 tw-w-5 tw-text-[#f97e2b]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
									<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
									<path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
								</svg>
								<span class="tw-text-[14px] tw-leading-[21px]">{{ __('plugins/voucher::voucher.public.loading') }}
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

	</div>
</div>

<div class="tw-bg-gray-50 tw-mb-10 tw-p-5">
	<div class="container">
		<div class="">
			<div>
				<h4 class="tw-text-xl tw-pb-[8px] tw-font-semibold tw-text-[#464646]">{{ __('plugins/voucher::voucher.public.categories') }}</h4>
			</div>
			<div class="tw-mx-auto tw-w-full">
				<div class="tw-relative tw-mb-4">
					<button id="categoryPrevBtn" class="tw-absolute tw-left-0 tw-top-1/2 -tw-translate-y-1/2 tw-z-10 tw-bg-white tw-border-2 tw-border-gray-200 tw-rounded-full tw-w-8 tw-h-8 tw-flex tw-items-center tw-justify-center tw-shadow-md hover:tw-bg-gray-50 tw-transition-colors" style="margin-left: -16px;">
						<svg class="tw-w-5 tw-h-5 tw-text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
						</svg>
					</button>
					<button id="categoryNextBtn" class="tw-absolute tw-right-0 tw-top-1/2 -tw-translate-y-1/2 tw-z-10 tw-bg-white tw-border-2 tw-border-gray-200 tw-rounded-full tw-w-8 tw-h-8 tw-flex tw-items-center tw-justify-center tw-shadow-md hover:tw-bg-gray-50 tw-transition-colors" style="margin-right: -16px;">
						<svg class="tw-w-5 tw-h-5 tw-text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
						</svg>
					</button>
					<div class="category-swiper-container tw-overflow-hidden" style="padding: 0 20px;">
						<div class="swiper-wrapper">
							<div class="swiper-slide" style="width: auto;">
								<button data-voucher-category="" class="tw-flex tw-items-center tw-gap-1 tw-border-2 tw-bg-[#f97e2b] tw-text-white tw-border-[#f97e2b] tw-px-3 tw-py-1.5 tw-rounded-full tw-whitespace-nowrap tw-text-base">
									{{ __('plugins/voucher::voucher.public.all') }}
								</button>
							</div>
							@foreach($categories as $category)
								<div class="swiper-slide" style="width: auto;">
									<button data-voucher-category="{{ $category }}" class="tw-flex tw-items-center tw-gap-1 tw-border-2 tw-bg-white tw-text-gray-700 tw-border-gray-200 tw-px-3 tw-py-1.5 tw-rounded-full tw-whitespace-nowrap tw-text-base">
										{{ $category }}
									</button>
								</div>
							@endforeach
						</div>
					</div>
				</div>

				<div class="tw-relative">
					<div id="voucher-loading" class="tw-relative tw-inset-0 tw-bg-white/70 tw-backdrop-blur-[1px] tw-z-10 tw-rounded-lg tw-items-center tw-justify-center" style="display:none;">
						<div class="tw-flex tw-items-center tw-gap-2 tw-text-gray-700 tw-font-medium">
							<div>
								<svg class="tw-animate-spin tw-h-5 tw-w-5 tw-text-[#f97e2b]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
									<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
									<path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
								</svg>
								<span>{{ __('plugins/voucher::voucher.public.loading') }}</span>
							</div>
						</div>
					</div>

					<div id="voucher-list" class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-3" data-provider="{{ optional($provider->slugable)->key }}" data-offset="{{ $initialCount }}">
					@include('plugins/voucher::public.partials.voucher-items', ['vouchers' => $vouchers, 'provider' => $provider])
					</div>
				</div>

				<div class="">
					<div id="loadMore" class="see-more tw-rounded-2xl tw-flex tw-flex-col tw-items-center tw-justify-center tw-cursor-pointer tw-text-center tw-mt-4">
						<svg class="arrows" width="60" height="72" viewBox="0 0 60 72" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0 L30 32 L60 0" class="a1" stroke="currentColor" stroke-width="2" fill="none"></path>
							<path d="M0 20 L30 52 L60 20" class="a2" stroke="currentColor" stroke-width="2" fill="none"></path>
							<path d="M0 40 L30 72 L60 40" class="a3" stroke="currentColor" stroke-width="2" fill="none"></path>
						</svg>
						<p class="tw-text-[14px] tw-leading-[21px] js-loadmore-label">{{ __('plugins/voucher::voucher.public.load_more_voucher') }}</p>
						<div class="tw-flex tw-items-center tw-gap-2 js-loadmore-loading" style="display:none;">
							<div>
								<svg class="tw-animate-spin tw-h-5 tw-w-5 tw-text-[#f97e2b]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
									<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
									<path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
								</svg>
								<span class="tw-text-[14px] tw-leading-[21px]">{{ __('plugins/voucher::voucher.public.loading') }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
@php
	$interestPosts = $interestPosts ?? collect();
	$gridClass = $gridClass ?? 'tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-3 xl:tw-grid-cols-4 tw-gap-6 grid-interest-posts';
@endphp

@if ($interestPosts->isNotEmpty())
	<section class="tw-mt-10">
		<h4 class="tw-text-xl tw-font-semibold tw-mb-3">{{ __('plugins/voucher::voucher.public.promo_news') }}</h4>
		<div class="{{ $gridClass }}">
			@foreach ($interestPosts as $relatedItem)
				<article class="post post__horizontal tw-rounded-xl tw-overflow-hidden tw-shadow-md hover:tw-shadow-xl tw-border-gray-100 tw-border tw-flex tw-flex-col tw-transition-all clearfix">
					<div class="post__thumbnail tw-relative" style="width: 100%">
						{{ RvMedia::image($relatedItem->image, $relatedItem->name, 'medium') }}
						<a class="post__overlay" href="{{ preg_match('/\.html$/i', $relatedItem->url) ? preg_replace('/(\.html)+$/i', '.html', $relatedItem->url) : $relatedItem->url . '.html' }}" title="{{ $relatedItem->name }}"></a>
					</div>
					<div class="post__content-wrap" style="width: 100%">
						<header class="post__header">
							<h3 class="post__title" style="width: 100%;">
								<a href="{{ preg_match('/\.html$/i', $relatedItem->url) ? preg_replace('/(\.html)+$/i', '.html', $relatedItem->url) : $relatedItem->url . '.html' }}" class="tw-line-clamp-3" title="{{ $relatedItem->name }}">{{ $relatedItem->name }}</a>
							</h3>
						</header>
						<div class="post__content tw-p-0 tw-mt-3">
							<p class="tw-line-clamp-3">{{ $relatedItem->description }}</p>
						</div>
					</div>
				</article>
			@endforeach
		</div>
	</section>
@endif

	@if(! empty($providerAccordionsFooter))
	<div class="tw-bg-white tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-lg tw-p-5 tw-my-10">
		<div>
			<h4 class="tw-text-xl tw-pb-[8px] tw-font-semibold tw-text-black">{{ __('plugins/voucher::voucher.public.faq') }}</h4>
		</div>
		<div class="tw-mx-auto tw-w-full">
			<div>
				<div class="accordion" id="accordionFooter">
					@foreach($providerAccordionsFooter as $i => $item)
						@php
							$title = $item['title'] ?? '';
							$content = $item['content'] ?? '';
							$collapseId = 'collapseFooter' . ($i + 1);
						@endphp
						@if($title || $content)
							<div class="accordion-item">
								<h2 class="accordion-header">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="false" aria-controls="{{ $collapseId }}">
										<div>{{ $i + 1 }}. {{ $title }}</div>
									</button>
								</h2>
								<div id="{{ $collapseId }}" class="accordion-collapse collapse" data-bs-parent="#accordionFooter">
									<div class="accordion-body">{!! clean($content) !!}</div>
								</div>
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
	@endif
</div>

<script>
	(function () {
		// Initialize Category Swiper
		const initCategorySwiper = function() {
			if (typeof Swiper === 'undefined') {
				console.warn('Swiper is not loaded yet');
				return;
			}

			const categorySwiper = new Swiper('.category-swiper-container', {
				slidesPerView: 'auto',
				spaceBetween: 8,
				freeMode: true,
				navigation: {
					nextEl: '#categoryNextBtn',
					prevEl: '#categoryPrevBtn',
				},
				on: {
					init: function() {
						// Ensure buttons are clickable
						const buttons = document.querySelectorAll('.category-swiper-container [data-voucher-category]');
						buttons.forEach(function(btn) {
							btn.style.pointerEvents = 'auto';
						});
					},
					slideChange: function() {
						// Keep buttons clickable during slide changes
						const buttons = document.querySelectorAll('.category-swiper-container [data-voucher-category]');
						buttons.forEach(function(btn) {
							btn.style.pointerEvents = 'auto';
						});
					}
				}
			});
		};

		// Wait for Swiper to be available
		if (typeof Swiper !== 'undefined') {
			initCategorySwiper();
		} else {
			// Retry mechanism to wait for Swiper
			let retryCount = 0;
			const maxRetries = 20;
			const retryInterval = setInterval(function() {
				retryCount++;
				if (typeof Swiper !== 'undefined') {
					clearInterval(retryInterval);
					initCategorySwiper();
				} else if (retryCount >= maxRetries) {
					clearInterval(retryInterval);
					console.error('Swiper failed to load after multiple retries');
				}
			}, 100);
		}

		// HOT Vouchers Load More
		const hotList = document.getElementById('hot-voucher-list');
		const loadMoreHotEl = document.getElementById('loadMoreHot');

		if (hotList && loadMoreHotEl) {
			const hotRoute = '{{ route('public.ajax.voucher.load-more-hot') }}';
			const provider = '{{ optional($provider->slugable)->key }}';
			let hotOffset = parseInt(hotList.getAttribute('data-offset') || '9', 10);
			let hotLoading = false;

			const loadMoreHotLoading = loadMoreHotEl.querySelector('.js-loadmore-loading');
			const loadMoreHotLabel = loadMoreHotEl.querySelector('.js-loadmore-label');

			const setHotLoading = function(isLoading) {
				hotLoading = isLoading;
				loadMoreHotEl.classList.toggle('tw-cursor-not-allowed', isLoading);
				loadMoreHotEl.classList.toggle('tw-pointer-events-none', isLoading);
				if (loadMoreHotLoading) loadMoreHotLoading.style.display = isLoading ? 'flex' : 'none';
				if (loadMoreHotLabel) loadMoreHotLabel.style.display = isLoading ? 'none' : 'block';
			};

			const fetchHotVouchers = async function() {
				if (hotLoading) return;
				setHotLoading(true);

				try {
					const url = new URL(hotRoute, window.location.origin);
					url.searchParams.set('provider', provider);
					url.searchParams.set('offset', String(hotOffset));
					url.searchParams.set('limit', '9');

					const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
					const data = await res.json();
					const payload = data.data || data;

					if (payload && typeof payload.html === 'string') {
						const tmp = document.createElement('div');
						tmp.innerHTML = payload.html;
						while (tmp.firstChild) {
							hotList.appendChild(tmp.firstChild);
						}

						const received = payload.count || 0;
						hotOffset += received;
						hotList.setAttribute('data-offset', String(hotOffset));

						if (received < 9) {
							loadMoreHotEl.style.display = 'none';
						}
					}
				} catch (e) {
					// ignore
				} finally {
					setHotLoading(false);
				}
			};

			loadMoreHotEl.addEventListener('click', function() {
				fetchHotVouchers();
			});
		}

		// Category Vouchers Load More
		const list = document.getElementById('voucher-list');
		const loadingEl = document.getElementById('voucher-loading');
		const loadMoreEl = document.getElementById('loadMore');
		const loadMoreLoading = loadMoreEl ? loadMoreEl.querySelector('.js-loadmore-loading') : null;
		const loadMoreLabel = loadMoreEl ? loadMoreEl.querySelector('.js-loadmore-label') : null;
		const categoryButtons = document.querySelectorAll('[data-voucher-category]');
		if (!list) return;

		const provider = list.getAttribute('data-provider') || '';
		const route = '{{ route('public.ajax.voucher.load-more') }}';
		const initialOffset = parseInt(list.getAttribute('data-offset') || '0', 10);

		let state = {
			category: '',
			offset: initialOffset,
			loading: false,
		};

		const setLoading = function (isLoading) {
			if (loadingEl) {
				loadingEl.style.display = isLoading ? 'flex' : 'none';
			}
			categoryButtons.forEach(function (button) {
				button.disabled = isLoading;
				button.classList.toggle('tw-cursor-not-allowed', isLoading);
			});
			if (loadMoreEl) {
				loadMoreEl.classList.toggle('tw-cursor-not-allowed', isLoading);
				loadMoreEl.classList.toggle('tw-pointer-events-none', isLoading);
				if (loadMoreLoading) loadMoreLoading.style.display = isLoading ? 'flex' : 'none';
				if (loadMoreLabel) loadMoreLabel.style.display = isLoading ? 'none' : 'block';
			}
		};

		const resetList = function () {
			list.innerHTML = '';
		};

		const setButtonState = function (hasMore) {
			if (!loadMoreEl) return;
			loadMoreEl.style.display = hasMore ? 'flex' : 'none';
		};

		const markActiveCategory = function (category) {
			categoryButtons.forEach(function (button) {
				button.classList.remove('tw-bg-[#f97e2b]', 'tw-text-white', 'tw-border-[#f97e2b]');
				button.classList.add('tw-bg-white', 'tw-text-gray-700', 'tw-border-gray-200');

				if ((button.getAttribute('data-voucher-category') || '') === category) {
					button.classList.add('tw-bg-[#f97e2b]', 'tw-text-white', 'tw-border-[#f97e2b]');
					button.classList.remove('tw-bg-white', 'tw-text-gray-700', 'tw-border-gray-200');
				}
			});
		};

		const renderHtml = function (html, reset) {
			const tmp = document.createElement('div');
			tmp.innerHTML = html;

			if (reset) {
				list.innerHTML = '';
			}

			while (tmp.firstChild) {
				list.appendChild(tmp.firstChild);
			}
		};

		const fetchVouchers = async function (reset) {
			if (state.loading) return;
			state.loading = true;
			setLoading(true);
			if (reset) {
				resetList();
				setButtonState(false);
			}

			try {
				const url = new URL(route, window.location.origin);
				const currentOffset = reset ? 0 : state.offset;
				url.searchParams.set('provider', provider);
				url.searchParams.set('offset', String(currentOffset));
				url.searchParams.set('limit', String(reset ? 18 : 9));
				if (state.category) {
					url.searchParams.set('category', state.category);
				}

				const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
				const data = await res.json();
				const payload = data.data || data;

				if (payload && typeof payload.html === 'string') {
					renderHtml(payload.html, reset);

					const received = payload.count || 0;
					state.offset = currentOffset + received;
					list.setAttribute('data-offset', String(state.offset));

					const hasMore = received >= (reset ? 18 : 9);
					setButtonState(hasMore);
				}
			} catch (e) {
				// ignore
			} finally {
				state.loading = false;
				setLoading(false);
			}
		};

		loadMoreEl && loadMoreEl.addEventListener('click', function () {
			fetchVouchers(false);
		});

		categoryButtons.forEach(function (button) {
			button.addEventListener('click', function () {
				const category = button.getAttribute('data-voucher-category') || '';
				if (state.loading) return;
				if (state.category === category) return;

				state.category = category;
				state.offset = 0;
				list.setAttribute('data-offset', '0');
				markActiveCategory(category);

				fetchVouchers(true);
			});
		});

		if (loadMoreEl && initialOffset < 18) {
			loadMoreEl.style.display = 'none';
		}

		// Coupon detail toggle on click (ensure overlay above others)
		document.addEventListener('click', function(e) {
			const couponCard = e.target.closest('.coupon-card');
			if (!couponCard) return;
			const couponDetail = couponCard.querySelector('.coupon-detail');
			if (!couponDetail) return;

			const willOpen = couponDetail.classList.contains('tw-hidden');

			// Close all other open details and reset z-index
			document.querySelectorAll('.coupon-card .coupon-detail:not(.tw-hidden)').forEach(function (el) {
				el.classList.add('tw-hidden');
				const parent = el.closest('.coupon-card');
				if (parent) parent.classList.remove('tw-z-50');
			});

			if (willOpen) {
				couponDetail.classList.remove('tw-hidden');
				couponCard.classList.add('tw-z-50');
			} else {
				couponDetail.classList.add('tw-hidden');
				couponCard.classList.remove('tw-z-50');
			}
		});
	})();
</script>

<style>
	.coupon-card {
		transition: transform 0.2s ease;
	}

	.coupon-card:hover {
		transform: translateY(-2px);
	}
</style>
