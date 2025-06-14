<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Kehadiran Anak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        .img-anak-konfirmasi {
            width: 80px;
            /* Ukuran disesuaikan untuk daftar */
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--theme-color-fuchsia-light);
            padding: 3px;
            background-color: white;
        }

        .info-box {
            background-color: var(--card-bg);
            padding: 1.5rem;
            border-radius: .5rem;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
        }

        .current-time {
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--theme-color-fuchsia);
        }

        .btn-fuchsia {
            background-color: var(--theme-color-fuchsia);
            border-color: var(--theme-color-fuchsia);
            color: var(--text-on-fuchsia);
        }

        .btn-fuchsia:hover {
            background-color: var(--theme-color-fuchsia-dark);
            border-color: var(--theme-color-fuchsia-dark);
            color: var(--text-on-fuchsia);
        }

        .child-selection-card {
            border: 1px solid var(--border-color);
            border-radius: .375rem;
            margin-bottom: 0.75rem;
            padding: 0.75rem;
            background-color: #fff;
            transition: box-shadow .2s ease-in-out;
        }

        .child-selection-card:hover {
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .1);
        }

        .child-selection-card .form-check-input {
            width: 1.5em;
            height: 1.5em;
            margin-top: 0;
            /* Align with text */
        }

        .child-details {
            margin-left: 1rem;
        }

        .child-details h6 {
            margin-bottom: 0.25rem;
            color: var(--theme-color-fuchsia);
        }

        .child-details p {
            font-size: 0.85rem;
            margin-bottom: 0.1rem;
            color: #555;
        }

        /* Custom radio button group styling */
        .btn-group-action .form-check-input {
            display: none;
        }

        .btn-group-action .btn {
            border-width: 1px;
        }

        .btn-group-action .form-check-input:checked+.btn {
            background-color: var(--theme-color-fuchsia);
            border-color: var(--theme-color-fuchsia);
            color: var(--text-on-fuchsia);
        }

        .btn-group-action .form-check-input:not(:checked)+.btn-outline-fuchsia:hover {
            background-color: var(--theme-color-fuchsia-light);
            color: var(--theme-color-fuchsia-dark);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-fuchsia shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Konfirmasi Kehadiran</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('scan.page') }}">Kembali ke Pindai</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4 mb-5 flex-fill">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="info-box">
                    <div class="text-center">
                        <p class="text-muted mb-1">Waktu Saat Ini:</p>
                        <p id="current-time" class="current-time mb-3">Memuat waktu...</p>
                    </div>

                    {{-- Asumsikan $children adalah collection/array objek anak dan $guardian adalah objek wali (opsional) --}}
                    @if (isset($guardian))
                        <div class="text-center mb-3 pb-3 border-bottom">
                            <p class="mb-0 text-muted small">Wali Murid:</p>
                            <h5 class="mb-0">{{ $guardian->name ?? 'Nama Wali Tidak Diketahui' }}</h5>
                            {{-- Tambahkan info wali lain jika perlu --}}
                        </div>
                    @endif

                    @if (isset($students) && count($students) > 0)
                        <form action="{{ route('scan.submitConfirmation') }}" method="POST" id="confirmationForm">
                            @csrf
                            <input type="hidden" name="scanned_qr_data" value="{{ $scanned_qr_data ?? '' }}">
                            <input type="hidden" name="timestamp" id="timestamp_input" value="">
                            @if (isset($guardian) && $guardian->id)
                                <input type="hidden" name="guardian_id" value="{{ $guardian->id }}">
                            @endif


                            @if (count($students) > 1)
                                <div class="mb-3">
                                    <label class="form-label fw-bold d-block mb-2">Pilih Anak yang Akan
                                        Diproses:</label>
                                    <div id="child-list-container">
                                        @foreach ($students as $child)
                                            @php
                                                $imageUrl =
                                                    $child->image_url ?:
                                                    'https://ui-avatars.com/api/?name=' .
                                                        urlencode($child->name) .
                                                        '&background=F8BBD0&color=C2185B&size=80';
                                            @endphp
                                            <div class="child-selection-card d-flex align-items-center">
                                                <input class="form-check-input ms-2" type="checkbox"
                                                    name="student_ids[]" value="{{ $child->id }}"
                                                    id="child_{{ $child->id }}">
                                                <label class="d-flex align-items-center w-100"
                                                    for="child_{{ $child->id }}" style="cursor:pointer;">
                                                    <img src="{{ $imageUrl }}"
                                                        alt="Foto {{ $child->name ?? 'Siswa' }}"
                                                        class="img-anak-konfirmasi ms-3 me-3 shadow-sm">
                                                    <div class="child-details">
                                                        <h6>{{ $child->name ?? 'Nama Siswa' }}</h6>
                                                        <p><i class="bi bi-building"></i> Kelas:
                                                            {{ $child->class ?? '-' }}</p>
                                                        <p><i class="bi bi-person-badge"></i> NIS:
                                                            {{ $child->nis ?? '-' }}</p>
                                                    </div>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="selection-error" class="text-danger mt-2" style="display: none;">
                                        Harap pilih minimal satu anak.
                                    </div>
                                </div>
                            @else
                                {{-- Hanya ada 1 anak --}}
                                @php
                                    $child = $students->first();
                                    $imageUrl =
                                        $child->image_url ?:
                                        'https://ui-avatars.com/api/?name=' .
                                            urlencode($child->name) .
                                            '&background=F8BBD0&color=C2185B&size=120';
                                @endphp
                                <input type="hidden" name="student_ids[]" value="{{ $child->id }}">
                                <div class="text-center mb-3">
                                    <img src="{{ $imageUrl }}" alt="Foto {{ $child->name ?? 'Siswa' }}"
                                        class="img-anak-konfirmasi mb-3 shadow-sm" style="width:120px; height:120px;">
                                    <h3 class="mb-1" style="color:var(--theme-color-fuchsia);">
                                        {{ $child->name ?? 'Nama Siswa Tidak Ditemukan' }}</h3>
                                    <p class="text-muted mb-1">
                                        <i class="bi bi-building"></i> Kelas: {{ $child->class ?? '-' }}
                                    </p>
                                    <p class="text-muted mb-3">
                                        <i class="bi bi-person-badge"></i> NIS: {{ $child->nis ?? '-' }}
                                    </p>
                                </div>
                            @endif


                            {{-- <div class="mb-4">
                                <label class="form-label fw-bold d-block text-center">Pilih Tindakan:</label>
                                <div class="btn-group w-100 btn-group-action" role="group"
                                    aria-label="Pilih Tindakan">
                                    <input type="radio" class="form-check-input" name="action_type" id="action_drop"
                                        value="drop" checked>
                                    <label class="btn btn-outline-fuchsia w-50 py-2" for="action_drop"><i
                                            class="bi bi-box-arrow-in-down me-2"></i>Antar (Drop Off)</label>

                                    <input type="radio" class="form-check-input" name="action_type"
                                        id="action_pickup" value="pickup">
                                    <label class="btn btn-outline-fuchsia w-50 py-2" for="action_pickup"><i
                                            class="bi bi-box-arrow-in-up me-2"></i>Jemput (Pick Up)</label>
                                </div>
                            </div> --}}

                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <a href="{{ route('scan.page') }}" class="btn btn-outline-secondary btn-lg px-4 gap-3">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-fuchsia btn-lg px-4">
                                    <i class="bi bi-check-circle"></i> Konfirmasi
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-danger text-center">
                            <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Data Anak Tidak
                                Ditemukan</h4>
                            <p>Informasi anak tidak dapat dimuat. QR Code mungkin tidak valid atau tidak ada anak yang
                                tertaut.</p>
                            <a href="{{ route('scan.page') }}" class="btn btn-secondary">Kembali ke Pindai</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto">
        <div class="container text-center">
            <div class="text-muted small">Hak Cipta &copy; {{ date('Y') }}</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;

            const timestampInput = document.getElementById('timestamp_input');
            if (timestampInput) {
                timestampInput.value = now.toISOString();
            }
        }
        setInterval(updateTime, 1000);
        updateTime();

        const confirmationForm = document.getElementById('confirmationForm');
        if (confirmationForm) {
            confirmationForm.addEventListener('submit', function(event) {
                const childCheckboxes = document.querySelectorAll('input[name="student_ids[]"]:checked');
                const selectionError = document.getElementById('selection-error');
                const childListContainer = document.getElementById('child-list-container');

                // Validasi hanya jika ada lebih dari satu anak (ada childListContainer)
                if (childListContainer && childCheckboxes.length === 0) {
                    event.preventDefault(); // Hentikan submit form
                    if (selectionError) selectionError.style.display = 'block';
                } else {
                    if (selectionError) selectionError.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>
