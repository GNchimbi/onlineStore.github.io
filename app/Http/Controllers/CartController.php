<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
use App\Models\Order;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index(Request $request)
    {
        $total = 0;
        $productIncart = [];
        $productsInSession = $request->session()->get('products');
        if($productsInSession){
            $productIncart = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($productIncart, $productsInSession);
        }

        $viewData = [];
        $viewData['title'] = 'Programming';
        $viewData['total'] = $total;
        $viewData['products'] = $productIncart;
        $viewData['sessions'] = $productsInSession;
        return Inertia::render('Cart/Index', [
            'products' => $viewData,
        ]);
    }

    public function add(Request $request, $id)
    {
        $products = $request->session()->get('products');
        $products[$id] = $request->quantity;
        $request->session()->put('products', $products);
        return redirect()->route('cart.index');
    }

    public function delete(Request $request)
    {
        $request->session()->forget('products');
        return back();
    }
    public function purchase(Request $request)
    {
        $productsInSession = $request->session()->get('products');
        if($productsInSession){
            $userId = Auth::user()->getId();
            $order = new Order();
            $order->setUserId($userId);
            $order->setTotal(0);
            $order->save();

            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];
                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();
                $total = $total + ($product->getPrice()*$quantity);
            }
            $order->setTotal($total);
            $order->save();

            $newBalance = Auth::user()->getBalance() - $total;
            Auth::user()->setBalance($newBalance);
            Auth::user()->save();

            $request->session()->forget('products');
            
            $viewData = [];
            $viewData["order"] = $order;
            

        }else{
            return redirect()->route('cart.index');
        }

        return redirect()->route('myaccount.orders')->with('message', 'Wow! purchase done successful');
        
    }
}
