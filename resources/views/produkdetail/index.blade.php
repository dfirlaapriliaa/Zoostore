<x-layout>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Detail Produk Sepatu Balita - Tokoku</title>

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
            integrity="sha512-zsNfQSmT6e95InHCXcmvNt95hK8mCs2+X6Qa8zJ8bHkqOM59wjYFSb6nKyekD+63XVDxwkStzUrLEbH1cj6FMA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            .swal2-popup {
                background: #fff !important;
                color: #222 !important;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .swal2-title {
                color: #000 !important;
            }

            .swal2-confirm {
                background-color: #222 !important;
                color: #fff !important;
            }

            .swal2-cancel {
                background-color: #555 !important;
                color: #fff !important;
            }

            /* Modal bottom sheet ala Shopee */
            #buyNowModal {
                transform: translateY(100%);
                transition: transform 0.4s ease-in-out;
            }

            #buyNowModal.show {
                transform: translateY(0);
            }

            .star {
                cursor: pointer;
                font-size: 1.75rem;
                color: lightgray;
                transition: color 0.2s;
            }

            .star.selected {
                color: gold;
            }

            .review-action {
                cursor: pointer;
                margin-left: 8px;
                font-size: 0.9rem;
                color: #555;
                transition: color 0.2s;
            }

            .review-action:hover {
                color: #000;
            }
        </style>
    </head>

    <body class="bg-gray-50 text-gray-900">
        <!-- Banner Promo -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-500 py-3">
            <div class="container mx-auto px-6 text-center text-white">
                <p class="text-lg font-bold">
                    Dapatkan <span class="underline">kupon diskon 10%</span> untuk pembelian pertama! Gunakan kode:
                    <span class="bg-white text-pink-500 px-2 rounded">WELCOME10</span>
                </p>
            </div>
        </div>
        </header>

        <main class="container mx-auto p-6 mt-6 space-y-10">
            <!-- Produk Detail -->
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-xl p-6 md:flex">
                    <!-- Gambar Produk -->
                    <div class="md:w-1/2 flex justify-center items-center relative">
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}"
                            class="w-full md:w-96 rounded-lg transform hover:scale-105 transition duration-300" />
                        <!-- Badge Flash Sale -->
                        @if ($product->diskon)
                            <div
                                class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold shadow">
                                Flash Sale!
                            </div>
                        @endif
                    </div>
                    <!-- Informasi Produk -->
                    <div class="md:w-1/2 mt-6 md:mt-0 md:ml-8">
                        <h2 class="text-3xl font-extrabold text-gray-900">{{ $product->name }}</h2>
                        <p class="mt-2 text-gray-600 text-lg">Harga Jual Spesial</p>
                        <div class="flex items-center space-x-4 my-3">
                            <p class="text-3xl font-bold text-red-500">
                                Rp{{ number_format($product->diskon ? $product->harga_diskon : $product->price, 0, ',', '.') }}
                            </p>
                            @if ($product->diskon)
                                <button
                                    class="bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-semibold px-3 py-1 rounded shadow transition">
                                    Dapatkan Kupon
                                </button>
                            @endif
                        </div>
                        <span class="inline-block bg-yellow-500 text-black font-semibold px-4 py-2 rounded-full">
                            Stok: {{ $product->stock }} Produk
                        </span>
                        <p class="mt-3 text-gray-700"><strong>Motif Produk:</strong> {{ $product->description }}</p>
                        <p class="mt-2 text-gray-700"><strong>Warna:</strong>
                            {{ $product->color ?? 'Variatif & Trendy' }}</p>
                        <p class="mt-2 text-gray-700"><strong>Fitur:</strong>
                            {{ $product->features ?? 'Anti slip, ringan & mudah dibersihkan' }}</p>

                        <!-- Info Pengiriman & Jaminan -->
                        <div class="mt-5 space-y-2">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-truck text-2xl text-blue-500"></i>
                                <span class="text-gray-700">Pengiriman cepat ke seluruh Indonesia</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-shield-alt text-2xl text-green-500"></i>
                                <span class="text-gray-700">Garansi produk 100%</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-headset text-2xl text-purple-500"></i>
                                <span class="text-gray-700">Layanan pelanggan 24/7</span>
                            </div>
                        </div>
                        <hr class="my-5" />

                        <!-- Tab Informasi -->
                        <div>
                            <ul class="flex border-b">
                                <li class="mr-1">
                                    <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold cursor-pointer"
                                        onclick="showTab('descTab')">Deskripsi</a>
                                </li>
                                <li class="mr-1">
                                    <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold cursor-pointer"
                                        onclick="showTab('specTab')">Spesifikasi</a>
                                </li>
                                <li class="mr-1">
                                    <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold cursor-pointer"
                                        onclick="showTab('reviewTab')">Review</a>
                                </li>
                            </ul>
                            <!-- Konten Tab -->
                            <div class="pt-4">
                                <div id="descTab" class="tab-content">
                                    <h3 class="text-xl font-bold mb-2">Deskripsi Produk</h3>
                                    <p class="text-gray-700">{{ $product->description }}</p>
                                </div>
                                <div id="specTab" class="tab-content hidden">
                                    <h3 class="text-xl font-bold mb-2">Spesifikasi Produk</h3>
                                    <ul class="list-disc list-inside text-gray-700">
                                        <li>Material: {{ $product->material ?? 'Belum tersedia' }}</li>
                                        <li>Ukuran: {{ $product->sizes ?? 'Tidak tersedia' }}</li>
                                        <li>Warna: {{ $product->color ?? 'Tidak tersedia' }}</li>
                                        <li>Fitur: {{ $product->features ?? 'Belum tersedia' }}</li>
                                    </ul>
                                </div>
                                <div id="reviewTab" class="tab-content hidden">
                                    <h3 class="text-xl font-bold mb-2">Ulasan Produk</h3>
                                    <div id="reviewsContainer" class="space-y-5">
                                        @foreach ($product->reviews as $review)
                                            <div class="flex items-center gap-5 bg-gray-100 p-5 rounded-lg shadow-md">
                                                <img src="{{ asset('storage/' . $review->user->avatar) }}"
                                                    alt="User" class="w-14 h-14 rounded-full shadow-lg" />
                                                <div>
                                                    <p class="font-bold text-lg">
                                                        {{ $review->user->name }} <span
                                                            class="text-yellow-500">★★★★☆</span>
                                                    </p>
                                                    <p class="text-gray-600">{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <button type="button"
                                class="w-full bg-gradient-to-r from-black to-gray-800 text-white py-3 px-8 rounded-lg shadow-lg hover:scale-105 transition"
                                onclick="toggleBuyNowModal(true)">
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </main>

        <!-- Modal Bottom Sheet ala Shopee -->
        <div id="buyNowModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-end flex-col hidden">
            <div class="bg-white rounded-t-2xl p-6 w-full max-w-full mx-auto"
                style="max-height: 90vh; overflow-y: auto;">
                <div class="flex justify-center items-center mb-4">
                    <div class="w-16 h-1 bg-gray-300 rounded-full"></div>
                </div>
                <div class="flex items-center gap-4 mb-3">
                    <img src="{{ asset('/assets/baby.jpeg') }}" alt="Sepatu Balita"
                        class="w-20 h-20 object-cover rounded-lg border border-gray-300" />
                    <div>
                        <p class="text-lg font-bold text-gray-800">Sepatu Balita</p>
                        <p class="text-sm text-red-500 font-semibold">Rp. 30.000</p>
                    </div>
                    <button class="ml-auto text-gray-500" onclick="toggleBuyNowModal(false)">✕</button>
                </div>
                <!-- Pilihan Warna -->
                <div class="mb-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Warna:</label>
                    <div class="flex items-center gap-2 overflow-x-auto pb-2">
                        <div class="border border-gray-300 rounded-lg p-1 cursor-pointer hover:shadow"
                            onclick="selectColor('Warna 1')">
                            <img src="{{ asset('/assets/baby.jpeg') }}" class="w-16 h-16 object-cover rounded"
                                alt="Warna 1" />
                        </div>
                        <div class="border border-gray-300 rounded-lg p-1 cursor-pointer hover:shadow"
                            onclick="selectColor('Warna 2')">
                            <img src="{{ asset('/assets/baby.jpeg') }}" class="w-16 h-16 object-cover rounded"
                                alt="Warna 2" />
                        </div>
                        <div class="border border-gray-300 rounded-lg p-1 cursor-pointer hover:shadow"
                            onclick="selectColor('Warna 3')">
                            <img src="{{ asset('/assets/baby.jpeg') }}" class="w-16 h-16 object-cover rounded"
                                alt="Warna 3" />
                        </div>
                    </div>
                    <p id="selectedColor" class="mt-2 text-gray-600 text-sm">Warna yang dipilih: <span
                            class="font-bold">-</span></p>
                </div>
                <!-- Pilih Ukuran -->
                <div class="mb-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Ukuran:</label>
                    <div class="flex flex-wrap gap-2" id="sizeOptions">
                        <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-100 focus:outline-none"
                            onclick="selectSize(event, '18')">18</button>
                        <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-100 focus:outline-none"
                            onclick="selectSize(event, '19')">19</button>
                        <button class="px-3 py-2 border border-gray-300 rounded hover:bg-gray-100 focus:outline-none"
                            onclick="selectSize(event, '20')">20</button>
                    </div>
                    <p id="selectedSize" class="mt-2 text-gray-600 text-sm">Ukuran yang dipilih: <span
                            class="font-bold">-</span></p>
                </div>
                <!-- Jumlah Pesanan -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Pesanan:</label>
                    <div class="flex items-center gap-3 w-32">
                        <button class="px-3 py-1 bg-gray-200 text-gray-800 rounded" onclick="updateQty(-1)">-</button>
                        <input id="quantityInput" type="number" min="1" value="1"
                            class="w-12 text-center border border-gray-300 rounded focus:outline-none" />
                        <button class="px-3 py-1 bg-gray-200 text-gray-800 rounded" onclick="updateQty(1)">+</button>
                    </div>
                </div>
                <!-- Tombol Check Out & Keranjang -->
                <div class="grid grid-cols-2 gap-3">
                    <button class="bg-black text-white py-3 px-4 rounded-lg shadow-lg hover:bg-gray-800 transition"
                        onclick="goToCheckout()">
                        Check Out
                    </button>
                    <button class="bg-gray-500 text-white py-3 px-4 rounded-lg shadow-lg hover:bg-gray-600 transition"
                        onclick="addToCart()">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>

        <!-- Script Utama -->
        <script>
            // ===============================================
            // Konstanta & Variabel
            // ===============================================
            const purchased = true; // Ubah ke false jika user belum membeli
            const itemCode = "SBALITA-001"; // Code produk
            const STORAGE_KEY = `reviewsData_${itemCode}`;
            let reviewsData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

            // ===============================================
            // Fungsi Tab untuk Deskripsi, Spesifikasi, Review
            // ===============================================
            function showTab(tabId) {
                document.querySelectorAll('.tab-content').forEach(tab => {
                    tab.classList.add('hidden');
                });
                document.getElementById(tabId).classList.remove('hidden');
            }
            // Inisialisasi Tab awal
            showTab('descTab');

            // ===============================================
            // Render Reviews di dua tempat (Tab & Section Review)
            // ===============================================
            function renderReviews() {
                const reviewsContainer = document.getElementById("reviewsContainer2");
                reviewsContainer.innerHTML = "";
                reviewsData.forEach(rv => {
                    const div = document.createElement("div");
                    div.className = "flex items-center gap-5 bg-gray-100 p-5 rounded-lg shadow-md mt-3";

                    const img = document.createElement("img");
                    img.src = rv.photo ? rv.photo : "https://via.placeholder.com/56";
                    img.className = "w-14 h-14 rounded-full shadow-lg";

                    const infoDiv = document.createElement("div");
                    const title = document.createElement("p");
                    title.innerHTML =
                        `${rv.name} <span class="text-yellow-500">${"★".repeat(rv.rating)}${"☆".repeat(5 - rv.rating)}</span>`;
                    title.className = "font-bold text-lg";

                    const text = document.createElement("p");
                    text.textContent = rv.text;
                    text.className = "text-gray-600";

                    const actions = document.createElement("div");
                    actions.className = "mt-2";

                    const editBtn = document.createElement("button");
                    editBtn.className = "review-action";
                    editBtn.innerHTML = '<i class="fas fa-edit"></i> Edit';
                    editBtn.addEventListener("click", () => editReview(rv.id));

                    const deleteBtn = document.createElement("button");
                    deleteBtn.className = "review-action";
                    deleteBtn.innerHTML = '<i class="fas fa-trash"></i> Hapus';
                    deleteBtn.addEventListener("click", () => deleteReview(rv.id));

                    actions.appendChild(editBtn);
                    actions.appendChild(deleteBtn);

                    infoDiv.appendChild(title);
                    infoDiv.appendChild(text);
                    infoDiv.appendChild(actions);

                    div.appendChild(img);
                    div.appendChild(infoDiv);

                    reviewsContainer.appendChild(div);
                });
            }
            // Panggil renderReviews saat load
            renderReviews();

            // ===============================================
            // Section Review (Form review)
            // ===============================================
            const reviewFormContainer = document.getElementById("reviewFormContainer");
            if (!purchased) {
                const msg = document.createElement("p");
                msg.className = "text-red-500 font-semibold";
                msg.textContent = "Anda belum pernah membeli barang ini. Tidak bisa memberikan ulasan.";
                reviewFormContainer.appendChild(msg);
            } else {
                reviewFormContainer.innerHTML = `
      `;

                const reviewForm = document.getElementById("reviewForm");
                const starContainer = document.getElementById("starContainer");
                const stars = starContainer.querySelectorAll(".star");
                let currentRating = 0;

                stars.forEach(star => {
                    star.addEventListener("click", () => {
                        currentRating = parseInt(star.getAttribute("data-value"));
                        stars.forEach(s => {
                            s.classList.toggle("selected", parseInt(s.getAttribute("data-value")) <=
                                currentRating);
                        });
                    });
                });

                const reviewPhoto = document.getElementById("reviewPhoto");
                const photoPreview = document.getElementById("photoPreview");
                const photoSizeSlider = document.getElementById("photoSizeSlider");
                let previewImgEl = null;

                reviewPhoto.addEventListener("change", () => {
                    photoPreview.innerHTML = "";
                    if (reviewPhoto.files && reviewPhoto.files.length > 0) {
                        const file = reviewPhoto.files[0];
                        const imgUrl = URL.createObjectURL(file);
                        previewImgEl = document.createElement("img");
                        previewImgEl.src = imgUrl;
                        previewImgEl.className = "object-cover rounded border border-gray-300";
                        previewImgEl.style.width = photoSizeSlider.value + "px";
                        photoPreview.appendChild(previewImgEl);
                    }
                });

                photoSizeSlider.addEventListener("input", (e) => {
                    if (previewImgEl) {
                        previewImgEl.style.width = e.target.value + "px";
                    }
                });

                reviewForm.addEventListener("submit", function(e) {
                    e.preventDefault();
                    if (currentRating === 0) {
                        Swal.fire({
                            title: "Mohon beri rating bintang!",
                            icon: "warning",
                            confirmButtonText: "OK"
                        });
                        return;
                    }

                    const reviewName = document.getElementById("reviewName").value.trim();
                    const reviewText = this.querySelector("textarea").value.trim();
                    let reviewPhotoURL = "";

                    if (reviewPhoto.files && reviewPhoto.files.length > 0) {
                        const file = reviewPhoto.files[0];
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            reviewPhotoURL = evt.target.result;
                            saveReviewToStorage(reviewName, currentRating, reviewText, reviewPhotoURL);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        saveReviewToStorage(reviewName, currentRating, reviewText, "");
                    }
                });

                function saveReviewToStorage(name, rating, text, photo) {
                    const newReview = {
                        id: Date.now(),
                        name,
                        rating,
                        text,
                        photo
                    };
                    reviewsData.push(newReview);
                    localStorage.setItem(STORAGE_KEY, JSON.stringify(reviewsData));
                    Swal.fire({
                            title: "Review berhasil ditambahkan!",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false
                        })
                        .then(() => {
                            reviewForm.reset();
                            photoPreview.innerHTML = "";
                            stars.forEach(s => s.classList.remove("selected"));
                            currentRating = 0;
                            renderReviews();
                        });
                }

                function editReview(reviewId) {
                    const review = reviewsData.find(r => r.id === reviewId);
                    if (!review) return;
                    Swal.fire({
                        title: "Edit Review",
                        html: `<textarea id="swal-input" class="swal2-textarea" placeholder="Ubah review Anda di sini...">${review.text}</textarea>`,
                        focusConfirm: false,
                        showCancelButton: true,
                        preConfirm: () => {
                            const newText = document.getElementById("swal-input").value.trim();
                            if (!newText) {
                                Swal.showValidationMessage("Review tidak boleh kosong!");
                            }
                            return newText;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            review.text = result.value;
                            localStorage.setItem(STORAGE_KEY, JSON.stringify(reviewsData));
                            renderReviews();
                            Swal.fire({
                                title: "Review berhasil diupdate!",
                                icon: "success",
                                timer: 1200,
                                showConfirmButton: false
                            });
                        }
                    });
                }

                function deleteReview(reviewId) {
                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Review akan dihapus secara permanen.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            reviewsData = reviewsData.filter(r => r.id !== reviewId);
                            localStorage.setItem(STORAGE_KEY, JSON.stringify(reviewsData));
                            renderReviews();
                            Swal.fire({
                                title: "Review telah dihapus!",
                                icon: "success",
                                timer: 1200,
                                showConfirmButton: false
                            });
                        }
                    });
                }

                // Pastikan tombol edit dan hapus tersedia saat render
                window.editReview = editReview;
                window.deleteReview = deleteReview;
            }

            // ===============================================
            // Fungsi Modal Beli Sekarang & Pilihan
            // ===============================================
            let selectedColorValue = "";
            let selectedSizeValue = "";

            function toggleBuyNowModal(show) {
                const modal = document.getElementById("buyNowModal");
                if (show) {
                    modal.classList.remove("hidden");
                    setTimeout(() => modal.classList.add("show"), 10);
                } else {
                    modal.classList.remove("show");
                    setTimeout(() => modal.classList.add("hidden"), 400);
                }
            }

            function selectColor(colorName) {
                selectedColorValue = colorName;
                document.getElementById("selectedColor").innerHTML =
                    `Warna yang dipilih: <span class="font-bold">${colorName}</span>`;
            }

            function selectSize(e, size) {
                e.preventDefault();
                selectedSizeValue = size;
                document.querySelectorAll("#sizeOptions button").forEach(btn => btn.classList.remove("bg-gray-200", "ring-2",
                    "ring-black"));
                e.target.classList.add("bg-gray-200", "ring-2", "ring-black");
                document.getElementById("selectedSize").innerHTML =
                    `Ukuran yang dipilih: <span class="font-bold">${size}</span>`;
            }

            function updateQty(val) {
                const qtyInput = document.getElementById("quantityInput");
                let currentVal = parseInt(qtyInput.value) || 1;
                qtyInput.value = Math.max(currentVal + val, 1);
            }

            function goToCheckout() {
                if (!selectedColorValue) {
                    Swal.fire({
                        title: "Harap pilih warna dahulu!",
                        icon: "warning",
                        confirmButtonText: "OK"
                    });
                    return;
                }
                if (!selectedSizeValue) {
                    Swal.fire({
                        title: "Harap pilih ukuran dahulu!",
                        icon: "warning",
                        confirmButtonText: "OK"
                    });
                    return;
                }
                const quantity = document.getElementById("quantityInput").value;
                Swal.fire({
                    title: "Redirect ke Checkout",
                    text: `Warna: ${selectedColorValue}, Ukuran: ${selectedSizeValue}, Jumlah: ${quantity}`,
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "/checkout";
                });
            }

            function addToCart() {
                Swal.fire({
                    title: "Item berhasil ditambahkan ke keranjang!",
                    icon: "success",
                    timer: 1200,
                    showConfirmButton: false
                });
                toggleBuyNowModal(false);
            }
        </script>
    </body>

    </html>
</x-layout>
