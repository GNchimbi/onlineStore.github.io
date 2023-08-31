<?php 
namespace App\Interfaces;

interface ProductRepositoryInterface 
{
    public function all($query);
    public function find($id);
}
?>