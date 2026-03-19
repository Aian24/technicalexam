@extends('layouts.app')

@section('title', 'Dashboard - CRM EXAM')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col-lg-12">
        <h1 class="display-6 fw-bold text-white mb-1">System Dashboard</h1>
        <p class="text-muted fw-semibold">Real-time overview of current client statistics.</p>
    </div>
</div>

<div class="row g-4 mb-5">
    {{-- Total Clients Stat --}}
    <div class="col-md-4">
        <div class="stat-card border-0 shadow-lg position-relative overflow-hidden">
            {{-- Fixed Ghost Icon --}}
            <div class="position-absolute text-white" style="right: -10px; bottom: -20px; font-size: 8rem; opacity: 0.04; pointer-events: none;">
                <i class="fas fa-users"></i>
            </div>
            
            <div class="stat-label text-white opacity-50 small fw-bold mb-1">TOTAL CLIENTS</div>
            <div class="stat-value text-white fw-bold display-4 mb-2">{{ \App\Models\Client::count() }}</div>
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-database" style="color: var(--brand-blue);"></i>
                <span class="text-white small opacity-75">Records in Database</span>
            </div>
        </div>
    </div>

    {{-- Active Clients Stat --}}
    <div class="col-md-4">
        <div class="stat-card border-0 shadow-lg position-relative overflow-hidden">
            {{-- Fixed Ghost Icon --}}
            <div class="position-absolute text-white" style="right: -10px; bottom: -20px; font-size: 8rem; opacity: 0.04; pointer-events: none;">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="stat-label text-white opacity-50 small fw-bold mb-1">ACTIVE STATUS</div>
            <div class="stat-value fw-bold display-4 mb-2" style="color: var(--brand-yellow);">{{ \App\Models\Client::where('status', 'active')->count() }}</div>
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-signal text-success"></i>
                <span class="text-white small opacity-75">Operational Accounts</span>
            </div>
        </div>
    </div>

    {{-- Inactive Clients Stat --}}
    <div class="col-md-4">
        <div class="stat-card border-0 shadow-lg position-relative overflow-hidden">
            {{-- Fixed Ghost Icon --}}
            <div class="position-absolute text-white" style="right: -10px; bottom: -20px; font-size: 8rem; opacity: 0.04; pointer-events: none;">
                <i class="fas fa-user-slash"></i>
            </div>

            <div class="stat-label text-white opacity-50 small fw-bold mb-1">INACTIVE STATUS</div>
            <div class="stat-value fw-bold display-4 mb-2" style="color: #f87171;">{{ \App\Models\Client::where('status', 'inactive')->count() }}</div>
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-shield-alt text-danger"></i>
                <span class="text-white small opacity-75">Needs Review</span>
            </div>
        </div>
    </div>
</div>

<div class="row pt-4">
    <div class="col-lg-12">
        <div class="p-5 rounded-5 shadow-lg border-0 position-relative" style="background: linear-gradient(135deg, var(--brand-dark), var(--brand-black)); border: 1px solid rgba(255,255,255,0.05) !important;">
            <div class="position-relative" style="z-index: 2;">
                <h2 class="display-5 fw-bold text-white mb-3">Welcome to CRM EXAM</h2>
                <p class="text-white opacity-75 fw-normal mb-5 fs-6" style="max-width: 700px; line-height: 1.8;">
                    Manage your client database efficiently with our modernized interface. 
                    Search, filter, and modify customer records in real-time. Use the sidebar to navigate between analytics and your client base.
                </p>
                
                <a href="{{ route('clients.index') }}" class="btn btn-brand p-3 ps-5 pe-5 shadow-lg">
                    <i class="fas fa-arrow-right me-2"></i> VIEW CLIENT LIST
                </a>
            </div>
            
            {{-- Background Accent for Welcome Card --}}
            <div class="position-absolute text-white" style="right: 5%; bottom: -20px; font-size: 15rem; opacity: 0.03; pointer-events: none;">
                <i class="fas fa-rocket"></i>
            </div>
        </div>
    </div>
</div>
@endsection
