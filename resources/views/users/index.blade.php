<x-admin-layout>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `User List`, pages: [
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
                        Users
                    </h3>
                    @can('create', App\Models\User::class)
                        <a href="{{ route('admin.users.create') }}" class="text-theme-lg font-medium text-gray-500 dark:text-white/90">
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
                                                    User
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Type
                                                </p>
                                            </div>
                                        </th>
                                        {{--  --}}
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Contact
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Sec. Contact
                                                </p>
                                            </div>
                                        </th>
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
                                                    Action
                                                </p>
                                            </div>
                                        </th>
                                        {{--  --}}
                                        
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                    Additional Details
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
                                            <div class="flex items-center">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 overflow-hidden rounded-full">
                                                        @if($item->image_path !== null)
                                                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->first_name.' image' }}" />
                                                        @else
                                                            <img src="{{ asset('images/user_default_image.png') }}" alt="{{ $item->first_name. ' image' }}" />
                                                        @endif
                                                    </div>

                                                    <div>
                                                        <span
                                                            class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                            {{ $item->first_name.' '.$item->last_name }}
                                                        </span>
                                                        @if($item->id != 1 && $item->id != 2)
                                                        <span
                                                            class="block text-gray-500 text-theme-xs dark:text-gray-400">
                                                            {{ $item->email }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <span class="text-gray-600 dark:text-gray-400">
                                                {{ $item->userType->type ?? 'N/A' }}
                                            </span>
                                        </td>
                                        {{--  --}}
                                        <td class="px-5 py-4 sm:px-6">
                                            <span class="text-gray-600 dark:text-gray-400">
                                                {{ $item->contact_no ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4 sm:px-6">
                                            <span class="text-gray-600 dark:text-gray-400">
                                                {{ $item->sec_contact_no ?? 'N/A' }}
                                            </span>
                                        </td>
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
                                                @can('update', $item)
                                                    <a href="{{ route('admin.users.edit', $item) }}" title="Edit" class="p-1 me-2.5 text-yellow-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                            <path fill-rule="evenodd" d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z" clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                @endcan

                                                @can('delete', $item)
                                                    <form action="{{ route('admin.users.destroy', $item) }}" method="post" id="{{ 'form-delete-'.$item->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:void(0);" title="Delete"
                                                            @click="showConfirmDeleteModal = true; formToDeleteId='{{ 'form-delete-'.$item->id }}'; confirmModalMsg='Are you sure to delete user <span class= \'font-medium \'>{{ $item->first_name.' '.$item->last_name }}</span>?'" 
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
                                        {{-- Additional Details (responsive row break)  --}}
                                        <td>
                                            <table class="bg-blue-50">
                                                <thead>
                                                    <tr>
                                                        <th class="px-5 py-3 sm:px-6">
                                                            <div class="flex items-center">
                                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                    Address
                                                                </p>
                                                            </div>
                                                        </th>
                                                        <th class="px-5 py-3 sm:px-6">
                                                            <div class="flex items-center">
                                                                <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                    Assigned Roles
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="max-w-50 text-wrap px-5 py-4 sm:px-6">
                                                            <span class="text-gray-600 dark:text-gray-400">
                                                                @php
                                                                    $state = $item->state ? $item->state->name : '';
                                                                    $country = $item->country ? $item->country->name : '';
                                                                @endphp
                                                                {{ $item->address . ', ' . $item->city . ', ' . $item->district . ', ' . $state . ', ' . $country }}
                                                            </span>
                                                        </td>
                                                        <td class="max-w-50 px-5 py-4 sm:px-6 text-wrap">
                                                            @php
                                                                $assigned_roles = [];
                                                            
                                                                if($item->roles){
                                                                    foreach($item->roles as $role){
                                                                        $assigned_roles[] = $role->title;
                                                                    }
                                                                }
                                                            @endphp
                                                            <span class="text-gray-600 dark:text-gray-400">
                                                                {{ implode(', ', $assigned_roles) }}
                                                            </span>
                                                        </td>
                                                        <td class="px-5 py-4 sm:px-6">
                                                            <div class="flex items-center">
                                                                <div class="flex items-center gap-3">
                                                                    <div class="w-10 h-10 overflow-hidden rounded-full">
                                                                        @php
                                                                            $image_path = $item->creator && $item->creator->image_path ? $item->creator->image_path : 'images/user_default_image.png';
                                                                        @endphp
                                                                        <img src="{{ asset($image_path) }}" alt="{{ $item->creator->first_name ?? 'Not found'}}" />
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
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @if($item->isUserAdmin())
                                                @can('view', $item->empDetail)
                                                    <table class="bg-blue-50">
                                                        <thead>
                                                            <tr>
                                                                <th class="px-5 py-3 sm:px-6" colspan="8">
                                                                    Employee Details
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th class="px-5 py-3 sm:px-6">
                                                                    <div class="flex items-center">
                                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                            Designation
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                                <th class="px-5 py-3 sm:px-6">
                                                                    <div class="flex items-center">
                                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                            Referrer Name
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                                <th class="px-5 py-3 sm:px-6">
                                                                    <div class="flex items-center">
                                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                            Referrer Contact
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                                <th class="px-5 py-3 sm:px-6">
                                                                    <div class="flex items-center">
                                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                            ID Doc
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                                <th class="px-5 py-3 sm:px-6">
                                                                    <div class="flex items-center">
                                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                            Edu Doc
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                                <th class="px-5 py-3 sm:px-6">
                                                                    <div class="flex items-center">
                                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                            Resume
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                                <th class="min-w-32 max-w-32 text-wrap px-5 py-3 sm:px-6">
                                                                    <div class="flex items-center">
                                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                            Emp Detail Created at
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                                <th class="min-w-32 max-w-32 text-wrap px-5 py-3 sm:px-6">
                                                                    <div class="flex items-center">
                                                                        <p class="font-semibold text-gray-700 dark:text-gray-400">
                                                                            Last Updated
                                                                        </p>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="px-5 py-4 sm:px-6">
                                                                    <span class="text-gray-600 dark:text-gray-400">
                                                                        @if($item->user_type_id == 1)
                                                                            {{ $item->empDetail && $item->empDetail->designation ? $item->empDetail->designation->title : 'N/A' }}
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    </span>
                                                                </td>
                                                                <td class="px-5 py-4 sm:px-6">
                                                                    <span class="text-gray-600 dark:text-gray-400">
                                                                            {{ $item->empDetail && !empty($item->empDetail->referrer_name) ? $item->empDetail->referrer_name : 'N/A' }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-5 py-4 sm:px-6">
                                                                    <span class="text-gray-600 dark:text-gray-400">
                                                                            {{ $item->empDetail && !empty($item->empDetail->referrer_contact) ? $item->empDetail->referrer_contact : 'N/A' }}
                                                                    </span>
                                                                </td>
                                                                <td class="px-5 py-4 sm:px-6">
                                                                    @if($item->empDetail && !empty($item->empDetail->identity_document_path))
                                                                        <a class="inline-block w-6 h-6" href="{{ asset($item->empDetail->identity_document_path) }}" target="_blank">
                                                                            <img class="w-5 h-5" src="{{ asset($item->empDetail->identity_document_path) }}" alt="Id Doc Image" />
                                                                        </a>
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td class="px-5 py-4 sm:px-6">
                                                                    @if($item->empDetail && !empty($item->empDetail->education_document_path))
                                                                        <a class="inline-block w-6 h-6" href="{{ asset($item->empDetail->education_document_path) }}" target="_blank">
                                                                            <img class="w-5 h-5" src="{{ asset($item->empDetail->education_document_path) }}" alt="Edu Doc Image" />
                                                                        </a>
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td class="px-5 py-4 sm:px-6">
                                                                    @if($item->empDetail && !empty($item->empDetail->resume_path))
                                                                        <a class="inline-block w-6 h-6" href="{{ asset($item->empDetail->resume_path) }}" target="_blank">
                                                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                                                <path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z" clip-rule="evenodd"/>
                                                                            </svg>                                                                      
                                                                        </a>
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td class="min-w-32 max-w-32 text-wrap px-5 py-4 sm:px-6">
                                                                    <span class="text-gray-600 dark:text-gray-400">
                                                                        {{ $item->empDetail ? $item->empDetail->created_at->format("d-m-Y H:i A") : 'N/A' }}
                                                                    </span>
                                                                </td>
                                                                <td class="min-w-32 max-w-32 text-wrap px-5 py-4 sm:px-6">
                                                                    <span class="text-gray-600 dark:text-gray-400">
                                                                        {{ $item->empDetail ? $item->empDetail->updated_at->format("d-m-Y H:i A") : 'N/A' }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @endcan
                                            @endif

                                            @if($item->isUserPartner())
                                            {{-- Show Partner Details --}}
                                            @endif

                                            @if($item->isUserCustomer())
                                            {{-- Show Customer Details --}}
                                            @endif
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