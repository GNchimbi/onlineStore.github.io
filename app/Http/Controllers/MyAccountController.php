<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;

class MyAccountController extends Controller
{
    public function orders()
    {
        $viewData = [];
        $viewData['orders'] = Order::where('user_id', Auth::user()->getId())->latest()->get();
        foreach ($viewData['orders'] as $order) {
            $viewData['items'] = $order->getItems();
            $order['created_at'] = $order->getCreatedAt();
            foreach($viewData['items'] as $item){
                $item['name'] = $item->getProduct()->getName();
                $item['image'] = $item->getProduct()->getImage();
                $item['product_id'] = $item->getProduct()->getId();
            }
        }
        return Inertia::render('Myaccount/Orders', [
            'orders' => $viewData,
        ]);
    }
}
