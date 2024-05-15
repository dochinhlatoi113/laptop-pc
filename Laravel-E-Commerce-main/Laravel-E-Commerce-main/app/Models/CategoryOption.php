<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class CategoryOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="category_option";

    protected $fillable = [
        'category_option_name',
        'category_id', 
        'status', 
    ];

    public function categoryRelation()
    {
        return $this->belongsTo(Category::class);
    }
}
