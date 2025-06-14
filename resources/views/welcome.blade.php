<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penjemputan Siswa SDIT Mutiara Hati</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Apply Inter font family to the body */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Hero section background image with a placeholder */
        .hero-bg {
            /* background-image: url('https://sditmh.sch.id/wp-content/uploads/2024/11/IMG_3456-1.jpg'); */
            background-image: url('{{ asset('images/backgrounds/slider-1.jpg') }}');
            /* Ganti dengan path gambar Anda jika perlu */
            background-size: cover;
            background-position: center;
        }

        /* Button scan transition for hover effects */
        .btn-scan {
            transition: all 0.3s ease;
        }

        /* Button scan hover effects */
        .btn-scan:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="https://placehold.co/50x50/BE185D/FFFFFF?text=Logo" alt="Logo SDIT Mutiara Hati"
                    class="h-10 w-10 mr-3 rounded-full">
                <span class="font-bold text-xl text-pink-700">SDIT Mutiara Hati</span>
            </div>
            <div class="hidden md:flex space-x-4 items-center">
                <a href="#fitur" class="text-gray-600 hover:text-pink-700">Fitur</a>
                <a href="#cara-kerja" class="text-gray-600 hover:text-pink-700">Cara Kerja</a>
                <a href="/admin/login"
                    class="bg-pink-700 hover:bg-pink-800 text-white font-medium py-2 px-4 rounded-lg transition duration-300">Login</a>
            </div>
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-gray-600 hover:text-pink-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </nav>
        <div id="mobile-menu" class="md:hidden hidden bg-white shadow-lg">
            <a href="#fitur" class="block px-6 py-3 text-gray-600 hover:bg-pink-100 hover:text-pink-700">Fitur</a>
            <a href="#cara-kerja" class="block px-6 py-3 text-gray-600 hover:bg-pink-100 hover:text-pink-700">Cara
                Kerja</a>
            <a href="#kontak" class="block px-6 py-3 text-gray-600 hover:bg-pink-100 hover:text-pink-700">Kontak</a>
            <a href="/admin/login"
                class="block px-6 py-3 text-pink-700 font-bold hover:bg-pink-100 hover:text-pink-800 border-t border-gray-100">Login</a>
        </div>
    </header>

    <section class="hero-bg text-white min-h-screen flex items-center justify-center">
        <div class="bg-black bg-opacity-60 p-8 md:p-16 rounded-lg text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Sistem Penjemputan Siswa <span class="text-pink-400">SDIT Mutiara Hati</span> Berbasis QR Code
            </h1>
            <p class="text-lg md:text-xl mb-8">
                Memastikan proses penjemputan siswa berjalan aman, cepat, dan terorganisir, sejalan dengan komitmen
                kami dalam membentuk generasi berakhlak mulia dan cerdas.
            </p>
            <!-- Scan QR Button -->
            <a href="{{ route('scan.page') }}" id="scan-qr-button-new"
                class="inline-block bg-pink-700 hover:bg-pink-800 text-white font-bold py-4 px-10 rounded-lg text-xl btn-scan shadow-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-opacity-50 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m6 11h2m-6.586l-4.243-4.243a1 1 0 010-1.414l4.243-4.243a1 1 0 011.414 0l4.243 4.243a1 1 0 010 1.414l-4.243 4.243a1 1 0 01-1.414 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m6 11h2M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Mulai Scan QR
            </a>
            <p class="mt-4 text-sm text-gray-300">Klik tombol di atas untuk memulai proses verifikasi penjemputan.</p>
        </div>
    </section>

    {{-- <section id="cara-kerja" class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Bagaimana Cara Kerjanya?</h2>
            <div class="flex flex-col md:flex-row items-center md:space-x-12">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <img src="https://placehold.co/600x400/FBCFE8/BE185D?text=Ilustrasi+Cara+Kerja"
                        alt="Ilustrasi Cara Kerja QR Code" class="rounded-lg shadow-xl w-full">
                </div>
                <div class="md:w-1/2 space-y-6">
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-pink-600 text-white rounded-full font-bold text-lg mr-4">
                            1</div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-700">Pendaftaran Penjemput</h4>
                            <p class="text-gray-600">Orang tua/wali mendaftarkan diri sebagai penjemput dan mendapatkan
                                QR Code unik.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-pink-600 text-white rounded-full font-bold text-lg mr-4">
                            2</div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-700">Scan QR Code Penjemput</h4>
                            <p class="text-gray-600">Saat menjemput, tunjukkan QR Code Anda langsung ke kamera alat
                                yang disediakan untuk scan.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-pink-600 text-white rounded-full font-bold text-lg mr-4">
                            3</div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-700">Verifikasi & Penjemputan</h4>
                            <p class="text-gray-600">Setelah data terverifikasi, siswa diizinkan pulang bersama
                                penjemput.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section id="cara-kerja" class="py-16 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Bagaimana Cara Kerjanya?</h2>
            <div class="flex flex-col md:flex-row items-center md:space-x-12">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <img src="{{ asset('images/alur-sistem-penjemputan.png') }}" alt="Ilustrasi Alur Sistem Penjemputan"
                        class="rounded-lg shadow-xl w-full">
                </div>
                <div class="md:w-1/2 space-y-6">
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-pink-600 text-white rounded-full font-bold text-lg mr-4">
                            1</div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-700">Pendaftaran Data oleh Admin</h4>
                            <p class="text-gray-600">Admin sekolah mendaftarkan data wali murid beserta data siswa yang
                                terkait. Sistem akan secara otomatis menghasilkan QR Code unik untuk setiap wali murid.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-pink-600 text-white rounded-full font-bold text-lg mr-4">
                            2</div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-700">Login & Unduh QR Code</h4>
                            <p class="text-gray-600">Wali murid dapat login ke dashboard khusus menggunakan akun yang
                                telah didaftarkan. Di dashboard, wali murid bisa mengunduh QR Code pribadi mereka dan
                                melihat riwayat penjemputan anak.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-pink-600 text-white rounded-full font-bold text-lg mr-4">
                            3</div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-700">Scan QR Saat Penjemputan</h4>
                            <p class="text-gray-600">Saat akan menjemput, wali murid cukup menunjukkan QR Code yang
                                telah diunduh (bisa dari HP atau dicetak) kepada petugas. Petugas akan melakukan scan
                                untuk verifikasi data secara cepat dan aman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="fitur" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Keunggulan Sistem Kami</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="flex items-center justify-center h-16 w-16 bg-pink-600 text-white rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center text-gray-700">Keamanan Terjamin</h3>
                    <p class="text-gray-600 text-center">
                        Verifikasi penjemput menggunakan QR Code unik untuk memastikan siswa dijemput oleh orang yang
                        tepat.
                    </p>
                </div>
                <div class="bg-gray-50 p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="flex items-center justify-center h-16 w-16 bg-pink-600 text-white rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center text-gray-700">Proses Cepat & Efisien</h3>
                    <p class="text-gray-600 text-center">
                        Mengurangi waktu tunggu dan antrian saat penjemputan siswa. Scan QR dan verifikasi instan.
                    </p>
                </div>
                <div class="bg-gray-50 p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div
                        class="flex items-center justify-center h-16 w-16 bg-pink-600 text-white rounded-full mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-center text-gray-700">Notifikasi Real-time</h3>
                    <p class="text-gray-600 text-center">
                        Orang tua/wali mendapatkan notifikasi saat siswa telah dijemput (fitur opsional).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div id="qr-scanner-modal"
        class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold text-gray-800">Scan QR Code Penjemput</h3>
                <button id="close-modal-button" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="scanner-container"
                class="w-full h-64 bg-gray-200 rounded-md flex items-center justify-center mb-4">
                <p class="text-gray-500">Kamera QR Scanner akan muncul di sini.</p>
            </div>
            <div id="scan-result" class="text-center text-gray-700">
                <p>Arahkan kamera ke QR Code penjemput.</p>
            </div>
            <button id="stop-scan-button"
                class="mt-4 w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg hidden">
                Hentikan Scan
            </button>
        </div>
    </div>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; <span id="current-year"></span> SDIT Mutiara Hati. Semua Hak Dilindungi.</p>
            <p>Dikembangkan untuk kemudahan dan keamanan bersama.</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden'); // Toggle visibility of mobile menu
        });

        // Set current year dynamically in the footer
        document.getElementById('current-year').textContent = new Date().getFullYear();

        // QR Scanner Modal Logic
        const scanQrButton = document.getElementById(
            'scan-qr-button'
        ); // ID ini sepertinya tidak ada di HTML, tombol utama di hero section memiliki id 'scan-qr-button-new'
        const scanQrButtonNew = document.getElementById(
            'scan-qr-button'); // Menggunakan ID yang benar dari Hero Section
        const qrScannerModal = document.getElementById('qr-scanner-modal');
        const closeModalButton = document.getElementById('close-modal-button');
        const scanResult = document.getElementById('scan-result');
        const stopScanButton = document.getElementById('stop-scan-button');
        const scannerContainer = document.getElementById('scanner-container');

        let html5QrCode; // Variable to store the scanner instance for control

        // Event listener to open the QR scanner modal
        if (scanQrButtonNew) { // Pastikan tombol ada sebelum menambah event listener
            scanQrButtonNew.addEventListener('click', (event) => { // tambahkan event parameter
                event.preventDefault(); // Mencegah link default jika ini adalah tag <a>
                qrScannerModal.classList.remove('hidden'); // Show the modal
                startScanner(); // Start the QR scanner
            });
        }


        // Event listener to close the QR scanner modal
        closeModalButton.addEventListener('click', () => {
            qrScannerModal.classList.add('hidden'); // Hide the modal
            stopScanner(); // Stop the QR scanner
        });

        // Event listener for the "Stop Scan" button
        stopScanButton.addEventListener('click', () => {
            stopScanner(); // Stop the scanner
            scanResult.innerHTML = '<p>Scan dihentikan. Klik "Mulai Scan QR" untuk memulai lagi.</p>';
            stopScanButton.classList.add('hidden'); // Hide the stop button
            scannerContainer.innerHTML =
                '<p class="text-gray-500">Kamera QR Scanner akan muncul di sini.</p>'; // Restore placeholder
        });

        // Close modal if clicked outside of it
        qrScannerModal.addEventListener('click', (event) => {
            if (event.target === qrScannerModal) { // Check if the click was on the modal background
                qrScannerModal.classList.add('hidden'); // Hide the modal
                stopScanner(); // Stop the scanner
            }
        });

        // Function to start the QR scanner
        function startScanner() {
            if (typeof Html5Qrcode !== 'undefined') {
                html5QrCode = new Html5Qrcode("scanner-container");
                const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                    scanResult.innerHTML =
                        `<p class="text-green-500 font-semibold">Scan Berhasil!</p><p>Data: ${decodedText}</p>`;
                    stopScanner();

                    // Redirect ke halaman scan.page dengan data QR Code
                    // Ganti dengan route yang sesuai jika diperlukan
                    // Ini adalah tempat Anda akan mengarahkan ke halaman /scan/validate-qr atau sejenisnya
                    window.location.href = `{{ route('scan.page') }}?qr_data=${encodeURIComponent(decodedText)}`;

                    // setTimeout(() => {
                    //     qrScannerModal.classList.add('hidden');
                    // }, 3000);
                };
                const config = {
                    fps: 10,
                    qrbox: {
                        width: 200,
                        height: 200
                    },
                    rememberLastUsedCamera: true
                };

                scannerContainer.innerHTML = '';
                stopScanButton.classList.remove('hidden');

                html5QrCode.start({
                        facingMode: "environment"
                    }, config, qrCodeSuccessCallback)
                    .catch(err => {
                        console.error("Tidak dapat memulai scanner:", err);
                        scanResult.innerHTML =
                            '<p class="text-red-500">Error: Tidak dapat mengakses kamera. Pastikan izin kamera diberikan.</p>';
                        scannerContainer.innerHTML =
                            '<p class="text-red-500 p-4">Gagal memulai kamera. Pastikan Anda memberikan izin akses kamera pada browser.</p>';
                        stopScanButton.classList.add('hidden');
                    });
            } else {
                scanResult.innerHTML =
                    '<p class="text-yellow-600">Fitur Scan QR memerlukan implementasi library (Html5Qrcode tidak termuat).</p>';
                scannerContainer.innerHTML =
                    '<p class="text-gray-500 p-4">Placeholder kamera. Library scanner QR tidak termuat.</p>';
                stopScanButton.classList.add('hidden');
            }
        }

        // Function to stop the QR scanner
        function stopScanner() {
            if (html5QrCode && typeof html5QrCode.stop === 'function') {
                html5QrCode.stop().then(ignore => {
                    console.log("QR Code scanning stopped.");
                }).catch(err => {
                    console.error("Gagal menghentikan scanner:", err);
                }).finally(() => {
                    html5QrCode = null;
                    stopScanButton.classList.add('hidden');
                    scannerContainer.innerHTML =
                        '<p class="text-gray-500">Kamera QR Scanner akan muncul di sini.</p>'; // Reset tampilan
                });
            } else if (html5QrCode && html5QrCode
                .isScanning) { // Fallback for older library version or different state check
                html5QrCode.clear(); // Or other clear/stop method if 'stop' is not available
                html5QrCode = null;
                stopScanButton.classList.add('hidden');
                scannerContainer.innerHTML = '<p class="text-gray-500">Kamera QR Scanner akan muncul di sini.</p>';
            }
        }

        // Smooth scroll for anchor links in navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                mobileMenu.classList.add('hidden');

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
