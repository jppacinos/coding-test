<?php

namespace App\Repositories;

use App\Models\Product;
use App\Contracts\ProductRepositoryInterface;

/**
 * ProductRepository utilizing Laravel's Eloquent Models
 */
class ProductRepository extends BaseRepository implements
    ProductRepositoryInterface
{
    public function paginate($perPage = 15): array
    {
        $results = Product::paginate($perPage)->withQueryString();
        return $results->toArray();
    }

    public function create($data): array
    {
        return Product::create($data)->toArray();
    }

    public function find($id): array|null
    {
        return Product::find($id)?->toArray();
    }

    public function update($id, $data = []): bool|null
    {
        return Product::find($id)?->update($data);
    }

    public function delete($id): bool|null
    {
        return Product::find($id)?->delete();
    }
}
