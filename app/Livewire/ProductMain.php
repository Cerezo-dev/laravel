<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ProductMain extends Component {

public $search, $descripcion;

#[Validate('required|min:4')]
public $nombre;
#[Validate('required')]
public $disponible;
#[Validate('required|numeric|min:1')]
public $cantidad, $precio;

    public function render(){
        $productos=Product::where('nombre', 'LIKE', '%'.$this->search. '%') -> paginate();
        return view('livewire.product-main',compact('productos'));
    }

    public function save(){
        $this->validate();
        Product::create([
        'nombre'=>$this->nombre,
        'descripcion'=>$this->descripcion,
        'cantidad'=>$this->cantidad,
        'precio'=>$this->precio,
        'disponible'=>$this->disponible

        ]);
    }
}
