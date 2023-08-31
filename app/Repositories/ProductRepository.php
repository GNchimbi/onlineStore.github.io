<?php
namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;
    public function __construct(Product $product){
        $this->model = $product;
    }

    public function all($query)
    {
        if($query !== true){
            return $this->model->where('id', $query)
                ->orWhere('name', 'LIKE', '%'. $query .'%')
                ->orWhere('price', 'LIKE', '%'. $query .'%')
                ->get();
        }
        else{
            return $this->model->all();
        }
        
    }
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
}
?>