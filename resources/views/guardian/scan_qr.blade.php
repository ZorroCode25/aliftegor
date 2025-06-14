<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pindai QR Code Kehadiran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        :root {
            --theme-color-fuchsia: #C2185B;
            --theme-color-fuchsia-dark: #AD1457;
            --theme-color-fuchsia-light: #F8BBD0;
            --text-on-fuchsia: #FFFFFF;
            --card-bg: #FFFFFF;
            --body-bg: #f4f6f9;
            --text-color: #333;
            --border-color: #e0e0e0;
        }

        body {
            background-color: var(--body-bg);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-fuchsia {
            background-color: var(--theme-color-fuchsia);
        }

        .navbar-fuchsia .navbar-brand,
        .navbar-fuchsia .nav-link {
            color: var(--text-on-fuchsia);
        }

        .navbar-fuchsia .nav-link.active,
        .navbar-fuchsia .nav-link:hover,
        .navbar-fuchsia .navbar-brand:hover {
            color: var(--theme-color-fuchsia-light);
        }

        .navbar-fuchsia .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .footer {
            background-color: #FFFFFF;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
            padding-bottom: 1rem;
            color: #6c757d;
        }

        #qr-reader-container {
            max-width: 500px;
            margin: 20px auto;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            /* Penting untuk styling video scanner */
        }

        #qr-reader {
            width: 100%;
            border: none;
            /* Hilangkan border default jika ada dari library */
        }

        #qr-reader__dashboard_section_csr>div:first-child {
            /* Menargetkan tombol "Request Camera Permissions" */
            display: flex;
            justify-content: center;
            padding: 1rem;
        }

        #qr-reader__dashboard_section_csr button {
            background-color: var(--theme-color-fuchsia) !important;
            color: var(--text-on-fuchsia) !important;
            border: none !important;
            padding: 0.5rem 1rem !important;
            font-size: 1rem !important;
            border-radius: 0.25rem !important;
        }

        .scan-status {
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 10px;
            min-height: 20px;
            /* Untuk ruang pesan */
        }

        .card-scan-info {
            border-left: 5px solid var(--theme-color-fuchsia);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-fuchsia shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Pemindaian</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Pindai QR</a></li>
                    {{-- Tambahkan link lain jika perlu, misal kembali ke dashboard admin --}}
                    {{-- <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4 mb-5 flex-fill">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm card-scan-info mb-4">
                    <div class="card-body">
                        <h4 class="card-title" style="color: var(--theme-color-fuchsia);"><i
                                class="bi bi-qr-code-scan"></i> Pindai QR Code Wali Murid</h4>
                        <p class="card-text text-muted">Arahkan kamera ke QR Code yang dimiliki oleh wali murid. Sistem
                            akan otomatis mendeteksi dan memproses QR Code.</p>
                    </div>
                </div>

                <div id="qr-reader-container" class="bg-light p-3 shadow-sm">
                    <div id="qr-reader"></div>
                </div>
                <div id="scan-status" class="scan-status">Menunggu kamera...</div>


                <!-- Tombol Tes Scan -->
                <!--<div class="text-center mt-4">-->
                <!--    <button class="btn btn-outline-primary" onclick="showTestForm()">-->
                <!--        <i class="bi bi-terminal"></i> Tes Scan Manual-->
                <!--    </button>-->
                <!--</div>-->

                <!-- Modal Tes Scan -->
                <div class="modal fade" id="testScanModal" tabindex="-1" aria-labelledby="testScanModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="modal-content" onsubmit="submitTestScan(event)">
                            <div class="modal-header">
                                <h5 class="modal-title" id="testScanModalLabel">Tes Scan Manual</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <label for="manualScanInput" class="form-label">Masukkan nilai QR Code:</label>
                                <input type="text" id="manualScanInput" class="form-control"
                                    placeholder="Misal: WALI12345" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between small">
                <div class="text-muted">Hak Cipta &copy; {{ date('Y') }}</div>
                <div>
                    <a href="#" class="text-decoration-none me-2"
                        style="color: var(--theme-color-fuchsia);">Bantuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // hentikan pemindaian
            html5QrcodeScanner.clear().catch(error => {
                console.error("Gagal membersihkan scanner.", error);
            });

            document.getElementById('scan-status').innerText = `QR Code terdeteksi: ${decodedText}`;
            console.log(`Scan result: ${decodedText}`, decodedResult);


            const validationUrl = `{{ route('scan.validateQr') }}?qr_code=${encodeURIComponent(decodedText)}`;

            Swal.fire({
                title: 'Memproses QR...',
                text: 'Mengirim data QR untuk validasi.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            // Simulasi AJAX call dan redirect
            setTimeout(() => {
                // Ganti ini dengan URL sebenarnya yang akan diberikan oleh Controller setelah validasi QR
                // Misal: window.location.href = `/scan/konfirmasi/${studentId}`;
                // Untuk sekarang, kita asumsikan ada route 'scan.showConfirmation' yang menerima ID
                // Atau Controller Anda yang mengarahkan ke `scan.showConfirmation` dengan data
                const baseUrl = "{{ route('scan.showConfirmation', ['qr_code' => 'PLACEHOLDER']) }}";
                const finalUrl = baseUrl.replace('PLACEHOLDER', encodeURIComponent(decodedText));

                window.location.href = finalUrl;
            }, 500);

        }

        function onScanFailure(error) {
            // Abaikan error jika bukan 'QR code not found'.
            if (error.includes("NotFoundException") || error.includes(" lecteurs.")) { // Pesan error bisa bervariasi
                document.getElementById('scan-status').innerText = "Arahkan QR Code ke kamera...";
            } else if (error.includes("permission denied")) {
                document.getElementById('scan-status').innerHTML =
                    `<span class="text-danger">Izin kamera ditolak. Mohon izinkan akses kamera di browser Anda.</span>`;
            }
            // else {
            //     console.warn(`QR error = ${error}`);
            //     document.getElementById('scan-status').innerText = `Error: ${error}`;
            // }
        }

        let html5QrcodeScanner;
        document.addEventListener('DOMContentLoaded', (event) => {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10, // Frames per second untuk scan
                    qrbox: {
                        width: 250,
                        height: 250
                    }, // Ukuran kotak scan (opsional)
                    rememberLastUsedCamera: true, // Ingat kamera terakhir yang digunakan
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA] // Hanya kamera
                },
                false // verbose = false
            );
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
            document.getElementById('scan-status').innerText = "Kamera siap. Arahkan QR Code...";

            @if (session('scan_success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('scan_success') }}',
                    icon: 'success',
                    timer: 2500,
                    showConfirmButton: false,
                    willClose: () => {
                        // Restart scanner jika perlu, atau biarkan untuk scan berikutnya
                        if (html5QrcodeScanner && !html5QrcodeScanner.getState || (html5QrcodeScanner
                                .getState && html5QrcodeScanner.getState() === Html5QrcodeScannerState
                                .NOT_STARTED)) {
                            // html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                        }
                    }
                });
            @endif

            @if (session('scan_error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: '{{ session('scan_error') }}',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: true // Biarkan pengguna menutup manual jika error
                });
            @endif
        });

        function showTestForm() {
            const modal = new bootstrap.Modal(document.getElementById('testScanModal'));
            modal.show();
        }

        function submitTestScan(event) {
            event.preventDefault();
            const input = document.getElementById('manualScanInput').value.trim();
            if (input === "") {
                alert("Isi QR Code tidak boleh kosong.");
                return;
            }

            // Jalankan fungsi seolah hasil dari QR scanner
            onScanSuccess(input, {
                simulated: true
            });

            // Tutup modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('testScanModal'));
            modal.hide();
        }
    </script>
</body>

</html>
