<?php
namespace App\Repositories\CategoryOption;

use App\Repositories\RepositoryInterface;

interface CategoryOptionRepositoryInterface extends RepositoryInterface
{
    public function show();
    public function find($id);
}
