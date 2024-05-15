<?php
namespace App\Repositories\CategoryOption;

use App\Repositories\BaseRepository;
use App\Repositories\CategoryOption\CategoryOptionRepositoryInterface;
use App\Models\CategoryOption;
use App\Models\Category;
class CategoryOptionRepository extends BaseRepository implements CategoryOptionRepositoryInterface
{
    public function getModel()
    {
        return CategoryOption::class;
    }

    public function show()
    {
        return $this->model->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getAllCategoryOptionWithCategory()
    {
        return $this->model->with('categoryRelation')->get();
    }
}
