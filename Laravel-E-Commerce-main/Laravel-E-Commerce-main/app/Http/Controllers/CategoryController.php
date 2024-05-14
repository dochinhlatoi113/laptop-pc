<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepositoryInterface|\App\Repositories\Repository
     */
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * 
     *  @return view
     */
    public function ViewCategory()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $data = $this->categoryRepo->show();
                 return $categories = $this->getSortedCategories($data);
                
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    /**
     * 
     *
     * @param  Request $request
     * @return void
    */
    public function AddCategory(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $data = $request->all();
                $category = $this->categoryRepo->create($data);
                return redirect()->back()->with('message', 'Category Added Successfully');
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }

    }

    /**
     * 
     *
     * @param  $id
     * @return view
    */
    public function DeleteCategory($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $this->categoryRepo->delete($id);
                return redirect()->back();

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }

    }

     /**
     * 
     *
     * @param  $id
     * @return redirect
    */
    public function EditCategory($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $category = $this->categoryRepo->find($id);
                return view('admin.category.edit_category', compact('category'));

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }

    }
  /**
     * 
     *
     * @param  $id,Request $request
     * @return redirect
    */
    public function UpdateCategory(Request $request ,$id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $category = $this->categoryRepo->update($id,$request->all());
                return redirect()->back();

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
     /**
         * 
         *
         * @param  $data
         * @return view
    */
    public function getSortedCategories($data)
    {
        $categories = [];
        $parents = [];
        $children = [];
        foreach ($data as $category) {
            if ($category->parent_id == 0) {
                $parents[] = $category;
            } else {
                $children[$category->parent_id][] = $category;
            }
        }
        foreach ($parents as $parent) {
            $categories[] = $parent;
            if (isset($children[$parent->id])) {
                foreach ($children[$parent->id] as $child) {
                    $categories[] = $child;
                }
            }
        }
        return view('admin.category.category', compact('categories'));
    }

}
