<x-admin-layout>
    <div class="h-screen flex flex-col">
        <div class="container mx-auto py-8 flex-grow">
            <h1 class="text-3xl font-bold mb-8 text-center">Contact Us</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Alamat Lengkap -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-map-marker-alt text-blue-500 text-3xl mr-4"></i>
                        <h2 class="text-xl font-semibold">Alamat Lengkap</h2>
                    </div>
                    <p>Jalan KH. Hasyim Ashari No. 123</p>
                    <p>Kelurahan Cipanas, Kecamatan Cipanas</p>
                    <p>Kota Cianjur, Jawa Barat</p>
                    <p>Kode Pos: 43253</p>
                    <p>Indonesia</p>
                    <p>No. Telepon: 08098080823</p>
                    <p>Email: jagooo@company.com</p>
                </div>

                <!-- Foto Kantor -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Foto Kantor</h2>
                    <img src="https://www.emporioarchitect.com/upload/portofolio/1280/desain-kantor-modern-2-lantai-18210322-14835242180822032038.jpg" alt="Foto Kantor" class="w-full rounded-lg">
                </div>

                <!-- Google Maps -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Lokasi Kantor</h2>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.483005392136!2d106.82282921426682!3d-6.229728995484402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f65fdafe6d3f%3A0xb5efdd33667eb1b3!2sMonumen%20Nasional!5e0!3m2!1sen!2sid!4v1648541776056!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Form Pertanyaan -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4 text-center">Pertanyaan untuk Developer</h2>
                <form action="#" method="post" class="max-w-lg mx-auto">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Nama</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-700 font-semibold mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Kirim Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>