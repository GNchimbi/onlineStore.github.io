<?php

namespace App\Http\Controllers;

use inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;


class AdminOrderController extends Controller
{
    public function index(){
        return Inertia::render('Admin/Orders/Index', [
            'orders' => Order::with(['items.product', 'user'])->get(),
        ]);
    }
    public function show($id){
        return Inertia::render('Admin/Orders/Show', [
            'items' => Item::with('product:id,name,image,description')
            ->where('order_id', $id)->get(),
        ]);
    }
}
