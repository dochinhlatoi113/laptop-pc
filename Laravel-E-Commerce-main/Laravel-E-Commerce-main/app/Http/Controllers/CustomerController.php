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

class CustomerController extends Controller
{
    public function Customers()
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $users = User::where('userType','=',0)->get();
                return view('admin.customers',compact('users'));

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function DeleteUser($id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                User::where('id','=',$id)->delete();
                Cart::where('user_id','=',$id)->delete();
                Order::where('user_id','=',$id)->delete();

                return redirect()->back();

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function SearchUser(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $searchText = $request->search;
                $users  = User::where('name', 'LIKE', "%$searchText%")->orWhere('email', 'LIKE', "%$searchText%")->get();
                return view('admin.customers', compact('users'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
