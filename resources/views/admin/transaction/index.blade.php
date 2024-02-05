<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div x-data="{ showModal: false, selectedMenu: {}, quantity: 1, notes: '' }" class="flex">
        <!-- Menu Column -->
        <div class="w-1/2 p-4">
            <h2 class="text-2xl font-bold mb-4b">Menu</h2>
            <div class="bg-green-500 grid grid-cols-2 gap-2 content-around">
                @foreach ($menus as $menu)
                    <div class="border p-4 rounded-md shadow-md hover:shadow-lg transition-transform transform hover:scale-105 w-40">
                        <h3 class="text-lg font-semibold">{{ $menu->name }}</h3>
                        <p class="text-gray-600">{{ $menu->description }}</p>
                        <p class="text-gray-600">$ {{ $menu->price }}</p>
                        <button 
                                class="mt-4 bg-blue-500 text-black px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                            Add to Order
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Order Column -->
        <div class="w-1/2 p-4">
            <h2 class="text-2xl font-bold mb-4">Order</h2>
            <!-- Display order items here -->
            <div>
                <div  class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <!-- Modal for quantity and notes -->
                    <div class="bg-white p-8 rounded-md shadow-md">
                        <label for="quantity" class="block mb-2 text-lg font-semibold">Quantity:</label>
                        <input type="number" x-model="quantity" id="quantity" min="1"
                               class="w-full border p-2 rounded-md mb-4">

                        <label for="notes" class="block mb-2 text-lg font-semibold">Notes:</label>
                        <textarea x-model="notes" id="notes" class="w-full border p-2 rounded-md mb-4"></textarea>
                        <div class="flex flex-col items-end gap-6 w-72">
                            <!-- Input fields go here -->
                        </div>

                        <button 
                                class="bg-green-500 text-black px-4 py-2 rounded-md mr-2 hover:bg-green-600 focus:outline-none focus:shadow-outline-green">
                            Add to Order
                        </button>
                        <button 
                                class="bg-gray-500 text-black px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:shadow-outline-gray">
                            Cancel
                        </button>
                    </div>
                </div>

                <!-- Display order items -->
                <div x-show="selectedMenu.name" class="mt-4">
                    <h3 x-text="selectedMenu.name" class="text-lg font-semibold"></h3>
                    <p x-text="selectedMenu.description" class="mb-2 text-gray-600"></p>
                    <p class="text-gray-700">Quantity: <span x-text="quantity"></span></p>
                    <p class="text-gray-700">Notes: <span x-text="notes"></span></p>
                    <button
                            class="bg-red-500 text-black px-4 py-2 rounded-md mr-2 hover:bg-red-600 focus:outline-none focus:shadow-outline-red">
                        Remove
                    </button>
                    <button
                            class="bg-yellow-500 text-black px-4 py-2 rounded-md hover:bg-yellow-600 focus:outline-none focus:shadow-outline-yellow">
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
  // Initialize the order storage
const orderStorage = [];

// Function to toggle the modal
function toggleModal() {
    const modal = document.getElementById('modal');
    if (modal.style.display === 'none') {
        modal.style.display = 'block';
    } else {
        modal.style.display = 'none';
    }
}

// Function to add an item to the order
function addToOrder(menuItem) {
    orderStorage.push(menuItem);
    // Hide the modal after adding the item
    toggleModal();
}

// Function to remove an item from the order
function removeFromOrder(index) {
    orderStorage.splice(index, 1);
    // Update the displayed order items
    updateOrderDisplay();
}

// Function to edit an item in the order
function editOrder(index, updatedItem) {
    orderStorage[index] = updatedItem;
    // Update the displayed order items
    updateOrderDisplay();
}

// Function to update the displayed order items
function updateOrderDisplay() {
    const orderContainer = document.getElementById('orderColumn');
    // Clear the current order display
    orderContainer.innerHTML = '';
    
    // Repopulate the order display with the updated orderStorage
    orderStorage.forEach((item, index) => {
        // Create and append the HTML elements for each item
        // ...
    });
}

// Event listeners for buttons
document.querySelectorAll('.add-to-order').forEach(button => {
    button.addEventListener('click', () => {
        const menuItem = {}; // Get the menu item from the button context
        addToOrder(menuItem);
    });
});

document.querySelectorAll('.remove-from-order').forEach(button => {
    button.addEventListener('click', () => {
        const index = parseInt(button.dataset.index);
        removeFromOrder(index);
    });
});

document.querySelectorAll('.edit-order').forEach(button => {
    button.addEventListener('click', () => {
        const index = parseInt(button.dataset.index);
        const updatedItem = {}; // Get the updated item from the button context
        editOrder(index, updatedItem);
    });
});
</script>