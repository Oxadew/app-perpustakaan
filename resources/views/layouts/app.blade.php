<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Perpustakaan Digital Kampus')</title>
    
    <style>
        /* ==========================================
           1. RESET & GLOBAL STYLES
           ========================================== */
        * { 
            box-sizing: border-box; 
        }
        body { 
            font-family: sans-serif; 
            margin: 0; 
            color: #1f2937; 
        }

        /* ==========================================
           2. NAVBAR STYLING
           ========================================== */
        nav { 
            background: #1e3a8a; 
            padding: 14px 40px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            flex-wrap: wrap; 
        }
        nav .brand { 
            color: #fff; 
            font-weight: bold; 
            font-size: 18px; 
        }
        nav ul { 
            list-style: none; 
            display: flex; 
            gap: 20px; 
            margin: 0; 
            padding: 0; 
        }
        nav ul li a { 
            color: #cbd5e1; 
            text-decoration: none; 
            padding: 6px 4px; 
        }
        nav ul li a.active { 
            color: #fff; 
            font-weight: bold; 
            border-bottom: 2px solid #fff; 
        }
        nav .navbar-user { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            color: #cbd5e1; 
            font-size: 14px; 
        }
        nav .btn-logout { 
            background: none; 
            border: 1px solid #cbd5e1; 
            color: #cbd5e1; 
            padding: 4px 10px; 
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 14px; 
        }
        nav .btn-logout:hover { 
            background: #1e40af; 
            color: #fff; 
        }

        /* ==========================================
           3. MAIN CONTENT & LAYOUT CONTAINER
           ========================================== */
        main { 
            max-width: 900px; 
            margin: 0 auto; 
            padding: 30px 40px; 
        }

        /* ==========================================
           4. TABLE STYLING
           ========================================== */
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-top: 16px; 
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 8px 12px; 
            text-align: left; 
        }

        /* ==========================================
           5. FORM & INPUT STYLING (TAMBAH & EDIT)
           ========================================== */
        .form-container, .form-wrapper { 
            max-width: 500px; 
        }
        .form-group { 
            margin-bottom: 8px; 
            display: flex; 
            flex-direction: column; 
        }
        .form-group label, 
        .form-wrapper label { 
            font-weight: 600; 
            margin-bottom: 6px; 
            display: block;
        }
        .form-group input, 
        .form-group select, 
        .form-group textarea,
        .form-wrapper input[type="text"],
        .form-wrapper input[type="date"],
        .form-wrapper input[type="number"],
        .form-wrapper select { 
            padding: 8px 10px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            font-size: 14px; 
            width: 100%; 
            box-sizing: border-box; 
            font-family: inherit;
        }
        .readonly { 
            background: #f3f4f6; 
            padding: 8px 10px; 
            border-radius: 4px; 
            margin-top: 4px; 
            border: 1px solid #e5e7eb; 
            font-size: 14px; 
        }

        /* ==========================================
           6. CHECKBOX LIST (UNTUK PEMINJAMAN)
           ========================================== */
        .checkbox-container, .checkbox-list { 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            padding: 10px; 
            margin-top: 4px; 
            max-height: 200px; 
            overflow-y: auto; 
            background: #fff; 
        }
        .checkbox-row { 
            display: flex !important; 
            align-items: center !important; 
            margin-bottom: 8px; 
        }
        .checkbox-row input[type="checkbox"] { 
            width: 18px !important; 
            height: 18px !important; 
            margin: 0 10px 0 0 !important; 
            cursor: pointer; 
        }
        .checkbox-row label { 
            margin: 0 !important; 
            font-weight: normal !important; 
            cursor: pointer; 
            display: inline !important; 
        }

        /* ==========================================
           7. BUTTONS, ALERTS & SEARCH
           ========================================== */
        .btn { 
            display: inline-block; 
            padding: 8px 16px; 
            background: #2563eb; 
            color: #fff; 
            text-decoration: none; 
            border-radius: 4px; 
            border: none; 
            cursor: pointer; 
            font-size: 14px;
            margin-top: 10px;
        }
        .btn:hover {
            background: #1d4ed8;
        }
        .error { 
            color: #dc3545; 
            font-size: 12px; 
            margin-top: 4px; 
        }
        .alert-success { 
            background: #d1fae5; 
            color: #065f46; 
            padding: 10px 14px; 
            border-radius: 4px; 
            margin-bottom: 16px; 
        }
        form.inline { 
            display: inline; 
        }
        .search-box {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }
        .search-input {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 280px;
        }
        .btn-search {
            padding: 8px 16px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-reset {
            padding: 8px 16px;
            background-color: #e5e7eb;
            color: #374151;
            text-decoration: none;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
        }
        .pagination-wrapper {
            margin-top: 20px;
        }

        /* ==========================================
           8. BADGES (STATUS WARNA)
           ========================================== */
        .badge {
            display: inline-block;
            padding: 4px 8px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 4px;
            text-transform: capitalize;
        }
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* ==========================================
           9. FOOTER STYLING
           ========================================== */
        footer { 
            text-align: center; 
            padding: 20px; 
            color: #6b7280; 
            font-size: 14px; 
            border-top: 1px solid #e5e7eb; 
            margin-top: 40px; 
        }
    </style>
</head>
<body>
    <!-- BAGIAN NAVBAR -->
    @include('partials.navbar')

    <!-- BAGIAN KONTEN UTAMA HALAMAN -->
    <main>
        @include('partials.alert')

        @yield('content')
    </main>

    <!-- BAGIAN FOOTER -->
    <footer>
        &copy; {{ date('Y') }} Sistem Perpustakaan Digital Kampus
    </footer>
</body>
</html>