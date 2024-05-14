<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
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
