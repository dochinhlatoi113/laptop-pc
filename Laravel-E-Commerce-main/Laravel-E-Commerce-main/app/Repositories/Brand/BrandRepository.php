<?php
namespace App\Repositories\Brand;

use App\Repositories\BaseRepository;
use App\Repositories\Brand\BrandRepositoryInterface;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Category::class;
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
