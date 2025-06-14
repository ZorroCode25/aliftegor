<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --theme-color-fuchsia: #C2185B;
            /* Fuchsia Utama */
            --theme-color-fuchsia-dark: #AD1457;
            /* Fuchsia Lebih Gelap untuk hover */
            --theme-color-fuchsia-light: #F8BBD0;
            /* Fuchsia Muda untuk aksen */
            --text-on-fuchsia: #FFFFFF;
            --card-bg: #FFFFFF;
            --body-bg: #f4f6f9;
            /* Abu-abu muda untuk body */
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


        .card {
            border: none;
            /* Menghilangkan border default card untuk flat design */
            background-color: var(--card-bg);
        }

        .card-header {
            background-color: var(--theme-color-fuchsia-light);
            color: var(--theme-color-fuchsia);
            border-bottom: 1px solid var(--border-color);
            /* Garis tipis untuk pemisah */
            font-weight: 500;
        }

        .card-header.main-header {
            /* Untuk header utama seperti QR Code */
            background-color: var(--theme-color-fuchsia);
            color: var(--text-on-fuchsia);
        }


        .card-anak {
            transition: transform .2s ease-in-out, box-shadow .2s ease-in-out;
            border: 1px solid var(--border-color);
        }

        .card-anak:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .10) !important;
        }

        .img-anak {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--theme-color-fuchsia-light);
            padding: 3px;
            /* Sedikit padding antara foto dan border */
            background-color: white;
            /* Jika foto transparan */
        }

        .qr-code-container img {
            max-width: 220px;
            /* Sedikit lebih kecil */
            border: 1px solid var(--border-color);
            padding: 8px;
            background-color: #fff;
            border-radius: 0.25rem;
            /* Sedikit rounded corner */
        }

        .btn-fuchsia {
            background-color: var(--theme-color-fuchsia);
            border-color: var(--theme-color-fuchsia);
            color: var(--text-on-fuchsia);
        }

        .btn-fuchsia:hover,
        .btn-fuchsia:focus {
            background-color: var(--theme-color-fuchsia-dark);
            border-color: var(--theme-color-fuchsia-dark);
            color: var(--text-on-fuchsia);
        }

        .btn-outline-fuchsia {
            color: var(--theme-color-fuchsia);
            border-color: var(--theme-color-fuchsia);
        }

        .btn-outline-fuchsia:hover,
        .btn-outline-fuchsia:focus {
            background-color: var(--theme-color-fuchsia);
            color: var(--text-on-fuchsia);
        }

        .footer {
            background-color: #FFFFFF;
            /* Footer putih bersih */
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
            padding-bottom: 1rem;
            color: #6c757d;
            /* Teks muted */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-fuchsia shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Dashboard Wali</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guardian.history') }}">Riwayat Presensi</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center mb-4 pt-3">
            <div class="col-md-8 col-lg-6 text-center">
                <div class="card shadow-sm">
                    <div class="card-header main-header">
                        <h5 class="card-title mb-0"><i class="bi bi-qr-code-scan"></i> QR Code Anda</h5>
                    </div>
                    <div class="card-body qr-code-container p-4">
                        @if (isset($qrCodeUrl) && $qrCodeUrl)
                            <p class="card-text text-muted small mb-3">Gunakan QR Code ini untuk proses antar jemput
                                anak.</p>
                            <img src="{{ $qrCodeUrl }}" alt="QR Code Wali Murid" class="img-fluid mb-3"
                                id="qr-code-image">
                            <div>
                                <button onclick="downloadQR('{{ $qrCodeUrl }}')" class="btn btn-fuchsia">
                                    <i class="bi bi-download"></i> Unduh QR Code
                                </button>
                            </div>
                        @else
                            <div class="alert alert-light border text-muted" role="alert">
                                <i class="bi bi-x-octagon-fill me-2"></i>QR Code tidak tersedia saat ini.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 mt-5">
            <h3 class="mb-0 display-6" style="color: var(--theme-color-fuchsia); font-weight: 300;">
                <i class="bi bi-people-fill"></i> Data Siswa Tertaut
            </h3>
            <hr class="mt-2" style="border-color: var(--theme-color-fuchsia-light); border-width: 2px;">
        </div>

        <div class="row">
            @forelse ($students as $child)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-anak h-100 shadow-sm">
                        <div class="card-body text-center p-4">
                            <img src="{{ $child->image_url ?: 'https://ui-avatars.com/api/?name=' . urlencode($child->name) . '&background=F8BBD0&color=C2185B&size=100' }}"
                                alt="Foto {{ $child->name }}" class="img-anak mb-3 shadow-sm">

                            <h5 class="card-title mt-2" style="color: var(--theme-color-fuchsia);">
                                {{ $child->name }}</h5>
                            <p class="card-text mb-1 text-muted">
                                <i class="bi bi-building"></i> Kelas: {{ $child->class ?? '-' }}
                            </p>
                            <p class="card-text mb-0 text-muted">
                                <i class="bi bi-person-badge"></i> NIS: {{ $child->nis ?? '-' }}
                            </p>
                        </div>
                        <div class="card-footer bg-white text-center py-3"
                            style="border-top: 1px solid var(--border-color);">
                            <a href="{{ url('/guardian/history?student_id=' . $child->id) }}"
                                class="btn btn-sm btn-outline-fuchsia">
                                <i class="bi bi-search"></i> Lihat Riwayat
                            </a>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info border-info bg-light text-center p-4" role="alert">
                        <h4 class="alert-heading"><i class="bi bi-info-circle-fill"></i> Informasi</h4>
                        <p class="mb-0">Belum ada data siswa yang tertaut dengan akun Anda.
                            Silakan hubungi pihak sekolah untuk menautkan data anak.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between small">
                <div class="text-muted">Hak Cipta &copy; {{ date('Y') }}</div>
                <div>
                    <a href="#" class="text-decoration-none me-2"
                        style="color: var(--theme-color-fuchsia);">Kebijakan Privasi</a>
                    &middot;
                    <a href="#" class="text-decoration-none ms-2"
                        style="color: var(--theme-color-fuchsia);">Syarat &amp; Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function downloadQR(url) {
            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengunduh file.');
                    return response.blob();
                })
                .then(blob => {
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'qr-code-wali.png';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    URL.revokeObjectURL(link.href);
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat mengunduh QR Code:', error);
                    alert('Gagal mengunduh QR Code. Silakan coba lagi nanti.');
                });
        }
    </script>
</body>

</html>
