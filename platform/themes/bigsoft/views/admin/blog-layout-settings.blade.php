@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <x-core::card>
        <x-core::form :url="route('theme.blog-layout.update')" method="post">
            <x-core::card.header>
                <x-core::card.title>
                    {{ __('Blog layout') }}
                </x-core::card.title>

                <x-core::card.actions>
                    <x-core::button type="submit" color="primary">
                        {{ trans('packages/theme::theme.save_changes') }}
                    </x-core::button>
                </x-core::card.actions>
            </x-core::card.header>

            <x-core::card.body>
                @php
                    $blogLayout = theme_option('blog_layout', 'default');
                    $postLayout = theme_option('post_layout', 'default');

                    $blogGridCols = (int) theme_option('blog_grid_cols', 2);
                    $blogGridColsSm = (int) theme_option('blog_grid_cols_sm', 2);
                    $blogGridColsMd = (int) theme_option('blog_grid_cols_md', 3);
                    $blogGridColsLg = (int) theme_option('blog_grid_cols_lg', 4);
                    $blogGridColsXl = (int) theme_option('blog_grid_cols_xl', 4);

                    $blogGridCols = max(1, min(6, $blogGridCols));
                    $blogGridColsSm = max(1, min(6, $blogGridColsSm));
                    $blogGridColsMd = max(1, min(6, $blogGridColsMd));
                    $blogGridColsLg = max(1, min(6, $blogGridColsLg));
                    $blogGridColsXl = max(1, min(6, $blogGridColsXl));

                    if ($blogLayout === 'no-sidebar') {
                        $blogLayout = 'default-no-sidebar';
                    }

                    if ($postLayout === 'no-sidebar') {
                        $postLayout = 'default-no-sidebar';
                    }
                @endphp

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-core::form.label for="blog_layout" :label="__('Blog page layout')" />
                            <select class="form-select" name="blog_layout" id="blog_layout">
                                <option value="default" @selected($blogLayout === 'default')>{{ __('With sidebar') }}</option>
                                <option value="default-no-sidebar" @selected($blogLayout === 'default-no-sidebar')>{{ __('No sidebar') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <x-core::form.label for="post_layout" :label="__('Post detail layout')" />
                            <select class="form-select" name="post_layout" id="post_layout">
                                <option value="default" @selected($postLayout === 'default')>{{ __('With sidebar') }}</option>
                                <option value="default-no-sidebar" @selected($postLayout === 'default-no-sidebar')>{{ __('No sidebar') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h4 class="mb-3">{{ __('Blog grid columns') }}</h4>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="blog_grid_cols" :label="__('Columns (mobile)')" />
                            <select class="form-select" name="blog_grid_cols" id="blog_grid_cols">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($blogGridCols === $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="blog_grid_cols_sm" :label="__('Columns (sm)')" />
                            <select class="form-select" name="blog_grid_cols_sm" id="blog_grid_cols_sm">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($blogGridColsSm === $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="blog_grid_cols_md" :label="__('Columns (md)')" />
                            <select class="form-select" name="blog_grid_cols_md" id="blog_grid_cols_md">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($blogGridColsMd === $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="blog_grid_cols_lg" :label="__('Columns (lg)')" />
                            <select class="form-select" name="blog_grid_cols_lg" id="blog_grid_cols_lg">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($blogGridColsLg === $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <x-core::form.label for="blog_grid_cols_xl" :label="__('Columns (xl)')" />
                            <select class="form-select" name="blog_grid_cols_xl" id="blog_grid_cols_xl">
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" @selected($blogGridColsXl === $i)>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </x-core::card.body>

            <x-core::card.footer>
                <x-core::button type="submit" color="primary">
                    {{ trans('packages/theme::theme.save_changes') }}
                </x-core::button>
            </x-core::card.footer>
        </x-core::form>
    </x-core::card>
@endsection
