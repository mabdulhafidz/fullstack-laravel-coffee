<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Menu</title>
  <!-- Include Tailwind CSS via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body class="bg-gray-100">

  <!-- Main Content -->
  <main class="ml-8 mt-4 mb-8">

    <!-- Menu and Order Section -->
    <div class="flex flex-col md:flex-row">

      <!-- Menu Column -->
      <div class="w-full md:w-1/2 pr-4">
        <h2 class="text-2xl font-bold mb-4">Menu</h2>
        <!-- Category Section -->
        <div class="flex mb-4">
          @foreach ($categories as $category)
            <button class="mr-4 px-4 py-2 bg-gray-300 hover:bg-green-600 text-black hover:text-white focus:outline-none focus:shadow-outline-blue category-btn rounded-full" data-category="{{ $category->slug }}">
              {{ $category->name }}
            </button>
          @endforeach
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="menuItems">
          @foreach ($categories as $category)
            @foreach ($category->menus as $menu)
              <div class="mb-4 category-menu" data-category="{{ $category->slug }}">
                <h3 class="text-xl font-semibold mb-2">{{ $category->name }}</h3>
                <div class="flex flex-col space-y-4">
                  <div class="border p-4 rounded-md shadow-md hover:shadow-lg transition-transform transform hover:scale-105">
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
                </div>
              </div>
            @endforeach
          @endforeach
        </div>
      </div>

      <!-- Order Column -->
      <div class="w-full md:w-1/2 p-4 ml-4">
        <h2 class="text-2xl font-bold mb-4">Order</h2>
        <!-- Display order items in a table -->
        <table class="w-full table-fixed">
          <thead>
            <tr>
              <th class="w-1/6">Name</th>
              <th class="w-1/6">Price</th>
              <th class="w-1/6">Quantity</th>
              <th class="w-1/6">Total</th>
              <th class="w-1/6">Action</th>
            </tr>
          </thead>
          <tbody class="ordered-items"> 
            <!-- Order items will go here -->
          </tbody>
        </table>
        <!-- Print Button -->
        <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-green" id="printBillButton">
          Print Bill
        </button>
      </div>

    </div>

  </main>

  @push('script') 
  <script>
    $(document).ready(function () {
      // Hide all menu items initially
      $('.category-menu').hide();
  
      // Handle category button clicks
      $('.category-btn').on('click', function () {
        // Get the selected category slug
        var categorySlug = $(this).data('category');
  
        // Hide all menu items
        $('.category-menu').hide();
  
        // Show only the menu items for the selected category
        $('.category-menu[data-category="' + categorySlug + '"]').show();
      });
    });
  </script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuItems = document.getElementsByClassName('menu-item');
        var orderedItemsBody = document.querySelector('.ordered-items');
  
        Array.prototype.forEach.call(menuItems, function(menuItem) {
            menuItem.addEventListener('click', function() {
                var name = this.getAttribute('data-name');
                var price = parseFloat(this.getAttribute('data-price'));
                
                var existingRow = orderedItemsBody.querySelector(`tr[data-name="${name}"]`);
                if (existingRow) {
                    var quantityInput = existingRow.querySelector('input[type="number"]');
                    quantityInput.value = parseInt(quantityInput.value) +  1;
                    updateTotalPrice(existingRow, quantityInput.value, price);
                } else {
                    var row = document.createElement('tr');
                    row.dataset.name = name;
                    
                    var nameCell = document.createElement('td');
                    nameCell.textContent = name;
                    row.appendChild(nameCell);
                    
                    var priceCell = document.createElement('td');
                    priceCell.textContent = '$' + price.toFixed(2);
                    row.appendChild(priceCell);
                    
                    var quantityCell = document.createElement('td');
                    var quantityInput = document.createElement('input');
                    quantityInput.type = 'number';
                    quantityInput.value =  1;
                    quantityInput.min =  1;
                    quantityCell.appendChild(quantityInput);
                    row.appendChild(quantityCell);
                    
                    var totalCell = document.createElement('td');
                    totalCell.textContent = `$${price.toFixed(2)}`;
                    row.appendChild(totalCell);
  
                    var deleteCell = document.createElement('td');
                    var deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.addEventListener('click', function() {
                        deleteOrderItem(row);
                    });
                    deleteCell.appendChild(deleteButton);
                    row.appendChild(deleteCell);
                    
                    orderedItemsBody.appendChild(row);
                }
            });
        });
  
        orderedItemsBody.addEventListener('input', function(event) {
            if (event.target.tagName === 'INPUT' && event.target.type === 'number') {
                var quantityInput = event.target;
                var row = quantityInput.closest('tr');
                var name = row.dataset.name;
                var price = parseFloat(row.cells[1].textContent.replace(/[^\d.]/g, ''));
                updateTotalPrice(row, quantityInput.value, price);
            }
        }, true);
  
        function deleteOrderItem(row) {
            orderedItemsBody.removeChild(row);
        }
    });
  
    function updateTotalPrice(row, quantity, price) {
        var totalCell = row.querySelector('td:nth-last-child(2)');
        totalCell.textContent = `$${(price * quantity).toFixed(2)}`;
    }
  </script>
</body>
</html>
