<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryOption;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="categories";

    protected $fillable = [
        'category_name',
        'category_describe', 
        'status', 
        'parent_id'
    ];
    public function categoryOptionRelation()
    {
        return $this->hasmany(CategoryOption::class,'category_id');
    }

}
