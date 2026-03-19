@extends('layouts.app')

@section('title', 'Client List')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col-lg-6">
        <h1 class="display-6 fw-bold text-white mb-1">Client List</h1>
        <p class="text-muted fw-semibold mb-0">Manage global client registrations.</p>
    </div>
    <div class="col-lg-6 text-lg-end">
        <button class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#addClientModal">
            <i class="fas fa-plus-circle me-1"></i> Register New Client
        </button>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-12">
        <div class="card p-0 border-0 overflow-hidden shadow-lg">
            {{-- Toolbar --}}
            <div class="p-4 bg-brand-dark-lighter border-bottom border-secondary border-opacity-10 d-flex flex-wrap justify-content-between align-items-center gap-3">
                
                {{-- Global Search --}}
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <form action="{{ route('clients.index') }}" method="GET">
                        @if($filter) <input type="hidden" name="status" value="{{ $filter }}"> @endif
                        <input type="text" name="search" class="search-input form-control shadow-none border-0" 
                               placeholder="Find a client..." value="{{ $search }}">
                    </form>
                </div>

                {{-- Status Pills --}}
                <div class="p-1 rounded-4 d-flex gap-1" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
                    <a href="{{ route('clients.index', ['search' => $search]) }}" 
                       class="btn btn-sm px-4 rounded-3 {{ !$filter ? 'bg-white text-dark fw-bold' : 'text-white border-0 opacity-50' }}">
                        All
                    </a>
                    <a href="{{ route('clients.index', ['status' => 'active', 'search' => $search]) }}" 
                       class="btn btn-sm px-4 rounded-3 {{ $filter === 'active' ? 'bg-white text-dark fw-bold' : 'text-white border-0 opacity-50' }}">
                        Active
                    </a>
                    <a href="{{ route('clients.index', ['status' => 'inactive', 'search' => $search]) }}" 
                       class="btn btn-sm px-4 rounded-3 {{ $filter === 'inactive' ? 'bg-white text-dark fw-bold' : 'text-white border-0 opacity-50' }}">
                        Inactive
                    </a>
                </div>
            </div>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead style="background: var(--brand-dark-lighter);">
                        <tr>
                            <th width="80" class="ps-4">ID</th>
                            <th>PROFILE</th>
                            <th class="text-center">STATUS</th>
                            <th>JOIN DATE</th>
                            <th class="text-end pe-4">OPERATIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                            <tr style="background: var(--brand-dark); border-bottom: 1px solid rgba(255,255,255,0.03);">
                                <td class="ps-4 fw-bold text-muted">#{{ $client->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px; font-weight: 800; background: var(--brand-yellow); color: var(--brand-black);">
                                            {{ strtoupper(substr($client->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-white">{{ $client->name }}</div>
                                            <div class="small" style="color: var(--text-muted);">{{ $client->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="status-pill {{ $client->status === 'active' ? 'status-active' : 'status-inactive' }}">
                                        {{ ucfirst($client->status) }}
                                    </span>
                                </td>
                                <td class="text-white small">
                                    <i class="far fa-calendar-alt me-1 text-blue" style="color: var(--brand-blue);"></i>
                                    {{ $client->created_at->format('d M Y') }}
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button class="action-btn-custom" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editClientModal{{ $client->id }}"
                                                title="Edit">
                                            <i class="fas fa-edit fs-6"></i>
                                        </button>

                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="action-btn-custom btn-purge" 
                                                    onclick="confirmDelete(this)"
                                                    title="Delete">
                                                <i class="fas fa-trash-alt fs-6"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold text-white">UPDATE #{{ $client->id }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('clients.update', $client->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body p-4">
                                                <div class="mb-4">
                                                    <label class="form-label">NAME</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $client->name }}" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">EMAIL</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $client->email }}" required>
                                                </div>
                                                <div class="mb-1">
                                                    <label class="form-label">STATUS</label>
                                                    <select name="status" class="form-select">
                                                        <option value="active" {{ $client->status === 'active' ? 'selected' : '' }}>ACTIVE</option>
                                                        <option value="inactive" {{ $client->status === 'inactive' ? 'selected' : '' }}>INACTIVE</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">DISCARD</button>
                                                <button type="submit" class="btn btn-brand">SUBMIT</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <h6 class="text-white opacity-50">NO RECORDS FOUND.</h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addClientModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-white">NEW REGISTRATION</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label">FULL NAME</label>
                        <input type="text" name="name" class="form-control" placeholder="ENTER NAME..." value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-bold">EMAIL ADDRESS</label>
                        <input type="email" name="email" class="form-control" placeholder="EMAIL@DOMAIN.COM" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">INITIAL STATUS</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>ACTIVE</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>INACTIVE</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark fw-bold" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-brand">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDelete(btn) {
    Swal.fire({
        background: '#0f172a',
        color: '#f8fafc',
        title: 'ARE YOU SURE?',
        text: "This record will be deleted forever.",
        icon: 'warning',
        iconColor: '#ef4444',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#1e293b',
        confirmButtonText: 'DELETE NOW',
        cancelButtonText: 'CANCEL'
    }).then((result) => {
        if (result.isConfirmed) {
            btn.closest('form').submit();
        }
    })
}
</script>
@endsection
