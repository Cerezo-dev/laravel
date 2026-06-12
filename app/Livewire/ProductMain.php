<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductMain extends Component
{
    public function render(){
        $productos=Product::paginate();
        return view('livewire.product-main',compact('productos'));
    }
}
