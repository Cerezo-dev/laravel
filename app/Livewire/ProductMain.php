<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Flux\Flux;
use Livewire\WithPagination;

class ProductMain extends Component{
    use WithPagination;

    public $search,$descripcion,$id;
    public $productSelectedId = null;

    #[Validate('required')]
    public $nombre,$cantidad,$precio,$disponible;

    public function render(){
        $productos=Product::where('nombre','LIKE','%'.$this->search.'%')
        ->latest()->paginate();
        return view('livewire.product-main',compact('productos'));
    }

    public function save(){
        $this->validate();
        if(!$this->id){
            Product::create([
                'nombre'=>$this->nombre,
                'descripcion'=>$this->descripcion,
                'cantidad'=>$this->cantidad,
                'precio'=>$this->precio,
                'disponible'=>$this->disponible
            ]);
            Flux::toast(
                heading: 'Producto registrado.',
                text: 'El registro se realizo correctamente.',
                variant: 'success'
            );
        }else{
            $producto=Product::find($this->id);
            $producto->update([
                'nombre'=>$this->nombre,
                'descripcion'=>$this->descripcion,
                'cantidad'=>$this->cantidad,
                'precio'=>$this->precio,
                'disponible'=>$this->disponible
            ]);
            Flux::toast(
                heading: 'Producto actualizado.',
                text: 'El registro se actualizo correctamente.',
                variant: 'success'
            );
        }

        $this->modal('showform')->close();
    }

    public function edit(Product $item){
        $this->id=$item->id;
        $this->nombre=$item->nombre;
        $this->descripcion=$item->descripcion;
        $this->cantidad=$item->cantidad;
        $this->precio=$item->precio;
        $this->disponible=$item->disponible;
        $this->modal('showform')->show();
    }

    public function create(){
        $this->reset(['id','nombre','descripcion','cantidad','precio','disponible']);
        $this->modal('showform')->show();
    }

    public function openUpload(Product $item){
        $this->productSelectedId = $item->id;
        $this->modal('showUpload')->show();
    }

    #[On('image-uploaded')]
    public function onImageUploaded(){
        $this->modal('showUpload')->close();
    }

    public function confirm(Product $item){
        $this->id=$item->id;
        $this->modal('delete-profile')->show();
    }

    public function delete(){
        $producto=Product::find($this->id);
        /*
        $producto->update([
            'disponible'=>false //Soft delete
        ]);*/
        $producto->delete(); //hard delete
        Flux::toast(
            heading: 'Producto eliminado.',
            text: 'El registro se borró correctamente.',
            variant: 'success'
        );
        $this->modal('delete-profile')->close();
    }

    public function updatingSearch(): void{
        $this->resetPage();
    }
}
