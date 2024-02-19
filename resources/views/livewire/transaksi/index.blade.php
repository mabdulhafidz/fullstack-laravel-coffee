<div>
    <div class="flex h-screen bg-gray-100">
        <div class="hidden md:flex flex-col items-center w-20 bg-cyan-500 p-4">

            <a href="#" class="text-white mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">

                </svg>
            </a>


            <ul class="flex flex-col space-y-4">
                <li>
                    <a href="#" class="text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center">
                        <span class="flex items-center justify-center h-12 w-12 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center">
                        <span
                            class="flex items-center justify-center text-cyan-100 hover:bg-cyan-400 h-12 w-12 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center">
                        <span
                            class="flex items-center justify-center text-cyan-100 hover:bg-cyan-400 h-12 w-12 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center">
                        <span
                            class="flex items-center justify-center text-cyan-100 hover:bg-cyan-400 h-12 w-12 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-grow flex flex-col">
            <div class="relative px-4">
                <div class="absolute left-0 top-0 px-2 py-2 rounded-full bg-cyan-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text"
                    class="bg-white rounded-3xl shadow text-lg w-1/4 h-16 py-4 pl-16 transition-shadow focus:shadow-2xl focus:outline-none"
                    placeholder="Cari menu ..." x-model="keyword" />
            </div>
            <div wire:poll.1s="">
                <div class="flex">
                    <!-- Tampilan Menu Card -->
                    <div class="relative px-4">
                        <select wire:model="selectedCategory"
                            class="rounded-full px-4 py-2 focus:outline-none focus:shadow-outline-blue">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-grow bg-blue-gray-50 p-4 overflow-auto grid grid-cols-4 gap-4">
                        @foreach ($menus as $menu)
                            <div class="bg-white rounded-md p-4 flex flex-col items-center">
                                <div class="text-center">
                                    <h3 class="text-lg font-semibold">{{ $menu->name }}</h3>
                                    <p class="text-gray-500">{{ $menu->description }}</p>
                                    @if (isset($menu->stocks))
                                        <p class="text-g  ray-500">{{ $menu->stocks->jumlah }}</p>
                                    @else
                                        <p class="text-gray-500">Sold Out</p>
                                    @endif
                                </div>
                                <div>
                                  <button wire:click="addToCart('{{ $menu->id }}', '{{ $menu->name }}', {{ $menu->price }}, {{ isset($quantity) ? $quantity :  1 }})"
                                    class="bg-blue-500 text-white menu-item mt-4 px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                                    Add to Order
                                </button>
                                    @if ($errors->has('stockEmpty'))
                                        <p>{{ $errors->first('stockEmpty') }}</p>
                                    @endif
                                </div>


                            </div>
                        @endforeach
                    </div>
                    <div class="w-5/12 bg-blue-gray-50 h-full bg-white pr-4 pl-2 py-4 overflow-auto">


                        <div x-show="cartUpdated || orderedItems > 0" class="flex-1 w-full px-4 overflow-auto">
                            <div class="select-none h-auto w-full text-center pt-3 pb-4 px-4">
                                <div class="flex flex-col space-y-4 text-lg font-semibold text-blue-gray-700">
                                    @foreach ($cart as $item)
                                        <div class="flex items-center justify-between">
                                            <p>Name: {{ $item['name'] }}</p>
                                            <p>Price: ${{ $item['price'] * $item['qty'] }}</p>
                                            <div class="flex items-center space-x-2">
                                                <button
                                                    wire:click="updateCart('{{ $item['id'] }}', {{ $item['qty'] + 1 }})"
                                                    class="p-2 rounded-full text-white">
                                                    <svg class="h-8 w-8 text-blue-500" width="24" height="24"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <circle cx="12" cy="12" r="9" />
                                                        <line x1="9" y1="12" x2="15"
                                                            y2="12" />
                                                        <line x1="12" y1="9" x2="12"
                                                            y2="15" />
                                                    </svg>
                                                </button>
                                                {{ $item['qty'] }}
                                                <button
                                                    wire:click="updateCart('{{ $item['id'] }}', {{ $item['qty'] - 1 }})"
                                                    class="p-2 rounded-full text-white">
                                                    <svg class="h-8 w-8 text-red-500" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>

                                                </button>
                                                <button wire:click="removeFromCart('{{ $item['id'] }}')"
                                                    class="p-2 rounded-full text-white hover:bg-red-600">
                                                    <svg class="h-8 w-8 text-red-500" width="24" height="24"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                        <line x1="4" y1="7" x2="20"
                                                            y2="7" />
                                                        <line x1="10" y1="11" x2="10"
                                                            y2="17" />
                                                        <line x1="14" y1="11" x2="14"
                                                            y2="17" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="mt-auto">
                            <h1>Subtotal: ${{ $totalPrice }}</h1>
                            <h1>Items: {{ $itemCount }}</h1>
                        </div>
                <button class="bg-gray-500 text-white menu-item mt-4 px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-blue">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
