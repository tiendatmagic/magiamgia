<div class="page-sidebar">
    @php
        $isServicePage = (bool) Theme::get('is_service_page');

        if ($isServicePage) {
            $serviceSidebar = (string) dynamic_sidebar('service_sidebar');
            $serviceSidebarText = trim(strip_tags($serviceSidebar));

            echo $serviceSidebarText !== '' ? $serviceSidebar : dynamic_sidebar('primary_sidebar');
        } else {
            echo dynamic_sidebar('primary_sidebar');
        }
    @endphp
</div>