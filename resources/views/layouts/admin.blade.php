<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.includes.admin.head')
    </head>
    <body class="font-sans antialiased"
          x-data="{ 
                    page: '{{ request()->route()->getName() }}', 
                    'loaded': true, 
                    'darkMode': false, 
                    'stickyMenu': false, 
                    'sidebarToggle': true, 
                    'scrollTop': false, 
                    'showConfirmDeleteModal': false,
                    'confirmModalMsg':'',
                    'formToDeleteId':''
                }"
            x-init="
                darkMode = JSON.parse(localStorage.getItem('darkMode'));
                $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
            :class="{'dark bg-gray-900': darkMode === true}"
    >
        
        <x-confirm-delete-modal/>

        <x-preloader/>

        <div class="flex h-screen overflow-hidden">
            @include('layouts.includes.admin.sidebar')

            <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
                <x-overlay/>

                @include('layouts.includes.admin.header')

                <main>
                    @include('layouts.includes.errors')
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
