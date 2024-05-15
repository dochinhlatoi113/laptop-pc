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
use App\Repositories\CategoryOption\CategoryOptionRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryOptionController extends Controller
{
    /**
     * @var CategoryOptionRepositoryInterface|\App\Repositories\Repository
     * @var CategoryRepositoryInterface|\App\Repositories\Repository
     */
    protected $categoryOptionRepository;
    protected $categoryRepository;

    public function __construct(
            CategoryOptionRepositoryInterface $categoryOptionRepository,
            CategoryRepositoryInterface $categoryRepository
        )
    {
        $this->categoryOptionRepository = $categoryOptionRepository;
        $this->categoryRepository = $categoryRepository;


    }
      /**
     * 
     *  @return view
     */
    public function ViewCategoryOption(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $param = '';
                if($request->search != ''){
                    $param = $request->search;
                }
                $categories = $this->categoryRepository->getAllCategoryWithCategoryOption($param);
                return view('admin.category.category_option', compact('categories'));                
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
    /**
     * 
     *  @return view
     */
    public function CreateCategoryOption()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $categories = $this->categoryRepository->show();
                return view('admin.category.add_category_option', compact('categories'));                
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
    public function AddCategoryOption(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $data = $request->all();
                $categoryOptionNames = $data['category_option_name'];
                $statuses = $data['status'];
                $categoryId = $data['category_id'];
                foreach ($categoryOptionNames as $key => $categoryOptionName) {
                    $status = $statuses[$key]; 
                    $this->categoryOptionRepository->create([
                        'category_option_name' => $categoryOptionName,
                        'status' => $status,
                        'category_id' => $categoryId,
                    ]);
                }
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
    public function DeleteCategoryOption($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $this->categoryOptionRepository->delete($id);
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
     * @param  $id,Request $request
     * @return redirect
    */
    public function UpdateCategoryOption(Request $request ,$id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $category = $this->categoryOptionRepository->update($id,$request->all());
                return redirect()->back();

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
    
}
