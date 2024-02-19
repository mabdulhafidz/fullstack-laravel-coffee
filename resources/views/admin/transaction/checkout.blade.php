

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-blue-gray-50">
  <div class="flex">
    <!-- Menu Column -->
    <div class="w-full md:w-1/2 p-4">
        <div class="h-full mt-4">
            <h2 class="text-2xl font-bold mb-4">Menu</h2>

                  <!-- store menu -->
                  <div class="flex flex-col bg-blue-gray-50 h-full w-full py-4">
                    <div class="flex mb-4">
                      @foreach ($categories as $category)
                          <button class="mr-4 px-4 py-2 bg-gray-300 hover:bg-green-600 text-black hover:text-white focus:outline-none focus:shadow-outline-blue category-btn rounded-full" data-category="{{ $category->slug }}">
                              {{ $category->name }}
                          </button>
                      @endforeach
                  </div>
                      <div class="flex px-2 flex-row relative">
                          <div class="absolute left-5 top-3 px-2 py-2 rounded-full bg-cyan-500 text-white">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                              </svg>
                          </div>
                          <input
                              type="text"
                              class="bg-white rounded-3xl shadow text-lg w-full h-16 py-4 pl-16 transition-shadow focus:shadow-2xl focus:outline-none"
                              placeholder="Cari menu ..."
                              x-model="keyword"
                          />
                      </div>
                          </div>
                      </div>
                  </div>
              </div>
            
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3" id="menuItems">
                  @foreach ($categories as $category)
                      @foreach ($category->menus as $menu)
                          <div class="mb-4 category-menu" data-category="{{ $category->slug }}">
                              <h3 class="text-xl font-semibold mb-2">{{ $category->name }}</h3>
                              <div class="border p-4 rounded-md shadow-md hover:shadow-lg transition-transform transform hover:scale-105">
                                  <h3 class="text-lg font-semibold">{{ $menu->name }}</h3>
                                  <p class="text-gray-600">{{ $menu->description }}</p>
                                  <p class="text-gray-600">$ {{ $menu->price }}</p>
                                  <p class="text-gray-600">Stock: {{ isset($menu->stocks) ? $menu->stocks->jumlah : 'Sold Out' }}</p>
      
                                  @if(isset($menu->stocks) && $menu->stocks->jumlah > 0)
                                      <button
                                          class="bg-blue-500 text-white menu-item mt-4 px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                                          data-name="{{ $menu->name }}"
                                          data-price="{{ $menu->price }}"
                                          data-stock="{{ $menu->stocks->jumlah }}">
                                          Add to Order
                                      </button>
                                  @else
                                      <p>Maaf, stock sudah habis</p>
                                      <button
                                          class="bg-dark-600 text-white menu-item mt-4 px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue"
                                          data-name="{{ $menu->name }}"
                                          data-price="{{ $menu->price }}">
                                          Add to Order
                                      </button>
                                  @endif
                              </div>
                          </div>
                      @endforeach
                  @endforeach
              </div>
          </div>
        </div>

        <!-- Order Column -->
        <div class="w-full md:w-1/2 bg-gray-500 p-4">
          <h2 class="text-2xl font-bold mb-4">Order</h2>
            <table class="w-full table-fixed shadow-md rounded-md bg-gray-100">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Quantity</th>
                        <th class="py-2 px-4 border-b">Total</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody class="ordered-items"></tbody>
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

    function addToOrder(menuId, quantity) {
    let currentStock = document.querySelector(`button[data-menu-id="${menuId}"]`).dataset.stock;
    if (quantity <= currentStock) {
        // Kurangi stok
        currentStock -= quantity;
        // Perbarui tampilan stok
        document.querySelector(`button[data-menu-id="${menuId}"]`).textContent = `Stock: ${currentStock}`;
        
        // Jika stok habis, nonaktifkan tombol dan ubah warna
        if (currentStock <=  0) {
            document.querySelector(`button[data-menu-id="${menuId}"]`).disabled = true;
            document.querySelector(`button[data-menu-id="${menuId}"]`).classList.remove('bg-blue-500');
            document.querySelector(`button[data-menu-id="${menuId}"]`).classList.add('bg-gray-500');
            // Tampilkan pesan
            document.querySelector(`button[data-menu-id="${menuId}"]`).insertAdjacentHTML('afterend', '<p>Maaf, stock sudah habis</p>');
        }
    } else {
        // Jika stok tidak cukup, tampilkan pesan
        alert('Maaf, stok tidak cukup untuk menambahkan item ini ke keranjang.');
    }
}
</script>

</body>
</html>