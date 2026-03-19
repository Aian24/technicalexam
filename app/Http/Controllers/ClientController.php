<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected ClientRepository $repo;

    public function __construct(ClientRepository $repo)
    {
        $this->repo = $repo;
    }

    // list all clients, with optional status filter
    public function index(Request $request)
    {
        $status = $request->query('status');
        $clients = $this->repo->getAll($status);

        return view('clients.index', [
            'clients' => $clients,
            'filter'  => $status,
        ]);
    }

    // show the form to add a new client
    public function create()
    {
        return view('clients.create');
    }

    // save a new client after validating the input
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:clients,email',
            'status' => 'required|in:active,inactive',
        ]);

        $this->repo->create($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Client added successfully.');
    }

    // show the edit form for a specific client
    public function edit(int $id)
    {
        $client = $this->repo->findById($id);

        if (!$client) {
            return redirect()->route('clients.index')
                ->with('error', 'Client not found.');
        }

        return view('clients.edit', compact('client'));
    }

    // update a client's details
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            // ignore the current client's own email when checking unique
            'email'  => 'required|email|unique:clients,email,' . $id,
            'status' => 'required|in:active,inactive',
        ]);

        $updated = $this->repo->update($id, $validated);

        if (!$updated) {
            return redirect()->route('clients.index')
                ->with('error', 'Client not found.');
        }

        return redirect()->route('clients.index')
            ->with('success', 'Client updated.');
    }

    // delete a client
    public function destroy(int $id)
    {
        $deleted = $this->repo->delete($id);

        if (!$deleted) {
            return redirect()->route('clients.index')
                ->with('error', 'Client not found.');
        }

        return redirect()->route('clients.index')
            ->with('success', 'Client removed.');
    }

    // Part 1 Q3 - storeClientDetails for API usage
    public function storeClientDetails(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:clients,email',
            'status' => 'required|in:active,inactive',
        ]);

        $client = $this->repo->create($validated);

        return response()->json([
            'status' => 'success',
            'client' => $client,
        ], 201);
    }
}
