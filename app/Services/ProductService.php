<?php

namespace App\Services;

use App\Contracts\ProductRepositoryInterface;

class ProductService extends BaseService
{
    public function __construct(
        public ProductRepositoryInterface $productRepository
    ) {
        //
    }

    public function paginate($perPage = 15): array
    {
        return $this->productRepository->paginate($perPage);
    }

    public function create($data): array
    {
        return $this->productRepository->create($data);
    }

    public function find($id): array|null
    {
        return $this->productRepository->find($id);
    }

    public function update($id, $data = []): bool|null
    {
        return $this->productRepository->update($id, $data);
    }

    public function delete($id): bool|null
    {
        return $this->productRepository->delete($id);
    }
}
