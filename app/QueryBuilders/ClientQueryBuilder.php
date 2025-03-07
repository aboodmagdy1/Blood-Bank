<?php

namespace App\QueryBuilders;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;

//NOTE: impelement builder pattern
class ClientQueryBuilder
{
    protected Builder $query;

    public function __construct()
    {
        $this->query = Client::query();
    }

    // Filter active users
    public function bloodType($id): static
    {
        $this->query->where('blood_type_id', $id);
        return $this;
    }

    public function city($id): static
    {
        $this->query->where('city_id', $id);
        return $this;
    }

    // Filter by role
    public function role(string $role): static
    {
        $this->query->where('role', $role);
        return $this;
    }


    // Order by latest created users


    // Set a limit on the query


    // Execute the query and return the result
    public function get()
    {
        return $this->query->get();
    }

    // Optionally, return the first result
    public function first()
    {
        return $this->query->first();
    }

    public function paginate(int $perPage)
    {
        return $this->query->paginate($perPage);
    }
}
