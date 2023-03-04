<div>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="relative w-full mb-3 formkit-field">
            <input wire:model="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" aria-label="Title" placeholder="Title" type="text">
            @error('title')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative w-full mb-3 formkit-field">
            <input wire:model="content" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" aria-label="Content" placeholder="Content" type="text">
            @error('content')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        @if ($image)
            Image Preview:
            <div class="mb-3">
                <img src="{{ $isUpdate ? $image->temporaryUrl() : asset('storage/'. $image) }}">
            </div>
        @endif
        <div class="relative w-full mb-3 formkit-field">
            <input wire:model="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image{{ $iteration }}" type="file">
            <div wire:loading wire:target="image">Uploading...</div>
            @error('image')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>

        @if ($postId)
            <button type="submit" data-element="submit" class="formkit-submit">
                <span class="px-5 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg cursor-pointer hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</span>
            </button>
            <a wire:click="resetInput()" class="formkit-submit">
                <span class="px-5 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg cursor-pointer hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancel</span>
            </a>
        @else
            <button type="submit" data-element="submit" class="formkit-submit">
                <span class="px-5 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg cursor-pointer hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</span>
            </button>
        @endif
    </form>
</div>
