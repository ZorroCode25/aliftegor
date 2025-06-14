<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Drop & Pickup Anak</title>
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
            --table-header-bg: #f8f9fa;
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

        .card {
            border: none;
            background-color: var(--card-bg);
        }

        .filter-card {
            background-color: var(--card-bg);
            padding: 1.5rem;
            border-radius: 0.375rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
            border: 1px solid var(--border-color);
        }

        .filter-card .form-label {
            font-weight: 500;
            color: #495057;
        }

        .card-header {
            background-color: var(--table-header-bg);
            color: var(--theme-color-fuchsia);
            border-bottom: 1px solid var(--border-color);
            font-weight: 500;
        }

        .table thead th {
            background-color: var(--table-header-bg);
            color: #343a40;
            border-bottom-width: 1px;
            font-weight: 500;
        }

        .table-hover tbody tr:hover {
            background-color: var(--theme-color-fuchsia-light);
            color: var(--theme-color-fuchsia-dark);
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

        .page-item.active .page-link {
            background-color: var(--theme-color-fuchsia);
            border-color: var(--theme-color-fuchsia);
            color: var(--text-on-fuchsia);
        }

        .page-link {
            color: var(--theme-color-fuchsia);
        }

        .page-link:hover {
            color: var(--theme-color-fuchsia-dark);
        }

        .footer {
            background-color: #FFFFFF;
            border-top: 1px solid var(--border-color);
            padding-top: 1rem;
            padding-bottom: 1rem;
            color: #6c757d;
        }

        .badge.bg-info {
            background-color: #5bc0de !important;
            color: white !important;
        }

        .badge.bg-success {
            background-color: #5cb85c !important;
            color: white !important;
        }

        /* Sembunyikan tabel di layar kecil */
        @media (max-width: 767.98px) {
            .desktop-table {
                display: none;
            }

            .mobile-list {
                display: block !important;
            }
        }

        /* Sembunyikan list di layar besar */
        @media (min-width: 768px) {
            .mobile-list {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-fuchsia shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Riwayat Penjemputan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guardian.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Riwayat Penjemputan</a>
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
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse"
                data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse">
                <i class="bi bi-sliders"></i> Tampilkan Filter
            </button>
        </div>

        <div class="collapse" id="filterCollapse">
            <div class="filter-card mb-4">
                <h4 class="mb-3 fw-normal" style="color: var(--theme-color-fuchsia);">
                    <i class="bi bi-funnel"></i> Filter Riwayat
                </h4>
                <form method="GET" action="{{ route('guardian.history') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3 col-sm-6">
                            <label for="filterAnak" class="form-label">Nama Anak:</label>
                            <select class="form-select form-select-sm" id="filterAnak" name="student_id">
                                <option value="">Semua Anak</option>
                                @if (isset($students))
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}"
                                            {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label for="startDate" class="form-label">Tanggal Mulai:</label>
                            <input type="date" class="form-control form-control-sm" id="startDate" name="start_date"
                                value="{{ $startDate ?? '' }}">
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label for="endDate" class="form-label">Tanggal Selesai:</label>
                            <input type="date" class="form-control form-control-sm" id="endDate" name="end_date"
                                value="{{ $endDate ?? '' }}">
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <button type="submit" class="btn btn-fuchsia btn-sm w-100">
                                <i class="bi bi-search"></i> Terapkan Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="bi bi-list-check"></i> Daftar Riwayat Penjemputan</h5>
            </div>
            <div class="card-body p-0 p-sm-3">
                {{-- <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Anak</th>
                                <th scope="col" class="text-center">Tipe</th>
                                <th scope="col" class="text-center">Jam Mulai</th>
                                <th scope="col" class="text-center">Jam Selesai</th>
                                <th scope="col">Durasi</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($histories) && $histories->count() > 0)
                                @foreach ($histories as $history)
                                    <tr>
                                        <th scope="row" class="text-center">
                                            {{ $loop->iteration + ($histories->currentPage() - 1) * $histories->perPage() }}
                                        </th>
                                        <td>{{ \Carbon\Carbon::parse($history->tanggal)->translatedFormat('d M Y') }}
                                        </td>
                                        <td>{{ $history->anak->nama_anak ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            @if ($history->tipe == 'drop')
                                                <span class="badge bg-info">Drop Off</span>
                                            @elseif($history->tipe == 'pickup')
                                                <span class="badge bg-success">Pick Up</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($history->tipe) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($history->jam_mulai)->format('H:i') }}</td>
                                        <td class="text-center">
                                            {{ $history->jam_selesai ? \Carbon\Carbon::parse($history->jam_selesai)->format('H:i') : '-' }}
                                        </td>
                                        <td>{{ $history->durasi ?? '-' }}</td>
                                        <td class="text-center">
                                            @if ($history->status == 'selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @elseif($history->status == 'proses')
                                                <span class="badge bg-warning text-dark">Proses</span>
                                            @else
                                                <span class="badge bg-danger">{{ ucfirst($history->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center p-4">
                                        <i class="bi bi-exclamation-circle-fill fs-3 text-muted d-block mb-2"></i>
                                        Tidak ada data riwayat untuk periode atau filter yang dipilih.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div> --}}
                <div class="desktop-table">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama Siswa</th>
                                    {{-- <th scope="col" class="text-center">Tipe</th> --}}
                                    <th scope="col" class="text-center">Jam Mulai</th>
                                    <th scope="col" class="text-center">Jam Selesai</th>
                                    <th scope="col">Durasi</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($histories) && $histories->count() > 0)
                                    @foreach ($histories as $history)
                                        <tr>
                                            <th scope="row" class="text-center">
                                                {{ $loop->iteration + ($histories->currentPage() - 1) * $histories->perPage() }}
                                            </th>
                                            <td>{{ \Carbon\Carbon::parse($history->tanggal)->translatedFormat('d M Y') }}
                                            </td>
                                            <td>{{ $history->student->name ?? 'N/A' }}</td>
                                            {{-- <td class="text-center">
                                                @if ($history->tipe == 'drop')
                                                    <span class="badge bg-info">Drop Off</span>
                                                @elseif($history->tipe == 'pickup')
                                                    <span class="badge bg-success">Pick Up</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary">{{ ucfirst($history->tipe) }}</span>
                                                @endif
                                            </td> --}}
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($history->start_at)->format('H:i') }}</td>
                                            <td class="text-center">
                                                {{ $history->end_at ? \Carbon\Carbon::parse($history->end_at)->format('H:i') : '-' }}
                                            </td>
                                            <td>{{ $history->durasi ?? '-' }}</td>
                                            <td class="text-center">
                                                @if ($history->status == 'selesai')
                                                    <span class="badge bg-success">Selesai</span>
                                                @elseif($history->status == 'proses')
                                                    <span class="badge bg-warning text-dark">Proses</span>
                                                @else
                                                    <span
                                                        class="badge bg-danger">{{ ucfirst($history->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center p-4">
                                            <i class="bi bi-exclamation-circle-fill fs-3 text-muted d-block mb-2"></i>
                                            Tidak ada data riwayat untuk periode atau filter yang dipilih.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- MOBILE VERSION --}}
                <div class="mobile-list">
                    @if (isset($histories) && $histories->count() > 0)
                        @foreach ($histories as $history)
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-2 text-fuchsia">{{ $history->anak->nama_anak ?? 'N/A' }}
                                    </h6>
                                    <p class="mb-1"><strong>Tanggal:</strong>
                                        {{ \Carbon\Carbon::parse($history->tanggal)->translatedFormat('d M Y') }}</p>
                                    <p class="mb-1"><strong>Tipe:</strong>
                                        @if ($history->tipe == 'drop')
                                            <span class="badge bg-info">Drop Off</span>
                                        @elseif($history->tipe == 'pickup')
                                            <span class="badge bg-success">Pick Up</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($history->tipe) }}</span>
                                        @endif
                                    </p>
                                    <p class="mb-1"><strong>Jam Mulai:</strong>
                                        {{ \Carbon\Carbon::parse($history->jam_mulai)->format('H:i') }}</p>
                                    <p class="mb-1"><strong>Jam Selesai:</strong>
                                        {{ $history->jam_selesai ? \Carbon\Carbon::parse($history->jam_selesai)->format('H:i') : '-' }}
                                    </p>
                                    <p class="mb-1"><strong>Durasi:</strong> {{ $history->durasi ?? '-' }}</p>
                                    <p class="mb-0"><strong>Status:</strong>
                                        @if ($history->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($history->status == 'proses')
                                            <span class="badge bg-warning text-dark">Proses</span>
                                        @else
                                            <span class="badge bg-danger">{{ ucfirst($history->status) }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center p-4">
                            <i class="bi bi-exclamation-circle-fill fs-3 text-muted d-block mb-2"></i>
                            Tidak ada data riwayat untuk periode atau filter yang dipilih.
                        </div>
                    @endif
                </div>

                @if (isset($histories) && $histories->hasPages())
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $histories->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');

            if (startDateInput && endDateInput && !startDateInput.value && !endDateInput.value) {
                const today = new Date();
                const firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                const currentDay = new Date(today.getFullYear(), today.getMonth(), today.getDate());

                const formatDate = (date) => {
                    const d = new Date(date);
                    let month = '' + (d.getMonth() + 1);
                    let day = '' + d.getDate();
                    const year = d.getFullYear();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;

                    return [year, month, day].join('-');
                }

                startDateInput.value = formatDate(firstDayOfMonth);
                endDateInput.value = formatDate(currentDay);
            }

            const filterCollapse = document.getElementById('filterCollapse');
            const anakSelected = "{{ request('student_id') }}";
            const startDate = "{{ request('start_date') }}";
            const endDate = "{{ request('end_date') }}";

            if (anakSelected || startDate || endDate) {
                const bsCollapse = new bootstrap.Collapse(filterCollapse, {
                    show: true,
                    toggle: false
                });
            }
        });
    </script>
</body>

</html>
