<div class="toc-container {{ $cssClasses ?? '' }} table-of-content">
    <p class="toc_title tw-relative">
       <button style="width: 100%;
    padding: 12px 15px;
    background-color: #e6f7ff;
    color: #007bff;
    border: none;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.1em;" class="toc_toggle">
         {{ trans('plugins/toc::toc.name') }}
        <span class="toc_toggle d-none show-text tw-absolute tw-left-0 tw-top-0 tw-w-full tw-h-full">
            <a href="#" class="tw-w-full tw-h-full tw-absolute tw-left-0 tw-top-0 tw-flex tw-justify-between tw-items-center tw-py-0 tw-px-5 tw-text-[#007bff]">
            </a>
        </span>
        <span class="toc_toggle d-none hide-text tw-absolute tw-left-0 tw-top-0 tw-w-full tw-h-full">
            <a href="#" class="tw-w-full tw-h-full tw-absolute tw-left-0 tw-top-0 tw-flex tw-justify-between tw-items-center tw-py-0 tw-px-5 tw-text-[#007bff]">
            </a>
        </span>
        </button>
    </p>
    <ul class="toc_list">{!! $items !!}</ul>
</div>