@extends('layouts.app')

@section('title', 'Clients')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">All Clients</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">+ Add Client</a>
</div>

{{-- status filter --}}
<div class="mb-3">
    <a href="{{ route('clients.index') }}"
       class="btn btn-sm {{ !$filter ? 'btn-dark' : 'btn-outline-dark' }}">All</a>
    <a href="{{ route('clients.index', ['status' => 'active']) }}"
       class="btn btn-sm {{ $filter === 'active' ? 'btn-success' : 'btn-outline-success' }}">Active</a>
    <a href="{{ route('clients.index', ['status' => 'inactive']) }}"
       class="btn btn-sm {{ $filter === 'inactive' ? 'btn-danger' : 'btn-outline-danger' }}">Inactive</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>
                            <span class="badge {{ $client->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($client->status) }}
                            </span>
                        </td>
                        <td>{{ $client->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client->id) }}"
                               class="btn btn-sm btn-outline-primary">Edit</a>

                            <form action="{{ route('clients.destroy', $client->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Delete this client?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No clients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
