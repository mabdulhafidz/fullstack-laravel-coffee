<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Menu Column -->
    <div class="flex">
<div class="w-1/2">
    <h2 class="text-2xl font-bold mb-4b">Menu</h2>
    <div class="grid grid-cols-2 gap-2 content-around">
        @foreach ($categories as $category)
            <div class="mb-4">
                <h3 class="text-xl font-semibold mb-2">{{ $category->name }}</h3>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($category->menus as $menu)
                        <div class="border p-4 rounded-md shadow-md hover:shadow-lg transition-transform transform hover:scale-105 w-40">
                            <h3 class="text-lg font-semibold">{{ $menu->name }}</h3>
                            <p class="text-gray-600">{{ $menu->description }}</p>
                            <p class="text-gray-600">$ {{ $menu->price }}</p>
                            <button   
                                class="bg-dark-600 text-white menu-item mt-4 bg-blue-500 text-black px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                                data-name="{{ $menu->name }}"
                                data-price="{{ $menu->price }}">
                                Add to Order
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
 
        <div class="w-1/2 p-4 bg-green-500">
            <h2 class="text-2xl font-bold mb-4">Order</h2>
            <!-- Display order items in a table -->
            <table class="w-full table-fixed">
                <thead>
                    <tr>
                        <th class="w-1/4">Name</th>
                        <th class="w-1/4">Price</th>
                        <th class="w-1/4">Quantity</th>
                    </tr>
                </thead>
                <tbody class="ordered-items"> 

                </tbody>
            </table>
            <!-- Print Button -->
            <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-green" id="printBillButton">
                Print Bill
            </button>
        </div>
    </div>
</x-admin-layout>

@push('script') 

<script>
document.addEventListener('DOMContentLoaded', function() {
    var menuItems = document.getElementsByClassName('menu-item');
    var orderedItemsBody = document.querySelector('.ordered-items');

    Array.prototype.forEach.call(menuItems, function(menuItem) {
        menuItem.addEventListener('click', function() {
            var name = this.getAttribute('data-name');
            var price = this.getAttribute('data-price');
            
            var row = document.createElement('tr');
            
            var nameCell = document.createElement('td');
            nameCell.textContent = name;
            row.appendChild(nameCell);
            
            var priceCell = document.createElement('td');
            priceCell.textContent = '$' + price;
            row.appendChild(priceCell);
            
            var quantityCell = document.createElement('td');
            var quantityInput = document.createElement('input');
            quantityInput.type = 'number';
            quantityInput.value =  1;
            quantityInput.min =  1;
            quantityCell.appendChild(quantityInput);
            row.appendChild(quantityCell);
            
            orderedItemsBody.appendChild(row);
        });
    });
});
</script>