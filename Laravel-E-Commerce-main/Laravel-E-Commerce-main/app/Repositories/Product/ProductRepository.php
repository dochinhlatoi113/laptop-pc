<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    public function show()
    {
        return $this->model->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
