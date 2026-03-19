<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    // grab all clients, with optional status filter and search keyword
    public function getAll(?string $status = null, ?string $search = null)
    {
        $query = Client::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    // find a single client by id
    public function findById(int $id): ?Client
    {
        return Client::find($id);
    }

    // save a new client record
    public function create(array $data): Client
    {
        return Client::create($data);
    }

    // update an existing client's data
    public function update(int $id, array $data): ?Client
    {
        $client = $this->findById($id);

        if (!$client) {
            return null;
        }

        $client->update($data);

        return $client->fresh();
    }

    // remove a client from the table
    public function delete(int $id): bool
    {
        $client = $this->findById($id);

        if (!$client) {
            return false;
        }

        $client->delete();

        return true;
    }
}
