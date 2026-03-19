@extends('layouts.app')

@section('title', 'CRM - All Clients')

@section('content')
<div class="row align-items-end mb-4">
    <div class="col-md-6">
        <h1 class="h3 fw-bold mb-1">Manage Clients</h1>
        <p class="text-muted small">View, add, and manage your CRM client database.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <div class="d-flex flex-wrap justify-content-md-end gap-3 align-items-center">
            
            {{-- Search Bar --}}
            <form action="{{ route('clients.index') }}" method="GET" class="d-flex bg-white rounded-3 shadow-sm border p-1" style="min-width: 250px;">
                @if($filter) <input type="hidden" name="status" value="{{ $filter }}"> @endif
                <input type="text" name="search" class="form-control border-0 bg-transparent py-1 px-3 shadow-none" 
                       placeholder="Find client..." value="{{ $search }}">
                <button class="btn btn-sm btn-light border-0 px-3">
                    <i class="fas fa-search text-muted"></i>
                </button>
            </form>

            {{-- Modern Filter Pills --}}
            <div class="p-1 bg-white rounded-3 shadow-sm d-flex gap-1 border">
                <a href="{{ route('clients.index', ['search' => $search]) }}" 
                   class="btn btn-sm px-3 rounded-2 {{ !$filter ? 'bg-primary text-white shadow' : 'text-secondary hover-light' }}">
                    All
                </a>
                <a href="{{ route('clients.index', ['status' => 'active', 'search' => $search]) }}" 
                   class="btn btn-sm px-3 rounded-2 {{ $filter === 'active' ? 'bg-success text-white shadow' : 'text-secondary hover-light' }}">
                    Active
                </a>
                <a href="{{ route('clients.index', ['status' => 'inactive', 'search' => $search]) }}" 
                   class="btn btn-sm px-3 rounded-2 {{ $filter === 'inactive' ? 'bg-danger text-white shadow' : 'text-secondary hover-light' }}">
                    Inactive
                </a>
            </div>

            {{-- Modern Add Button --}}
            <button class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addClientModal">
                <i class="fas fa-plus-circle me-2"></i> New Client
            </button>
        </div>
    </div>
</div>

{{-- Main CRM Table Card --}}
<div class="card overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="80" class="text-center">#ID</th>
                        <th>Client Info</th>
                        <th width="150" class="text-center">Status</th>
                        <th width="180">Date Added</th>
                        <th width="150" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr class="hover-row">
                            <td class="text-center text-muted fw-bold">#{{ $client->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px; font-weight: 700;">
                                        {{ strtoupper(substr($client->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $client->name }}</div>
                                        <div class="text-muted small">{{ $client->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge-{{ $client->status }}">
                                    <i class="fas {{ $client->status === 'active' ? 'fa-check' : 'fa-times' }} me-1 small"></i>
                                    {{ ucfirst($client->status) }}
                                </span>
                            </td>
                            <td class="text-muted">
                                <i class="far fa-calendar-alt me-1 opacity-50"></i>
                                {{ $client->created_at->format('M d, Y') }}
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Edit Modal Trigger --}}
                                    <button class="btn btn-light action-btn text-primary hover-scale" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editClientModal{{ $client->id }}"
                                            title="Edit Client">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>

                                    {{-- Modern Delete Form --}}
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-light action-btn text-danger hover-scale" onclick="confirmDelete(this)" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- Edit Client Modal (one per client for simplicity) --}}
                        <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg border-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">
                                            <i class="fas fa-user-edit text-primary me-2"></i> Update Client Details
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="{{ route('clients.update', $client->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label fw-600">Full Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $client->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-600">Email Address</label>
                                                <input type="email" name="email" class="form-control" value="{{ $client->email }}" required>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label fw-600">Account Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="active" {{ $client->status === 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ $client->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 p-4">
                                            <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary px-4 fw-bold">Update Record</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="https://img.icons8.com/clouds/100/null/empty-box.png" alt="Empty" class="mb-3">
                                <h6 class="text-muted fw-bold">No clients found matching these criteria.</h6>
                                <p class="text-secondary small">Try adding a new client or clearing filters.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Client Modal --}}
<div class="modal fade" id="addClientModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-user-plus text-primary me-2"></i> New CRM Client
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-600">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-600">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="john@example.com" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-600">Initial Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Create Client</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Styles and Scripts --}}
<style>
    .fw-600 { font-weight: 500; }
    .hover-row { transition: background 0.2s; cursor: pointer; }
    .hover-row:hover { background-color: #f8fafc; }
    .hover-light:hover { background-color: #f1f5f9; color: var(--primary-color) !important; }
    .hover-scale { transition: transform 0.2s; }
    .hover-scale:hover { transform: scale(1.1); }
</style>

<script>
function confirmDelete(btn) {
    Swal.fire({
        title: 'Delete Client?',
        text: "This record will be permanently removed from the CRM. This cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            btn.closest('form').submit();
        }
    })
}
</script>
@endsection
