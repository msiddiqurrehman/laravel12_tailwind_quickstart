<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.includes.admin.head')
    </head>
    <body class="font-sans antialiased"
          x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
            x-init="
                darkMode = JSON.parse(localStorage.getItem('darkMode'));
                $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
            :class="{'dark bg-gray-900': darkMode === true}"
    >
        
        <x-preloader/>

        <div class="flex h-screen overflow-hidden">
            @include('layouts.includes.admin.sidebar')

            <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
                <x-overlay/>
            </div>

            @include('layouts.includes.admin.header')

            <main>
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    <div class="grid grid-cols-12 gap-4 md:gap-6">
                    <div class="col-span-12 space-y-6 xl:col-span-7">
                        <!-- Metric Group One -->
                        @include('admin.partials.metric-group-01')
                        <!-- Metric Group One -->

                        <!-- ====== Chart One Start -->
                        <!-- <include src="./partials/chart/chart-01.html" /> -->
                        <!-- ====== Chart One End -->
                    </div>
                    <div class="col-span-12 xl:col-span-5">
                        <!-- ====== Chart Two Start -->
                        <!-- <include src="./partials/chart/chart-02.html" /> -->
                        <!-- ====== Chart Two End -->
                    </div>

                    <div class="col-span-12">
                        <!-- ====== Chart Three Start -->
                        <!-- <include src="./partials/chart/chart-03.html" /> -->
                        <!-- ====== Chart Three End -->
                    </div>

                    <div class="col-span-12 xl:col-span-5">
                        <!-- ====== Map One Start -->
                        <!-- <include src="./partials/map-01.html" /> -->
                        <!-- ====== Map One End -->
                    </div>

                    <div class="col-span-12 xl:col-span-7">
                        <!-- ====== Table One Start -->
                        <!-- <include src="./partials/table/table-01.html" /> -->
                        <!-- ====== Table One End -->
                    </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- <div class="min-h-screen bg-gray-100">
            @include('layouts.includes.admin.navigation') -->

            <!-- Page Heading -->
            <!-- @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset -->

            <!-- Page Content -->
            <!-- <main>
                {{ $slot }}
            </main> -->
        </div>
    </body>
</html>
