<x-admin-layout>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `User Type List`, pages: [
                                                        {name: `Dashboard`, url: `{{route('admin.dashboard')}}` }, 
                                                    ]
                    }">
            <x-breadcrumbs />
        </div>
        <!-- Breadcrumb End -->

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex justify-between px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-theme-xl font-medium text-gray-800 dark:text-white/90">
                        User Types
                    </h3>
                    @can('create', App\Models\UserType::class)
                        <a href="{{ route('admin.userTypes.create') }}" class="text-theme-lg font-medium text-gray-500 dark:text-white/90">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 inline -mt-0.5">
                                <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                            </svg>
                            Add New
                        </a>
                    @endcan
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <div class="relative mb-2.5 pb-3">
                        {{ $dataItems->links() }}
                        <div>
                            <div class="w-80 md:mx-auto md:-mt-8">
                                {{ "Showing Batch no. " . $dataItems->currentPage() . " containing " . $dataItems->count() . " entries." }}
                            </div>
                        </div>
                    </div>
                    <!-- ====== Table Start -->
                    <div class="mb-5 p-2.5 overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="max-w-full overflow-x-auto">
                            <table id="to-data-table" class="display responsive">
                                <!-- table header start -->
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    S. No.
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    User Type
                                                </p>
                                            </div>
                                        </th>
                                        {{-- <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Slug
                                                </p>
                                            </div>
                                        </th> --}}
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Status
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Created By
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Created At
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Last Updated
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Action
                                                </p>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <!-- table header end -->
                                <!-- table body start -->
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @php
                                        $sno = $dataItems->firstItem();
                                    @endphp
                                    @foreach ($dataItems as $item)
                                    <tr>
                                        <td class="px-5 py-4 sm:px-6">
                                            <span class="text-gray-600 dark:text-white/90">
                                                {{ $sno++ }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <span class="text-gray-600 dark:text-gray-400">
                                                {{ $item->type }}
                                            </span>
                                        </td>
                                        {{-- <td class="px-5 py-4 sm:px-6">
                                            <span class="text-gray-600 dark:text-gray-400">
                                                {{ $item->slug }}
                                            </span>
                                        </td> --}}
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                @if ($item->status)
                                                    <p class="rounded-full bg-success-50 px-2 py-0.5 font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                        {{ $item->getStatusLabel($item->status) }}
                                                    </p>
                                                @else
                                                    <p class="rounded-full bg-warning-50 px-2 py-0.5 font-medium text-warning-700 dark:bg-warning-500/15 dark:text-warning-400">
                                                        {{ $item->getStatusLabel($item->status) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 overflow-hidden rounded-full">
                                                        <img src="{{ asset('images/tailadmin/user/user-10.jpg') }}" alt="{{ $item->creator->first_name }}" />
                                                    </div>

                                                    <div>
                                                        <span class="block font-medium text-gray-800 dark:text-white/90">
                                                            @if($item->creator->id == 1)
                                                                {{ $item->creator->first_name }}
                                                            @else
                                                                {{ $item->creator->first_name . ' ' . $item->creator->last_name }}
                                                            @endif
                                                        </span>

                                                        @if($item->creator->id != 1 && $item->creator->id != 2)
                                                            <span class="block text-gray-500 text-theme-sm dark:text-gray-400">
                                                                {{ $item->creator && $item->creator->empDetail && $item->creator->empDetail->designation ? $item->creator->empDetail->designation->title : 'Designation Not Found' }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <span class="text-gray-600 dark:text-gray-400">
                                                {{ $item->created_at->format("d-m-Y H:i A") }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <span class="text-gray-600 dark:text-gray-400">
                                                {{ $item->updated_at->format("d-m-Y H:i A") }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <div class="flex items-center">
                                                @can('update', $item)
                                                    <a href="{{ route('admin.userTypes.edit', $item) }}" title="Edit" class="p-1 me-2.5 text-yellow-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                            <path fill-rule="evenodd" d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z" clip-rule="evenodd" />
                                                        </svg>                                              
                                                    </a>
                                                @endcan
                                                
                                                @can('delete', $item)
                                                    <form action="{{ route('admin.userTypes.destroy', $item) }}" method="post" id="{{ 'form-delete-'.$item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:void(0);" title="Delete"
                                                            @click="showConfirmDeleteModal = true; formToDeleteId='{{ 'form-delete-'.$item->id }}'; confirmModalMsg='Are you sure to delete user type <span class= \'font-medium \'>{{ $item->type }}</span>?'" 
                                                            class="text-red-600"
                                                        >
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                                                <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                                            </svg>
                                                        </a>
                                                        
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- ====== Table End -->
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>