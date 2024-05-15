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
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class ProductController extends Controller
{
     /**
     * @var ProductRepositoryInterface|\App\Repositories\Repository
     */
    protected $productRepo;
    protected $categoryRepo;

    public function __construct(ProductRepositoryInterface $productRepo,CategoryRepositoryInterface $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * 
     *  @return view
     */
    public function AddProduct(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $data = $request->all();
                $category = $this->productRepo->create($data);
                Alert::success('Product Added Successfully!', 'You have added a new product');
                return redirect()->back()->with('message', 'Category Added Successfully');
                // $image = $request->image;
                // $imageName = time() . '.' . $image->getClientOriginalExtension();
                // $request->image->move('products_images', $imageName);
                // $product->image = $imageName;
                // $product->save();
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
        
    }

    public function ViewProduct()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {
                $categories = Category::all();
                return view('admin.product.add_product', compact('categories'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }

    }

    public function ShowProduct()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $products = Product::orderBy('id', 'desc')->get();
                return view('admin.show_product', compact('products'));

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
        
    }

    public function DeleteProduct($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $product = Product::find($id);
                $product->delete();
                return redirect()->back()->with('message', 'The Product has been deleted successfully');

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
        
    }

    public function EditProduct($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $product = Product::find($id);
                $categories = Category::all();
                return view('admin.edit_product', compact('product'));

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    
    }

    public function UpdateProduct(Request $request, $id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $product = Product::find($id);
                $product->title = $request->title;
                $product->category = $request->category;
                $product->quantity = $request->quantity;
                $product->price = $request->price;
                $product->discount_price = $request->discount_price;
                $product->screen_size = $request->screen_size;
                $product->screen_resolution = $request->screen_resolution;
                $product->screen_refresh_rate = $request->screen_refresh_rate;
                $product->device_weight = $request->device_weight;
                $product->graphics_type = $request->graphics_type;
                $product->graphics_card_memory = $request->graphics_card_memory;
                $product->ssd_capacity = $request->ssd_capacity;
                $product->operating_system = $request->operating_system;
                $product->processor = $request->processor;
                $product->processor_generation = $request->processor_generation;
                $product->processor_type = $request->processor_type;
                $product->processor_speed = $request->processor_speed;
                $product->ram = $request->ram;
                $product->keyboard = $request->keyboard;
                $product->color = $request->color;

                if ($request->hasFile('image')) {
                    $image = $request->image;
                    @unlink(public_path('products_images/' . $product->image));
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $request->image->move('products_images', $imageName);
                    $product->image = $imageName;
                } else {
                    $product->image = $product->image;
                }
                $product->save();

                Alert::success('Successfully Updated', 'The product has been successfully updated!');
                return redirect()->route('admin.show_product');

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
        
    }

    public function SearchProduct(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $searchText = $request->search;
                $products  = Product::where('title','LIKE',"%$searchText%")->orWhere('ram', 'LIKE', "%$searchText%")->orWhere('category', 'LIKE', "%$searchText%")->get();
                return view('admin.show_product', compact('products'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function ViewProductCategoryOptionJson($id) {

        $category = $this->categoryRepo->getCategoryOptionWithCategoryById($id);
        return response()->json($category);
    }
}
