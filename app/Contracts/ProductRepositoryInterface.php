<?php

namespace App\Contracts;

interface ProductRepositoryInterface
{
    public function paginate($perPage = 15): array;

    public function create($data): array;

    public function find($id): array|null;

    public function update($id, $data = []): bool|null;

    public function delete($id): bool|null;
}
