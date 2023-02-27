<div>
    @if (session()->has('message'))
    <div x-data="{show: true}" x-show.transition.duration.1000ms="show"
        x-init="() => { $wire.on('show-flash-message', () => show = true);
        setTimeout(() => { show = false; $wire.call('clearMessage'); }, 3000) }"
        class="p-3 mb-5 text-white bg-green-500 rounded">
        {{ session('message') }}
    </div>
    @endif

    @livewire('form')

    <hr class="p-2 mt-5">
    <input wire:model="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-45 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" aria-label="Search" placeholder="Search" required="" type="text">
    <hr class="p-2 mt-5 mb-3">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                       No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Content
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $no=0 ?>
                @foreach ( $posts as $post )
                <?php $no++; ?>
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $no }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $post->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->content }}
                    </td>
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/'. $post->image) }}" alt="{{ $post->title }}" class="h-auto max-w-xl rounded-lg shadow-xl dark:shadow-gray-800">
                    </td>
                    <td class="px-6 py-4">
                        {{ $post->created_at}}
                    </td>
                    <td class="px-6 py-4">
                        <button wire:click="getPost({{$post->id}})" class="formkit-submit">
                            <span class="px-5 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg cursor-pointer hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</span>
                        </button>
                        <button wire:click="destroy({{$post->id}})" class="formkit-submit">
                            <span class="px-5 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg cursor-pointer hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete</span>
                        </button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
</div>

