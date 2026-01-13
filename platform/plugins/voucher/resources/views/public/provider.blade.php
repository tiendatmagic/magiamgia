@php
	/** @var \Botble\Voucher\Models\Provider $provider */
	$hotVouchers = $hotVouchers ?? collect();
	$categories = $categories ?? [];
	$categories = array_values(array_filter(array_unique(array_map('strval', $categories))));
	$initialCount = $initialCount ?? 0;
	$providerAccordionsHeader = $providerAccordionsHeader ?? [];
	$providerAccordionsFooter = $providerAccordionsFooter ?? [];
@endphp

<div class="tw-my-6 container">
	<div class="tw-bg-white tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-lg tw-p-5">
		<div class="tw-flex tw-flex-col sm:tw-flex-row tw-items-center">
			<div class="sm:tw-w-1/4 lg:tw-w-1/5 tw-w-full tw-flex tw-justify-center tw-mb-4 sm:tw-mb-0">
				@if($provider->logo)
					<img src="{{ RvMedia::getImageUrl($provider->logo) }}" alt="{{ $provider->name }}" class="tw-w-32 tw-h-32 tw-object-contain tw-rounded-lg tw-border tw-border-gray-100" />
				@endif
			</div>

			<div class="sm:tw-w-3/4 lg:tw-w-4/5 tw-w-full">
				<div class="tw-text-[var(--primary-color)] tw-font-bold tw-text-2xl" style="--primary-color: rgb(249, 126, 43); --breadcrumb-base: rgb(249, 126, 43);">
					{{ $provider->name }}
				</div>
				@if($provider->description)
					<div class="tw-text-base tw-mt-3">
						{!! clean($provider->description) !!}
					</div>
				@endif

				<div class="tw-flex tw-gap-3 tw-flex-wrap tw-mt-4">
					@if($provider->button_1_text && $provider->button_1_url)
						<a class="tw-bg-[#cc2c62] tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-shadow-md" href="{{ $provider->button_1_url }}" target="_blank" rel="nofollow">
							{{ $provider->button_1_text }}
							<i class="fa fa-mouse-pointer"></i>
						</a>
					@endif
					@if($provider->button_2_text && $provider->button_2_url)
						<a class="tw-bg-[#2c92cc] tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-text-sm tw-font-medium tw-shadow-md" href="{{ $provider->button_2_url }}" target="_blank" rel="nofollow">
							{{ $provider->button_2_text }}
							<i class="fa fa-mouse-pointer"></i>
						</a>
					@endif
				</div>
			</div>
		</div>
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

	@if($hotVouchers->isNotEmpty())
		<div class="tw-bg-[#fbfbfb] tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-lg tw-p-5 tw-my-5">
			<div>
				<h4 class="tw-text-xl tw-pb-[8px] tw-font-semibold tw-text-[#464646]">{{ __('Mã giảm giá HOT') }}</h4>
			</div>

			<div class="tw-mx-auto tw-w-full">
				<div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-3">
					@include('plugins/voucher::public.partials.voucher-items', ['vouchers' => $hotVouchers, 'provider' => $provider])
				</div>
			</div>
		</div>
	@endif

	<div class="tw-bg-[#fbfbfb] tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-lg tw-p-5 tw-my-5">
		<div>
			<h4 class="tw-text-xl tw-pb-[8px] tw-font-semibold tw-text-[#464646]">{{ __('Danh mục') }}</h4>
		</div>
		<div class="tw-mx-auto tw-w-full">
			<div class="tw-flex tw-gap-2 tw-overflow-x-auto tw-mb-4 tw-pb-2 tw-text-xs">
				<button data-voucher-category="" class="tw-flex tw-items-center tw-gap-1 tw-border-2 tw-bg-[#f97e2b] tw-text-white tw-border-[#f97e2b] tw-px-3 tw-py-1.5 tw-rounded-full tw-whitespace-nowrap tw-text-base">
					{{ __('Tất cả') }}
				</button>
				@foreach($categories as $category)
					<button data-voucher-category="{{ $category }}" class="tw-flex tw-items-center tw-gap-1 tw-border-2 tw-bg-white tw-text-gray-700 tw-border-gray-200 tw-px-3 tw-py-1.5 tw-rounded-full tw-whitespace-nowrap tw-text-base">
						{{ $category }}
					</button>
				@endforeach
			</div>

			<div class="tw-relative">
				<div id="voucher-loading" class="tw-absolute tw-inset-0 tw-bg-white/70 tw-backdrop-blur-[1px] tw-z-10 tw-rounded-lg tw-items-center tw-justify-center" style="display:none;">
					<div class="tw-flex tw-items-center tw-gap-3 tw-text-gray-700 tw-font-medium">
						<svg class="tw-animate-spin tw-h-5 tw-w-5 tw-text-[#f97e2b]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
							<circle class="tw-opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
							<path class="tw-opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
						</svg>
						<span>{{ __('Đang tải voucher...') }}</span>
					</div>
				</div>

				<div id="voucher-list" class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-3" data-provider="{{ optional($provider->slugable)->key }}" data-offset="{{ $initialCount }}">
				@include('plugins/voucher::public.partials.voucher-items', ['vouchers' => $vouchers, 'provider' => $provider])
				</div>
			</div>

			<div class="tw-text-center tw-mt-4">
				<button type="button" class="tw-inline-flex tw-items-center tw-justify-center tw-gap-2 tw-border tw-border-[#f97e2b] tw-text-[#f97e2b] tw-font-medium tw-px-5 tw-py-2 tw-rounded-lg hover:tw-bg-[#f97e2b] hover:tw-text-white tw-transition" id="voucher-load-more">
					{{ __('Xem thêm') }}
				</button>
			</div>
		</div>
	</div>

