<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRM EXAM - Premium')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --brand-yellow: #fbbf24;
            --brand-yellow-hover: #f59e0b;
            --brand-blue: #3b82f6;
            --brand-dark: #0f172a;
            --brand-dark-lighter: #1e293b;
            --brand-black: #020617;
            --text-muted: #cbd5e1; /* Made lighter for visibility */
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--brand-black);
            color: #f8fafc;
            overflow-x: hidden;
        }

        /* custom sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--brand-dark);
            position: fixed;
            left: 0;
            top: 0;
            padding: 2rem 1.5rem;
            z-index: 1001;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--brand-yellow);
            letter-spacing: -1px;
            text-decoration: none;
            display: flex;
            align-items: center;
            margin-bottom: 3rem;
        }

        .sidebar-brand i {
            font-size: 1.8rem;
            margin-right: 0.75rem;
        }

        .nav-column {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .side-link {
            display: flex;
            align-items: center;
            padding: 0.85rem 1.25rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .side-link:hover {
            color: var(--brand-yellow);
            background: rgba(251, 191, 36, 0.05);
        }

        .side-link.active {
            color: var(--brand-black);
            background-color: var(--brand-yellow);
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
        }

        .side-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* main content area */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 3rem 4rem;
        }

        .card {
            background-color: var(--brand-dark);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .table {
            color: #f1f5f9;
        }

        .table thead th {
            color: #ffffff; /* Explicitly white */
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 1.5rem;
            background: var(--brand-dark-lighter);
            border: none;
        }

        .table tbody td {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            vertical-align: middle;
            background-color: var(--brand-dark); /* Ensure it's dark, not white */
        }

        .btn-brand {
            background-color: var(--brand-yellow);
            color: var(--brand-black);
            font-weight: 800;
            border: none;
            border-radius: 14px;
            padding: 0.8rem 1.8rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
        }

        .btn-brand:hover {
            background-color: var(--brand-yellow-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.3);
            color: var(--brand-black);
        }

        .search-container {
            position: relative;
        }

        .search-input {
            background-color: rgba(255,255,255,0.05) !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            border-radius: 16px !important;
            padding: 0.8rem 1.2rem 0.8rem 3rem !important;
            color: white !important;
            width: 320px;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .search-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--brand-yellow);
            z-index: 5;
        }

        .status-pill {
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-weight: 800;
            font-size: 0.7rem;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.2);
            color: #34d399; /* Brighter green */
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.2);
            color: #f87171; /* Brighter red */
        }

        /* Action Buttons Fix */
        .action-btn-custom {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255,255,255,0.05);
            color: white; /* Explicitly white icon */
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .action-btn-custom:hover {
            background: var(--brand-yellow);
            color: var(--brand-black);
            border-color: var(--brand-yellow);
        }

        .btn-purge:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        .stat-card {
            background-color: var(--brand-dark);
            border-radius: 24px;
            padding: 2rem;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .modal-content {
            background-color: var(--brand-dark);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
        }

        .form-label {
            color: #ffffff !important;
            font-weight: 700;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control, .form-select {
            background-color: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            padding: 0.8rem 1.2rem;
            color: white !important;
        }

        .form-control:focus, .form-select:focus {
            background-color: rgba(255,255,255,0.08);
            border-color: var(--brand-yellow);
            box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.1);
            color: white;
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <a href="{{ route('clients.index') }}" class="sidebar-brand">
        <i class="fas fa-bolt"></i> CRM EXAM
    </a>

    <nav class="nav-column">
        <a href="{{ route('dashboard') }}" class="side-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
        <a href="{{ route('clients.index') }}" class="side-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Client Base
        </a>
    </nav>
</aside>

<main class="main-wrapper">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@if(session('success'))
<script>
    Swal.fire({
        background: '#0f172a',
        color: '#f8fafc',
        icon: 'success',
        iconColor: '#fbbf24',
        title: 'SUCCESS',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        background: '#0f172a',
        color: '#f8fafc',
        icon: 'error',
        iconColor: '#ef4444',
        title: 'ERROR',
        text: "{{ session('error') }}",
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });
</script>
@endif

</body>
</html>
