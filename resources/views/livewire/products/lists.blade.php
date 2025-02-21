<div class="">
    @if (session('error'))
    <div class="flex items-center p-4 my-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="">
            {{session('error')}}
        </div>
    </div>
    @endif

    @if (session('success'))
    <div class="flex items-center p-4 my-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
        {{session('success')}}
        </div>
    </div>
    @endif

    <div class="my-3 space-x-2">
        <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="text-white inline-flex items-center px-4 py-2 bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800" type="button">
            Add Product
        </button>

    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Image</th>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Price</th>
                <th scope="col" class="px-6 py-3">Stock</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr data-product-id="{{ $product->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->title }}" class="w-8 h-8 md:w-16 md:h-16">
                    </th>
                    <td class="px-6 py-4 truncate max-w-32">{{ $product->title }}</td>
                    <td class="px-6 py-4"><a href="{{ route('products.lists') }}?category={{ $product->category->id }}" class="hover:text-blue-400 underline">{{ $product->category->name }}</a></td>
                    <td class="px-6 py-4">${{ $product->price }}</td>
                    <td class="px-6 py-4">{{ $product->stock }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Show</a>
                            <button wire:click="$dispatch('editSelected', { idProduct: '{{ $product->id }}' })"" data-modal-toggle="edit-modal" data-modal-target="edit-modal" class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 edit-link" data-id="{{ $product->id }}">Edit</button>
                            <a data-modal-toggle="popup-modal" href="" class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 delete-link" data-id="{{ $product->id }}">Delete</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="my-4 md:mx-4">
        {{ $products->links() }}
    </div>


    <livewire:products.store-modal />

    <livewire:products.update-modal />

</div>
