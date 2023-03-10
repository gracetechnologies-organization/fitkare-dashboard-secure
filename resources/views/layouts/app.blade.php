<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style customizer-hide" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('dashboard') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Grace Technologies CMS" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/images/logo.jpg') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/fonts/boxicons.css') }}" />
    <!-- Core CSS (It is basically Bootstap 5) -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('dashboard/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/libs/apex-charts/apex-charts.css') }}" />
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('dashboard/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js')}} in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('dashboard/js/config.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('head')
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @if (Auth::user()->role_id === "emp")
        @include('livewire.employee.layout.header')
        @elseif (Auth::user()->role_id === "admin")
        {{"Admin"}}
        @endif
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @if (Auth::user()->role_id === "emp")
        @include('livewire.employee.layout.footer')
        @elseif (Auth::user()->role_id === "admin")
        {{"Admin footer"}}
        @endif
    </div>
    @stack('footer')
    @stack('wire_script')
    @livewireScripts
</body>

</html>

<script src="{{ asset('dashboard/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('dashboard/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('dashboard/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('dashboard/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('dashboard/vendor/js/menu.js') }}"></script>
<script src="{{ asset('dashboard/js/main.js') }}"></script>
<script src="{{ asset('dashboard/js/dashboards-analytics.js') }}"></script>
{{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
<script>
    window.addEventListener('close-modal', event => {
        $('#' + event.detail.id).modal('hide');
    });

    // Get all elements with class 'menu-item'
    var menuItems = document.querySelectorAll('.menu-item');
    // Loop through each element
    menuItems.forEach(function(item) {
        // Get the sub-menu element
        var subMenu = item.querySelector('.menu-sub-items');
        // If a sub-menu element exists
        if (subMenu) {
            // Hide the sub-menu by default
            subMenu.style.display = 'none';
            // Add a click event listener to the menu item
            item.addEventListener('click', function() {
                // Toggle the sub-menu visibility on click
                subMenu.style.display = subMenu.style.display === 'none' ? 'block' : 'none';
            });
        }
    });
</script>

