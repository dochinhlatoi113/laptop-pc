<?php
namespace App\Repositories\CategoryOption;

use App\Repositories\BaseRepository;
use App\Repositories\CategoryOption\CategoryOptionRepositoryInterface;

class CategoryOptionRepository extends BaseRepository implements CategoryOptionRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\CategoryOption::class;
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
