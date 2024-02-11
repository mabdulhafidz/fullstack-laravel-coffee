<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Menu</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body class="bg-gray-100">
    {{-- Category and Menu --}}
  <main class="ml-8 mt-4 mb-8">
    <div class="flex flex-col md:flex-row">
      <div class="w-full md:w-1/2 pr-4">
        <h2 class="text-2xl font-bold mb-4">Menu</h2>
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
    <table class="w-full table-fixed bg-white shadow-md rounded-md">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">Name</th>
          <th class="py-2 px-4 border-b">Price</th>
          <th class="py-2 px-4 border-b">Quantity</th>
          <th class="py-2 px-4 border-b">Total</th>
          <th class="py-2 px-4 border-b">Action</th>
        </tr>
      </thead>
      <tbody class="ordered-items"> 
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="text-right font-bold py-2 px-4">Subtotal</td>
          <td id="subtotal" class="font-bold py-2 px-4">$0.00</td>
          <td class="py-2 px-4"></td>
        </tr>
      </tfoot>
    </table>
    <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-green" id="printBillButton">
      Print Bill
    </button>
  </div>
  

    </div>

  </main>

  @push('script') 
  <script>
    $(document).ready(function () {
      $('.category-menu').hide();
      $('.category-btn').on('click', function () {
        var categorySlug = $(this).data('category');
        $('.category-menu').hide();
        $('.category-menu[data-category="' + categorySlug + '"]').show();
      });
    });
  </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var menuItems = document.getElementsByClassName('menu-item');
        var orderedItemsBody = document.querySelector('.ordered-items');
        var subtotalElement = document.getElementById('subtotal');

        Array.prototype.forEach.call(menuItems, function (menuItem) {
            menuItem.addEventListener('click', function () {
                var name = this.getAttribute('data-name');
                var price = parseFloat(this.getAttribute('data-price'));

                var existingRow = orderedItemsBody.querySelector(`tr[data-name="${name}"]`);
                if (existingRow) {
                  
                    var quantityInput = existingRow.querySelector('input[type="number"]');
                    quantityInput.value = parseInt(quantityInput.value) + 1;
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
                    quantityInput.value = 1;
                    quantityInput.min = 1;
                    quantityCell.appendChild(quantityInput);
                    row.appendChild(quantityCell);

                    var totalCell = document.createElement('td');
                    totalCell.textContent = `$${price.toFixed(2)}`;
                    row.appendChild(totalCell);

                    var deleteCell = document.createElement('td');
                    var deleteButton = document.createElement('button');
                    deleteButton.innerHTML = '<svg class="h-6 w-6 text-red-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>';
                    deleteButton.classList.add('text-red-500', 'hover:text-red-700');
                    deleteButton.addEventListener('click', function () {
                        deleteOrderItem(row);
                        updateSubtotal();
                    });
                    deleteCell.appendChild(deleteButton);
                    row.appendChild(deleteCell);

                    orderedItemsBody.appendChild(row);
                    updateSubtotal();
                }
            });
        });

        orderedItemsBody.addEventListener('input', function (event) {
            if (event.target.tagName === 'INPUT' && event.target.type === 'number') {
                var quantityInput = event.target;
                var row = quantityInput.closest('tr');
                var name = row.dataset.name;
                var price = parseFloat(row.cells[1].textContent.replace(/[^\d.]/g, ''));
                updateTotalPrice(row, quantityInput.value, price);
                updateSubtotal();
            }
        }, true);

        function deleteOrderItem(row) {
            orderedItemsBody.removeChild(row);
            updateSubtotal();
        }

        function updateTotalPrice(row, quantity, price) {
            var totalCell = row.querySelector('td:nth-last-child(2)');
            totalCell.textContent = `$${(price * quantity).toFixed(2)}`;
        }

        function updateSubtotal() {
            var rows = orderedItemsBody.getElementsByTagName('tr');
            var subtotal = 0;

            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];
                var price = parseFloat(row.cells[1].textContent.replace(/[^\d.]/g, ''));
                var quantity = parseInt(row.cells[2].querySelector('input[type="number"]').value);
                subtotal += price * quantity;
            }

            subtotalElement.textContent = '$' + subtotal.toFixed(2);
        }
    });
</script>

</body>
</html>
