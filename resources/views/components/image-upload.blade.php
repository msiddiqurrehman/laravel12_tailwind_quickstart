@props(['name', 'label' => '', 'isMultiple' => false, 'oldImagePath' => null ])
<!-- Image upload -->
<div  x-data="{ 
                images: [], 
                oldImageExists: '{{ $oldImagePath }}' ? true : false,
                get showOldImage() {
                    return this.images.length === 0 && this.oldImageExists;
                }
            }"
        x-init="
                if ('{{ $oldImagePath }}' === '') {
                    oldImageExists = false;
                }
            "
 >
    <!-- icons -->
    <div class="icons mt-10">
        <label class="cursor-pointer flex mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
            <span>{{ $label }}</span>
            <svg class="ms-2 mr-2 hover:text-gray-700 border rounded-full p-1 h-7"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
            </svg>
            <input type="file" name="{{ $name }}" hidden @if ($isMultiple) multiple @endif
                @change="images = Array.from($event.target.files).map(file => ({url: URL.createObjectURL(file), name: file.name, preview: ['jpg', 'jpeg', 'png', 'gif'].includes(file.name.split('.').pop().toLowerCase()), size: file.size > 1024 ? file.size > 1048576 ? Math.round(file.size / 1048576) + 'mb' : Math.round(file.size / 1024) + 'kb' : file.size + 'b'}))"
                {{ $attributes->merge([]) }} x-ref="fileInput" />

        </label>
    </div>

    <!-- Preview image here -->
    <div id="preview" class="flex">
        <template x-for="(image, index) in images" :key="index">
            <div class="relative w-32 h-32 my-4 object-cover rounded ">
                <div x-show="image.preview" class="relative w-32 h-32 object-cover rounded">
                    <img :src="image.url" class="w-32 h-32 object-cover rounded">
                    <button @click="images.splice(index, 1)"
                        class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span
                            class="mx-auto">×</span></button>
                    <div x-text="image.size" class="text-xs text-center p-2 dark:text-white/90"></div>
                </div>
                <div x-show="!image.preview" class="relative w-32 h-32 object-cover rounded">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-white stroke-indigo-500" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg> -->
                    <svg class="fill-current  w-32 h-32 ml-auto pt-1"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                    </svg>
                    <button @click="images.splice(index, 1)"
                        class="w-6 h-6 absolute text-center flex items-center top-0 right-0 m-2 text-white text-lg bg-red-500 hover:text-red-700 hover:bg-gray-100 rounded-full p-1"><span
                            class="mx-auto">×</span></button>
                    <div x-text="image.size" class="text-xs text-center p-2"></div>
                </div>

            </div>
        </template>
    </div>

    <!-- Old image here -->
    <div x-show="showOldImage" class="relative w-32 my-4 object-cover rounded">
        <img src="{{ $oldImagePath }}" alt="No Image Found" class="w-32 h-32 object-cover rounded" />
        {{ $slot }}
    </div>
</div>
<!-- Image upload -->