@php
	$interestPosts = $interestPosts ?? collect();
	$gridClass = $gridClass ?? 'tw-grid tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-3 xl:tw-grid-cols-4 tw-gap-6 grid-interest-posts';
@endphp

@if ($interestPosts->isNotEmpty())
	<section class="tw-mt-8 tw-mb-4">
		<h4 class="tw-text-xl tw-font-semibold tw-mb-4">{{ __('Tin khuyến mãi') }}</h4>
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
	<div class="tw-bg-[#fbfbfb] tw-border tw-border-gray-100 tw-rounded-xl tw-shadow-lg tw-p-5 tw-my-5">
		<div>
			<h4 class="tw-text-xl tw-pb-[8px] tw-font-semibold tw-text-[#F9993C]">{{ __('Câu hỏi thường gặp') }}</h4>
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
		const list = document.getElementById('voucher-list');
		const loadingEl = document.getElementById('voucher-loading');
		const btn = document.getElementById('voucher-load-more');
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
				button.classList.toggle('tw-opacity-70', isLoading);
				button.classList.toggle('tw-cursor-not-allowed', isLoading);
			});
			if (btn) {
				btn.disabled = isLoading;
				btn.classList.toggle('tw-opacity-70', isLoading);
				btn.classList.toggle('tw-cursor-not-allowed', isLoading);
			}
		};

		const resetList = function () {
			list.innerHTML = '';
		};

		const setButtonState = function (hasMore) {
			if (!btn) return;
			btn.style.display = hasMore ? 'inline-flex' : 'none';
			btn.disabled = false;
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

		btn && btn.addEventListener('click', function () {
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

		if (btn && initialOffset < 18) {
			btn.style.display = 'none';
		}

		// Coupon detail toggle on click
		document.addEventListener('click', function(e) {
			const couponCard = e.target.closest('.coupon-card');
			if (couponCard) {
				const couponDetail = couponCard.querySelector('.coupon-detail');
				if (couponDetail) {
					couponDetail.classList.toggle('tw-hidden');
				}
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
