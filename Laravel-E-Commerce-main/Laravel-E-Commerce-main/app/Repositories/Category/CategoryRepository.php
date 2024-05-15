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

    public function getAllCategoryWithCategoryOption($param)
    {  
        $query = $this->model->with('categoryOptionRelation');
        if ($param != '') {
            $query->whereHas('categoryOptionRelation', function($query) use ($param) {
                $query->where('category_option_name', 'like', '%' . $param . '%');
            });
        }
        return $query->get();
    }

    public function getCategoryOptionWithCategoryById($id)
    {   
        return $this->model->with('categoryOptionRelation')->find($id);
    }
}
