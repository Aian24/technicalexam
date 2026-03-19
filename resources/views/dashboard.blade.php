@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row align-items-end mb-4">
    <div class="col-md-6">
        <h1 class="h3 fw-bold mb-1">CRM Dashboard</h1>
        <p class="text-muted small">Quick overview of your client statistics and CRM activity.</p>
    </div>
</div>

<div class="row g-4">
    {{-- Total Clients Stat --}}
    <div class="col-md-4">
        <div class="card p-4 border-0 shadow-sm rounded-4">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" 
                     style="width: 50px; height: 50px;">
                    <i class="fas fa-users-viewfinder fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted small fw-600 mb-0">Total Reach</h6>
                    <h2 class="fw-bold mb-0">{{ \App\Models\Client::count() }}</h2>
                </div>
            </div>
            <div class="text-secondary small">
                Registered database entries
            </div>
        </div>
    </div>

    {{-- Active Clients Stat --}}
    <div class="col-md-4">
        <div class="card p-4 border-0 shadow-sm rounded-4 border-start border-success border-4">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-3" 
                     style="width: 50px; height: 50px;">
                    <i class="fas fa-check-double fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted small fw-600 mb-0">Active Clients</h6>
                    <h2 class="fw-bold mb-0 text-success">{{ \App\Models\Client::where('status', 'active')->count() }}</h2>
                </div>
            </div>
            <div class="text-secondary small">
                Active in the last sync
            </div>
        </div>
    </div>

    {{-- Inactive Clients Stat --}}
    <div class="col-md-4">
        <div class="card p-4 border-0 shadow-sm rounded-4 border-start border-danger border-4">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center me-3" 
                     style="width: 50px; height: 50px;">
                    <i class="fas fa-user-slash fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted small fw-600 mb-0">Inactive</h6>
                    <h2 class="fw-bold mb-0 text-danger">{{ \App\Models\Client::where('status', 'inactive')->count() }}</h2>
                </div>
            </div>
            <div class="text-secondary small">
                Deactivated accounts
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 mt-4">
    <div class="col-md-12">
        <div class="card p-5 text-center border-0 shadow-sm rounded-4 bg-primary text-white">
            <h4 class="fw-bold">Welcome back to the CRM Technical Exam!</h4>
            <p class="opacity-75 mb-4">Click below to manage your client database with the new modernized view.</p>
            <div>
                <a href="{{ route('clients.index') }}" class="btn btn-light px-4 py-2 rounded-3 text-primary fw-bold shadow">
                    <i class="fas fa-arrow-right me-2"></i> View Client List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
