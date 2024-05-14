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

class OrderController extends Controller
{

    public function UserOrders()
    {
        if(Auth::check()){
            $userType = Auth::user()->usertype;
            if($userType == 1){

                $orders = Order::where('delivery_status', '!=', 'passive_order')->get();
                return view('admin.orders', compact('orders'));

            }else{
                return redirect('login');
            }
        }else{
            return redirect('login');
        }
    }

    public function UpdateOrder($user_id, $order_id,$delivery_status)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $order = Order::where('user_id', $user_id)->where('id', $order_id)->first();
                
                if($order){
                    // the order was found, update the delivery status
                    if($delivery_status == 'cancel_order'){
                        $product = Product::find($order->product_id);
                        if ($product) {
                            // Update the quantity of the product in the products table
                            $product->quantity += $order->quantity;
                            $product->save();

                            // Remove the product from the cart
                            $order->delete();

                            return redirect()->back();
                        } else {
                            return redirect()->back()->with('error', 'Product not found!');
                        }
                    }else{
                        $order->delivery_status = $delivery_status;
                        $order->save();
                        return redirect()->back();
                    }
                }else{
                    return redirect()->back();
                }
                
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }

    public function PrintBill($order_id)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $order = Order::where('id', $order_id)->first();

                if ($order) {
                    
                    $pdf = PDF::loadView('admin.user_bill', compact('order'));
                    return $pdf->download('order_bill'.$order->id.'.pdf');

                } else {
                    return redirect()->back();
                }

            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }


    public function SearchOrder(Request $request)
    {
        if (Auth::check()) {
            $userType = Auth::user()->usertype;
            if ($userType == 1) {

                $searchText = $request->search;
                $orders  = Order::where('tracking_id', 'LIKE', "%$searchText%")->where('delivery_status', '!=', 'passive_order')->get();
                return view('admin.orders', compact('orders'));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('login');
        }
    }
}
