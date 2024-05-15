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
use App\Repositories\Brand\BrandRepositoryInterface;

class BrandController extends Controller
{
    /**
     * @var BrandRepositoryInterface|\App\Repositories\Repository
     */
    protected $brandRepo;

    public function __construct(BrandRepositoryInterface $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }
    /**
     * 
     *  @return view
     */
    public function ViewBrand()
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
    public function AddBrand(Request $request)
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
    public function DeleteBrand($id)
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
    public function EditBrand($id)
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
    public function UpdateBrand(Request $request ,$id)
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
     *  @return view
     */
    public function CreateBrand()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $data = $this->brandRepo->show();
                return view('admin.brand.brand', compact('data'));
                
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
